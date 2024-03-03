<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\AdminRequest;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::where('is_active', 1)->get();

        if (count($admins) == 0) {
            return response()->json([
                'message' => 'There is no admin data'
            ], 404);
        }

        return response()->json([
            'admins' => $admins
        ], 200);
    }

    public function store(AdminRequest $request)
    {
        // $this->validate($request, [
        //     'role_id' => 'nullable|integer',
        //     'full_name' => 'nullable|string',
        //     'user_name' => 'nullable|string',
        //     'email' => 'nullable|email|unique:admins',
        //     'password' => 'nullable|string',
        //     'is_active' => 'nullable|boolean',
        //     'created_by' => 'nullable|integer',
        // ]);

        $admin = Admin::create($request->all());

        return response()->json([
            'admin' => $admin,
            'message' => 'Admin created successfully'
        ], 201);
    }

    public function show($id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json([
                'message' => 'Admin not found'
            ], 404);
        }

        return response()->json([
            'admin' => $admin
        ], 200);
    }

    public function update(AdminRequest $request, $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json([
                'message' => 'Admin not found'
            ], 404);
        }

        $admin->update($request->all());

        return response()->json([
            'admin' => $admin,
            'message' => 'Admin updated successfully'
        ], 200);
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json([
                'message' => 'Admin not found'
            ], 404);
        }

        $admin->delete();

        return response()->json([
            'message' => 'Admin deleted successfully'
        ], 200);
    }
}