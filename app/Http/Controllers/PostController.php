<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Null_;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user'])->latest()->paginate(6);

        // return $posts;
        return view('post.index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
      
        return view('post.create', [
            'tags' => $tags,
            'categories' => $categories
        ]);
    }



    public function store(PostRequest $request)
    {   
        $data = $request->all();
        $slug = \Str::slug($request->title);

        $data['slug'] = $slug;

        $thumbnail = $request->file('thumbnail');
        
        if($thumbnail != NULL){
            $data['thumbnail'] = $thumbnail->storeAs("images/posts", "{$slug}.{$thumbnail->extension()}", "public");
        }

        $user = auth()->user();
        $post = $user->posts()->create($data);
        
        $post->categories()->attach($request->category_id);
        $post->tags()->attach($request->tag_id);

        session()->flash('success', 'The Post wast Created');

        return redirect()->route('posts-index');
    }



    public function show($slug)
    {
        $post = Post::with(['categories','tags', 'user'])->where('slug', $slug)->firstOrFail();
        
        return view('post.show', [
            'post' => $post
        ]);
    }



    public function edit($slug)
    {
        $post = Post::with(['categories','tags'])->where('slug', $slug)->firstOrFail();
        $this->authorize('update_and_delete', $post);
        $tags = Tag::all();
        $categories = Category::all();

        return view('post.edit', [
            'post' => $post,
            'tags' => $tags,
            'categories' => $categories
        ]);
    }



    public function update(PostRequest $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $this->authorize('update_and_delete', $post);
        
        $data = $request->all();

        $slug = \Str::slug($request->title);

        $data['slug'] = $slug;

        $thumbnail = $request->file('thumbnail');
        if($thumbnail != NULL){
            $data['thumbnail'] = $thumbnail->storeAs("images/posts", "{$slug}.{$thumbnail->extension()}", "public");
        }
        
        $post->update($data);
        $post->categories()->sync($request->category_id);
        $post->tags()->sync($request->tag_id);

        session()->flash('update', 'The Post was Updated');

        return redirect()->route('posts-show', $post->slug);
    }



    public function destroy($slug)
    {
        $item = Post::where('slug', $slug)->firstOrFail();

        $this->authorize('update_and_delete', $item);
        
        if(Storage::exists("public/".$item->thumbnail)){
            return $x = Storage::delete("public/".$item->thumbnail);
        }

        $item->categories()->detach();
        $item->tags()->detach();
        $item->delete();

        session()->flash('deleted', 'The Post was Deleted');

        return redirect()->route('posts-index');

    }

    public function find($username){
        $user = User::with(['posts'])->where('username', $username)->firstOrFail();
        $posts = $user->posts()->latest()->paginate(6);
        
        return view('searcher.post_by_author', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
