<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class Helper extends Controller
{
    //
    public static $domain = "fbi-ph.dev";
    public static $cookie_life_default = 3600 / 2;
    public static $cookie_life_forever = 2000000000;

    public static $facebook_app_id = "239866523142614";
    public static $app_secret = "99647c4751d6afe5a54cbc1d4c20773b";
    public static $account_kit_api_version = "v1.1";

    public static function create_database_user($username, $password, $withRemote = null) {

        try {
            $db = DB::statement("CREATE USER '{$username}'@'localhost' IDENTIFIED BY '{$password}';");

            if($withRemote != null) {
                $db = DB::statement("CREATE USER '{$username}'@'%' IDENTIFIED BY '{$password}';");
            }

            if($db) {

                $db = DB::statement("GRANT USAGE ON *.* TO '{$username}'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;");

                if($db) {

                    return [
                        "status" => "success",
                        "code" => 200,
                        "message" => "[{$username}] database was created and added privileges to [{$username}]."
                    ];
                }

                return [
                    "status" => "fail",
                    "code" => 500,
                    "message" => "Error adding privileges of database."
                ];
            }

            return [
                "status" => "fail",
                "code" => 500,
                "message" => "{$username} database error while in processing."
            ];


        } catch (\Illuminate\Database\QueryException $e) {
            return [
                "status" => $e->errorInfo[0],
                "code" => $e->errorInfo[1],
                "message" => $e->errorInfo[2],
            ];

        } catch (PDOException $e) {
            dd($e);
        }
    }

    public static function create_database_and_attach_user($username, $database) {

        try {
            $db = DB::statement("CREATE DATABASE `{$database}`;");

            if($db) {

                $db = DB::statement("GRANT ALL PRIVILEGES ON `{$database}`.* TO '{$username}'@'localhost' WITH GRANT OPTION;");

                if($db) {

                    return [
                        "status" => "success",
                        "code" => 200,
                        "message" => "[{$database}] database was created and added privileges to [{$username}]."
                    ];
                }

                return [
                    "status" => "fail",
                    "code" => 500,
                    "message" => "Error adding privileges of database."
                ];
            }

            return [
                "status" => "fail",
                "code" => 500,
                "message" => "{$database} database error while in processing."
            ];


        } catch (\Illuminate\Database\QueryException $e) {
            return [
                "status" => $e->errorInfo[0],
                "code" => $e->errorInfo[1],
                "message" => $e->errorInfo[2],
            ];

        } catch (PDOException $e) {
            dd($e);
        }
    }

    public static function set_database_and_attach_user($username, $database, $withRemote = null) {

        try {

            $db = DB::statement("GRANT ALL PRIVILEGES ON `{$database}`.* TO '{$username}'@'localhost' WITH GRANT OPTION;");

            if($withRemote != null) {
                $db = DB::statement("GRANT ALL PRIVILEGES ON `{$database}`.* TO '{$username}'@'%' WITH GRANT OPTION;");
            }

            if($db) {

                return [
                    "status" => "success",
                    "code" => 200,
                    "message" => "[{$database}] database was created and added privileges to [{$username}]."
                ];
            }

            return [
                "status" => "fail",
                "code" => 500,
                "message" => "Error adding privileges of database."
            ];


        } catch (\Illuminate\Database\QueryException $e) {
            return [
                "status" => $e->errorInfo[0],
                "code" => $e->errorInfo[1],
                "message" => $e->errorInfo[2],
            ];

        } catch (PDOException $e) {
            dd($e);
        }
    }

    public static function domain_check($sub = "web", $path = "/", $secured = false) {

        $s = $sub . ".";
        if($sub == null) {
            $s = "web.";
        }

        if($secured) {
            return redirect("https://". $s . Helper::$domain . $path);
        }
        return redirect("http://". $s . Helper::$domain . $path);
    }

    public static function sub_domain_validation($sub) {
        $result = null;
        switch ($sub) {
            case "staging" :
                $result = "staging";
                break;
            default :
                $result = "www";
                break;
        }
        return $result;
    }

    public static function ssl_secured(Request $request) {
        $ssl = null;
        if ($request->server('HTTP_X_FORWARDED_PROTO') == 'https')
        {
            $ssl = ["status" => true];
        }
        else
        {
            $ssl = ["status" => false];
        }
        return $ssl;
    }

    public static function getCookies($cookies_name = "fbi_session")
    {
        $data = \Cookie::get($cookies_name);

        if($data == null) {
            return null;
        }

        if(count($data) == 0) {
            return null;
        }

        return $data;
    }

    public static function flushCookies($cookies_name = "fbi_session") {
        \Cookie::forget($cookies_name);
        \Cookie::queue(\Cookie::forget($cookies_name));

        \Cache::flush();
    }

    public static function get_current_time_stamp($value = null) {
        if($value == null) {
            $value = Carbon::now();
        }
        $date_now = Carbon::createFromFormat('Y-m-d H:i:s', $value);
        $date_time_stamp = $date_now->setTimezone('Asia/Taipei')->format('Y/m/d h:i:s A');
        return $date_time_stamp;
    }

    public static function do_parse_time_stamp($value) {
        $date_time_stamp = Carbon::createFromTimeStamp($value);
        //format('Y-m-d H:i:s')
        return $date_time_stamp;
    }

    public static function get_random_password($value = null) {
        $random = mt_rand(10, 727379969);
        if($value == null) {
            $value = $random;
        }
        $result = md5('@BC12abc' . $value);
        return array("new_password" => $value, "hash_password" => $result);
    }

    public static function get_member_information($account) {
        $random = DB::select("
                  SELECT * FROM member_table 
                  WHERE hash_code = '{$account}' OR username = '{$account}' 
                  OR email = '{$account}' OR mobile = '{$account}';
        ");
        if( COUNT($random) > 0 ) {
            return $random;
        }
        return null;
    }

    public static function get_total_connected($uid) {
        $total = DB::select("
                  SELECT COUNT(*) AS total_conntected 
                  FROM member_table 
                  WHERE endorse_uid = {$uid}
                  AND status > 0;
        ");

        return $total[0]->total_conntected;
    }

    public static function get_total_members($type) {

        $sort_id = 0;
        
        if($type == "activated") {
            $sort_id = 3;
        }
        else if ($type == "on-processed") {
            $sort_id = 2;
        }
        else {
            $sort_id = 1;
        }
        $members = DB::select("SELECT COUNT(*) total_count FROM member_table WHERE status = {$sort_id};");

        return $members[0]->total_count;
    }

    public static function post_email_send($uid = 3, $temp = "FBI.Notification", $arr = array()) {
        if( count($arr) == 0) {
            return false;
        }

        $name = str_replace(" ", "%20", $arr["name"]);
        $to = str_replace(" ", "%20", $arr["to"]);
        $subject = str_replace(" ", "%20", $arr["subject"]);
        $message = str_replace(" ", "%20", $arr["message"]);

        $query = "http://www.fbi-ph.org:2100/mail/post/email?id={$uid}&name={$name}&email={$to}&subject={$subject}&message={$message}&temp_name={$temp}";

        $result = Helper::do_curl($query);

        return $result;
    }

    public static function post_password_email_send($name, $email, $username, $password) {
        $message =      "<h3>We would like to personally welcome you to our community.</h3>";
        $message .=     "Login: www.fbi-ph.org/login<br />";
        $message .=     "Your Hash-Code: {$username}<br />";
        $message .=     "Your Password: {$password}<br />";

        $data = array(
            "name" => $name,
            "to" => $email,
            "subject" => "FBI Verification and Account Information",
            "message" => $message
        );

        return Helper::post_email_send(3, "FBI.Notification", $data);
    }

    public static function post_generic_email_send($name, $email, $message, $subject) {

        $data = array(
            "name" => $name,
            "to" => $email,
            "subject" => $subject,
            "message" => $message
        );

        return Helper::post_email_send(3, "FBI.Notification", $data);
    }

    // Method to send Get request to url
    public static function do_curl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return $data;
    }

    public static function do_curl_v2($url) {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
        curl_setopt($ch,CURLOPT_TIMEOUT, 20);
        $response = curl_exec($ch);
        curl_close ($ch);
        $data = json_decode($response, true);
        return $data;
    }

    public static function facebook_account_kit_v2(Request $request) {

        // Initialize variables
        $app_id = "239866523142614";
        $secret = "99647c4751d6afe5a54cbc1d4c20773b";
        $version = "v1.1";
        $code = $request['code'];

        // Exchange authorization code for access token

        $token_exchange_url = "https://graph.accountkit.com/{$version}/access_token?grant_type=authorization_code&code={$code}&access_token=AA|{$app_id}|{$secret}";

        $data = Helper::do_curl($token_exchange_url);

        $user_id = $data['id'];
        $user_access_token = $data['access_token'];
        $refresh_interval = $data['token_refresh_interval_sec'];

        // Get Account Kit information
        $me_endpoint_url = 'https://graph.accountkit.com/'.$version.'/me?'.
            'access_token='.$user_access_token;

        $data = Helper::do_curl($me_endpoint_url);
        $phone = isset($data['phone']) ? $data['phone']['number'] : '';
        $email = isset($data['email']) ? $data['email']['address'] : '';

        return array(
            "phone_number" => $phone,
            "email_address" => $email
        );

    }

    public static function facebook_token($user_access_token) {
        $version = "v1.1";

        $me_endpoint_url = "https://graph.accountkit.com/{$version}/me?access_token={$user_access_token}";

        $data = Helper::do_curl($me_endpoint_url);

        $phone = isset($data['phone']) ? $data['phone'] : '';

        $email = isset($data['email']) ? $data['email'] : '';

        return array(
            "phone_number" => $phone,
            "email_address" => $email
        );
    }
}
