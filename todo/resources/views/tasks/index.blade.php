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
                    <li class="alert alert-success" role="alert" id="display-area-{{$task->id}}">
                    <!-- <form action="{{ action('TasksController@finish', $task->id) }}" method="post" id="finish_{{ $task->id }}"　style="display: inline">
                    @csrf
                    @method('patch') -->
                    <input type="button" name="finished_at" class="finished"　value="Finish" data-id="{{ $task->id }}" style=" 
                    background-color: khaki; 
                    font-size: 8px;
                    border-radius: 30px;"
                    onclick="finishTask(this)"
                    >
                    <!-- </form> -->
                    <a href="{{ action('TasksController@show', $task) }}" style="margin-left:30px;">{{ $task->detail }}</a>（PlanDate:{{ substr($task->planned_at->format('Y/m/d'), 0, 10) }}）
                    <span class="editer">
                    <input type="button"  class="edit" value="Edit" onclick="Edit();" data-id="{{ $task->id }}"
                    style=" 
                    background-color: skyblue; 
                    font-size: 8px;
                    border-radius: 30px;
                    margin-right: 10px;"
                    >
                    <!-- edit url onclick="location.href='{{ action('TasksController@edit', $task) }}'" -->
                    <input type="button" data-id="{{ $task->id }}" class="del" onclick="deleteTask(this);"
                    value="Delete"
                    style=" 
                    background-color: pink; 
                    font-size: 8px;
                    border-radius: 30px;"
                    >
                    <!-- <form action="{{ action('TasksController@destroy', $task->id) }}" id="form_{{ $task->id }}" method="post"　display="inline-block">
                    @csrf
                    @method('delete')
                    </form> -->
                    </span>
                    </li>
                    <li class="alert alert-success" role="alert" id="input-form-{{$task->id}}" style="display:none;">
                    <form method="post" action="{{ action('TasksController@update', $task->id) }}">
                    @csrf
                    @method('patch')
                    <input type="text" name="detail" value="{{ $task->detail }}">
                    <input type="date" name="planned_at" value="{{ substr($task->planned_at, 0, 10) }}">
                    <input type="submit" data-id="{{ $task->id }}" class="edit" onclick="Edit(this);"
                    value="Update"
                    style=" 
                    background-color: pink; 
                    font-size: 8px;
                    border-radius: 30px;"
                    >
                    </form>
                    </li>
                    @else
                    @endif
                    @empty
                    <li>No Task!!</li>
                    @endforelse
                </ul>

                <div class="card-header">Tags</div>
                <ul class="card-body">
                    @forelse ($tags as $tag)
                    <li class="alert alert-success" role="alert">
                    <a href="{{ action('TagsController@show', $tag) }}">{{ $tag->text }}</a>（Tasks Quantity:{{ $tag->tasks->count() }}）
                    <input type="button" data-id="{{ $tag->id }}" class="del" onclick="deleteTag(this);"
                    value="Delete"
                    style=" 
                    background-color: pink; 
                    font-size: 8px;
                    border-radius: 30px;
                    float:right"
                    >
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

if (confirm('本当に削除していいですか?')) {
document.getElementById('form_' + e.dataset.id).submit();
}
}

function deleteTag(e) {

if (confirm('本当に削除していいですか?')) {
document.getElementById('form_' + e.dataset.id).submit();
}
}

function finishTask(e) {

if (confirm('本当に完了しましたか?')) {
document.getElementById('finish_' + e.dataset.id).submit();
}
}

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
  }
});

//delete ajax処理
$(function() {
    $('.del').on('click', function() {
        var id = $(this).data('id');
        var clickel = $(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('tasks') }}/" + id,
            type: 'POST',
            data: {'task': id, '_method': 'DELETE'}
        })
        // Ajaxリクエストが成功した場合
        .done(function(data) {
            clickel.parents('li').remove();
        })
        // Ajaxリクエストが失敗した場合
        .fail(function(data) {
            alert('エラー');
        });
    });
});

//finish ajax処理
$(function() {
    $('.finished').on('click', function() {
        var id = $(this).data('id');
        var clickel = $(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('tasks') }}/" + id + "/finish",
            type: 'POST',
            data: {'task': id, '_method': 'PATCH'}
        })
        // Ajaxリクエストが成功した場合
        .done(function(data) {
            clickel.parents('li').remove();
        })
        // Ajaxリクエストが失敗した場合
        .fail(function(data) {
            alert('エラー');
        });
    });
});

//edit ajax処理
$(function Edit() {
    $('.edit').on('click', function() {
        var id = $(this).data('id');

        $('#display-area-' + id).hide();
        $('#input-form-' + id).show();



    });
});



</script>

@endsection