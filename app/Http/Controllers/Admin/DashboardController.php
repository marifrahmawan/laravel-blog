<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $user = count(User::all());
        $post = count(Post::all());

        return view('dashboard.index',[
            'user' => $user,
            'post' => $post
        ]);
    }
}
