<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Tag;
use App\Http\Requests\TaskRequest;
use Carbon\Carbon;

class TasksController extends Controller
{

    public function index() {
        $tasks = Task::oldest('planned_at')->get();
        $tags = Tag::latest()->get();
        return view('tasks.index')->with([
       'tasks' => $tasks,
       'tags' => $tags
    ]);
    }

    public function show(Task $task, Tag $tags) {
        return view('tasks.show')->with([
       'task' => $task,
       'tags' => $tags
    ]);
    }

    public function create() {
        $tags = Tag::oldest()->get();
        return view('tasks.create')->with('tags', $tags);
    }

    public function store(TaskRequest $request) {
        $task = new Task();
        $tags = $request->input('tags');
        $task->detail = $request->detail;
        $task->planned_at = $request->input('planned_at');
        $task->user_id = auth()->id();
        $task->save();
        $task->tags()->attach($tags);
        return redirect('/index');
    }

    public function edit(Task $task) {
        $tags = Tag::oldest()->get();
        return view('tasks.edit')->with([
       'task' => $task,
       'tags' => $tags
    ]);
    }

    public function update(TaskRequest $request, Task $task) {
        $tags = $request->input('tags');
        $task->detail = $request->detail;
        $task->planned_at = $request->input('planned_at');
        $task->save();
        $task->tags()->sync($tags);
        return redirect('/index');
    }

    public function destroy(Task $task) {
        $task->delete();
        $task->tags()->detach();
        return redirect('/index');
    }

    public function finish(Request $request, Task $task) {
        $task->finished_at = Carbon::now();
        $task->save();
        return redirect('/index');
    }

}
