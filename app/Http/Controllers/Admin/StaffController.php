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

        $staff = DB::table('staff')
            ->join('users', 'users.id', 'staff.userid')
            ->select('staff.*', 'users.email')
            ->get();
        $role = Role::all();
        return view('admin.staff.index', compact('staff', 'role'));
    }

    public function create()
    {
        $department = Department::all();
        $role = Role::all();
        return view('admin.staff.create', compact('department', 'role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:users,email',

            // 'email' => [
            //     'required',
            //     'email',
            //     Rule::unique('staff', 'email'),
            //     Rule::unique('users', 'email'),
            // ],

            'phone' => 'nullable|string',
            'password' => 'nullable|string',
            'department_id' => 'nullable|string',
            'description' => 'nullable|string',

        ],);
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
        // dd($id);
        $department = Department::all();
        $staffdetails = DB::table('staff')
            ->select('staff.*', 'department.name as dname', 'users.email as user_email', 'users.password as user_password')
            ->join('department', 'staff.department_id', '=', 'department.id')
            ->join('users', 'users.id', 'staff.userid')
            ->where('users.id', $id)->first();

        // dd($staffdetails);

        return view('admin.staff.edit', compact('staffdetails', 'department'));
    }

    public function update(Request $request, $id)
    {
        // dd($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'password' => 'nullable|string',
            'department_id' => 'nullable|string',
            'description' => 'nullable|string',
        ], [
            'email.unique:staff' => 'This email is already exists.',

        ]);
        // dd($request->email);
        Staff::where('userid', $id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'description' => $request->description,
        ]);

        $user = User::where('id', $id)->firstOrFail();

        $userData = [
            'email' => $request->email,
            'name' => $request->name,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);;




        return redirect()->route('admin.staff')->with('success', 'staff updated successfully.');
    }
}
