<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Config;

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

        $configs = Config::get('laradnet_config');

        return view('member.web.create', compact('helper', 'user', 'web', 'configs'));
    }

    public function app_install_wordpress(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        $user_id = $user[0]->Id;

        $web = DB::select("SELECT * FROM web_table WHERE user_id = {$user_id} AND status > 1;");

        $configs = Config::get('laradnet_config');

        return view('member.app.wordpress', compact('helper', 'user', 'web', 'configs'));
    }

    public function web_traffic($license, $site_name) {
        
        $plus = 1000;

        if($license == "0897fdd7-d374-458f-8c18-10bab3329a59") {
            if($site_name == "cheappartsguy.com") {
                $plus = 0;
            }

            if($site_name == "scrapcatapp.com") {
                $plus = 0;
            }
        }

        $site = array("name" => $site_name, "date" => Date("ymd") + $plus);

        return view('layout.traffic', compact('site'));
    }
}
