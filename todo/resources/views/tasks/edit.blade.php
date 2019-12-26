@extends('layouts.app')

@section('content')
<div class="container">
<h1>
Edit Task
</h1>
<form method="post" action="{{ url('/tasks' , $task->id) }}">
@csrf
@method('patch')
    <p style="color: red"><input type="text" name="detail" placeholder="enter body" value="{{ old('detail', $task->detail) }}">
    @if ($errors->has('detail'))
    <span class="error">{{ $errors->first('detail') }}</span>
    @endif
    </p>

    <h1>
    Tags
    </h1>
    @foreach($tags as $tag)
    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
    
    @if (count($task->tags->where('id', $tag->id)))
        checked
    @endif
    
    >{{ $tag->text }}
    @endforeach

    <h2>
    Plan data
    </h2>
    <p style="color: red"><input type="date" name="planned_at" value="{{ substr($task->planned_at, 0, 10) }}">
    @if ($errors->has('planned_at'))
    <span class="error">{{ $errors->first('planned_at') }}</span>
    @endif
    </p>


  <p><input type="submit" value="Update"></p>
  <br>
  <br>
  <a href="{{ url('/index') }}" class="header_menu">back</a>
</div>
</form>

@endsection