<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CkeditorController extends Controller
{
	//////////blog posts
	public function create()
	{
		return view('editor');
	}
	
	public function upload(Request $request)
	{
		if($request->hasFile('upload'))
		{
			$originName = $request->file('upload')->getClientOriginalName();
			$fileName = pathinfo($originName, PATHINFO_FILENAME);
			$extension = $request->file('upload')->getClientOriginalExtension();
			$fileName = $fileName.'-'.time().'.'.$extension;
			$request->file('upload')->move(public_path('images/posts'), $fileName);
			$CKEditorFuncNum = $request->input('CKEditorFuncNum');
			$url = asset('images/posts/'.$fileName);
			$response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url')</script>";
			echo $response;
		}
	}
}
