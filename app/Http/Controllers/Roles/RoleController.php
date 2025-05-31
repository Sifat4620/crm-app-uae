<?php

namespace App\Http\Controllers\Roles;

use App\Enum\Super;
use App\Models\User;
use App\Enum\Permissions;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the role.
     */
    public function index()
    {
        if (!Auth::user()->can(Permissions::RoleShow)) {
            abort(403);
        }

        $roles = Role::where('name', '!=', Super::Admin)->get();
        return view('roles.index', compact(['roles']));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        if (!Auth::user()->can(Permissions::RoleCreate)) {
            abort(403);
        }

        return view('roles.create');
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->can(Permissions::RoleCreate)) {
            abort(403);
        }

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
        if (!Auth::user()->can(Permissions::RoleEdit)) {
            abort(403);
        }

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
        if (!Auth::user()->can(Permissions::RoleEdit)) {
            abort(403);
        }

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
        if (!Auth::user()->can(Permissions::RoleDelete)) {
            abort(403);
        }

        if ($role->name == Super::Admin->value) {
            return redirect()->route('roles.index')->with('error', 'You can not delete this role');
        }

        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role Deleted');
    }

    /**
     * Assign role to user
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assign_role_to_user(Request $request, User $user)
    {
        if (!Auth::user()->can(Permissions::RoleEdit)) {
            abort(403);
        }

        if ($user->hasRole(Super::Admin) && !Auth::user()->hasRole(Super::Admin)) {
            abort(401);
        }
        if (Auth::user()->id == $user->id) {
            abort(404);
        }
        if ($request->role === null) {
            $user->syncRoles([]);
            return redirect()->route('roles.users')->with('success', 'Role dispatched successfully');
        }

        $request->validate([
            'role' => 'exists:roles,id'
        ]);

        // As Spatie Laravel Permission does not provide a direct method to assign a
        // role by its ID. So, we have to find the role by its ID first.
        $role = Role::find($request->role);
        $user->syncRoles($role->name);

        return redirect()->route('roles.admins')->with('success', 'Role assigned successfully');
    }

    /**
     * Sync permissions to role
     * @param \Illuminate\Http\Request $request
     * @param \Spatie\Permission\Models\Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sync_permissions_to_role(Request $request, Role $role)
    {
        if (!Auth::user()->can(Permissions::RoleEdit)) {
            abort(403);
        }

        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $role->syncPermissions($request->permissions);

        return redirect()->back()->with('success', 'Permissions assigned successfully');
    }

    /**
     * Detach all role from a user
     * @param \App\Models\User $user
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function remove_all_role_from_user(User $user)
    {

        // Only super admin can detach role to another super admin
        if ($user->hasRole(Super::Admin) && !Auth::user()->hasRole(Super::Admin)) {
            abort(401);
        }

        // Own role can not be detached
        if (Auth::user()->id == $user->id) {
            abort(404);
        }

        // Detach all roles from the user.
        $user->syncRoles([]);

        return redirect()->back()->with('success', 'All roles detached from ' . $user->name);
    }

    /**
     * Get all admins
     * @return \Illuminate\Contracts\View\View
     */
    public function admins()
    {
        $title = 'Admin';
        $users = User::whereHas('roles')->get();

        return view('roles.users', compact(['users', 'title']));
    }

    /**
     * Get all users
     * @return \Illuminate\Contracts\View\View
     */
    public function users()
    {
        $title = 'Users';
        $users = User::doesntHave('roles')->get();

        return view('roles.users', compact(['users', 'title']));
    }

    /**
     * Assign role to user form
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit_user(User $user)
    {
        $roles = Role::where('name', '!=', Super::Admin)->orderBy('name')->get();
        return view('roles.users_edit', compact(['user', 'roles']));
    }
}
