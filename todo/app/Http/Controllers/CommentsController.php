<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Comment;

class CommentsController extends Controller
{
    //
    public function store (Request $request, Task $task) {
        $this->validate($request,[
            'text' => 'required'
        ]);
        $comment = new Comment(['text' => $request->text]);
        $comment->user_id = auth()->id();
        $task->comments()->save($comment);
        $comment->save();
        return redirect()->action('TasksController@show', $task);
    }

    public function destroy(Task $task, Comment $comment) {
        $comment->delete();
        return redirect()->back();
    }
}

