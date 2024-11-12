<?php

namespace App\Http\Controllers;

use App\Models\AssignPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\PermissionCategory;



class AdminController extends Controller
{

    public function login()
    {
        if (Auth::user()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }
    public function check(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($user)) {
            $userId = Auth::id();


            $userData = DB::table('users')
                ->join('staff', 'staff.userid', '=', 'users.id')
                ->join('assign_permissions', 'assign_permissions.role_id', 'staff.roleid')
                ->join('permission_category', 'permission_category.id', 'assign_permissions.category_id')
                ->where('assign_permissions.can_view', 1)
                ->where('users.id', $userId)
                ->select('permission_category.*')
                ->get();


            // Session::put('sidebar', $userData);


            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('error', 'Invalid Credentils');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function department()
    {

        return view('admin.department.index');
    }

    public function viewRole(Request $request)
    {
        $roleData = Role::all();
        return view("admin.roles.view", compact('roleData'));
    }


    public function CreateRoleView()
    {
        return view('admin.roles.create');
    }

    public function createRole(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Role::create([
            'name' => $request->name,
            'short_name' => $request->name,
        ]);
        return redirect(route('admin.roles.view'));
    }
    public function edit($id)
    {
        $editData = Role::where('id', $id)->first();
        return view('admin.roles.edit', compact('editData'));
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $post = Role::find($id);
        $post->update($request->all());
        return redirect()->route('admin.roles.view')->with('success', 'role updated successfully.');
    }


    public function deleteRole($id)
    {
        Role::where('id', $id)->delete();
        return back();
    }


    public function assign($id)
    {
        $assignData['categories'] = PermissionCategory::all();
        $assignData['assigned'] = AssignPermission::where(['role_id' => $id, 'can_view' => 1])->pluck('category_id');

        $assignData['roleid'] = $id;
        return view('admin.roles.assign', compact('assignData'));
    }


    public function AssignRole(Request $request)
    {


        $categories = PermissionCategory::all()->pluck('id');
        $category_selected = $request->category_id;
        $role_id = $request->role_id;

        AssignPermission::where(['role_id' => $role_id])->delete();
        foreach ($categories as $key => $value) {
            $arr = [
                'category_id' => $value,
                'role_id' => $role_id,
                'can_view' => in_array($value, $category_selected) ? 1 : 0,
            ];
            AssignPermission::create($arr);
        }
    }
}
