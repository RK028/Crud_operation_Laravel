<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class Usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Log::info('Fetching all users.');
        $users = User::all();
        return response()->json([
            'success' => true,
            'data' => $users,
            'message' => 'Users retrieved successfully.'
        ], 200);
    }

    public function store(Request $request)
    {
        Log::info('Creating a new user.', ['request' => $request->all()]);
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'role' => 'required|in:Admin,Supervisor,Agent',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'location_latitude' => 'nullable|string',
            'location_longitude' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'timezone' => 'nullable|string|max:255',
        ]);
        $user = User::create($validated);
        Log::info('User created successfully.', ['user' => $user]);
        return response()->json(['success' => true, 'message' => 'User Create successfully.','data' => $user], 201);
    }

    public function show(User $user)
    {
        // Log::info('Fetching user details.', ['user' => $user]);
        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User details retrieved successfully.'
        ], 200);
    }

    public function update(Request $request, User $user)
    {
        Log::info('Updating user details.', ['request' => $request->all(), 'user' => $user]);
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'role' => 'required|in:Admin,Supervisor,Agent',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'date_of_birth' => 'required|date',
            'timezone' => 'required|string|max:255',
        ]);

        $user->update($validated);
        Log::info('User updated successfully.', ['user' => $user]);
        return response()->json(['success' => true,'message' => 'User Update successfully.','data' => $user], 200);
    }

    public function destroy(User $user)
    {
        Log::info('Deleting user.', ['user' => $user]);
        $user->delete();
        Log::info('User deleted successfully.', ['user' => $user]);
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully.'
        ], 200);
    }
}
