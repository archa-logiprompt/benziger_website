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
            'department_id' => 'required',
            'country_code' => 'required',
            'paper' => 'required',
            'abstract' => 'required',
            'key_words'
        ]);
        Journal::create([
            'paper_title' => $request->paper_title,
            'department_id' => $request->department_id,
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
            ->join('staff', 'staff.department_id', 'journal.department_id')
            ->select('Journal.*', 'journal_author.*', 'staff.name as staff_name', 'staff.id as staff_id')
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
        $journalStatus = DB::table('journel_status')->get();
        return view('admin.journel.view', compact('journalDataById', 'journalStatus'));
    }

    public function rejectJournel(Request $request)
    {
        $journelId = $request->journelid;
        JournelStatus::create([
            'staffid' => $request->staffid,
            'journelid' => $request->journelid,
            'reason' => $request->reason,
            'status' => 0,
            "created_at" => Carbon::now(),
            "updated_at" =>  Carbon::now()
        ]);

        Mail::to($request->email)->send(
            (new sendEmail([
                'name' => $request->name,
                'reason' => $request->reason,
                'title' => $request->title,
            ]))->from('nsaslam55@gmail.com', 'Benziger')
        );
        Journal::where('id', $journelId)
            ->update([
                'status' => 2
            ]);
        return redirect()->route('journal.index');
    }

    public function acceptJournel(Request $request)
    {
        $departmentId = $request->departmentid;
        $journelId = $request->journelid;

        $status_count = DB::table('journel_status')
            ->where('journelid', $journelId)
            ->where('status', 1)
            ->get();
        $staff_count = DB::table('staff')
            ->where('department_id', $departmentId)
            ->get();


        if ($staff_count->count() !==  $status_count->count()) {
            JournelStatus::create([
                'staffid' => $request->staffid,
                'journelid' => $request->journelid,
                'reason' => "Null",
                'status' => 1,
                "created_at" => Carbon::now(),
                "updated_at" =>  Carbon::now()
            ]);
        } else {
            Journal::where('id', $journelId)
                ->update([
                    'status' => 1
                ]);
        }

        return redirect()->route('journal.index');
    }
}
