<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use Illuminate\Http\Request;
use App\Member;
use App\MemberBasic;
use App\MemberBeneficiary;
use App\Payment;
use DB;


class MemberController extends Controller
{
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
            ->withCookie(\Cookie::make('fbi_session', $member_information, Helper::$cookie_life_default));
    }

    public function member_sign_in_validation_v2(Request $request) {
        $account = $request->code;
        $member_information = Helper::get_member_information($account);
        if( COUNT($member_information) > 0 ) {
            return redirect('/dashboard')
                ->withCookie(\Cookie::make('fbi_session', $member_information, Helper::$cookie_life_default));
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

        $specialist = Helper::get_member_information($request->specialist);

        $endorser_id = 0;;
        $endorser = Helper::getCookies('endorsement_session');
        if($endorser == null) {
            $endorser = Helper::get_member_information($request->endorsed_by);
            if($endorser == null) {
                return redirect('/sign-up')->with('message', 'Oops, Invalid endorser account name.');
            }
            $endorser_id = $endorser[0]->Id;
        }
        else {
            $endorser_id = $endorser["Id"];
        }

        $specialist_uid = 0;
        if($specialist != null) {
            $specialist_uid = $specialist[0]->Id;
        }

        $password_code = Helper::get_random_password();

        $member  = new Member();
        $member->role = 1;
        $member->password = $password_code["hash_password"];
        $member->first_name = $request->first_name;
        $member->middle_name = $request->middle_name;
        $member->last_name = $request->last_name;
        $member->birth_date = $request->date_of_birth;
        $member->gender = $request->gender;
        $member->email = $request->email;
        $member->mobile = $request->mobile;
        $member->endorse_uid = $endorser_id;
        $member->specialist_uid = $specialist_uid;
        $member->status = 1; // default 1, meaning member is not yet verified. 2 is verified!
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

            $h = Helper::post_password_email_send($request->first_name, $request->email, $user_hash_code, $password_code["new_password"]);

            if($h["Status"] == 200) {
                return redirect('/sign-up/verification');
            }

            return redirect('/sign-up')->with('message', 'Oops, Error sending your account information, Please contact FBI Admin.');

        }
        return redirect('/sign-up')->with('message', 'Oops, Something went wrong. Please try again');
    }
    // end registration processing
    
    public function dashboard_index(Request $request) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        $user_uid = $user[0]->Id;
        $check_ = MemberBasic::where("uid", "=", $user_uid)->first();
        if($check_ == null) {
            return redirect('/edit-profile?page=basic');
        }

        $check_ = MemberBeneficiary::where("uid", "=", $user_uid)->first();
        if($check_ == null) {
            return redirect('/edit-profile?page=beneficiary');
        }

        $check_ = DB::select("SELECT * FROM payment_table WHERE uid = {$user_uid} AND status > 0;");
        if($check_ == null) {
            return redirect('/payment');
        }

        $total_connected = Helper::get_total_connected($user[0]->Id);
        $statistics = array(
            "Connected" => $total_connected,
            "PBAT" => 0,
            "Damayan" => 0
        );

        return view('member.dashboard', compact('helper', 'user', 'statistics'));
    }

    public function member_index(Request $request, $type) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        if($user[0]->role == 1) {
            return view('layout.404', compact('helper'));
        }

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

        if( IsSet($request->search) ) {

            $keyword = "SELECT * FROM member_table WHERE ";
            $keyword .= "(first_name LIKE '%". $request->search ."%' OR ";
            $keyword .= "middle_name LIKE '%". $request->search ."%' OR ";
            $keyword .= "last_name LIKE '%". $request->search ."%' OR ";
            $keyword .= "email LIKE '%". $request->search ."%' OR ";
            $keyword .= "mobile LIKE '%". $request->search ."%') AND ";
            $keyword .= "status = {$sort_id} ORDER BY created_at ASC;";

            $members = DB::select($keyword);
        }
        else {
            $members = DB::select("SELECT * FROM member_table WHERE status = {$sort_id} ORDER BY created_at ASC;");
        }

        $sort_type = ["name" => $sort_name];

        return view('member.members', compact('helper', 'user', 'members', 'sort_type'));
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

        $m = Member::where("Id", "=", $uid)
            ->update(
                array("status" => 3)
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
