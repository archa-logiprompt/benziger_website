<?php

namespace App\Http\Controllers;

use App\Mail\sendEmail;
use Illuminate\Http\Request;
use App\Models\Journal;
use App\Models\JournelStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    public function createJournal(Request $request)
    {
        // Validate the input data
        $uniqueId = ('BNZ' . substr(str_shuffle(time()), 0, 3));
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
            'unique_id' => $uniqueId,
        ]);

        return view('welcome');
    }

    public function viewAllJournal()
    {

        $user = Auth::user();
        if ($user->role == 1) {
            $journalData  = Journal::where(['status' => 0])->with(['department', 'department.staff', 'journalAuthor'])->get();
        } else {

            $journalData  = Journal::where(['status' => 0])->with(['department', 'journalAuthor'])
                ->whereHas('department', function ($query) use ($user) {
                    $query->where('id', $user->staff[0]->department_id);
                })
                ->get();
        }

        return view('admin.journel.index', compact('journalData'));
    }


    public function viewJournalById($id)
    {
        $journalDataById  = DB::table('journal')
            ->join('journal_author', 'journal_author.journal_id', 'journal.id')
            ->join('department', 'department.id', 'journal.department_id')
            ->select('department.name as dname', 'journal.*', 'journal_author.*')
            ->where('journal.id', $id)
            ->where('journal_author.main', 1)
            ->get();

        $journalStatus = DB::table('journel_status')->get();
        return view('admin.journel.view', compact('journalDataById', 'journalStatus'));
    }

    public function rejectJournel(Request $request)
    {
        $journelId = $request->journelid;
        $uniqueId = $request->uniqueid;

        $digits = 4;
        $otp = rand(pow(10, $digits - 1), pow(10, $digits) - 1);

        JournelStatus::create([
            'staffid' => $request->staffid,
            'journelid' => $request->journelid,
            'reason' => $request->reason,
            'status' => 0,
        ]);

        Mail::to($request->email)->send(
            (new sendEmail([
                'name' => $request->name,
                'reason' => $request->reason,
                'title' => $request->title,
                'random' => $uniqueId,
                'otp' => $otp,
            ]))->from('nsaslam55@gmail.com', 'Benziger')
        );
        JournelStatus::where(['journelId' => $journelId])->delete();

        Journal::where(['id' => $journelId])
            ->update([
                'status' => 2,
                'otp' => $otp,
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
            ]);
        } else {
            Journal::where('id', $journelId)
                ->update([
                    'status' => 1
                ]);
        }

        return redirect()->route('journal.index');
    }

    public function index($id)
    {
        return view('frontend.index', compact('id'));
    }


    public function otpCheck(Request $request)
    {
        $otp = $request->otp;
        $uniqueId = $request->uniqueid;


        $data  = DB::table('journal')
            ->join('journal_author', 'journal_author.journal_id', 'journal.id')
            ->join('department', 'department.id', 'journal.department_id')
            ->select('department.name as dname', 'journal.*', 'journal_author.*')
            ->where(['otp' => $otp, 'unique_id' => $uniqueId])
            ->where('journal_author.main', 1)
            ->get();

        if ($data->count() == 1) {
            return redirect('user/resubmit/' . $uniqueId);
        } else {
            return redirect()->route('user.index');
        }
    }

    public function reSubmit($id)
    {
        // dd($id);
        $journalDataById  = DB::table('journal')
            ->join('journal_author', 'journal_author.journal_id', 'journal.id')
            ->join('department', 'department.id', 'journal.department_id')
            ->select('department.name as dname', 'journal.*', 'journal_author.*')
            ->where('journal.unique_id', $id)
            ->where('journal_author.main', 1)
            ->get();

        return view('frontend.resubmit', compact('journalDataById'));
    }

    public function updateJournal(Request $request)
    {
        $Id = $request->journelid;

        if ($request->has('file')) {

            $path = public_path('uploads');

            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);

            Journal::where('id', $Id)
                ->update([
                    'paper' => $filename
                ]);
        }
        return redirect()->route('login');
    }
}
