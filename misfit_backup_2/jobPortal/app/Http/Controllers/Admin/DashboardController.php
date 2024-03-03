<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function advanced_form()
    {
        return view('admin.forms.advanced');
    }

    public function editor_form()
    {
        return view('admin.forms.editors');
    }

    public function general_form()
    {
        return view('admin.forms.general');
    }

    public function validation_form()
    {
        return view('admin.forms.validation');
    }

    public function data_table()
    {
        return view('admin.tables.data');
    }

    public function grid_table()
    {
        return view('admin.tables.jsgrid');
    }

    public function simple_table()
    {
        return view('admin.tables.simple');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
