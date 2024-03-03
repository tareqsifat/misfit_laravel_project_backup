<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('created_at', 'DESC');

        // Filter by project
        if (request()->filled('search_key') && request('search_key') != "") {
            $projects->where('name', 'like',  '%' . request('search_key') . '%');
        }
        $projects = $projects->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:projects|max:255',
            'code' => 'required|unique:projects|max:255',
        ]);

        $project = Project::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Project not found');
        }

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Project not found');
        }

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|unique:projects,name,' . $project->id . '|max:255',
            'code' => 'required|unique:projects,code,' . $project->id . '|max:255',
        ]);

        $project->update([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
        ]);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Project not found');
        }

        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
    }
}
