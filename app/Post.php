<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'thumbnail', 'body'
    ];

    public function categories(){
        return $this->belongsToMany(Category::class,'category_post', 'post_id', 'category_id');
    }
    
    public function tags(){
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
