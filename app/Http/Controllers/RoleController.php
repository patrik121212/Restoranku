<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $roles = Role::all();
        return view('admin.role.index', compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        Role::create([
            'role_name' => $request->role_name,
            'description' => $request->description,
        ]);

        return redirect()->route('roles.index')->with('success', 'Berhasil menambahkan role.');
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
    public function edit(Request $request, string $id)
    {
      $role = Role::findOrFail($id);

        return view('admin.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'role_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // find the role by id and update it
        $role = Role::findOrFail($id);
        $role->update($request->all());

        return redirect()->route('roles.index')->with('success', 'Berhasil Mengupdate Role.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Berhasil Menghapus Role.');
    }
}
