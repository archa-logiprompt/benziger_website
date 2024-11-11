<?php

namespace App\Http\Controllers;

use App\Models\AssignPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

         $assignData['roleid'] = $id;
        return view('admin.roles.assign', compact('assignData'));
    }


    public function AssignRole(Request $request)
    {


        AssignPermission::create([
            "catgory_id" => $request->catgory_id,
            "role_id" => 1,
            "can_view" => 1
        ]);
    }






    // public function AssignRole(Request $request, $id)
    // {
    //     dd($id);
    //     $existingData = AssignPermission::where('id', $id)->first();

    //     if ($existingData) {

    //         $existingData->update([
    //             'role_id' =>  $request->route('id'),
    //             'category_id' => $request->category_id,
    //             'can_view' => 1,
    //         ]);
    //     } else {

    //         $existingData = AssignPermission::create([
    //             'role_id' => $request->route('id'),
    //             'category_id' => $request->category_id,
    //             'can_view' => 1,
    //         ]);
    //     }


    //     return view('admin.roles.assign', compact('existingData'));
    // }
}
