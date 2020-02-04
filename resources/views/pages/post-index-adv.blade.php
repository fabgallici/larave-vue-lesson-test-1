@extends('layouts.base')

@section('content')

  @include('comps.post')

  <div id='app'>
    <h1 title="posts">POSTS:</h1>
    <ul>

      @foreach ($posts as $post)

        <post-box
          :id='{{ $post -> id }}'
          :title='"{{ $post -> title }}"'
          :body='"{{ $post -> body }}"'
          :tags='{{ $post -> tags }}'
        ></post-box>

      @endforeach

    </ul>
  </div>

@endsection
