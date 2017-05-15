<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\MemberBasic;
use App\MemberBeneficiary;
use App\Payment;
use App\Disk;
use App\Quota;
use App\WebSite;
use App\FTP;
use DB;

use Composer\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

use Illuminate\Support\Facades\Crypt;

class ApiController extends Controller
{
    //
    public static $host_api = "http://cpanelv21-engine.kpa21.info/";

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

    public function create_package_plan(Request $request) {
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
        $package_plan = (int)$request->package_plan;
        $packages = DB::select("SELECT * FROM quota_reference_table WHERE Id = {$package_plan} AND status > 1;");

        if( COUNT($packages) == 0 ) {
            $data = array(
                "code" => 404,
                "message" => "Package plan did not found."
            );
            return $data;
        }

        if($packages[0]->status != 3) {
            $data = array(
                "code" => 200,
                "message" => "success",
                "url" => "/package/plan/payment"
            );
            return $data;
        }
        else {
            $disk_json = $this->disk_create($user, (double)$packages[0]->disk);
            if($disk_json["Code"] == 200) {
                $ftp_json = $this->ftp_create($user, null, null, null, null);
                if($ftp_json["Code"] == 200) {
                    $quota = new Quota();
                    $quota->quota_id = $package_plan;
                    $quota->user_id = $user_uid;
                    $quota->status = 2;
                    $r = $quota->save();
                    if( $r ) {
                        $data = array(
                            "code" => 200,
                            "message" => "success",
                            "url" => "/package/plan/completed"
                        );
                        return $data;
                    }
                    $data = array(
                        "code" => 501,
                        "message" => "Oops, something went wrong.",
                        "url" => "/package/plan/completed"
                    );
                    return $data;
                }
                $data = array(
                    "code" => $ftp_json["Code"],
                    "message" => $ftp_json["Message"]
                );
                return $data;
            }
        }
    }

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

        $disk_json = $this->disk_create($user, $disk[0]->disk);
        if($disk_json["Code"] == 200) {
            $ftp_json = $this->ftp_create($user, null, null, null, null);

            $data = array(
                "code" => $ftp_json["Code"],
                "message" => $ftp_json["Message"]
            );
            return $data;
        }

        $data = array(
            "code" => $disk_json["Code"],
            "message" => $disk_json["Message"]
        );

        return $data;
    }

    public function create_web(Request $request) {
        $user_cookies = Helper::getCookies();
        if($user_cookies == null) {
            $data = array(
                "code" => 404,
                "message" => "Fail"
            );
            return $data;
        }

        $user = Crypt::decrypt($user_cookies);
        $hostname = $request->hostname;
        $port = $request->port;
        $protocol = $request->protocol;

        $web = DB::select("SELECT * FROM web_table WHERE binding_hostname = '{$hostname}';");
        if( COUNT($web) == 0 ) {
            $data = array(
                "code" => 401,
                "message" => $hostname . " already exists."
            );
            return $data;
        }

        $json = $this->web_create($user, $hostname, $port);
        $data = array(
            "code" => $json["Code"],
            "message" => $json["Message"]
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

    public function disk_create($users, $size) {
        $account = $users[0]->username;
        $data = "?todo=DIR&account={$account}&size={$size}";
        $json = Helper::do_curl(ApiController::$host_api . $data);

        if($json["Code"] == 200) {
            $body = "Your Disk was Created Successfully, Please check details below:";
            $body .= "<br /><br /><b>Disk Name:</b> {$account}";
            $body .= "<br /><b>Disk Size:</b> {$size} GB";

            Helper::notification_email_send_mailgun($users[0]->first_name, $users[0]->email, "Disk Created", $body);

            $disk = new Disk();
            $disk->user_id = $users[0]->Id;
            $disk->quota = (double)$size;
            $r = $disk->save();
        }
        return $json;
    }

    public function web_create($users, $hostname, $port) {
        $account = $users[0]->username;
        $data = "?todo=IIS&account={$account}&hostname={$hostname}&port={$port}";
        $json = Helper::do_curl(ApiController::$host_api . $data);

        if($json["Code"] == 200) {
            $body = "Your Web Site was Created Successfully, Please check details below:";
            $body .= "<br /><br /><b>Hostname:</b> {$hostname}";
            $body .= "<br /><b>Port:</b> {$port}";

            Helper::notification_email_send_mailgun($users[0]->first_name, $users[0]->email, "Website Created", $body);

            $root = "/". $account ."/". $hostname ."/wwwroot/public";
            $web = new WebSite();
            $web->user_id = $users[0]->Id;
            $web->root_path = $root;
            $web->site_name = $hostname;
            $web->binding_type = 1;
            $web->binding_ip = "127.0.0.1";
            $web->binding_port = (int)$port;
            $web->binding_hostname = $hostname;
            $web->status = 2;
            $r = $web->save();
        }
        return $json;
    }

    public function ftp_create($users, $app, $sub, $username, $password) {
        $account = $users[0]->username;
        $random = Helper::get_random_password($password);
        $password = $random["new_password"];

        if($app == null && $username == null) {
            $app = $account;
            $username = $account;
        }
        else if($app == null) {
            $app = $account;
        }

        $data = "FTP.aspx?account={$account}&app={$app}&ub={$sub}&username={$username}&password={$password}";
        $json = Helper::do_curl(ApiController::$host_api . $data);

        $root = "/". $account ."/". $app ."/". $sub;

        if($json["Code"] == 200) {
            $body = "Your FTP Account Created Automatically, Please check below:";
            $body .= "<br /><br /><b>Hostname:</b> ftp.ckt.kpa21.com";
            $body .= "<br /><b>Port:</b> 21";
            $body .= "<br /><b>Username:</b> {$account}";
            $body .= "<br /><b>Password:</b> {$password}";
            Helper::notification_email_send_mailgun($users[0]->first_name, $users[0]->email, "FTP Account Created", $body);

            $ftp = new FTP();
            $ftp->user_id = $users[0]->Id;
            $ftp->username = $username;
            $ftp->password = $password;
            $ftp->path = $root;
            $ftp->status = 2;
            $r = $ftp->save();
        }
        return $json;
    }

    //

    public function get_disk_statistic(Request $request, $username, $disk_size) {
        $user_cookies = Helper::getCookies();
        if($user_cookies == null) {
            $data = array(
                "code" => 404,
                "message" => "Fail"
            );
            return $data;
        }

        $data = "?todo=QUOTA&account={$username}&size={$disk_size}";

        $json = Helper::do_curl(ApiController::$host_api . $data);

        return $json;
    }

    public function web_state_update(Request $request) {
        $user_cookies = Helper::getCookies();
        if($user_cookies == null) {
            $data = array(
                "code" => 404,
                "message" => "Fail"
            );
            return $data;
        }
        $hostname = $request->domain;
        $state = $request->status;
        $data = "?todo=SITE-STATE&hostname={$hostname}&state={$state}";
        $json = Helper::do_curl(ApiController::$host_api . $data);
        return $json;
    }

}
