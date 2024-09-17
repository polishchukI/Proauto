<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Requests;

use App\Models\Blog\Tag;

use Illuminate\Support\Str;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class BlogTagsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword))
		{
            $blog_tags = Tag::where('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        }
		else
		{
            $blog_tags = Tag::paginate($perPage);
        }

        return view('inventory.blog_tags.index', compact('blog_tags'));
    }
	public function create()
    {
        return view('inventory.blog_tags.create');
    }
	
	public function store(Request $request)
    {
        
		$this->validate($request, [
            'name' => 'required'
        ]);
        
        $requestData = $request->all();
		$requestData['slug'] = Str::slug($request['name'], "-");
        
        Tag::create($requestData);

        return redirect()->route('blog_tags.index')->withStatus('Tag added!');
    }
	
	public function show($id)
    {
        $tag = Tag::findOrFail($id);

        return view('inventory.blog_tags.show', compact('tag'));
    }
	
	public function edit($id)
    {
        $tag = Tag::findOrFail($id);

        return view('inventory.blog_tags.edit', compact('tag'));
    }
	
	public function update(Request $request, $id)
    {
		$this->validate($request, [
            'name' => 'required'
        ]);
        
        $requestData = $request->all();
		$requestData['slug'] = Str::slug($request['name'], "-");
        
        $tag = Tag::findOrFail($id);
        $tag->update($requestData);

        // return redirect('inventory/blog_tags')->withStatus('Tag updated!');
        return redirect()->route('blog_tags.index')->withStatus('Tag updated!');
    }
	
	public function destroy($id)
    {
        Tag::destroy($id);

        return redirect()->route('blog_tags.index')->withStatus('Receipt successfully removed.');
    }
}
