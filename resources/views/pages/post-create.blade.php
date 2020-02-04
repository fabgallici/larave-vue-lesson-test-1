@extends('layouts.base')

@section('content')

  <br>
  <form action="{{ route('post.store') }}" method="post">
    @csrf
    @method('POST')

    <label for="title">TITLE</label>
    <input type="text" name="title" value=""><br>
    <label for="body">BODY</label>
    <input type="text" name="body" value=""><br>
    <br>
    <select name="tags[]" multiple>

        @foreach ($tags as $tag)

          <option value="{{ $tag -> id }}">{{ $tag -> name }}</option>

        @endforeach

    </select>
    <br>
    <input type="submit" name="" value="CREATE">
    <br>

  </form>

@endsection
