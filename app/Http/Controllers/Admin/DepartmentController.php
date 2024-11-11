<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    //


    public function index()  {

        $department=Department::all();
        // dd($department);
      return  view('admin.department.index',compact('department'));
     
        
    }



    public function create()  {
      return  view('admin.department.create');
        
    }

    public function store(Request $request)
    {
        // dd($request->all());
    
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // image validation
        ]);

        // Handle the photo upload
        $photoPath = null;
        if ($request->hasFile('image')) {
            $photoPath = $request->file('image')->store('departments', 'public');
        }

        // Create the department
        Department::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $photoPath,
        ]);

        // Redirect or return response
        return redirect()->route('admin.department.create')->with('success', 'Department created successfully!');
    }

    public function destroy($id)
{
    Department::where('id',$id)->delete();
    return redirect()->route('department')->with('success', 'Department deleted successfully!');
}

public function edit($id)
{ 
  
     $service= Department::where('id',$id)->first();

    return view('admin.department.edit',compact('service'));
}

public function update(Request $request, $id)
{ 
    $data = [
    'name'=>$request->name,
    'description'=>$request->description,   
    ];
    if ($request->hasFile('image')) {
        $filename = time() . $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('departments', $filename, 'public');
        $data['image'] = '/storage/' . $path;
    } 
   
    Department::where('id', $id)->update($data);
     return redirect('department');
}

}
