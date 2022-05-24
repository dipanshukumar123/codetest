<?php

namespace App\Http\Controllers\Admin\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use View;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Role::orderBy('id', 'asc')->get();

            $data = [];
            foreach ($items as $key => $item) {
                $nestedData['id'] = $key + 1;
                $nestedData['name'] = $item->name;
                $nestedData['options'] = (string)View::make('admin.security.role.options-template', ['role' => $item])->render();;

                $data[$key] = $nestedData;
            }

            $json_data = [
                'draw' => $request->query('draw'),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => $data
            ];

            return response()->json($json_data);
        } else {
            return View('admin.security.role.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('id', 'asc')->get();

        return View('admin.security.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $exists = Role::whereName($value)->exists();

                    if ($exists) {
                        $fail('Name is already exist');
                    }
                }
            ],
            'permissions' => ['array']
        ]);

        // store
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.security.roles.index')->with('status', 'Role created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('id', 'asc')->get();

        $role_permissions = $role->permissions()->get()->map(function ($item, $key) {
            return $item->name;
        });

        return View('admin.security.role.edit', compact('role', 'role_permissions', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($role) {
                    $exists = Role::whereNotIn('id', [$role->id])->whereName($value)->exists();

                    if ($exists) {
                        $fail('Name is already exist');
                    }
                }
            ],
            'permissions' => ['array']
        ]);

        // update
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.security.roles.index')->with('status', 'Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->syncPermissions([]);
        $role->delete();

        return back()->with('status', 'Role deleted successfully!');
    }
}
