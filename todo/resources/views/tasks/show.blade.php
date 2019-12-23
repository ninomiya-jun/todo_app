@extends('layouts.app')

@section('content')
<div class="container">
<h1>
{{ $task->detail }}
</h1>
<p>Contributor:{{ $task->user->name }}</p>
<br>
<p>Tags: @foreach ($task->tags as $tag) {{ $tag->text }} @endforeach</p>
<p>Plan Date:{{ substr($task->planned_at->format('Y/m/d'), 0, 10) }}</p>
<br>
<h3>
Comments
</h3>
<ul>
@forelse ($task->comments as $comment)
<li>
{{ $comment->text }}

  <a href="#" data-id="{{ $comment->id }}" class="del" onclick="deletePost(this);">[x]</a>
<form action="{{ action('CommentsController@destroy', [$task, $comment]) }}" id="form_{{ $comment->id }}" method="post"　display="inline-block">
@csrf
@method('delete')
</form>

</li>
@empty
<li>No comments!!</li>
@endforelse
</ul>

<form method="post" action="{{ action('CommentsController@store' , $task) }}">
@csrf
  <p><input type="text" name="text" placeholder="enter text" value="{{ old('text') }}">
  @if ($errors->has('text'))
  <span class="error">{{ $errors->first('text') }}</span>
  @endif
  </p>
  <p><input type="submit" value="Add Comment"></p>
</form>

<script>
function deletePost(e) {
  'use strict';
 
  if (confirm('本当に削除していいですか?')) {
  document.getElementById('form_' + e.dataset.id).submit();
  }
}
</script>

</p>
<br>
<br>
<a href="{{ url('/index') }}" class="header_menu">back</a>
<div>

@endsection