<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboard()
    {

        $department = DB::table('department')->count();
        $staff = DB::table('staff')->count();
        return view('welcome', compact('department', 'staff'));
        
    }
}
