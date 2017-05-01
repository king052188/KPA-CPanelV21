<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\MemberBasic;
use App\MemberBeneficiary;
use App\Payment;
use App\Disk;
use App\FTP;
use DB;

use Illuminate\Support\Facades\Crypt;

class ApiController extends Controller
{
    //
    public static $host_api = "http://a4f66aca.ap.ngrok.io/";

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

    //

    public function create_disk(Request $request) {
        $user_cookies = Helper::getCookies();
        if($user_cookies == null) {
            $data = array(
                "code" => 404,
                "message" => "Fail"
            );
            return $data;
        }

        $user = Crypt::decrypt($user_cookies);

        $user_uid = $user[0]->Id;

        $disk = DB::select("SELECT * FROM disk_table WHERE user_id = {$user_uid};");

        if( COUNT($disk)> 0) {
            $data = array(
                "code" => 404,
                "message" => "You have disk already."
            );
            return $data;
        }

        $account = $request->account;
        $size = $request->size;

        $data = "?todo=DIR&account={$account}&size={$size}";
        $json = Helper::do_curl(ApiController::$host_api . $data);

        if($json["Code"] == 200) {
            $body = "We have received a request that you create a disk for the following:";
            $body .= "<br /><br /><b>Disk Name:</b> {$account}";
            $body .= "<br /><b>Disk Size:</b> {$size} GB";

            Helper::notification_email_send_mailgun($user[0]->first_name, $user[0]->email, "Disk Created", $body);

            $disk = new Disk();
            $disk->user_id = $user_uid;
            $disk->quota_id = (int)$size;
            $disk->status = 2;
            $r = $disk->save();
        }

        $password = Helper::get_random_password();
        $hashed = $password["new_password"];
        $data = "FTP.aspx?account={$account}&app={$account}&username={$account}&password={$hashed}";
        $json = Helper::do_curl(ApiController::$host_api . $data);

        if($json["Code"] == 200) {
            $body = "FTP Account Created Automatically, Please check below:";
            $body .= "<br /><br /><b>Hostname:</b> ftp.ckt.kpa21.com";
            $body .= "<br /><b>Port:</b> 21";
            $body .= "<br /><b>Username:</b> {$account}";
            $body .= "<br /><b>Password:</b> {$hashed}";

            Helper::notification_email_send_mailgun($user[0]->first_name, $user[0]->email, "FTP Account Created", $body);
        }

        $data = array(
            "code" => $json["Code"],
            "message" => $json["Message"],
            "hashed" => $hashed,
        );

        return $data;
    }

    public function create_ftp(Request $request) {
        $user_cookies = Helper::getCookies();
        if($user_cookies == null) {
            $data = array(
                "code" => 404,
                "message" => "Fail"
            );
            return $data;
        }

        $user = Crypt::decrypt($user_cookies);
        $user_uid = $user[0]->Id;
        $account = $request->account;
        $app = $request->app;
        $sub = $request->sub;
        $username = $request->username;
        $password = $request->password;
        
        $data = "FTP.aspx?account={$account}&app={$app}&sub={$sub}&username={$username}&password={$password}";

        $json = Helper::do_curl(ApiController::$host_api . $data);

        $root = "\\". $account ."\\". $app ."\\". $sub;

        if($json["Code"] == 200) {
            $body = "We have received a request that you create an FTP Account for the following:";
            $body .= "<br /><br /><b>Hostname:</b> ftp.ckt.kpa21.com";
            $body .= "<br /><b>Port:</b> 21";
            $body .= "<br /><b>Path:</b> {$root}";
            $body .= "<br /><b>Username:</b> {$username}";
            $body .= "<br /><b>Password:</b> {$password}";

            Helper::notification_email_send_mailgun($user[0]->first_name, $user[0]->email, "FTP Account Created", $body);
            $ftp = new FTP();
            $ftp->user_id = $user_uid;
            $ftp->username = $username;
            $ftp->password = $password;
            $ftp->path = $root;
            $ftp->status = 2;
            $r = $ftp->save();
        }

        $data = array(
            "code" => $json["Code"],
            "message" => $json["Message"]
        );
        return $data;
    }

}
