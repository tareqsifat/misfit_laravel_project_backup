<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TeammateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teammates = User::where('user_type_id', 2)->with('user_type')->get();

        return view('teammates.index', ['teammates' => $teammates]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teammates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'position' => 'nullable|string|max:255',
            'employee_id' => 'nullable|string|max:50',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new teammate
        $teammate = User::create([
            'user_type_id' => 2,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'position' => $request->input('position'),
            'employee_id' => $request->input('employee_id'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('teammates.index')->with('success', 'Teammate created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teammate = User::findOrFail($id);
        $tasks = Task::OrderBy('created_at', 'DESC')->get();

        return view('teammates.show', compact(['teammate', 'tasks']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teammate = User::findOrFail($id);

        return view('teammates.edit', ['teammate' => $teammate]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teammate = User::findOrFail($id);

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teammate->id,
            'position' => 'nullable|string|max:255',
            'employee_id' => 'nullable|string|max:50',
        ]);

        // Update teammate details
        $teammate->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'position' => $request->input('position'),
            'employee_id' => $request->input('employee_id'),
        ]);

        return redirect()->route('teammates.index')->with('success', 'Teammate updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teammate = User::findOrFail($id);
        $teammate->delete();

        return redirect()->route('teammates.index')->with('success', 'Teammate deleted successfully.');
    }
}
