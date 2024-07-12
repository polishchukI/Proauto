<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Inventory\Currency;

use App\Models\Inventory\Provider;
use App\Models\Inventory\ProviderPrice;
use App\Models\Inventory\ProviderPriceColumn;

use App\Http\Requests\ProviderRequest;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ProviderController extends Controller
{
    public function index(Provider $model)
    {
        $providers = Provider::paginate(25);

        return view('inventory.providers.index', compact('providers'));
    }

    public function create()
    {
        return view('inventory.providers.create');
    }

    public function store(ProviderRequest $request, Provider $provider_model)
    {
        $provider = $provider_model->create($request->all());

		if($request->hasprice)
		{
			return redirect()
				->route('providers.edit', ['provider' => $provider->id])
				->withStatus('Product registered successfully.');
		}
		else
		{
			return redirect()
				->route('providers.index')
				->withStatus('Successfully Registered Vendor.');
		}
    }

    public function edit(Provider $provider)
    {
		$currencies = Currency::pluck('code')->all();
		$columns_settings = [];
		$columns = $this->getcolumns($provider->id);
		$pricefiles = $this->get_price_files();
		$webscriptfiles = $this->get_webscript_files();
        return view('inventory.providers.edit', compact('provider','currencies','pricefiles','webscriptfiles','columns'));
    }

    public function show(Provider $provider)
    {
        $transactions = $provider->transactions()->latest()->limit(50)->get();

        $receipts = $provider->receipts()->latest()->limit(50)->get();

        $to_provider_orders = $provider->to_provider_orders()->latest()->limit(50)->get();

        return view('inventory.providers.show', compact('provider', 'transactions', 'receipts','to_provider_orders'));
    }

    public function update(ProviderRequest $request, Provider $provider)
    {
        $provider->update($request->all());

        return redirect()
            ->route('providers.index')
            ->withStatus('Provider updated successfully.');
    }

    public function destroy(Provider $provider)
    {
        $provider->delete();

        return redirect()
            ->route('providers.index')
            ->withStatus('Provider removed successfully.');
    }
	//price section
	public function upload_price(Request $request)
	{
		$file = $request->file('file');

		if ($file)
		{
			$filename = $file->getClientOriginalName();
			$path = $request->file('file')->move('../storage/app/prices', $filename);
		}
		else
		{
			$error = 'File error';
			return response()->json($error);
		}
		
		if($path)
		{
			return response()->json($filename);
		}
	}
	
	public function delete_prices(Request $request)
	{
		$provider_code = $request->provider_code;
		// dd(compact('provider_code'));
		$DeletedOld = ProviderPrice::where('provider_code', $provider_code)->delete();

		return redirect()->back();
	}
	
    public function getcolumns($id)
	{
		$provider_id = intval($id);
		$columns = [];
		if($provider_id > 0)
		{
			$settings = ProviderPriceColumn::where('provider_id','=', $provider_id)->orderBy('field_number','ASC')->get();
			foreach($settings as $column)
			{
				$columns[] = ["id"=>$column->id,"provider_id"=>$column->provider_id, "field_number"=>$column->field_number, "field_type"=>$column->field_type];
			}
		}
		return $columns;
	}
	
    public function save_column_settings(Request $request, $id)
	{
		$fields = $request->fields;
		$fields_type = $request->fields_type;
		$provider_id = intval($request->id);
		foreach($fields as $id => $field_number)
		{
			if($field_number>0 AND $fields_type[$id] != "")
			{
				ProviderPriceColumn::updateOrCreate(["provider_id" => $provider_id,"field_number" => $field_number], ["field_type"=>$fields_type[$id]]);
			}
		}
		return back()->with('flash_message', 'Price settings updated!');
	}
	
	public function get_price_files()
	{		
		$pricefiles = [];
		
		$price_directory = "../storage/app/prices";
		if (!file_exists($price_directory))
		{
			mkdir($price_directory, 0777, true);
		}
		if ($price_directory = opendir("../storage/app/prices"))
		{
			while (false !== ($price_file = readdir($price_directory)))
			{
				if (!($price_file != "." && $price_file != ".."))
				{
					continue;
				}
				$pricefiles[] = $price_file;
			}
			closedir($price_directory);
		}	
		
        return $pricefiles;
    }
	
	public function get_webscript_files()
	{
		$scripts = [];
		
		if ($scripts_directory = opendir("../app/Http/Controllers/WS"))
		{
			while (false !== ($file = readdir($scripts_directory)))
			{
				if (!($file != "." && $file != ".."))
				{
					continue;
				}
				if (!(0 < strpos($file, ".php")))
				{
					continue;
				}
				$script_file = str_replace(".php", "", $file);
				$scripts[] = $script_file;
			}
			closedir($scripts_directory);
		}
        return $scripts;
    }
}
