<?php

namespace App\Http\Controllers;

use App\Member;
use App\MySQLSharedDatabase;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\MySQLAccount;
use App\MySQLDatabase;
use App\MySQLAccountPrivileges;

use Illuminate\Support\Str;

class MySQLController extends Controller
{
    //
    public function phpmyadmin_init(Request $request) {
        $helper = Helper::ssl_secured($request);

        $rand = substr(uniqid('', true), -5);

        return view('member.mysql.phpmyadmin', compact('helper'));
    }

    public function database_init(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        $user_uid = $user[0]->Id;
        $database = MySQLDatabase::where("user_id", "=", $user_uid)->orderBy("database_name")->get()->toArray();

        return view('member.mysql.database', compact('helper', 'user', 'database'));
    }

    public function create_database_init(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        $user_uid = $user[0]->Id;
        $account = MySQLAccount::where("user_id", "=", $user_uid)->orderBy("username")->get()->toArray();
//        $database = MySQLDatabase::where("user_id", "=", $user_uid)->orderBy("database_name")->get()->toArray();

        return view('member.mysql.create', compact('helper', 'user', 'account'));
    }

    public function create_database_execute(Request $request) {
        $user = Helper::getCookies();
        if($user == null) {
            return array(
                "code" => 404,
                "message" => 'Please re-login, session was expired.'
            );
        }

        $remote = null;
        $user_uid = $user[0]->Id;
        $account_name = $request->account;
        $database_name = $request->database;

        $u = DB::select("SELECT * FROM mysql_account_table WHERE user_id = {$user_uid} AND username = '{$account_name}';");
        if( COUNT($u) > 0 ) {
            if($u[0]->role > 1) {
                $remote = "YES";
            }
        }

        $mysql = Helper::create_database_and_attach_user($database_name, $account_name, $remote);
        if($mysql["code"] != 200) {
            return array(
                "code" => 401,
                "message" => $mysql["message"]
            );
        }

        $d = DB::select("SELECT * FROM mysql_database_table WHERE database_name = '{$database_name}';");
        if( COUNT($d) > 0 ) {
            return array(
                "code" => 402,
                "message" => "[ {$database_name} ] already exists."
            );
        }

        $d = new MySQLDatabase();
        $d->user_id = $user_uid;
        $d->account_name = $account_name;
        $d->database_name = $database_name;
        $d->status = 2;
        $r = $d->save();

        if($r) {

            $body = "We have received a request that you created a database with username for the following:";
            $body .= "<br /><br /><b>Database:</b> {$database_name}";
            $body .= "<br /><b>Username:</b> {$account_name}";

//            $this->post_notification_email_send("Database Added", $user[0]->first_name, $user[0]->email, $body);
            
            Helper::notification_email_send_mailgun($user[0]->first_name, $user[0]->email, "New database has been added", $body);

            return array(
                "code" => 200,
                "message" => "[ {$database_name} ] database has been added."
            );
        }
        return array(
            "code" => 500,
            "message" => "[ {$database_name} ] database was failed to add."
        );
    }

    public function create_database_username_init(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        return view('member.mysql.username', compact('helper', 'user'));
    }

    public function create_database_username_execute(Request $request) {
        $user = Helper::getCookies();
        if($user == null) {
            return array(
                "code" => 404,
                "message" => 'Please re-login, session was expired.'
            );
        }

        $user_uid = $user[0]->Id;
        $host = (int)$request->host;
        $username = $request->username;
        $password = $request->password1;

        $d = DB::select("SELECT * FROM mysql_account_table WHERE user_id = {$user_uid} AND role = {$host} AND username = '{$username}';");
        if( COUNT($d) > 0 ) {
            return array(
                "code" => 402,
                "message" => "[ {$username} ] already exists."
            );
        }

        $remote = null;
        if($host > 1) {
            $remote = "YES";
        }

        $mysql = Helper::create_database_user($username, $password, $remote);
        if($mysql["code"] != 200) {
            return array(
                "code" => 401,
                "message" => $mysql["message"]
            );
        }

        $u = new MySQLAccount();
        $u->user_id = $user_uid;
        $u->role = $host;
        $u->username = $username;
        $u->password = $password;
        $u->status = 2;
        $r = $u->save();

        if($r) {

            $body = "We have received a request that you added an account for the following account:";
            $body .= "<br /><br /><b>Username:</b> {$username}";
            $body .= "<br /><b>Password:</b> {$password}";

//            $this->post_notification_email_send("Database Account Added", $user[0]->first_name, $user[0]->email, $body);

            Helper::notification_email_send_mailgun($user[0]->first_name, $user[0]->email, "New database account has been added", $body);

            return array(
                "code" => 200,
                 "message" => "[ {$username} ] username has been added."
            );
        }

        return array(
            "code" => 500,
            "message" => "[ {$username} ] username was failed to add."
        );
    }

    public function add_privileges_init(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();
        if($user == null) {
            return redirect('/logout');
        }
        $user_uid = $user[0]->Id;
        $username = MySQLAccount::where("user_id", "=", $user_uid)->orderBy("username")->get()->toArray();
        $database = MySQLDatabase::where("user_id", "=", $user_uid)->orderBy("database_name")->get()->toArray();
        return view('member.mysql.privileges', compact('helper', 'username', 'database'));
    }

    public function add_privileges_execute(Request $request) {
        $user = Helper::getCookies();
        if($user == null) {
            return array(
                "code" => 404,
                "message" => 'Please re-login, session was expired.'
            );
        }

        $user_uid = $user[0]->Id;
        $role = (int)$request->role;
        $username = $request->username;
        $database = $request->database;

        $d = DB::select("SELECT * FROM mysql_account_privileges_table WHERE user_id = {$user_uid} AND role = {$role} AND account_name = '{$username}' AND database_name = '{$database}';");
        if( COUNT($d) > 0 ) {
            return array(
                "code" => 402,
                "message" => "[ {$username} ] already had a privileges to [ {$database} ]."
            );
        }

        $remote = null;
        if($role > 1) {
            $remote = "YES";
        }

        $mysql = Helper::set_database_and_attach_user($username, $database, $remote);
        if($mysql["code"] != 200) {
            return array(
                "code" => 401,
                "message" => $mysql["message"]
            );
        }

        $p = new MySQLAccountPrivileges();
        $p->user_id = $user_uid;
        $p->role = $role;
        $p->account_name = $username;
        $p->database_name = $database;
        $p->status = 2;
        $r = $p->save();

        if($r) {
            $body = "We have received a request that the username set the privilege for the following:";
            $body .= "<br /><br /><b>Database:</b> {$database}";
            $body .= "<br /><b>Username:</b> {$username}";

            Helper::notification_email_send_mailgun($user[0]->first_name, $user[0]->email, "User privilege has been added to a database", $body);

            return array(
                "code" => 200,
                "message" => "[ {$username} ] username has been added to [ {$database} ]."
            );
        }
        return array(
            "code" => 500,
            "message" => "[ {$username} ] username failed to add."
        );
    }

    public function share_database($database, Request $request) {
        $user = Helper::getCookies();
        if($user == null) {
            return array(
                "code" => 404,
                "message" => 'Please re-login, session was expired.'
            );
        }

        $owner_uid = $user[0]->Id;
        $share_uid = (int)$request->shared_uid;
        $role = (int)$request->role;
        $username = $request->username;

        $d = DB::select("
                  SELECT * FROM mysql_database_shared_table 
                  WHERE owner_uid = {$owner_uid}
                  AND shared_uid = {$share_uid}
                  AND role = {$role}
                  AND account_name = '{$username}'
                  AND database_name = '{$database}';
              ");

        if( COUNT($d) > 0 ) {
            return array(
                "code" => 402,
                "message" => "[ {$database} ] already shared to [ {$username} ]."
            );
        }

        $remote = null;
        if($role > 1) {
            $remote = "YES";
        }

        $mysql = Helper::set_database_and_attach_user($username, $database, $remote);
        if($mysql["code"] != 200) {
            return array(
                "code" => 401,
                "message" => $mysql["message"]
            );
        }

        $account = Member::where("Id", "=", $share_uid)->first();

        $m = new MySQLSharedDatabase();
        $m->owner_uid = $owner_uid;
        $m->shared_uid = $share_uid;
        $m->role = $role;
        $m->account_name = $username;
        $m->database_name = $database;
        $m->status = 2;
        $r = $m->save();

        if($r) {
            $body = "We have received a request that you share your database for the following:";
            $body .= "<br /><br /><b>Database:</b> {$database}";
            $body .= "<br /><b>Username:</b> {$username}";

            Helper::notification_email_send_mailgun($user[0]->first_name, $user[0]->email, "Database shared to other account", $body);

            $g = $account->gender == 1 ? "his" : "her";
            $body = $user[0]->first_name .", has shared ". $g ." database with your account for the following:";
            $body .= "<br /><br /><b>Database:</b> {$database}";
            $body .= "<br /><b>Your Username:</b> {$username}";

            Helper::notification_email_send_mailgun($account->first_name, $account->email, "Database shared to one of your account", $body);

            return array(
                "code" => 200,
                "message" => "[ {$username} ] username has been shared to [ {$database} ]."
            );
        }
        return array(
            "code" => 500,
            "message" => "[ {$username} ] username failed to share."
        );

    }

    public static function post_notification_email_send($subject, $name, $email, $body) {

        $data = array(
            "name" => $name,
            "to" => $email,
            "subject" => "Status Alert about {$subject}",
            "message" => $body
        );
        
        return Helper::post_email_send(2, "KPA.Notification", $data);
    }

}
