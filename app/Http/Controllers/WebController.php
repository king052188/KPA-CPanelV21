<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class WebController extends Controller
{
    //


    public function site_init(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        $user_id = $user[0]->Id;

        $web = DB::select("SELECT * FROM web_table WHERE user_id = {$user_id} AND status > 1;");

        return view('member.web.site', compact('helper', 'user', 'web'));
    }

    public function create_init(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        $web = Helper::get_available_quota($user, "web_table");

        return view('member.web.create', compact('helper', 'user', 'web'));
    }
}
