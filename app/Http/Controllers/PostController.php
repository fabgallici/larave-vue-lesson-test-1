<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Post;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('pages.post-index', compact('posts'));
    }

    public function indexAdv()
    {
        $posts = Post::all();
        return view('pages.post-index-adv', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('pages.post-create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request -> all();

        // $post = Post::create($data);
        $user = Auth::user();
        $post = Post::make($data);
        $post -> user() -> associate($user);
        $post -> save();

        if (isset($data['tags'])) {

          $tags = Tag::find($data['tags']);
          $post -> tags() -> attach($tags);
        }

        return redirect() -> route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $tags = Tag::all();

        return view('pages.post-edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request -> all();

        $post = Post::findOrFail($id);
        $post -> update($data);

        $tags = Tag::find($data['tags']);
        $post -> tags() -> sync($tags);

        return redirect() -> route('post.index');
    }

    public function updateAxios(Request $request, $id) {

      $data = $request -> all();

      $post = Post::findOrFail($id);
      $post -> update($data);

      // $tags = Tag::find($data['tags']);
      // $post -> tags() -> sync($tags);

      return response() -> json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // $post -> tags() -> detach();
        $tags = $post -> tags;
        foreach ($tags as $tag) {
          $post -> tags() -> detach($tag);
        }

        $post -> delete();

        return redirect() -> route('post.index');
    }
    public function destroyAxios($id) {

      $post = Post::findOrFail($id);

      // $post -> tags() -> detach();
      $tags = $post -> tags;
      foreach ($tags as $tag) {
        $post -> tags() -> detach($tag);
      }

      $post -> delete();

      return response() -> json($post, 200);
    }
}
