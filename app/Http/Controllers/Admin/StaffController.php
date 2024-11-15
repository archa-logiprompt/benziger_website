<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use App\Models\Department;
use App\Models\Journal;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
// use DB;
class StaffController extends Controller
{

    public function index()
    {
        $staff = Staff::all();
        $role = Role::all();
        return view('admin.staff.index', compact('staff','role'));
    }

    public function create()
    {
        $department = Department::all();
        $role = Role::all();
        return view('admin.staff.create', compact('department','role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
// 'email' => 'required|email|unique:users,email',

            'email' => [
                'required',
                'email',
                Rule::unique('staff', 'email'),
                Rule::unique('users', 'email'),
            ],

            'phone' => 'nullable|string',
            'password' => 'nullable|string',
            'department_id' => 'nullable|string',
            'description' => 'nullable|string',

        ], [
            'email.unique:staff' => 'This email is already taken in the staff table.',
            'email.unique:users' => 'This email is already taken in the users table.',

        ]);
        $userid = User::insertGetId(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 2
            ]
        );
        Staff::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'department_id' => $request->department_id,
            'description' => $request->description,
            'userid' => $userid,
            'roleid' => $request->role
        ]);
        return redirect()->route('admin.staff')->with('success', 'Staff created successfully!');
    }


    public function destroy($id)
    {
        Staff::where('id', $id)->delete();
        return redirect()->route('admin.staff')->with('success', 'staff deleted successfully');
    }

    public function edit($id)
    {
        // $staffdetails=Staff::where('id',$id)->first();
        $department = Department::all();
        $staffdetails = DB::table('staff')->select('staff.*', 'department.name as dname')->join('department', 'staff.department_id', '=', 'department.id')
            ->where('staff.id', $id)->first();

        return view('admin.staff.edit', compact('staffdetails', 'department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

           'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('staff', 'email'),
                Rule::unique('users', 'email'),
            ],
            'phone' => 'nullable|string',
            'password' => 'nullable|string',
            'department_id' => 'nullable|string',
            'description' => 'nullable|string',
        ], [
            'email.unique:staff' => 'This email is already taken in the staff table.',
            'email.unique:users' => 'This email is already taken in the users table.',

        ]);
        $post = Staff::find($id);
        $post->update($request->all());
        return redirect()->route('admin.staff')->with('success', 'staff updated successfully.');
    }

}
