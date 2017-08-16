<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordpressController extends Controller
{
    //

    public function free_plan() {

        return view("layout.promo_2017_1");
    }

    public function account_kit(Request $request) {

        $h = Helper::facebook_account_kit_v2($request);

        return $h;
    }

    public function account_kit_token($id, $token, $mobile) {

        return Helper::facebook_token($token);
    }
}
