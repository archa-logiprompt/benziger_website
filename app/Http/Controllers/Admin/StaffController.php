<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
// use DB;
class StaffController extends Controller
{

    public function index()
    {
        $staff = Staff::all();
        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        $department = Department::all();
        return view('admin.staff.create', compact('department'));
    }

    public function store(Request $request)
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
        Staff::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'department_id' => $request->department_id,
            'description' => $request->description,
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
