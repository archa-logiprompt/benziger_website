<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;


class JournalController extends Controller
{
    public function createJournal(Request $request)
    {
        // Validate the input data
        $request->validate([
            'paper_title' => 'required',
            'research_area' => 'required',
            'country_code' => 'required',
            'paper' => 'required',
            'abstract' => 'required',
            'key_words' 
        ]);

        
        Journal::create([
            'paper_title' => $request->paper_title,
            'research_area' => $request->research_area,
            'country_code' => $request->country_code,
            'paper' => $request->paper,
            'abstract' => $request->abstract,
            'key_words' => $request->key_words,
        ]);

        return view('welcome');
    }
}
