<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use App\Models\Role;

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

    // public function dashboard()
    // {

    //     $Patient = Patient::orderBy('patients.id', 'desc')
    //     ->join('doctors', 'patients.doctor_id', '=', 'doctors.id')
    //     ->join('department', 'patients.department_id', '=', 'department.id')
    //     ->join('slots', 'patients.slot_id', '=', 'slots.id')->get();

    //     return view('admin.dashboard',compact('Patient'));
    // }

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
}
