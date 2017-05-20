<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WebSite;
use Illuminate\Support\Facades\Config;

class FTPController extends Controller
{
    //

    public function create_disk_init(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        return view('member.disk.create', compact('helper', 'user'));
    }

    public function create_init(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        $web = WebSite::where("Id", "=", $user[0]->Id)
            ->orWhere("status", "=", 2)->get()->toArray();

        $ftp = Helper::get_available_quota($user, "mysql_database_table");

        $configs = Config::get('laradnet_config');

        return view('member.ftp.create', compact('helper', 'user', 'web', 'ftp', 'configs'));
    }


}
