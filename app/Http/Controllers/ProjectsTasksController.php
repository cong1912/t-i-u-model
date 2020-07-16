<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ProjectsTasksController extends Controller
{
    public function store(Project $project)
    {
        // if (auth()->user()->isNot($project->owner)){
        //     abort(403);
        // }

        $this->authorize('update',$project);
        request()->validate(['body'=>'required']);
        $project->addTask(request('body'));
        return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {
        $this->authorize('update',$task->project);
        // if (auth()->user()->isNot($project->owner)){
        //     abort(403);
        // }
        request()->validate(['body'=>'required']);
        
        $task->update([
            'body'=>request('body'),
            'completed'=>request()->has('completed')
        ]);

        return redirect($project->path());
    }
}