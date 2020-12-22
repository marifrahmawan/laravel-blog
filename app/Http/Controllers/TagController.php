<?php

namespace App\Http\Controllers;

use App\Tag;

class TagController extends Controller
{
    public function show($slug){
        $tag = Tag::with(['posts'])->where('slug', $slug)->firstOrFail();
        $items = $tag->posts()->latest()->paginate(6);
        
        return view('searcher.tag_search', [
            'items' => $items,
            'tag' => $tag
        ]);
    }
}
