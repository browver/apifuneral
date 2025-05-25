<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Create User
    public function create(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'fullname' => $request->fullname,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return response([
            'message' => 'User created successfully.',
            'data' => $user,
            'status' => 201
        ]);
    }

    // Get All Users
    public function getAll()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return response(['message' => 'No users found.', 'status' => 404]);
        }

        return response(['message' => 'Success', 'data' => $users, 'status' => 200]);
    }

    // Get Single User
    public function getOne($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response(['message' => 'User not found.', 'status' => 404]);
        }

        return response(['message' => 'Success', 'data' => $user, 'status' => 200]);
    }

    // Update User
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response(['message' => 'User not found.', 'status' => 404]);
        }

        $request->validate([
            'name'     => 'string|max:255',
            'fullname' => 'string|max:255',
            'email'    => 'email|unique:users,email,' . $id,
            'phone'    => 'string|max:20',
            'password' => 'nullable|string|min:6',
        ]);

        $user->update([
            'name'     => $request->name ?? $user->name,
            'fullname' => $request->fullname ?? $user->fullname,
            'email'    => $request->email ?? $user->email,
            'phone'    => $request->phone ?? $user->phone,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return response(['message' => 'User updated.', 'data' => $user, 'status' => 200]);
    }

    // Delete User
    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response(['message' => 'User not found.', 'status' => 404]);
        }

        $user->delete();

        return response(['message' => 'User deleted successfully.', 'status' => 200]);
    }
}
