<?php

namespace App\Http\Controllers\Shop;

use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use App\Models\Blog\Comment;
use App\Models\Blog\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

//////////seo
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
//////////seo

class BlogController extends Controller
{
	///////////////////////postscarousel
	static function ShowPostsCarousel()
	{
		$posts = Post::select('blog_posts.id',
				'users.name as author',
				'blog_posts.category_id',
				'blog_posts.title',
				'blog_posts.slug',
				'blog_posts.description',
				'blog_posts.image',
				'blog_posts.created_at as created_at',
				'blog_categories.title as category',
				'blog_categories.slug as category_uri')
				->join('users', 'users.id', '=', 'blog_posts.author_id')
				->join('blog_categories', 'blog_categories.id', '=', 'blog_posts.category_id')
				->get()->toArray();
        return $posts;
	}
	
	//Blog
	public function ShowPostsPage(Request $request)
	{
		$keyword = $request->get('search');
		$perPage = 5;

        if (!empty($keyword))
		{
            $posts = Post::where('title', 'LIKE', "%$keyword%")
                ->where('active','>','0')
				->paginate($perPage);
        }
		else
		{
            $posts = Post::where('active','>','0')
				->paginate($perPage);
        }
		
		$categories = Category::get();
		$tags = Tag::get();
		$latestpost = Post::orderBy('created_at','desc')->first();
		$latestcomment = $this->LastComment($request);

		////////////////////////////////
		SEOMeta::setTitle('Блог');
		SEOMeta::setDescription('Блог');

		OpenGraph::setTitle('Блог');
        OpenGraph::setDescription('Блог');
        OpenGraph::addProperty('type', 'website');
		OpenGraph::addImage('https://proauto.shop/images/opengraph.png');

		TwitterCard::setTitle('Блог');
		TwitterCard::setSite($request->url());
		////////////////////////////////

		return view('shop.blog.blog', compact('posts','categories','tags','latestcomment', 'latestpost'));
	}
	
	//ShowPostsByCategory
	public function ShowPostsByCategory(Request $request)
	{
		$categorytitle = $request->categorytitle;
		$perPage = 5;
		$category = Category::where('slug', '=', $categorytitle)->firstOrFail();
		$posts = Post::select('blog_posts.*')
				->join('users', 'users.id', '=', 'blog_posts.author_id')
				->where('active','>','0')
				->where('category_id', '=', $category->id)
				->paginate($perPage);
		
		$categories = Category::get();
		$tags = Tag::get();
		$latestpost = Post::orderBy('created_at','desc')->first();
		$latestcomment = $this->LastComment($request);

		////////////////////////////////
		SEOMeta::setTitle('Блог');
		SEOMeta::setDescription('Блог');

		OpenGraph::setTitle('Блог');
        OpenGraph::setDescription('Блог');
        OpenGraph::addProperty('type', 'website');
		OpenGraph::addImage('https://proauto.shop/images/opengraph.png');

		TwitterCard::setTitle('Блог');
		TwitterCard::setSite($request->url());
		////////////////////////////////
        
        return view('shop.blog.blog', compact('posts','categories','tags','latestcomment', 'latestpost'));
	}
	
	//ShowPostsByTag
	public function ShowPostsByTag(Request $request)
	{
		$tagtitle = $request->tagtitle;
		$perPage = 5;
		
		$posts = Post::select('blog_posts.*')
				->join('users', 'users.id', '=', 'blog_posts.author_id')
				->join('blog_posts_tags', 'blog_posts_tags.post_id', '=', 'blog_posts.id')
				->join('blog_tags', 'blog_posts_tags.tag_id', '=', 'blog_tags.id')
				->where('active','>','0')
				->where('blog_tags.slug', '=', $tagtitle)
				->paginate($perPage);
				
		$categories = Category::get();
		$tags = Tag::get();
		$latestpost = Post::orderBy('created_at','desc')->first();
		$latestcomment = $this->LastComment($request);

		////////////////////////////////
		SEOMeta::setTitle('Блог');
		SEOMeta::setDescription('Блог');

		OpenGraph::setTitle('Блог');
        OpenGraph::setDescription('Блог');
        OpenGraph::addProperty('type', 'website');
		OpenGraph::addImage('https://proauto.shop/images/opengraph.png');

		TwitterCard::setTitle('Блог');
		TwitterCard::setSite($request->url());
		////////////////////////////////
		
        return view('shop.blog.blog', compact('posts','categories','tags', 'latestcomment', 'latestpost'));
	}

	public function ShowPostPage(Request $request)
	{
		$post = Post::where('slug','=',$request->slug)->firstOrFail();
		$post->increment('views'); // add a new page view to our `views` column by incrementing it

		$previous = Post::where('id', '<', $post->id)->where('active','>','0')->orderBy('id','desc')->first();
		$next = Post::where('id', '>', $post->id)->where('active','>','0')->orderBy('id')->first();
		$post->category = Category::where('id', $post->category_id)->first();
		$post->tags = Tag::where('id', '=', $post->id)->get();
		
		//sidepanel
		$latestpost = Post::orderBy('created_at','desc')->first();
		$latestcomment = $this->LastComment($request);
		//fullist
		$categories = Category::get();
		$tags = Tag::get();

		////////////////////////////////
		$uri = env('APP_URL','https://proauto.shop');
		
		SEOMeta::setTitle('Статья | ' . $post->title);
		SEOMeta::setDescription('Статья | ' . $post->title . ' | ' . $post->description);

		OpenGraph::setTitle('Статья | ' . $post->title);
        OpenGraph::setDescription('Статья | ' . $post->title . ' | ' . $post->description);
		OpenGraph::addProperty('type', 'article');
		// OpenGraph::addImage($uri . '/images/posts/' . $post->image);
		OpenGraph::addImage($uri . $post->image);
		
		TwitterCard::setTitle('Статья | ' . $post->title);
		TwitterCard::addImage($uri . '/images/posts/' . $post->image);
		TwitterCard::setDescription('Статья | ' . $post->title . ' | ' . $post->description);
		TwitterCard::setUrl($request->url());
		TwitterCard::setSite($request->url());
		////////////////////////////////

        return view('shop.blog.post', compact('post','previous','next','categories','tags','latestcomment', 'latestpost'));
	}
	
	public function AddComment(Request $request)
	{
		$request->validate([
			'comment'=>'required',
			'client_id'=>'required',
			'post_id'=>'required',
		]);
		
		$input = $request->all();
		Comment::create($input);

        return back();
	}

	public function LastComment(Request $request)
	{
		$latestcomment = Comment::select('blog_posts_comments.comment',
				'blog_posts.slug',
				'blog_posts_comments.created_at',
				'blog_posts.title as posttitle',
				'clients.lastname',
				'clients.firstname',
				'clients.email',
				'clients.avatar')
				->join('blog_posts', 'blog_posts_comments.post_id', '=', 'blog_posts.id')
				->join('clients', 'blog_posts_comments.client_id', '=', 'clients.id')
				->latest()->first();
		return $latestcomment;
	}
}
