<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('profile')->middleware(['auth'])->group(function(){
    Route::get('/{username}', 'ProfileController@index')->name('my-profile');
    Route::get('/{username}/settings', 'ProfileController@settings')->name('settings');
    Route::get('/{username}/edit_bio', 'ProfileController@edit_bio')->name('edit-bio');
    Route::patch('/{username}/edit_bio', 'ProfileController@update_bio')->name('update-bio');
    Route::get('/{username}/edit_photo', 'ProfileController@edit_photo')->name('edit-photo');
    Route::patch('/{username}/edit_photo', 'ProfileController@update_photo')->name('update-photo');
    Route::get('/{username}/change_password', 'ProfileController@change_password')->name('change-password');
    Route::patch('/{username}/change_password', 'ProfileController@update_password')->name('update-password');
});

Route::get('/posts', 'PostController@index')->name('posts-index');

Route::prefix('posts')->middleware(['auth'])->group(function (){
    Route::get('/create', 'PostController@create')->name('posts-create');
    Route::post('/create', 'PostController@store')->name('posts-store');
    Route::get('/{slug}/edit', 'PostController@edit')->name('posts-edit');
    Route::patch('/{slug}/update', 'PostController@update')->name('posts-update');

    Route::delete('/{slug}/delete', 'PostController@destroy')->name('posts-delete');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('posts/{slug}', 'PostController@show')->name('posts-show');
Route::get('posts/byauthor/{username}', 'PostController@find')->name('posts-find');

Route::get('categories/{slug}', 'CategoryController@show')->name('category-show');
Route::get('tags/{slug}', 'TagController@show')->name('tag-show');

Route::prefix('dashboard')->namespace('Admin')->middleware(['auth', 'role:super-admin|admin'])->group(function (){
    Route::get('', 'DashboardController@index')->name('dashboard');

    // USER
    Route::get('user', 'UserController@index_user')->name('dashboard-user');
    Route::get('user/{username}/edit', 'UserController@edit')->name('user-edit');
    Route::patch('user/{username}/update_user', 'UserController@update_user')->name('update-user');
    Route::patch('user/{username}/update_user_role', 'UserController@update_user_role')->name('update-role-user');
    Route::delete('user/{username}/delete_user', 'UserController@delete_user')->name('delete-user');
    Route::get('user/create', 'UserController@create_user')->name('create-user');
    Route::post('user/create', 'UserController@store_user')->name('store-user');

    // ADMIN
    Route::get('admin', 'UserController@index_admin')->name('dashboard-admin');
    Route::get('admin/create', 'UserController@create_admin')->name('create-admin');
    Route::post('admin/create', 'UserController@store_admin')->name('store-admin');
    Route::delete('user/{username}/delete_admin', 'UserController@delete_admin')->name('delete-admin');

    // POST SETTINGS
    Route::get('/category-and-tag', 'CategoryTagController@index')->name('category-tag');
    // CATEGORY
    Route::get('/category-and-tag/create_category', 'CategoryTagController@create_category')->name('create-category');
    Route::post('/category-and-tag/create_category', 'CategoryTagController@store_category')->name('store-category');
    Route::get('/category-and-tag/{slug}/edit_category', 'CategoryTagController@edit_category')->name('edit-category');
    Route::patch('/category-and-tag/{slug}/edit_category', 'CategoryTagController@update_category')->name('update-category');
    Route::delete('/category-and-tag/{slug}/delete_category', 'CategoryTagController@delete_category')->name('delete-category');
    // TAG
    Route::get('/category-and-tag/create_tag', 'CategoryTagController@create_tag')->name('create-tag');
    Route::post('/category-and-tag/create_tag', 'CategoryTagController@store_tag')->name('store-tag');
    Route::get('/category-and-tag/{slug}/edit_tag', 'CategoryTagController@edit_tag')->name('edit-tag');
    Route::patch('/category-and-tag/{slug}/edit_tag', 'CategoryTagController@update_tag')->name('update-tag');
    Route::delete('/category-and-tag/{slug}/delete_tag', 'CategoryTagController@delete_tag')->name('delete-tag');
});

Auth::routes();

// Route::get('/', 'HomeController@index')->name('home');
