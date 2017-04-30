<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WebSite;

class FTPController extends Controller
{
    //

    public function create_init(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        $web = WebSite::where("Id", "=", $user[0]->Id)
            ->orWhere("status", "=", 2)->get()->toArray();
        
        return view('member.ftp.create', compact('helper', 'user', 'web'));
    }


}
