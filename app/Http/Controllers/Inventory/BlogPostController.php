<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use App\Models\Blog\Category;

use App\Http\Requests;
use Illuminate\Support\Str;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;

use App\Http\Controllers\Controller;

class BlogPostController extends Controller
{
	public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword))
		{
            $blog_posts = Post::where('title', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        }
		else
		{
            $blog_posts = Post::latest()->paginate($perPage);
        }
        
        return view('inventory.blog_posts.index', compact('blog_posts'));
    }

    public function create(Request $request)
    {
		$tags = Tag::get()->pluck('name', 'id');
		$categories = Category::get()->pluck('title', 'id');
        
		return view('inventory.blog_posts.create', compact('tags','categories'));
    }

    public function store(StorePostsRequest $request)
    {
        $this->validate($request, [
            'title' => 'required',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $requestData = $request->all();
		
		$requestData['slug'] = Str::slug($request['title'], "-");
		$requestData['author_id'] = $request->user()->id;
		$requestData['category_id'] = (int)$request->category;
		
		if ($request->hasfile('image'))
		{
			$image = $request->file('image');
			$filename = $requestData['slug'] . '.' . $image->getClientOriginalExtension();
			$request->file('image')->move(public_path('images/posts'), $filename);
			$requestData['image'] = '/images/posts/' . $filename;
		}

		$blog_post = Post::create($requestData);
		$blog_post->tag()->sync((array)$request->input('tag'));
		
		///////////////////////////////
		// $text					= $_SERVER['HTTP_HOST'] . '/blog/' . $blog_post->slug;
		// $TelegramBotController	= new TelegramBotController;
		// $TelegramBotController->sendMessage(config('telegram.telegram_channel_id'), $text);
		///////////////////////////////

        return redirect()->route('blog_posts.index')->withStatus('Post successfully removed.');
    }

    public function show($id)
    {
        $blog_post = Post::findOrFail($id);

        return view('inventory.blog_posts.show', compact('blog_post'));
    }

    public function edit(Request $request, $id)
    {
		$tags = Tag::get()->pluck('name','id');
		$categories = Category::get()->pluck('title', 'id');
        $blog_post = Post::findOrFail($id);
		
		$requestData['slug'] = Str::slug($request['title'], "-");
        
        return view('inventory.blog_posts.edit', compact('blog_post','tags','categories'));
    }

    public function update(UpdatePostsRequest $request, $id)
    {
		$blog_post = Post::findOrFail($id);

        $this->validate($request, [
            'title' => 'required',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $requestData = $request->all();
        // dd(compact('requestData'));
		
		$requestData['slug'] = Str::slug($request['title'], "-");
		$requestData['author_id'] = $request->user()->id;
		$requestData['category_id'] = $request->category;
		
		if ($request->hasfile('image'))
		{
			$image = $request->file('image');
			$filename = $requestData['slug'] . '.' . $image->getClientOriginalExtension();
			$request->file('image')->move(public_path('images/posts'), $filename);
			$requestData['image'] = '/images/posts/' . $filename;
		}
		
		$blog_post->tag()->sync((array)$request->input('tag'));
        
        $blog_post->update($requestData);
		
        return redirect()->route('blog_posts.index')->withStatus('Post successfully updated.');
    }

    public function destroy($id)
    {
        Post::destroy($id);

        return redirect()->route('blog_posts.index')->withStatus('Post successfully deleted.');
    }
}
