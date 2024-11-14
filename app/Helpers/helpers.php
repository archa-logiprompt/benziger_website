<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    function checkJournalStatus() 
    {
        // $status = DB::where();
        // if($status){
        //     return true;
        // }else{
        //     return false;

        // }
        return false;
    }
}

// if (! function_exists('getUserCompany')) {
//     function getUserCompany(): ?object
//     {
//         $companyId = Auth::user()->comp_id;
//         return Company::find($companyId);
//     }
// }
