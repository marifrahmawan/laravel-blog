<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug'
    ];

    public function posts(){
        return $this->belongsToMany(Post::class, 'category_post', 'category_id', 'post_id');
    }
}
