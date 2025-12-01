<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mengambil data user dengan role selain customer
        $users = User::whereHas('role', function ($query) {
            $query->where('role_name', '!=', 'customer');
        })->orderBy('fullname')->get();

        // Return the users to a view
        return view('admin.user.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'phone' => 'required|string|max:20|unique:users,phone',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ], [
            'fullname.required' => 'Full name is required.',
            'username.required' => 'Username is required.',
            'phone.required' => 'Phone number is required.',
            'email.required' => 'Email is required.',
            'password.required' => 'Password is required.',
            'role_id.required' => 'Role is required.',
            'password.confirmed' => 'Password confirmation does not match.',
            'username.unique' => 'Username has already been taken.',
            'phone.unique' => 'Phone number has already been taken.',
            'email.unique' => 'Email has already been taken.'
        ]);
        // validate data
        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    public function show(string $id) {}


    public function edit(string $id)
    {
        // find user by id
        $user = User::findOrFail($id);
        // fetch all roles
        $roles = Role::all();

        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
                function ($attribute, $value, $fail) use ($user) {
                    if (Hash::check($value, $user->password)) {
                        $fail("Password baru tidak boleh sama dengan password lama");
                    }
                },
            ],
            'role_id' => 'required|exists:roles,id',
        ], [
            'fullname.required' => 'The full name is required.',
            'username.required' => 'The username is required.',
            'phone.required' => 'The phone number is required.',
            'email.required' => 'The email address is required.',
            'role_id.required' => 'The role is required.',
            'password.confirmed' => 'The password confirmation does not match.'
        ]);

        // Create a new user
        $validatedData['password'] = bcrypt($validatedData['password']);

        $user->update($validatedData);

        // Redirect to the users index with a success message
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // find the user by id
        $user = User::findOrFail($id);
        // delete the user
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
