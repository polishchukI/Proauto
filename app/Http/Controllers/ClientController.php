<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Support\Str;

use Illuminate\Http\Request;

use App\Http\Requests\ClientRequest;

use App\Models\Client\Client;
use App\Models\Client\ClientPhone;
use App\Models\Client\ClientAuto;
use App\Models\Client\ClientAddress;
use App\Models\Client\ClientAutoColor;

use App\Models\Inventory\Sale;
use App\Models\Inventory\Transaction;
use App\Models\Inventory\PaymentMethod;

use App\Http\Controllers\Tecdoc\NewTecdocController;
use App\Models\Catalog\CatalogGroup;
use App\Http\Controllers\Catalog\CatalogController;


class ClientController extends Controller
{
    public function index(Request $request)
    {
		$keyword = $request->get('search');
        if (!empty($keyword))
		{
            $clients = Client::select('clients.*')
					->where('clients.name', 'LIKE', "%$keyword%")
					->orwhere('clients.comment', 'LIKE', "%$keyword%")
					->paginate(25)
					->withQueryString();
        }
		else
		{
			$clients = Client::paginate(25);
        }

        
        return view('inventory.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('inventory.clients.create');
    }

    public function store(ClientRequest $request, Client $client)
    {
        $requestData						= $request->all();
		$requestData['product_discount']	= $request->product_discount ?? 0;
		$requestData['service_discount']	= $request->service_discount ?? 0;
		$requestData['name']				= $request->lastname." ".$request->firstname." ".$request->secondname;
		$requestData['created_at']			= Carbon::now();
		$requestData['notified_at']			= Carbon::now();
		// dd(compact('requestData'));

        $client								= $client->create($requestData);
        
        return redirect()->route('clients.edit', ['client' => $client->id])->withStatus('Данные клиента успешно зарегистрированы!');
    }

    public function show(Client $client)
    {
        return view('inventory.clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
		$colors = $this->getColors();
		$cataloggroups = CatalogGroup::where('isactive','=','True')->get();
		
        return view('inventory.clients.edit', compact('client','colors','cataloggroups'));
    }

    public function update(ClientRequest $request, Client $client)
    {
		$requestData			= $request->all();
		$requestData['name']	= $request->lastname." ".$request->firstname." ".$request->secondname;
        $client					= $client->update($requestData);

        return redirect()->route('clients.index')->withStatus('Данные клиента успешно обновлены!');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')->withStatus('Данные клиента успешно удалены!');
    }

    public function client_auto_service_parts(ClientAuto $clientauto)
    {
		return view('inventory.clients.transactions.add', compact('clientauto'));
    }
	
	public function getColors()
    {
		$colors = ClientAutoColor::get();
        return $colors;
    }
	
	//phone
	public static function addphone(Request $request)
	{
		$edit = "false";
		$client_id = (int)$request->client_id;		
		
		return view('inventory.clients.addphone', compact('client_id','edit'));
	}

	public function addphone_store(Request $request, ClientPhone $clientphone)
    {
		$requestData['client_id']			= (int)$request->client_id;
		$requestData['phone']				= $request->phone;
		$requestData['telegram']			= (int)$request->telegram ?? intval(0);
		$requestData['viber']				= (int)$request->viber ?? intval(0);
		$requestData['whatsapp']			= (int)$request->whatsapp ?? intval(0);
		$requestData['default']				= (int)$request->default ?? intval(0);
		$requestData['comment']				= $request->comment ?? "";
		$requestData['created_at']			= Carbon::now();

		$clientphone = $clientphone->create($requestData);

		if(strlen($clientphone->phone) == 12)
		{
			$phoneRespose = substr($clientphone->phone, 0, 2).' ('.substr($clientphone->phone, 2, 3).') '.substr($clientphone->phone, 5, 3).' '.substr($clientphone->phone, 8, 2).' '.substr($clientphone->phone, 10, 2);
		}
		elseif(strlen($clientphone->phone) == 13)
		{
			$phoneRespose = substr($clientphone->phone, 0, 3).' ('.substr($clientphone->phone, 3, 3).') '.substr($clientphone->phone, 6, 3).' '.substr($clientphone->phone, 9, 2).' '.substr($clientphone->phone, 11, 2);
		}
		// dd(compact('phoneRespose'));
		return response()->json([
			'status'  => 1 , 
			'message' => ['Телефон добавлен', 'success'],
			'info'    => [
				'client_id'			=> $clientphone->client_id,
				'phone_id'			=> $clientphone->id,
				'phone'				=> $phoneRespose,
				'telegram'			=> $clientphone->telegram,
				'viber'				=> $clientphone['viber'],
				'whatsapp'			=> $clientphone['whatsapp'],
				'default'			=> $clientphone['default'],
				'comment'			=> $clientphone['comment'],
			],
		]);
    }
	
	public static function edit_phone(Request $request)
	{
		$edit = "true";
		$client_id = $request->client_id;
		$phone_id = $request->phone_id;
		
		$phone = ClientPhone::where('client_id','=',$client_id)->where('id','=',$phone_id)->first()->toArray();

		return view('inventory.clients.addphone', compact('client_id','phone_id','phone','edit'));
	}
	
	public static function editphone_store(Request $request, ClientPhone $clientphone)
    {
		$client_id						= $request->client_id;
		$phone_id						= $request->phone_id;

		$item = ClientPhone::where('client_id','=',$client_id)->where('id','=',$phone_id)->get()->first();

		if ($item)
		{
			$item = $item->update([
				'phone'			=> $request->phone,
				'telegram'		=> $request->telegram ?? intval(0),
				'viber'			=> $request->viber ?? intval(0),
				'whatsapp'		=> $request->whatsapp ?? intval(0),
				'default'		=> $request->default ?? intval(0),
				'comment'		=> $request->comment ?? "",
				'updated_at'	=> Carbon::now(),
			]);

			$item = ClientPhone::where('client_id','=',$client_id)->where('id','=',$phone_id)->get()->first();
			if(strlen($item->phone) == 12)
			{
				$phoneRespose = substr($item->phone, 0, 2).' ('.substr($item->phone, 2, 3).') '.substr($item->phone, 5, 3).' '.substr($item->phone, 8, 2).' '.substr($item->phone, 10, 2);
			}
			elseif(strlen($item->phone) == 13)
			{
				$phoneRespose = substr($item->phone, 0, 3).' ('.substr($item->phone, 3, 3).') '.substr($item->phone, 6, 3).' '.substr($item->phone, 9, 2).' '.substr($item->phone, 11, 2);
			}

			if ($item) {
				return response()->json([
					'status'  => 1 , 
					'message' => ['Обновлен', 'success'],
					'info'    => [
							'phone_id'    	=> $item->id,
							'phone'			=> $phoneRespose,
							'telegram'		=> $item->telegram ?? intval(0),
							'viber'			=> $item->viber ?? intval(0),
							'whatsapp'		=> $item->whatsapp ?? intval(0),
							'default'		=> $item->default ?? intval(0),
							'comment'		=> $item->comment ?? "",
					],
				]);
			}
        }
    }

	public function phone_delete(Request $request)
    {
		if (!$request->ajax())
		{
			abort('404');
		};
		
		$client_id				= (int)$request->client_id;
		$phone_id				= (int)$request->phone_id;
		
		$item = ClientPhone::where('client_id','=',$client_id)->where('id','=',$phone_id)->get()->first();
		
		if ($item)
		{
			$client = Client::find($client_id);
			if ($client)
			{
				$item = $item->delete();
				return response()->json([
					'status'  => 1 , 
					'message' => ['Удалено', 'success'],
					'info'    => [
							'phone_id'    => $phone_id,
						],
				]);
			}
		}
    }


	public function renewRregistrationDate(Request $request)
    {
		$client_id = $request->client_id;
		
		$created_at_set = Client::findOrFail($client_id)->created_at;
		if(!$created_at_set)
		{
			$created_at_new_date = Carbon::now();
			Client::where('id','=',$client_id)->update(['created_at' => $created_at_new_date]);
		}
		
		return back();
    }

	public function notifyClient(Request $request)
    {
		$client_id = $request->client_id;
		
		$notified_at_set = Client::findOrFail($client_id)->notified_at;
		if(!$notified_at_set)
		{
			$notified_at_new_date = Carbon::now();
			Client::where('id','=',$client_id)->update(['notified_at' => $notified_at_new_date]);
		}
		
		return back();
    }
	
	//addresses
	public static function addaddress(Request $request)
	{
		$edit = "false";
		$client_id = $request->client_id;		
		
		return view('inventory.clients.addaddress', compact('client_id','edit'));
	}
	
	public function addaddress_store(Request $request, ClientAddress $clientaddress)
    {
		$requestData['client_id']		= (int)$request->client_id;
		
		$requestData['zipcode']			= $request->zipcode;
		$requestData['country']			= $request->country;
        $requestData['state']			= $request->state;
		$requestData['city']			= $request->city;
		$requestData['settlement']		= $request->settlement;
		$requestData['street']			= $request->street;
		$requestData['address']			= $request->address;
		$requestData['housing']			= $request->housing;
		$requestData['apartment']		= $request->apartment;
		$requestData['comment']			= $request->comment;
		$requestData['default']			= $request->default ?? intval(0);
		$requestData['name']			= $request->city . ', ' . $request->street . ', ' . $request->address . ' / ' . $request->apartment ;
		$requestData['created_at']		= Carbon::now();
			
		$clientaddress					= $clientaddress->create($requestData);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Адресс добавлен', 'success'],
			'info'    => [
				'client_id'			=> $requestData['client_id'],
				'address_id'		=> $clientaddress->id,
				'zipcode'			=> $clientaddress->zipcode,
				'country'			=> $clientaddress->country,
				'state'				=> $clientaddress->state,
				'city'				=> $clientaddress->city,
				'settlement'		=> $clientaddress->settlement,
				'street'			=> $clientaddress->street,
				'address'			=> $clientaddress->address,
				'housing'			=> $clientaddress->housing,
				'default'			=> $clientaddress->default,
				'comment'			=> $clientaddress->comment,
			],
		]);
    }
	
	public static function edit_address(Request $request)
	{
		$client_id = $request->client_id;
		$address_id = $request->address_id;
		$address = ClientAddress::where('client_id','=',$client_id)->where('id','=',$address_id)->first()->toArray();
		$edit = "true";
		return view('inventory.clients.addaddress', compact('client_id','address_id','address','edit'));
	}
	
	public static function address_update(Request $request, ClientAddress $clientaddress)
    {
		$client_id = $request->client_id;
		$address_id = $request->address_id;
		
		$requestData['zipcode']			= $request->zipcode;
		$requestData['country']			= $request->country;
        $requestData['state']			= $request->state;
		$requestData['city']			= $request->city;
		$requestData['settlement']		= $request->settlement;
		$requestData['street']			= $request->street;
		$requestData['address']			= $request->address;
		$requestData['housing']			= $request->housing;
		$requestData['apartment']		= $request->apartment;
		$requestData['comment']			= $request->comment;
		$requestData['default']			= $request->default ?? intval(0);
		$requestData['name']			= $request->city . ', ' . $request->street . ', ' . $request->address . ' / ' . $request->apartment;
		
		$item = Clientaddress::where('client_id','=',$client_id)->where('id','=',$address_id)->get()->first();

		if ($item)
		{
			$item = $item->update([
				'zipcode'			=> $request->zipcode,
				'country'			=> $request->country,
				'state'				=> $request->state,
				'city'				=> $request->city,
				'settlement'		=> $request->settlement,
				'street'			=> $request->street,
				'address'			=> $request->address,
				'housing'			=> $request->housing,
				'apartment'			=> $request->apartment,
				'comment'			=> $request->comment,
				'default'			=> $request->default ?? intval(0),
				'name'				=> $request->city . ', ' . $request->street . ', ' . $request->address . ' / ' . $request->apartment,
				'updated_at'		=> Carbon::now(),
			]);

			if ($item) {
				return response()->json([
					'status'  => 1 , 
					'message' => ['Обновлен', 'success'],
					'info'    => [
							'address_id'    	=> $address_id,
							'zipcode'			=> $request->zipcode,
							'country'			=> $request->country,
							'state'				=> $request->state,
							'city'				=> $request->city,
							'settlement'		=> $request->settlement,
							'street'			=> $request->street,
							'address'			=> $request->address,
							'housing'			=> $request->housing,
							'apartment'			=> $request->apartment,
							'comment'			=> $request->comment,
							'default'			=> $request->default ?? intval(0),
					],
				]);
			}
        }
    }
	
	public function address_delete(Request $request)
    {
		if (!$request->ajax())
		{
			abort('404');
		};

		$client_id = $request->client_id;
		$address_id = $request->address_id;
		
		$item = Clientaddress::where('client_id','=',$client_id)->where('id','=',$address_id)->get()->first();
		
		if ($item)
		{
			$client = Client::find($client_id);
			if ($client)
			{
				$item = $item->delete();
				return response()->json([
					'status'  => 1 , 
					'message' => ['Удалено', 'success'],
					'info'    => [
							'address_id'    => $address_id,
						],
				]);
			}
		}
    }
	
	//auto
	public static function client_addauto(Request $request, ClientAuto $clientauto)
	{
		$client_id				= $request->client_id;
		$group					= $request->group;// group "passenger"
		$year					= $request->year;// year "2010"
		$manufacturer_id		= $request->manufacturer;// id "603"
		$model_id				= $request->model;// model "8041"
		$modification_id		= $request->modification;// type "7190"
		$vin					= $request->vin;
		$plate					= $request->plate;
		$color					= $request->color;
		
		$ManufacturerRequest = NewTecdocController::getManufacturerById($group, $manufacturer_id);
		
		////////////////convert
		$ManufacturerData = [];
		foreach ($ManufacturerRequest as $ManufacturerItem)
		{
			$ManufacturerData["manufacturer_id"]		= $ManufacturerItem["manufacturer_id"];
			$ManufacturerData["manufacturer_name"]		= $ManufacturerItem["manufacturer_name"];
			$ManufacturerData["brand"]					= Str::lower($ManufacturerItem["manufacturer_name"]);
		}
		$manufacturer									= $ManufacturerData["manufacturer_name"];
		//////////////////////////////////////////////

		$ModelRequest = NewTecdocController::getModelById($group, $model_id);
		////////////////convert
		$ModelData = [];
		foreach ($ModelRequest as $ModelItem)
		{
			$ModelData["model_id"]					= $ModelItem["model_id"];
			$ModelData["constructioninterval"]		= $ModelItem["constructioninterval"];
			$ModelData["model_name"]				= $ModelItem["name"];
			$ModelData["model_url"]					= FunctionsController::GetURLNameByModelID($ManufacturerData["brand"], $ModelItem["model_id"]);
		}
		////////////////////////////////////////////////
		$ModificationRequest = NewTecdocController::getModificationById($group, $modification_id);
		
		$ModificationData = [];
		foreach($ModificationRequest as $item)
		{

			$mod_id									= $item['modification_id'];
			$ModificationData						= [];
			$ModificationData["modification_id"]	= $mod_id;
			foreach($ModificationRequest as $item)
			{
				if($item['modification_id']						== $mod_id)
				{
					$ModificationData[$item['attributetype']]	= $item['displayvalue'];
				}
			}
		}
		// "passenger" => array:1 [
			// 19904 => array:15 [
				// "modification_id" => 19904
				// "ConstructionInterval" => "11.2005 - 11.2010"
				// "Power" => "97 PS"
				// "Capacity_Tax" => "0 ccm"
				// "Capacity_Technical" => "1399 ccm"
				// "Capacity" => "1.4 l"
				// "NumberOfValves" => "4"
				// "NumberOfCylinders" => "4"
				// "EngineType" => "Бензиновый двигатель"
				// "BodyType" => "седан"
				// "DriveType" => "Привод на передние колеса"
				// "FuelType" => "бензин"
				// "FuelMixture" => "Впрыскивание во впускной коллектор/Карбюратор"
				// "KBANumber" => "8252 AAA"
				// "EngineCode" => "G4EE"
			// ]
		// ]
		
		////////////////////////////////////////////////////////////////////
		$garage = new ClientAuto;
		$garage->client_id					= $client_id;
		$garage->group						= $group;
		$garage->plate						= Str::upper($plate);
		$garage->vin						= Str::upper($vin);
		$garage->year						= $year;
		$garage->year						= $year;
		$garage->color						= $color;
		$garage->model_id					= $model_id;
		$garage->modification_id			= $modification_id;
		$garage->ccm						= $ModificationData["Capacity_Technical"];

		$ModificationData["EngineCode"]		= isset($ModificationData["EngineCode"]) ? $ModificationData["EngineCode"] : "No Code";
		$ModificationData["Capacity"]		= isset($ModificationData["Capacity"]) ? Str::upper($ModificationData["Capacity"]) : "Not Specified";
		$ModificationData["BodyType"]		= isset($ModificationData["BodyType"]) ? $ModificationData["BodyType"] : "Not Specified";
		$ModificationData["FuelType"]		= isset($ModificationData["FuelType"]) ? $ModificationData["FuelType"] : "Not Specified";

		$garage->engine						= $ModificationData["EngineCode"];
		$garage->body						= $ModificationData["BodyType"];
		$garage->fuel						= $ModificationData["FuelType"];

		$name = $manufacturer . ' ' . $ModelData["model_name"] . ' ' . $ModificationData["Capacity"];
		
		if(!is_null($garage->color))
		{
			$name = $name . ' ' . $garage->color;
		}

		if(!is_null($garage->plate))
		{
			$name = $name . ' ' . $garage->plate;
		}
		$garage->name = $name . ' VIN ' . $garage->vin;
		$garage->details = 'Engine ' . $ModificationData["EngineCode"] . ' (' . $ModificationData["Capacity_Technical"] . '-' . $ModificationData["EngineType"] . ')';
		
		$garage->save();

		return redirect()->back();
	}
	
	public function client_delete_auto(Request $request)
    {
		$client_id = $request->client_id;
		$auto_id = $request->auto_id;
		ClientAuto::where('client_id','=',$client_id)->where('id','=',$auto_id)->delete();
		return back();
    }
		
	public function phones_renew_settings(Request $request)
	{
		return view('inventory.clients.renewphone');
	}
	
	public function phones_renew(Request $request)
    {
		$oldprefix = $request->oldprefix;
		$newprefix = $request->newprefix;

		$phones = ClientPhone::where('phone', 'LIKE', $oldprefix)->get()->toArray();
		foreach($phones as $item)
		{
			$new_phone = str_replace($oldprefix, $newprefix, $item["phone"]);
			ClientPhone::create(['client_id' => $item["client_id"], 'phone' => $new_phone]);
		}
		return back();
	}

	public static function clientLiveSearch(Request $request)
	{
        $search = strip_tags($request->clientLive);
		
        if ($search)
		{
            $data = Client::where('name', 'LIKE', "%${search}%")->limit(10)->get(['id', 'name']);
        }
		else
		{
            $data = Client::where('id', 'LIKE', "%%")->limit(15)->get(['id', 'name']);
        }
		
        return response()->json($data);
	}
}
