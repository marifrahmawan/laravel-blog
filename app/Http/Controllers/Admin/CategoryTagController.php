<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryTagController extends Controller
{
    public function index(){
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('dashboard.post_settings.index', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }
    
    public function create_category(){

        return view('dashboard.post_settings.create_category');
    }

    public function store_category(Request $request){
        $data = $request->validate([
            'name' => ['string', 'min:3', 'max:30', 'unique:categories', 'regex:/^(\d|\w)+$/']
        ]);
        $data['slug'] = \Str::slug($request['name']);
        Category::create($data);
        session()->flash('create-category', 'Category has been created');
        
        return redirect()->route('category-tag');
    }

    public function edit_category($slug){
        $category = Category::where('slug', $slug)->firstOrFail();

        return view('dashboard.post_settings.edit_category', [
            'category' => $category
        ]);
    }

    public function update_category(Request $request, $slug){
        $category = Category::where('slug', $slug)->firstOrFail();
        $data = $request->validate([
            'name' => ['string', 'min:3', 'max:30', Rule::unique('categories')->ignore($category->id), 'regex:/^(\d|\w)+$/']
        ]);
        $data['slug'] = \Str::slug($request['name']);
        $category->update($data);
        session()->flash('update-category', 'Category has been updated');
        
        return redirect()->route('category-tag');
    }

    public function delete_category($slug){
        $category = Category::where('slug', $slug)->firstOrFail();

        $category->delete();
        session()->flash('delete-category', 'Category has been deleted');

        return redirect()->route('category-tag');
    }

    // TAG
    public function create_tag(){

        return view('dashboard.post_settings.create_tag');
    }

    public function store_tag(Request $request){
        $data = $request->validate([
            'name' => ['string', 'min:3', 'max:30', 'unique:tags', 'regex:/^(\d|\w)+$/']
        ]);
        $data['slug'] = \Str::slug($data['name']);
        Tag::create($data);
        session()->flash('create-tag', 'Tag has been created');

        return redirect()->route('category-tag');
    }

    public function edit_tag($slug){
        $tag = Tag::where('slug', $slug)->firstOrFail();

        return view('dashboard.post_settings.edit_tag',[
            'tag' => $tag
        ]);
    }

    public function update_tag(Request $request, $slug){
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $data = $request->validate([
            'name' => ['string', 'min:3', 'max:30', Rule::unique('tags')->ignore($tag->id), 'regex:/^(\d|\w)+$/']
        ]);
        $data['slug'] = \Str::slug($request['name']);
        $tag->update($data);
        session()->flash('update-tag', 'Tag has been updated');
        
        return redirect()->route('category-tag');
    }

    public function delete_tag($slug){
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $tag->delete();
        session()->flash('delete-tag', 'Tag has been deleted');

        return redirect()->route('category-tag');
    }
}
