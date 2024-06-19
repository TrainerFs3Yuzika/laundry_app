<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index',compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required', // add this line to validate the role field
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role, // add this line to save the role field
            'password' => Hash::make($request->password),

        ]);
        $user->setRememberToken(Str::random(50));
        $user->save();

        if ($user) {
            return response()->json([
                'success' => 'User created successfully',
                'redirect' => route('admin.users'),
            ]);
        } else {
            return response()->json([
                'error' => 'Failed to created user. Please try again.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);

        // Return the user data as JSON
        return response()->json($user);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json(['user' => $user]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $request->validate([
            'edit-name' => 'required|max:255',
            'edit-email' => 'required|email|unique:users,email,' . $id,
            'edit-role' => 'required',
        ]);

        $user->name = $request->input('edit-name');
        $user->email = $request->input('edit-email');
        $user->role = $request->input('edit-role');

        // Only update the password if a new one is provided
        if ($request->input('edit-password')) {
            $request->validate([
                'edit-password' => 'required|min:8',
            ]);
            $user->password = bcrypt($request->input('edit-password'));
        } else{
            // when password its > 8
        }

        $user->save();

        if ($user) {
            return response()->json([
                'success' => 'User edited successfully',
                'redirect' => route('admin.users'),
            ]);
        }
        else {
            return response()->json([
                'error' => 'Failed to edit user. Please try again.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json(['success' => 'User deleted successfully.']);
    }
}
