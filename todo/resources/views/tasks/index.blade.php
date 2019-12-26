@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todo List　<a href="{{ url('/tasks/create') }}" class="header_menu">new task</a>　<a href="{{ url('/tags/create') }}" class="header_menu">new tag</a></div>
                
                <ul class="card-body">
                    @forelse ($tasks as $task)
                    @if ( $task->finished_at === null )
                    <li class="alert alert-success" role="alert">
                    <form method="post" action="{{ action('TasksController@finish', $task->id) }}"　style="display: inline">
                    @csrf
                    @method('patch')
                    <input type="submit" name="finished_at" value="finish">
                    </form>
                    <a href="{{ action('TasksController@show', $task) }}">{{ $task->detail }}</a>（PlanDate:{{ substr($task->planned_at->format('Y/m/d'), 0, 10) }}）
                    <span class="editer"><a href="{{ action('TasksController@edit', $task) }}" class="edit">[Edit]</a>
                    <a href="#" data-id="{{ $task->id }}" class="del" onclick="deleteTask(this);">[x]</a><span>
                    <form action="{{ action('TasksController@destroy', $task->id) }}" id="form_{{ $task->id }}" method="post"　display="inline-block">
                    @csrf
                    @method('delete')
                    </form>
                    </li>
                    @else
                    @endif
                    @empty
                    <li>No Task!!</li>
                    @php($oldTask = $task)
                    @endforelse
                </ul>
                <div class="card-header">Tags</div>
                <ul class="card-body">
                    @forelse ($tags as $tag)
                    <li class="alert alert-success" role="alert">
                    <a href="{{ action('TagsController@show', $tag) }}">{{ $tag->text }}</a>
                    <a href="#" data-id="{{ $tag->id }}" class="del" onclick="deleteTag(this);">[x]</a>
                    　<form action="{{ action('TagsController@destroy', $tag->id) }}" id="form_{{ $tag->id }}" method="post"　display="inline-block">
                    @csrf
                    @method('delete')
                    </form>
                    </li>
                    @empty
                    <li>No Tag!!</li>
                    @endforelse
                </ul>
                
            </div>
        </div>
    </div>
</div>

<script>
function deleteTask(e) {
'use strict';

if (confirm('本当に削除していいですか?')) {
document.getElementById('form_' + e.dataset.id).submit();
}
}

function deleteTag(e) {
'use strict';

if (confirm('本当に削除していいですか?')) {
document.getElementById('form_' + e.dataset.id).submit();
}
}
</script>
@endsection

