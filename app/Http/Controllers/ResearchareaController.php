<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResearchArea;

class ResearchareaController extends Controller
{
// view form
    public function create()
    {
        return  view('admin.researchArea.create');
    }

    // create
    public function store(Request $request)
    {
        $request->validate([
            'researchArea' => 'required',
            'description',
        ]);

        ResearchArea::create([
            'researchArea' => $request->researchArea,
            'description' => $request->description,
        ]);

        return redirect('admin/researcharea')->with('success', 'research area added successfully!');
    }

    // view
    public function index()
    {
        $researchAreas = ResearchArea::all();
        // dd($researchAreas);
        return view('admin.researchArea.index', compact('researchAreas'));
    }

    // delete
    public function destroy($id)
    {
        ResearchArea::where('id', $id)->delete();
        return redirect('admin/researcharea')->with('success', 'research area deleted successfully!');
    }

    // edit
    public function edit($id)
    {
        $service = ResearchArea::where('id', $id)->first();
        return view('admin.researchArea.edit', compact('service'));
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'researchArea' => 'required',
            'description',
        ]);
        $post = ResearchArea::find($id);
        $post->update($request->all());
        return redirect('admin/researcharea')->with('success', 'research Area updated successfully.');
    }
}
