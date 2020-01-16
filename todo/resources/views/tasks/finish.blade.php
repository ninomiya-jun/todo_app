@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todo List　<a href="{{ url('/tasks/create') }}" class="header_menu">new task</a>　<a href="{{ url('/tags/create') }}" class="header_menu">new tag</a>　<a href="{{ url('/tasks/finish') }}" class="header_menu">finish task</a></div>
                
                <ul class="card-body">
                    @forelse ($tasks as $task)
                    @if ( $task->finished_at === null )
                    @else
                    <li class="alert alert-success" role="alert">
                    <a href="{{ action('TasksController@show', $task) }}" style="margin-left:30px;">{{ $task->detail }}</a>（FinishedDate:{{ substr($task->finished_at->format('Y/m/d'), 0, 10) }}）
                    <input type="button" data-id="{{ $task->id }}" class="del" onclick="deleteTask(this);"
                    value="Delete"
                    style=" 
                    background-color: pink; 
                    font-size: 8px;
                    border-radius: 30px;
                    float: right;"
                    >
                    <form action="{{ action('TasksController@destroy', $task->id) }}" id="form_{{ $task->id }}" method="post"　display="inline-block">
                    @csrf
                    @method('delete')
                    </form>
                    </li>
                    @endif
                    @empty
                    <li>No Task!!</li>
                    @endforelse
                </ul>                
            </div>
        </div>
    </div>
</div>

<script>

function deleteTask(e) {

if (confirm('本当に削除していいですか?')) {
document.getElementById('form_' + e.dataset.id).submit();
}
}


</script>

@endsection