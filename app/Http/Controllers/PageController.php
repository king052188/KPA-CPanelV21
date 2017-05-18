<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function landing_page() {
        return redirect('\login');
    }

    public function package(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }
        
        return view('member.package.index', compact('helper', 'user'));
    }

    public function setup_server(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        return view('member.package.setup', compact('helper', 'user'));
    }

    public function temp(Request $request) {
        $helper = Helper::ssl_secured($request);

        return view('layout.404', compact('helper'));
    }

    public function clear_cache() {
        Helper::flushCookies();
        Helper::flushCookies("endorsement_session");
        return redirect('/registration/completed');
    }

    public function registration_completed(Request $request) {
        $helper = Helper::ssl_secured($request);
        Helper::flushCookies();
        Helper::flushCookies("endorsement_session");
        return view('layout.200', compact('helper'));
    }

    public function reset_password_completed(Request $request) {
        $helper = Helper::ssl_secured($request);
        Helper::flushCookies();
        Helper::flushCookies("endorsement_session");
        return view('layout.200_reset_password', compact('helper'));
    }

    public function compose_init(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        return view('member.tools.composer', compact('helper', 'user'));
    }
}
