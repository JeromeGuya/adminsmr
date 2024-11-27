<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(5); // Paginate and sort by the latest created_at
        return view('users.view_users', compact('users'));
    }


    public function create()
    {
        return view('users.add_users');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user instance
        $user = new User();
        $user->first_name = $validated['first_name'];
        $user->middle_name = $validated['middle_name'] ?? null;
        $user->last_name = $validated['last_name'];
        $user->phone_number = $validated['phone_number'];
        $user->email = $validated['email'];
        $user->address = $validated['address'];
        $user->password = Hash::make($validated['password']); // Hash the password

        // Save the user
        $user->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'User successfully added!');
    }

        public function destroy(User $user)
        {
            // Deleting the user
            $user->delete();

            // Redirecting with a success message
            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Fetch the user or throw a 404
        return view('users.edit_users', compact('user')); // Pass user data to the view
    }

    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|numeric',
            'email' => 'required|email|unique:users,email,' . $id, // Unique except for this user
            'address' => 'required|string|max:255',
        ]);

        // Fetch the user and update
        $user = User::findOrFail($id);
        $user->update($request->only(['first_name', 'middle_name', 'last_name', 'phone_number', 'email', 'address']));

        // Redirect with a success message
        return redirect()->back()->with('success', 'User updated successfully.');
    }


}
