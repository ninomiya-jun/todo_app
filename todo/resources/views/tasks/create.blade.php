@extends('layouts.app')

@section('content')
<div class="container">
<h1>
New Task
</h1>
<form method="post" action="{{ url('/tasks') }}">
@csrf
  <p style= "color: red"><input type="text" name="detail" placeholder="enter body" value="{{ old('detail') }}">
  @if ($errors->has('detail'))
  <span class="error">{{ $errors->first('detail') }}</span>
  @endif
  </p>

    <h2>
    Tags
    </h2>
    @forelse ($tags as $tag)
    <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->text }}
    @empty
    <p>No Tags!!</p>
    @endforelse

    <h2>
    Plan data
    </h2>
    <p style= "color: red"><input type="date" name="planned_at">
    @if ($errors->has('planned_at'))
    <span class="error">{{ $errors->first('planned_at') }}</span>
    @endif
    </p>

  <p><input type="submit" value="Add"></p>
  <br>
  </form>

  <br>
  <br>
  <a href="{{ url('/index') }}" class="header_menu">back</a>
<div>

@endsection