<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function landing_page() {
        return redirect('\login');
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
}
