@extends('layouts.app')

@section('content')
<div class="container">
<h1>
New Tags
</h1>
<form method="post" action="{{ url('/tags') }}">
{{ csrf_field() }}
  <p><input type="text" name="text" placeholder="enter body" value="{{ old('title') }}">
  @if ($errors->has('title'))
  <span class="error">{{ $errors->first('title') }}</span>
  @endif
  </p>
  <p><input type="submit" value="Add"></p>
  <br>
  </form>

  <br>
  <br>
  <a href="{{ url('/home') }}" class="header_menu">back</a>
<div>

@endsection