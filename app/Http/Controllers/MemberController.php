<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\User;
use Illuminate\Http\Request;
use App\Member;
use App\MemberBasic;
use App\MemberBeneficiary;
use App\Payment;
use DB;


class MemberController extends Controller
{
    // login processing
    public function member_forgot_password_index(Request $request) {
        $helper = Helper::ssl_secured($request);

        return view('member.forgot_password', compact('helper'));
    }

    public function member_forgot_password_execute(Request $request) {

        $user = Member::where("username", "=", $request->account)
        ->orWhere("email", "=", $request->account)
        ->orWhere("mobile", "=", $request->account);

        $u = $user->first();

        if( COUNT($u) > 0) {
            $password_code = Helper::get_random_password();

            $h = $password_code["hash_password"];
            $p = $password_code["new_password"];

            $r = $user->update(
                array("password" => $h)
            );

            if($r) {
                $h = Helper::reset_password_email_send_mailgun($u->first_name, $u->email, $p);
                if($h) {
                    return redirect('/reset-password/completed');
                }
            }
        }
    }

    // login processing
    public function member_sign_in_index(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();
        if($user != null) {
            return redirect('/dashboard');
        }

        return view('member.signin', compact('helper'));
    }

    public function member_sign_in_validation(Request $request) {
        $account = $request->account;
        $password = $request->password;

        $member_information = Helper::get_member_information($account);
        if( COUNT($member_information) > 0 ) {
            $encrypted = Helper::get_random_password($password);
            if($member_information[0]->password != $encrypted["hash_password"]) {
                return redirect('/login')->with('message', 'Please enter your valid account.');
            }
        }

        return redirect('/dashboard')
            ->withCookie(\Cookie::make('Laradnet-User', $member_information, Helper::$cookie_life_default));
    }

    public function member_sign_in_validation_v2(Request $request) {
        $account = $request->code;
        $member_information = Helper::get_member_information($account);
        if( COUNT($member_information) > 0 ) {
            return redirect('/dashboard')
                ->withCookie(\Cookie::make('Laradnet-User', $member_information, Helper::$cookie_life_default));
        }
        return redirect('/login')->with('message', 'Please enter your valid account.');
    }
    // end login processing

    // registration processing
    public function member_url_validation(Request $request, $endorser_id = null) {
        $helper = Helper::ssl_secured($request);

        $endorser_account = Member::where("hash_code", "=", $endorser_id)->first();

        if(count($endorser_account) == 0) {
            return view('layout.404', compact('helper'));
        }
        else {
            return redirect('/sign-up/')
                ->withCookie(\Cookie::make('endorsement_session', $endorser_account, Helper::$cookie_life_default));
        }
    }

    public function validate_account($type, $value) {
        $r = Helper::is_exist($value);

        if($r) {
            return array(
                "status" => 500,
                "message" => "{$type} already exists."
            );
        }

        return array(
            "status" => 200,
            "message" => ""
        );
    }

    public function member_sign_up_index(Request $request, $clear = null) {
        if($clear != null) {
            Helper::flushCookies();
            Helper::flushCookies("endorsement_session");
            return redirect('/registration/verification');
        }

        $helper = Helper::ssl_secured($request);
        $endorser_account = Helper::getCookies('endorsement_session');
        return view('member.signup', compact('helper', 'endorser_account'));
    }

    public function member_sign_up_execute(Request $request) {

        if((int)$request->gender == 0) {
            return redirect('/sign-up')->with('message', 'Oops, Please select your gender.');
        }

        $password_code = Helper::get_random_password();

        $member  = new Member();
        $member->role = 1;
        $member->password = $password_code["hash_password"];
        $member->first_name = $request->first_name;
        $member->middle_name = $request->middle_name;
        $member->last_name = $request->last_name;
        $member->gender = $request->gender;
        $member->email = $request->email;
        $member->mobile = $request->mobile;
        $member->status = 2; // default 1, meaning member is not yet verified. 2 is verified!
        $result = $member->save();
        $issued_uid = $member->id;

        if($result) {

            $hash_code = Helper::get_random_password($request->email . $issued_uid);

            $user_hash_code = $hash_code["hash_password"];

            $temp_username = preg_replace('/\s+/', '', strtolower($request->first_name)) .".". $issued_uid;

            $add_temp_username = Member::where("Id", "=", $issued_uid)
                ->update(
                  array(
                      "hash_code" => $user_hash_code,
                      "username" => $temp_username
                  )
                );
            
            $h = Helper::welcome_email_send_mailgun($request->first_name, $request->email, $password_code["new_password"]);

//            if($h["Status"] == 200) {

            if($h) {
                return redirect('/sign-up/verification');
            }

            return redirect('/sign-up')->with('message', 'Oops, Error sending your account information, Please contact info@CPanelV21.kpa21.com.');

        }
        return redirect('/sign-up')->with('message', 'Oops, Something went wrong. Please try again');
    }
    // end registration processing

    public function verify_database_username($username) {
        $data = DB::select("
            SELECT a.*, m.email, m.first_name, m.last_name 
            FROM mysql_account_table AS a
            INNER JOIN member_table AS m
            ON a.user_id = m.Id
            WHERE a.username = '{$username}';
        ");

        if( COUNT($data) > 0) {
            return array(
                "status" => 200,
                "count" => COUNT($data),
                "data" => $data
            );
        }

        return array(
            "status" => 500,
            "count" => 0,
            "data" => null
        );
    }
    
    public function dashboard_index(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        $user_status = $user[0]->status;
        $user_uid = $user[0]->Id;
        $username = $user[0]->username;
        $disk = DB::select("SELECT * FROM quota_table WHERE user_id = {$user_uid};");
        
        if($user_status >= 2) {
            if( COUNT($disk) == 0 ) {
                return redirect('/setup/package/plan');
            }
        }

        $package_plan = $disk[0]->quota_id;

        $packages = DB::select("SELECT * FROM quota_reference_table WHERE Id = {$package_plan} AND status > 0;");

        if( COUNT($packages) == 0 ) {
            return view('layout.404', compact('helper', 'user'));
        }
        
        $disk_size = $packages[0]->disk;

        $api = new ApiController();
        $data_result = $api->get_disk_statistic($request, $username, $disk_size);

        $used = 0;
        $available = 0;
        if($data_result["Code"] == 200) {
            $used = $data_result["Quota_Used"];
            $available = $data_result["Quota_Availble"];
        }

        $Website_Quota = $packages[0]->web;;
        $MySQL_Quota = $packages[0]->mysql;;
        $FTP_Quota = $packages[0]->ftp;

        $website_used = Helper::get_total_used("web_table", $user_uid);
        $mysql_used = Helper::get_total_used("mysql_database_table", $user_uid);
        $ftp_used = Helper::get_total_used("ftp_account_table", $user_uid);

        $statistics = array(
            "Disk" => array(
                "Quota" => (double)$disk_size,
                "Used" => ($used / 1024 / 1024 / 1024),
                "Available" => ($available / 1024 / 1024 / 1024)
            ),
            "Website" => array(
                "Quota" => $Website_Quota,
                "Used" => $website_used,
                "Available" => ($Website_Quota - $website_used)
            ),
            "MySQL" => array(
                "Quota" => $MySQL_Quota,
                "Used" => $mysql_used,
                "Available" => ($MySQL_Quota - $mysql_used)
            ),
            "FTP" => array(
                "Quota" => $FTP_Quota,
                "Used" => $ftp_used,
                "Available" => ($FTP_Quota - $ftp_used)
            )
        );

        return view('member.dashboard', compact('helper', 'user', 'statistics'));
    }

    public function package(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        $user_status = $user[0]->status;
        $user_uid = $user[0]->Id;
        $disk = DB::select("SELECT * FROM quota_table WHERE user_id = {$user_uid};");

        if($user_status > 2) {
            if( COUNT($disk) > 0 ) {
                return redirect('/dashboard');
            }
        }

        $packages = DB::select("SELECT * FROM quota_reference_table WHERE status > 1;");

        return view('member.package.index', compact('helper', 'user', 'packages'));
    }

    public function setup_server(Request $request, $package_id) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        $servers = DB::select("SELECT * FROM servers_table WHERE status > 1;");

        $package = ["id" => (int)$package_id];

        return view('member.package.setup', compact('helper', 'user', 'servers', 'package'));
    }

    public function package_plan_completed(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        return view('layout.createdAccount', compact('helper', 'user'));
    }
    
    public function edit_profile_index(Request $request) {
        $helper = Helper::ssl_secured($request);

        $user = Helper::getCookies();

        $user_uid = $user[0]->Id;

        if( IsSet( $request->page ) ) {

            if($request->page == "basic") {

                $page = ["page" => "basic"];

                $check_ = MemberBasic::where("uid", "=", $user_uid);

                $basic_info = $check_->first();

                return view('member.profile_basic', compact('helper', 'basic_info', 'page'));
            }

            if($request->page == "beneficiary") {

                $page = ["page" => "beneficiary"];

                $check_ = MemberBeneficiary::where("uid", "=", $user_uid);

                $beneficiary_info = $check_->first();

                return view('member.profile_addition', compact('helper', 'beneficiary_info', 'page'));
            }
        }

        return view('layout.404', compact('helper'));
    }

    public function edit_profile_execute(Request $request, $type) {
        $user = Helper::getCookies();

        $user_uid = $user[0]->Id;

        if($type == "basic") {

            $basic_ = $this->basic_information($request, $user_uid);

            if($basic_) {
                return redirect('/edit-profile?page=beneficiary');
            }

            return redirect('/edit-profile?page=basic')
                ->with('message', 'Please check your information.');
        }

        if($type == "beneficiary") {

            $basic_ = $this->beneficiary_information($request, $user_uid);

            if($basic_) {
                return redirect('/payment');
            }

            return redirect('/edit-profile?page=beneficiary')
                ->with('message', 'Please check your information.');
        }
    }

    public function activate_account(Request $request, $uid) {

        $data = Member::where("Id", "=", $uid);
        $u = $data->first();

        if($u->status > 2) {
            return array(
                "status" => 201
            );
        }

        $m = $data->update(
                array(
                    "group_name" => $request->group,
                    "status" => 3
                )
            );

        if($m) {
            return array(
                "status" => 200
            );
        }

        return array(
            "status" => 500
        );
    }

    public function basic_information(Request $request, $user_uid) {
        $check_ = MemberBasic::where("uid", "=", $user_uid);

        $is_exist = $check_->first();

        $is_save = false;

        if($is_exist == null) {
            $m = new MemberBasic();
            $m->uid = $user_uid;
            $m->streets = $request->streets;
            $m->barangay = $request->barangay;
            $m->city = $request->city;
            $m->province = $request->province;
            $m->zip_code = $request->zip_code;
            $m->telephone = $request->telephone;
            $m->mobile = $request->mobile;
            $m->education_attainment = (int)$request->education_attainment;
            $m->profession = $request->profession;
            $m->skills = $request->skills;
            $m->citizenship = $request->citizenship;
            $m->blood_type = $request->blood_type;
            $m->civil_status = (int)$request->civil_status;
            $m->sss_no = $request->sss_no;
            $m->tin_no = $request->tin_no;

            $is_save = $m->save();
        }
        else {

            $updates = array(
                "streets" => $request->streets,
                "barangay" => $request->barangay,
                "city" => $request->city,
                "province" => $request->province,
                "zip_code" => $request->zip_code,
                "telephone" => $request->telephone,
                "mobile" => $request->mobile,
                "education_attainment" => (int)$request->education_attainment,
                "profession" => $request->profession,
                "skills" => $request->skills,
                "citizenship" => $request->citizenship,
                "blood_type" => $request->blood_type,
                "civil_status" => (int)$request->civil_status,
                "sss_no" => $request->sss_no,
                "tin_no" => $request->tin_no
            );

            $is_save = $check_->update($updates);
        }

        return $is_save;
    }

    public function beneficiary_information(Request $request, $user_uid) {
        $check_ = MemberBeneficiary::where("uid", "=", $user_uid);

        $is_exist = $check_->first();

        $is_save = false;

        if($is_exist == null) {
            $m = new MemberBeneficiary();
            $m->uid = $user_uid;
            $m->name_of_beneficiary = $request->name_of_beneficiary;
            $m->same_with_primary = $request->same_with_primary == "on" ? 1 : 0;
            $m->streets = $request->streets;
            $m->barangay = $request->barangay;
            $m->city = $request->city;
            $m->province = $request->province;
            $m->zip_code = $request->zip_code;
            $m->telephone = $request->telephone;
            $m->mobile = $request->mobile;
            $m->email = $request->email;

            $is_save = $m->save();
        }
        else {
            $updates = array(
                "same_with_primary" => $request->same_with_primary == "on" ? 1 : 0,
                "streets" => $request->streets,
                "barangay" => $request->barangay,
                "city" => $request->city,
                "province" => $request->province,
                "zip_code" => $request->zip_code,
                "telephone" => $request->telephone,
                "mobile" => $request->mobile,
                "email" => $request->email
            );

            $is_save = $check_->update($updates);
        }

        return $is_save;
    }

    public function payment_index(Request $request) {
        $helper = Helper::ssl_secured($request);

        $user = Helper::getCookies();

        $user_uid = $user[0]->Id;

        $is_exist = DB::select("SELECT * FROM payment_table WHERE uid = {$user_uid}1 AND status > 0;");

        if( COUNT($is_exist) > 0 ) {
            return redirect('/dashboard');
        }

        $page = ["page" => "payment"];

        return view('member.payment', compact('helper', 'page'));
    }

    public function payment_execute(Request $request) {
        $user = Helper::getCookies();
        $user_uid = $user[0]->Id;
        $type = (int)$request->p_member_type;

        $amount = 500;
        if($type > 1) {
            $amount = 1500;
        }

        $p = new Payment();
        $p->uid = $user_uid;
        $p->type = $type;
        $p->mode_of_payment = $request->mode_of_payment;
        $p->amount = $amount;
        $p->proof_of_payment_url = $request->proof_of_payment_url;
        $p->id_picture_url = $request->id_picture;
        $p->signature_url = $request->signature;
        $p->valid_id_url = $request->valid_id;
        $p->confirming_a = (int)$request->confirming_a;
        $p->confirming_b = (int)$request->confirming_b;
        $p->confirming_c = (int)$request->confirming_c;
        $p->status = 1;
        $is_save = $p->save();

        if($is_save) {

            $check_ = Member::where("Id", "=", $user_uid);
            $is_exist = $check_->update(
                array(
                    "type" => $type,
                    "status" => 2,
                )
            );

            $message = "Your Payment is in our queuing process.";
            $message .= "<br />Please allow us to evaluate your account within 24 to 48 Hours.";

            $h = Helper::post_generic_email_send(
                $user[0]->first_name,
                $user[0]->email,
                $message,
                "Your Payment Has Been Sent");

            return redirect('/dashboard')
                ->with('message', 'success');
        }

        return redirect('/payment')
            ->with('message', 'Please check your information.');
    }

    public function settings_index(Request $request) {
        $helper = Helper::ssl_secured($request);

        $page = ["page" => "settings"];

        return view('member.settings', compact('helper', 'page'));
    }

    public function settings_change_password(Request $request) {
        $member = Helper::getCookies();
        if($member == null) {
            return redirect('/logout');
        }

        $current_password = $request->current_password;
        $new_password = $request->new_password;

        $encrypted1 = Helper::get_random_password($current_password);
        $encrypted2 = Helper::get_random_password($new_password);

        $user = Member::where("Id", "=", $member[0]->Id);
        $user_get = $user->first();

        $result = false;
        if( $user_get->password == $encrypted1["hash_password"] ) {
            $result = $user->update(["password" => $encrypted2["hash_password"]]);
        }

        if($result) {
            return redirect('/logout');
        }

        return redirect('/settings')->with('message', 'Please enter your valid password.');
    }

    public function member_sign_out_process(Request $request) {
        Helper::flushCookies();
        Helper::flushCookies("endorsement_session");
        return redirect("/login");
    }
}
