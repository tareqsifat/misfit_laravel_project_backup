<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd(\request()->all());
        $userTasks = Task::orderBy('created_at', 'DESC');

        // Filter by project
        if (request()->filled('project') && request('project') != 0) {
            $userTasks->where('project_id', request('project'));
        }

        // Filter by task status
        if (request()->filled('status') && request('status') != 'all') {
            $userTasks->where('status', request('status'));
        }
        // Filter by task Teammate
        if (request()->filled('user_id') && request('user_id') != 0) {
            $userTasks->where('user_id', request('user_id'));
        }

        $tasks = $userTasks->get();
        $projects = Project::get();
        $teammates = User::where('user_type_id', 2)->get();
        return view('tasks.index', compact(['tasks', 'projects', 'teammates']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all projects to pass to the create view
        $projects = Project::get();
        return view('tasks.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'description' => 'nullable|string',
        ]);

        // Create a new task
        $task = Task::create([
            'name' => $request->name,
            'project_id' => $request->project_id,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::find($id);
        $teammates = User::where('user_type_id', 2)->orderBy('name', 'ASC')->get();
        if(!$task){
            return redirect()->route('tasks.index')->with('error', 'Task not found');
        }
        return view('tasks.show', compact(['task', 'teammates']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::find($id);
        if(!$task){
            return redirect()->route('tasks.index')->with('error', 'Task not found');
        }
        $projects = Project::get();
        return view('tasks.edit', compact('task', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,working,done',
            'creator' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
        ]);

        // Update the task
        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if(!$task){
            return redirect()->route('tasks.index')->with('error', 'Task not found');
        }
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }

    public function assign_task_to_teammate(Request $request)
    {
        $teammate = User::find($request->user_id);
        $task = Task::find($request->task_id);

//        dd($teammate, $task);
        if(!$task){
            return redirect()->back()->with('error', 'task not found');
        }
        if(!$teammate){
            return redirect()->back()->with('error', 'teammate not found');
        }

        $task->user_id = $teammate->id;
//        dd($teammate, $task);
        $task->save();

        return redirect()->back()->with('success', 'task assigned successfully');

    }
}
