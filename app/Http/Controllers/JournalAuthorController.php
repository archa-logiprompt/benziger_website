<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JournalAuthor;


class JournalAuthorController extends Controller
{
    public function createAuthor(Request $request)
    {
        
        $request->validate([
            'journal_id' => 'required|exists:journal,id',
            'name' => 'required',
            'designation' => 'required',
            'organization' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'address_line1' => 'required',
            'address_line2' => 'nullable',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'postalCode' => 'required',
            'main' => 'required|boolean',
        ]);

        JournalAuthor::create([
            'journal_id' => $request->journal_id,
            'name' => $request->name,
            'designation' => $request->designation,
            'organization' => $request->organization,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postalCode' => $request->postalCode,
            'main' => $request->main,
        ]);

        return view('welcome');
    }
}
