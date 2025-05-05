<?php

namespace App\Http\Controllers\Roles;

use App\Enum\Super;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the role.
     */
    public function index()
    {
        $roles = Role::where('name', '!=', Super::Admin)->get();
        return view('roles.index', compact(['roles']));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:50', 'unique:roles,name'],
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role create successfully.');
    }

    /**
     * Display the specified role.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(Role $role)
    {

        if ($role->name == Super::Admin->value) {
            abort(404);
        }

        $permissions = Permission::orderBy('name')->get();
        return view('roles.edit', compact(['role', 'permissions']));
    }

    /**
     * Update the specified role in storage.
     */
    public function update(Request $request, Role $role)
    {
        if ($role->name == Super::Admin->value) {
            return redirect()->route('roles.index')->with('error', 'You can not update this role');
        }

        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:50', 'unique:roles,name,' . $role->id],
        ]);

        $role->name = $request->name;
        $role->save();

        return redirect()->route('roles.index')->with('success', 'Role Updated Successfully');
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(Role $role)
    {
        if ($role->name == Super::Admin->value) {
            return redirect()->route('roles.index')->with('error', 'You can not delete this role');
        }

        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role Deleted');
    }
}
