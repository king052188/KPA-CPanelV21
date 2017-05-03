<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class WebController extends Controller
{
    //

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
