<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index()
    {
        $department = Department::all();
        // dd($department);
        return  view('admin.department.index', compact('department'));
    }


    public function create()
    {
        return  view('admin.department.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048', // image validation
            ],
            ['image.mime' => 'Only jpeg, png, jpg, gif, svg extensions are allowed!']
        );

        // Handle the photo upload
        $filename = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'departments/' . time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('departments'), $filename);
        }
        Department::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $filename,
        ]);

        // Redirect or return response
        return redirect('admin/department')->with('success', 'Department created successfully!');
    }

    public function destroy($id)
    {
        Department::where('id', $id)->delete();
        return redirect()->route('department')->with('success', 'Department deleted successfully!');
    }

    public function edit($id)
    {
        $service = Department::where('id', $id)->first();
        return view('admin.department.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {

        $data = $request->validate(
            [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            ['image.mime' => 'Only jpeg, png, jpg, gif, svg extensions are allowed!']
        );
        $filename = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'departments/' . time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('departments'), $filename);
            $data['image'] = $filename;
        }
        Department::where('id', $id)->update($data);
        return redirect('department');
    }

}
