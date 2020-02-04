@extends('layouts.base')

@section('content')

  <br>
  <form action="{{ route('post.update', $post -> id) }}" method="post">
    @csrf
    @method('POST')

    <label for="title">TITLE</label>
    <input type="text" name="title" value="{{ $post -> title }}"><br>
    <label for="body">BODY</label>
    <input type="text" name="body" value="{{ $post -> body }}"><br>
    <select name="tags[]" multiple>

        @foreach ($tags as $tag)

          <option value="{{ $tag -> id }}"

              @if ($post -> tags() -> find($tag -> id))
                selected
              @endif

            >{{ $tag -> name }}</option>

        @endforeach

    </select>
    <br>
    <input type="submit" name="" value="UPDATE">
    <br>

  </form>

@endsection
