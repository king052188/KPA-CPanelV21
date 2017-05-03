<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/create/username/{username}/{password}/{remote?}', 'Helper@create_database_user');
Route::get('/create/database/{username}/{database}', 'Helper@create_database_and_attach_user');
Route::get('/set/database/{username}/{database}/{remote?}', 'Helper@set_database_and_attach_user');


Route::get('/', 'PageController@landing_page');

Route::get('/account-kit', 'TestController@index');
Route::post('/account-kit/process', 'TestController@account_kit_response');
Route::get('/account-kit/process/v2/{token}', 'TestController@account_kit_token');

Route::get('/forgot-password', 'MemberController@member_forgot_password_index');
Route::post('/forgot-password/processing', 'MemberController@member_forgot_password_execute');


Route::get('/login', 'MemberController@member_sign_in_index');
Route::post('/login/processing', 'MemberController@member_sign_in_validation');
Route::any('/login/execute/v2', 'MemberController@member_sign_in_validation_v2');

Route::get('/endorsement/link/{endorser?}', 'MemberController@member_url_validation');
Route::get('/sign-up/{clear?}', 'MemberController@member_sign_up_index');
Route::post('/sign-up/processing', 'MemberController@member_sign_up_execute');

Route::get('/validating/{type}/{value}', 'MemberController@validate_account');
Route::get('/registration/verification', 'PageController@clear_cache');
Route::get('/registration/completed', 'PageController@registration_completed');


Route::get('/reset-password/completed', 'PageController@reset_password_completed');


Route::get('/dashboard', 'MemberController@dashboard_index');

Route::get('/setup/package/plan', 'MemberController@package');

Route::get('/package/plan/completed', 'MemberController@package_plan_completed');

//Route::get('/create-disk', 'FTPController@create_disk_init');

Route::get('/edit-profile', 'MemberController@edit_profile_index');
Route::post('/edit-profile/{type}/execute', 'MemberController@edit_profile_execute');

Route::get('/activate/account/{uid}', 'MemberController@activate_account');

Route::get('/verify/account/{username}', 'MemberController@verify_database_username');

Route::get('/payment', 'MemberController@payment_index');
Route::post('/payment/execute', 'MemberController@payment_execute');

Route::get('/members/{type}', 'MemberController@member_index');

Route::get('/settings', 'MemberController@settings_index');
Route::post('/settings/change-password', 'MemberController@settings_change_password');


Route::get('/web/create', 'WebController@create_init');


Route::get('/mysql/database', 'MySQLController@database_init');

Route::get('/mysql/create-database', 'MySQLController@create_database_init');
Route::post('/mysql/create-database-execute', 'MySQLController@create_database_execute');

Route::post('/mysql/share/database/', 'MySQLController@create_database_execute');

Route::get('/mysql/create-database-username', 'MySQLController@create_database_username_init');
Route::post('/mysql/create-database-username-execute', 'MySQLController@create_database_username_execute');

Route::get('/mysql/add-privileges', 'MySQLController@add_privileges_init');
Route::post('/mysql/add-privileges-execute', 'MySQLController@add_privileges_execute');

Route::post('/mysql/share/database/{database}', 'MySQLController@share_database');

Route::get('/mysql/phpmyadmin', 'MySQLController@phpmyadmin_init');

Route::get('/ftp/create', 'FTPController@create_init');

Route::post('/ftp/create-execute', 'PageController@temp');


Route::get('/logout', 'MemberController@member_sign_out_process');

Route::get('/robot/create/new-hash-code', 'TestController@re_create_hash_code');
Route::get('/robot/create/temp/username', 'TestController@re_create_temp_username');

Route::get('/api/list-of-all-account/{value?}', 'TestController@show_all_members');
Route::get('/api/list-of-all-downline/{value}', 'TestController@show_all_downline');

Route::get('/list-of-all-account', function() {
    return view('test.lists');
});

Route::get('/list-of-all-downline/{value}', function($value) {

    $id = array("uid" => $value);

    return view('test.downline', compact('id'));



});

Route::get('/smtp.mailgun.org/sandboxf97d79f7c7184f32b8d6b2e472f527ba.mailgun.org', function() {

    $var  = \App\Http\Controllers\Helper::notification_email_send_mailgun("King", "king@cdgpacific.com", "123213 13221 2 321 ", "3213213213123 213 21 321 321 3");

    if($var) {
        dd('Mail Send Successfully');
    }
    dd('Mail Sending Error');
});


Route::get('/smtp.mailgun.org/mail.cpanelv21.kpa21.com', function() {

    $var  = \App\Http\Controllers\Helper::welcome_email_send_mailgun("King", "king@cdgpacific.com", "ABC12abc");

    if($var) {
        dd('Mail Send Successfully');
    }
    dd('Mail Sending Error');

});








