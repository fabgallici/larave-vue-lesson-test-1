@extends('layouts.base')

@section('content')

  <h1>POSTS:</h1>
  <ul>

    @foreach ($posts as $post)

      <li>

        <h3>[{{ $post -> id }}] {{ $post -> title }}</h3>
        BODY:<br>
        {{ $post -> body }}<br>

        <ul>

          @foreach ($post -> tags as $tag)

            <li>

              @auth
                @if (Auth::user() -> id == $post -> user -> id)
                  <a href="{{ route('post.remove.tag', [$post -> id, $tag -> id]) }}">X</a>
                @endif
              @endauth
              [{{ $tag -> id }}] {{ $tag -> name }}

            </li>

          @endforeach

        </ul>

        @auth
          @if (Auth::user() -> id == $post -> user -> id)

            <br>
            <a href="{{ route('post.edit', $post -> id) }}">EDIT ME</a><br>
            <a href="{{ route('post.delete', $post -> id) }}">DELETE ME</a>
          @endif
        @endauth
        <br>
        from <b>{{ $post -> user -> name }}</b>
        <br>

        <br><br><br>

      </li>

    @endforeach

  </ul>

@endsection
