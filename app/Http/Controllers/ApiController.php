<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\MemberBasic;
use App\MemberBeneficiary;
use App\Payment;
use DB;

use Illuminate\Support\Facades\Crypt;

class ApiController extends Controller
{
    //
    public function member_populate($type) {
        $sort_id = 0;

        $sort_name = "Pending";

        if($type == "activated") {
            $sort_id = 3;
            $sort_name = "Activated";
        }
        else if ($type == "on-processed") {
            $sort_id = 2;
            $sort_name = "On-Processed";
        }
        else {
            $sort_id = 1;
            $sort_name = "Pending";
        }

        $members = DB::select("SELECT * FROM member_table WHERE status = {$sort_id};");

        return array(
            "status" => 403,
            "message" => "You are not able to access this.",
            "sort_by" => $sort_name,
            "draw" => 1,
            "recordsTotal" => COUNT($members),
            "recordsFiltered" => COUNT($members),
            "data" => $members,
        );
    }

    public function cookies(Request $request) {

        $user_cookies = Helper::getCookies();

        if($user_cookies == null) {
            $data = array(
                "code" => 404,
                "message" => "Fail"
            );

            return $data;
        }

        $data = array(
            "code" => 200,
            "message" => "Success"
        );

        $user = Crypt::decrypt($user_cookies);
        $app_id = 1;
        $app_name = $request->app;
        $feed = $request->feed;
        $user_id = $user[0]->Id;

        Helper::flushCookies("LaradnetServer");
        $cookies = Helper::do_curl("http://localhost:61512/TokenRequest.aspx?app_id={$app_id}&app_name={$app_name}&uid={$user_id}&first={$feed}");
        $guid = $cookies["Token_GUID"];
        $hashed = $cookies["Token_Hashed"];
        return response($data)
            ->withCookie(cookie('Laradnet-Guid', $guid, 60))
            ->withCookie(cookie('Laradnet-Session', $hashed, 60));
    }

}
