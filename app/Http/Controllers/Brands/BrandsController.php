<?php

namespace App\Http\Controllers\Brands;

use Carbon\Carbon;

use App\Models\Brand\Brand;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

use App\Http\Controllers\FunctionsController as Functions;

class BrandsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        if (!empty($keyword))
		{
            $brands = Brand::where('brand', 'LIKE', "%$keyword%")
				->orwhere('bkey', 'LIKE', "%$keyword%")
				->paginate(25);
        }
		else
		{
            $brands = Brand::paginate(25);
        }
        return view('inventory.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('inventory.brands.create');
    }

    public function store(Request $request, Brand $brand)
    {
        $this->validate($request, [
			'brand' => 'required'
		]);
        $requestData = $request->all();
        
        $bkey = Functions::SingleKey($request->brand,true);
        $brand_check = Brand::where('bkey','=', $bkey)->first();
        
        if(!$brand_check)
		{
            $requestData['bkey']        = $bkey;
            $requestData['brand']       = Str::upper($request->brand);
            $requestData['slug']        = Str::slug($request->brand);
            $requestData['logo']        = Str::slug($request->brand);
            
            $brand->create($requestData);
            
            return redirect()->route('brands.index')->withStatus('Successfully registered brand.');
        }
        else
        {
            return redirect()->route('brands.edit', ['brand' => $brand_check])->withStatus('Item already exists.');
        }
    }
    
    public function edit(Brand $brand)
    {
        return view('inventory.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $requestData = $request->all();
        
        $requestData['brand']           = Str::upper($request->brand);
        $requestData['bkey']            = Functions::SingleKey($request->brand,true);
		$requestData['slug']            = Str::slug($request->brand);
		$requestData['logo']            = Str::slug($request->brand);
        
        $brand->update($requestData);

        return redirect()->back()->withStatus('Successfully modified brand.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()->route('brands.index')->withStatus('Brand successfully removed.');
    }
	
	public function createforbrand()
	{
		return view('editor');
	}
	
	public function uploadforbrand(Request $request)
	{
		if($request->hasFile('upload'))
		{
			$originName                 = $request->file('upload')->getClientOriginalName();
			$fileName                   = pathinfo($originName, PATHINFO_FILENAME);
			$extension                  = $request->file('upload')->getClientOriginalExtension();
			$fileName                   = $fileName.'-'.time().'.'.$extension;
			$request->file('upload')->move(public_path('images/brandtextimg'), $fileName);
			$CKEditorFuncNum            = $request->input('CKEditorFuncNum');
			$url                        = asset('images/brandtextimg/'.$fileName);
			$response                   = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url')</script>";
			echo $response;
		}
	}

    //service function
    public static function update_bkeys(Request $request)
    {
		$brands = Brand::all();
        foreach($brands as $brand)
        {
            $brand_id           = $brand->id;
            $bkey               = Functions::SingleKey($brand['brand']);
            $slug               = Str::slug($brand['brand']);
            Brand::where('id', $brand_id)->update(['bkey' => $bkey, 'slug' => $slug]);
        }
		return back();
    }
}