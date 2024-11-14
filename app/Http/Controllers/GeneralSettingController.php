<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralSettings;
use Illuminate\Support\Facades\Storage;

class GeneralSettingController extends Controller

{

    public function create()
    {
        return  view('admin.generalSettings.create');
    }

    // create
    public function store(Request $request)
    {

        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'contact' => 'required|string|max:255',
            'whatsappContact' => 'required|string|max:255',
            'email' => 'required|string',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postalCode' => 'required|string|max:20',
            'apiKey' => 'nullable|string|max:255',
            'apiSecret' => 'nullable|string|max:255',
            'payment' => 'required|boolean',
            'amount' => 'nullable|numeric'
        ]);

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = 'generalsettings/' . time() . '_' . $logo->getClientOriginalName();

            $logo->move(public_path('generalsettings'), $logoPath);
        }

        GeneralSettings::create([
            'logo' => $logoPath,
            'contact' => $request->contact,
            'whatsappContact' => $request->whatsappContact,
            'email' => $request->email,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postalCode' => $request->postalCode,
            'apiKey' => $request->apiKey,
            'apiSecret' => $request->apiSecret,
            'payment' => $request->payment,
            'amount' => $request->amount
        ]);

        return redirect('admin/generalsettings')->with('success', 'Settings added successfully!');
    }

    // view
    public function index()
    {
        $settings = GeneralSettings::all();

        return view('admin.generalSettings.index', compact('settings'));
    }

    // delete
    public function destroy($id)
    {
        GeneralSettings::where('id', $id)->delete();
        return redirect('admin/generalsettings')->with('success', 'General Settings deleted successfully!');
    }

    // edit
    public function edit($id)
    {

        $settings = GeneralSettings::where('id', $id)->first();
        return view('admin.generalSettings.edit', compact('settings'));
    }

    // update
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'contact' => 'required|string|max:255',
            'whatsappContact' => 'required|string|max:255',
            'email' => 'required|string',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postalCode' => 'required|string|max:20',
            'apiKey' => 'nullable|string|max:255',
            'apiSecret' => 'nullable|string|max:255',
            'payment' => 'required|boolean',
            'amount' => 'nullable|numeric'
        ]);

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = 'generalsettings/' . time() . '_' . $logo->getClientOriginalName();
            $logo->move(public_path('generalsettings'), $logoPath);
            $validatedData['logo'] = $logoPath;
        }

        GeneralSettings::where('id', $id)->update($validatedData);

        return redirect('admin/generalsettings')->with('success', 'General settings updated successfully.');
    }
}
