<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResearchArea;

class ResearchareaController extends Controller
{
    public function create(Request $request)
    {
        // Validate the input data
        $request->validate([
            'researchArea' => 'required',
            'description',
        ]);


        ResearchArea::create([
            'researchArea' => $request->researchArea,
            'description' => $request->description,
        ]);

     return redirect()->route('admin.researcharea.create')->with('success', 'research area added successfully!');

    }


    public function view()
    {
        $researchAreas = ResearchArea::all();
        // dd($researchAreas);
        return view('admin.researchArea.index', compact('researchAreas'));

    }

    public function destroy($id){

        ResearchArea::where('id',$id)->delete();
        return redirect()->route('admin.researchArea.index')->with('success', 'research area deleted successfully!');
        
    }


    public function edit($id)
{ 
  
     $researchArea= ResearchArea::where('id',$id)->first();
     dd($researchArea);
    return view('admin.researchArea.edit',compact('researchArea'));
}

public function update(Request $request, $id)
    {
        $request->validate([
            'researchArea' => 'required',
            'description',
        ]);
      $post = ResearchArea::find($id);
      $post->update($request->all());
      return redirect()->route('admin.researchArea')->with('success', 'research Area updated successfully.');
    }

}
