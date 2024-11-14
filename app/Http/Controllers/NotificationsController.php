<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications;

class NotificationsController extends Controller
{
    // view
    public function index()
    {
        $datas = Notifications::all();

        return view('admin.notifications.index', compact('datas'));
    }

    public function create()
    {
        return  view('admin.notifications.create');
    }

    // create
    public function store(Request $request)
    {
        $request->validate([
            'title',
            'description',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = 'notifications/' . time() . '_' . $image->getClientOriginalName();

            $image->move(public_path('notifications'), $imagePath);
        }

        Notifications::create([

            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect('admin/notifications')->with('success', 'notifications added successfully!');
    }

    // delete
    public function destroy($id)
    {
        Notifications::where('id', $id)->delete();
        return redirect('admin/notifications')->with('success', 'Notifications deleted successfully!');
    }

    // edit
    public function edit($id)
    {

        $data = Notifications::where('id', $id)->first();
        return view('admin.notifications.edit', compact('data'));
    }

    // update
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = 'notifications/' . time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('notifications'), $imagePath);

            $validatedData['image'] = $imagePath;
        }
        Notifications::where('id', $id)->update($validatedData);

        return redirect('admin/notifications')->with('success', 'Notification updated successfully.');
    }
}
