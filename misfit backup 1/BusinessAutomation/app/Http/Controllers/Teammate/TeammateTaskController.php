<?php

namespace App\Http\Controllers\Teammate;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeammateTaskController extends Controller
{
    public function index()
    {
        $userTasks = Task::where('user_id', Auth::user()->id);

        // Filter by project
        if (request()->filled('project') && request('project') != 0) {
            $userTasks->where('project_id', request('project'));
        }

        // Filter by task status
        if (request()->filled('status') && request('status') != 'all') {
            $userTasks->where('status', request('status'));
        }

        $tasks = $userTasks->orderBy('created_at', 'DESC')->get();
        $projects = Project::get();

        return view('tasks.index', compact(['tasks', 'projects']));
    }

    public function status_edit($id)
    {
        $task = Task::find($id);

        if(!$task){
            return redirect()->back()->with('error', 'Task not Found');
        }

        return view('tasks.show', compact('task'));
    }



    public function status_update(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'status' => 'required|in:pending,working,done'
        ]);
        $task = Task::find($request->task_id);

        if($task->status == 'done'){
            return redirect()->back()->with('error', 'Task is done, further update is not possible');
        }

        if(!$task || $task->user_id != Auth::user()->id){
            return redirect()->back()->with('error', 'Task not Found');
        }

        $task->status = $request->status;
        $task->save();

        return redirect()->back()->with('success', 'Task Status Updated Successfully');
    }
}
