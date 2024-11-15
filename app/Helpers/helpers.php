<?php

use App\Models\JournelStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

if (! function_exists('getUser')) {
    function getUser(int $id): ?object
    {
        return User::find($id);
    }
}

if (! function_exists('getCurrentUser')) {
    function getCurrentUser()
    {
        return Auth::user();
    }
}
if (! function_exists('checkJournalStatus')) {
    function checkJournalStatus($userid, $journalId)
    {

        $status = JournelStatus::where(['staffid' => $userid, 'journelid' => $journalId])->get();
        if ($status->count() > 0) {
            return true;
        } else {
            return false;
        }
        return false;
    }
}
