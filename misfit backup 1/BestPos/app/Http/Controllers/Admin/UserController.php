<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('status', 1)->get();
        if(count($users) == 0){
            return response()->json([
                'message' => 'There is no user',
                'data' => $users
            ], 404);
        }
        return response()->json(['data' => $users], 200);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['data' => $user], 200);
    }

    public function store(UserStoreRequest $request)
    {

        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'user_name' => $request->input('user_name'),
            'mobile_number' => $request->input('mobile_number'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json([
            'message' => 'User created Successfully',
            'data' => $user
        ], 201);
    }

    public function blockUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found Block'], 404);
        }
        if ($user->status == 0){
            return response()->json(['message' => 'User already blocked'], 400);
        }

        $user->update(['status' => 0]);

        return response()->json(['message' => 'User blocked successfully'], 200);
    }

    public function unblockUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found Unblock'], 404);
        }
        if ($user->status == 1){
            return response()->json(['message' => 'User already unblocked'], 400);
        }

        $user->update(['status' => 1]);

        return response()->json(['message' => 'User unblocked successfully'], 200);
    }

    public function blockedUsers()
    {
        $blockedUsers = User::where('status', 0)->get();

        return response()->json(['data' => $blockedUsers], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found Delete'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
