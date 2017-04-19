<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\MySQLAccount;
use App\MySQLDatabase;

class MySQLController extends Controller
{
    //

    public function create_database_init(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        $user_uid = $user[0]->Id;
        $account = MySQLAccount::where("user_id", "=", $user_uid)->orderBy("username")->get()->toArray();

        return view('member.mysql.create', compact('helper', 'user', 'account'));
    }

    public function create_database_execute(Request $request) {
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
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
            return redirect('/mysql/create-database')->with('message', $mysql["message"]);
        }

        $d = DB::select("SELECT * FROM mysql_database_table WHERE database_name = '{$database_name}';");
        if( COUNT($d) > 0 ) {
            return redirect('/mysql/create-database')->with('message', $database_name. ' already exists.');
        }

        $d = new MySQLDatabase();
        $d->user_id = $user_uid;
        $d->account_name = $account_name;
        $d->database_name = $database_name;
        $d->status = 2;
        $r = $d->save();

        if($r) {
            return redirect('/mysql/create-database')->with('message', $database_name . ' database has been added.');
        }
        return redirect('/mysql/create-database')->with('message', $database_name . ' database failed to add.');
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
            return redirect('/logout');
        }

        $user_uid = $user[0]->Id;
        $host = (int)$request->host;
        $username = $request->username;
        $password = $request->password1;

        $d = DB::select("SELECT * FROM mysql_account_table WHERE user_id = {$user_uid} AND role = {$host} AND username = '{$username}';");
        if( COUNT($d) > 0 ) {
            return redirect('/mysql/create-database-username')->with('message', $request->username . ' already exists.');
        }

        $remote = null;
        if($host > 1) {
            $remote = "YES";
        }

        $mysql = Helper::create_database_user($username, $password, $remote);

        if($mysql["code"] != 200) {
            return redirect('/mysql/create-database-username')->with('message', $mysql["message"]);
        }

        $u = new MySQLAccount();
        $u->user_id = $user_uid;
        $u->role = $host;
        $u->username = $username;
        $u->password = $password;
        $u->status = 2;
        $r = $u->save();

        if($r) {
            return redirect('/mysql/create-database-username')->with('message', $request->username . ' username has been added.');
        }
        return redirect('/mysql/create-database-username')->with('message', $request->username . ' username failed to add.');
    }
}
