<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Tag;

class TagsController extends Controller
{
    public function show(Task $tasks, Tag $tag) {
        return view('tags.show')->with([
       'tasks' => $tasks,
       'tag' => $tag
       ]);
    }

    public function create() {
        return view('tags.create');
    }

    public function store(Request $request) {
        $tag = new Tag();
        $tag->text = $request->text;
        $tag->save();
        return redirect('/index');
    }
    public function destroy(Tag $tag) {
        $tag->delete();
        $tag->tasks()->detach();
        return redirect('/index');
    }


}
