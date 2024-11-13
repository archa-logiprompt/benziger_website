<?php

namespace App\Http\Controllers;

use App\Mail\sendEmail;
use Illuminate\Http\Request;
use App\Models\Journal;
use App\Models\JournelStatus;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendMail;


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

    public function viewAllJournal()
    {
        $journalData  = DB::table('journal')
            ->join('journal_author', 'journal_author.journal_id', 'journal.id')
            ->where('journal_author.main', 1)
            ->get();
        return view('admin.journel.index', compact('journalData'));
    }


    public function viewJournalById($id)
    {
        $journalDataById  = DB::table('journal')
            ->join('journal_author', 'journal_author.journal_id', 'journal.id')
            ->where('journal_author.id', $id)
            ->where('journal_author.main', 1)
            ->get();


        return view('admin.journel.view', compact('journalDataById'));
    }

    public function rejectJournel(Request $request)
    {
        JournelStatus::create([
            'staffid' => $request->staffid,
            'journelid' => $request->journelid,
            'reason' => $request->reason,
            'status' => 0,
            "created_at" => Carbon::now(),
            "updated_at" =>  Carbon::now()
        ]);
        Mail::to('namithamanikandan631@gmail.com')->send(
            (new sendEmail([
                'name' => 'Demo',
            ]))->from('nsaslam55@gmail.com', 'configmail.from.name')
        );

        return redirect()->route('journal.index');
    }

    public function acceptJournel(Request $request)
    {
        JournelStatus::create([
            'staffid' => $request->staffid,
            'journelid' => $request->journelid,
            'reason' => "Null",
            'status' => 1,
            "created_at" => Carbon::now(),
            "updated_at" =>  Carbon::now()
        ]);
        return redirect()->route('journal.index');
    }
}
