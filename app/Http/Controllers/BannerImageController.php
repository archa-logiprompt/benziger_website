<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BannerImage;

class BannerImageController extends Controller
{
    public function index()
    {
        $datas = BannerImage::all();

        return view('admin.bannerImage.index', compact('datas'));
    }

    public function create()
    {
        return  view('admin.bannerImage.create');
    }

    // create
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'picture' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'picture.mimes' => 'Only jpeg, png, jpg, gif, svg extensions are allowed!',
        ]);

        $picturePath = null;

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $picturePath = 'bannerImage/' . time() . '_' . $picture->getClientOriginalName();
            $picture->move(public_path('bannerImage'), $picturePath);
        }


        BannerImage::create([
            'title' => $request->title,
            'picture' => $picturePath,
        ]);

        return redirect('admin/bannerImage')->with('success', 'Banner Image added successfully!');
    }


    // delete
    public function destroy($id)
    {
        BannerImage::where('id', $id)->delete();
        return redirect('admin/bannerImage')->with('success', 'Banner Image deleted successfully!');
    }

    // edit
    public function edit($id)
    {

        $data = BannerImage::where('id', $id)->first();
        return view('admin.bannerImage.edit', compact('data'));
    }

    // update
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'title' => 'required|string|max:255',
                'picture' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            ['picture.mime' => 'Only jpeg, png, jpg, gif, svg extensions are allowed!']
        );
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $picturePath = 'bannerImage/' . time() . '_' . $picture->getClientOriginalName();
            $picture->move(public_path('bannerImage'), $picturePath);

            $validatedData['picture'] = $picturePath;
        }
        BannerImage::where('id', $id)->update($validatedData);

        return redirect('admin/bannerImage')->with('success', 'Banner Image updated successfully.');
    }
}
