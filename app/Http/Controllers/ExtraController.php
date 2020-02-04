<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Post;
use App\Tag;
use App\User;

class ExtraController extends Controller
{

    public function removeTagFromPost($idp, $idt) {

      $post = Post::findOrFail($idp);
      $tag = Tag::findOrFail($idt);

      $post -> tags() -> detach($tag);

      return redirect() -> route('post.index');
    }

    public function setUserImage(Request $request) {

      // $data = $request -> all();
      // dd($data);

      $file = $request -> file('image');
      $filename = $file -> getClientOriginalName();

      $file -> move('images', $filename);

      $newUserData = [

        'image' => $filename

      ];

      Auth::user() -> update($newUserData);

      return redirect() -> route('post.index');
    }

    public function getToken(Request $request) {

      $data = $request -> all();
      $email = $data['email'] ?? -1;
      $password = $data['password'] ?? -1;

      if (Auth::attempt(compact('email', 'password'))) {

        // LOGGED
        $user = Auth::user();
        $username = $user -> name;
        $token = $user -> api_token;

        return response() -> json(compact('username', 'token'));
      }

      // WRONG MAIL OR PWS
      return response() -> json("Sorry, email or password is not correct");
    }

    public function getAllPost() {

        $posts = Post::all();
        return response() -> json(compact('posts'));
    }

    public function getMyPost(Request $request) {

      $data  = $request -> all();
      $token = $data['api_token'];

      $user = User::where('api_token', $token) -> first();
      $posts = $user -> posts;

      return response() -> json(compact('posts'));
    }
}
