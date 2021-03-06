@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $tag->text }}'s tasks</div>
                <ul class="card-body">
                    @forelse ($tag->tasks as $task)
                    @if ( $task->finished_at === null )
                    <li class="alert alert-success" role="alert">
                    <a href="{{ action('TasksController@show', $task) }}">{{ $task->detail }}</a>（PlanDate:{{ substr($task->planned_at->format('Y/m/d'), 0, 10) }}）
                    </li>
                    @else
                    <li class="alert alert-success" role="alert">
                    <a href="{{ action('TasksController@show', $task) }}">{{ $task->detail }}</a>（PlanDate:{{ substr($task->planned_at->format('Y/m/d'), 0, 10) }}）
                    <span style=" 
                    width: 50px;
                    text-align: center;
                    background-color: pink; 
                    font-size: 8px;
                    border-radius: 10px;
                    float:right">Finish</span>
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

@endsection