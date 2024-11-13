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
            'address_line1' => 'required',
            'address_line2' => 'nullable',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'postalCode' => 'required',
            // authors details
            'authors' => 'required|array|min:1',
            'authors.*.name' => 'required',
            'authors.*.designation' => 'required',
            'authors.*.organization' => 'required',
            'authors.*.email' => 'required',
            'authors.*.mobile' => 'required',
            'authors.*.main' => 'required|boolean',
        ]);

        foreach ($request->authors as $authorData) {
            JournalAuthor::create([
                'journal_id' => $request->journal_id,
                'address_line1' => $request->address_line1,
                'address_line2' => $request->address_line2,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'postalCode' => $request->postalCode,
                'name' => $authorData['name'],
                'designation' => $authorData['designation'],
                'organization' => $authorData['organization'],
                'email' => $authorData['email'],
                'mobile' => $authorData['mobile'],
                'main' => $authorData['main'],
            ]);
        }

        return view('welcome');
    }
}
