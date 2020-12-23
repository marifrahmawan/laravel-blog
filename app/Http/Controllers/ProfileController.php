<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index($username){
        $user = User::where('username', $username)->firstOrFail();
        $posts = Post::with(['user'])->where('user_id', $user->id)->get();

        return view('profiles.index',[
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function settings($username){
        $user = User::where('username', $username)->firstOrFail();

        return view('profiles.settings',[
            'user' => $user
        ]);
    }

    public function edit_bio($username){
        $user = User::where('username', $username)->firstOrFail();

        return view('profiles.edit_bio', [
            'user' => $user
        ]);
    }
    
    public function update_bio(Request $request, $username){
        $user = User::where('username', $username)->firstOrFail();
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^(?![ .]+$)[a-zA-Z .]*$/'],
            'username' => ['required', 'string', Rule::unique('users')->ignore($user->id),'regex:/^[a-zA-Z0-9_.-]*$/' ,'max:25'],
            'gender' => ['required'],
            'birth_date' => ['nullable', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update($data);

        session()->flash('update', 'Your Profile Bio has been updated');

        return redirect()->route('settings', $user->username);
    }

    public function edit_photo($username){
        $user = User::where('username', $username)->firstOrFail();

        return view('profiles.edit_photo', [
            'user' => $user
        ]);
    }

    public function update_photo(Request $request, $username){
        $user = User::where('username', $username)->firstOrFail();

        if(\Storage::exists("public/".$user->photo)){
            \Storage::delete("public/".$user->photo);
        }

        $data = $request->validate([
            'photo' => ['required','mimes:jpg,jpeg,png', 'max:2000'],
        ]);

        $photo = $request->file('photo');

        $data['photo'] = $photo->storeAs("images/profile-picture", "{$user->id}.{$photo->extension()}", "public");

        $user->update($data);

        session()->flash('update_photo', 'Your Profile Picture has been updated');

        return redirect()->route('settings', $user->username);
    }

    public function change_password($username){
        $user = User::where('username', $username)->firstOrFail();

        return view('profiles.change_password', [
            'user' => $user
        ]);
    }

    public function update_password(Request $request, $username){
        $user = User::where('username', $username)->firstOrFail();
        
        $data = $request->validate([
            'password' => ['required', 'confirmed']
        ]);
        $data['password'] = \Hash::make($request['password']);
        $user->update($data);

        session()->flash('update_password', 'Your Password has been changed');
        
        return redirect()->route('settings', $user->username);
    }
}
