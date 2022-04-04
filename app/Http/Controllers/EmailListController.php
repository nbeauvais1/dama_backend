<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Member;


class EmailListController extends Controller
{
    public function index(){

        $now = DB::raw('NOW()');
        $member_emails = Member::join('user_membership', 'user.user_id', '=', 'user_membership.user_id')
                        ->where('expiry_date', '>', $now)
                        ->get();

        return view('email-list', ['emails' => $member_emails,]);        
    }
}
