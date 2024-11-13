<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralSettings;

class GeneralSettingController extends Controller

{

    public function create()
    {
        return  view('admin.generalSettings.create');
    }

    public function store(Request $request)
    {
        dd($request->all());

        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'contact',
            'whatsappContact',
            'email',
            'address_line1',
            'address_line2',
            'city',
            'state',
            'country',
            'postalCode',
            'apiKey',
            'apiSecret',
            'payment',
            'amount'

        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('settings', 'public');
        }

        // Create the department
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


        return redirect('admin/generalSettings')->with('success', 'Settings added successfully!');
    }



    public function index()
    {
        $settings = GeneralSettings::all();
        dd ($settings);
        // return view('welcome');
        // return view('admin.generalSettings.index', compact('settings'));
    }

    public function destroy($id)
    {

        GeneralSettings::where('id', $id)->delete();
        return redirect('admin/generalSettings')->with('success', 'General Settings deleted successfully!');
    }


    public function edit($id)
    {

        $settings = GeneralSettings::where('id', $id)->first();
        // dd($researchArea);
        return view('admin.generalSettings.edit', compact('settings'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'contact',
            'whatsappContact',
            'email',
            'address_line1',
            'address_line2',
            'city',
            'state',
            'country',
            'postalCode',
            'apiKey',
            'apiSecret',
            'payment',
            'amount'
        ]);

        $data = $request->except('logo');

        // Handle logo upload if present
        if ($request->hasFile('logo')) {
            $logoPath = time() . '_' . $request->file('logo')->getClientOriginalName();
            $path = $request->file('logo')->storeAs('settings', $logoPath, 'public');
            $data['logo'] = '/storage/' . $path;
        }

        // Update the record
        GeneralSettings::where('id', $id)->update($data);

        return redirect()->route('admin.generalsettings')->with('success', 'General settings updated successfully.');
    }
}
