<?php
/*
			"FEDERALMOGUL" => "AE",
			"SALERISIL" => "SIL",
			"GENUINE" => "GENERALMOTORS",
			"METELLICIFAM" => "METELLI",//??
			"NPS" => "NIPPONPIECES",//??
*/
namespace App\Http\Controllers\Brands;

use Illuminate\Http\Request;

use App\Models\Brand\BrandRename;

use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionsController as Functions;

class BrandRenamesController extends Controller
{
    public function index()
    {
        $brand_renames = BrandRename::all();

        return view('inventory.brand_renames.index', compact('brand_renames'));
    }
    
    public function create()
    {
        return view('inventory.brand_renames.create');
    }

    public function store(Request $request, BrandRename $brand_rename)
    {
        $this->validate($request, [
			'name' => 'required'
		]);
        
        $requestData['name']                        = Str::upper($request->name);
        $requestData['bkey']                        = $this->clear_bkey($request->name);
        $requestData['rename_from']                 = Str::upper($request->rename_from);
        $requestData['rename_from_bkey']            = $rename_from_bkey = $this->clear_bkey($request->rename_from);
        $requestData['rename_to']                   = Str::upper($request->rename_to);
        $requestData['rename_to_bkey']              = $rename_to_bkey = $this->clear_bkey($request->rename_to);
        $requestData['user_id']                     = $request->user_id;
        $requestData['comment']                     = $request->comment;
        
        $rename_check   = BrandRename::where('rename_from_bkey','=', $rename_from_bkey)->where('rename_to_bkey','=', $rename_to_bkey)->first();
        
        if(!$rename_check)
		{
            $brand_rename->create($requestData);

            return redirect()->route('brand_renames.index')->withStatus('Successfully registered item.');
        }
        else
        {
            return redirect()->route('brand_renames.index')->withStatus('Item already exists.');
        }
    }
    
    public function edit(BrandRename $brand_rename)
    {
        return view('inventory.brand_renames.edit', compact('brand_rename'));
    }

    public function update(Request $request, BrandRename $brand_rename)
    {
        $this->validate($request, [
			'name' => 'required'
		]);
        
        $requestData['name']                        = Str::upper($request->name);
        $requestData['bkey']                        = $this->clear_bkey($request->name);
        $requestData['rename_from']                 = Str::upper($request->rename_from);
        $requestData['rename_from_bkey']            = $rename_from_bkey = $this->clear_bkey($request->rename_from);
        $requestData['rename_to']                   = Str::upper($request->rename_to);
        $requestData['rename_to_bkey']              = $rename_to_bkey = $this->clear_bkey($request->rename_to);
        $requestData['user_id']                     = $request->user_id;
        $requestData['comment']                     = $request->comment;
        
        $brand_rename->update($requestData);
        
        return redirect()->route('brand_renames.index')->withStatus('Successfully registered brand.');

    }

    public function clear_bkey($value)
    {
		$value = Str::upper(trim($value));
		$value = str_replace("Ї", "I", $value);
		$value = str_replace("Ë", "E", $value);
		$value = str_replace("Ö", "O", $value);
		$value = str_replace("Ò", "O", $value);
		$value = str_replace("Ä", "A", $value);
		$value = str_replace("Ã", "A", $value);
		$value = str_replace("Ü", "U", $value);
		$value = str_replace("O'", "O", $value);
		$value = str_replace("№", "", $value);
		$value = preg_replace("/[^A-ZА-ЯІЇЄҐ0-9a-zа-яіїєґ]/u", "", $value);
        return $value;
    }
    public function destroy(BrandRename $brand_rename)
    {
        $brand_rename->delete();

        return redirect()->route('brand_renames.index')->withStatus('Item successfully removed.');
    }


}
