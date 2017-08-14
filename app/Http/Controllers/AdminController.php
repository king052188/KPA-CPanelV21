<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class AdminController extends Controller
{
    //

    public function clients_index(Request $request, $type) {
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
            $keyword .= "hash_code LIKE '%". $request->search ."%' OR ";
            $keyword .= "username LIKE '%". $request->search ."%' OR ";
            $keyword .= "(first_name LIKE '%". $request->search ."%' OR ";
            $keyword .= "middle_name LIKE '%". $request->search ."%' OR ";
            $keyword .= "last_name LIKE '%". $request->search ."%' OR ";
            $keyword .= "email LIKE '%". $request->search ."%' OR ";
            $keyword .= "mobile LIKE '%". $request->search ."%') AND ";
            $keyword .= "status = {$sort_id} ORDER BY created_at ASC;";
            $members = DB::select($keyword);
        }
        else {
            $query = "SELECT * FROM member_table WHERE status = {$sort_id} ORDER BY created_at ASC";
            if($sort_id > 2) {
                $query = "
                    SELECT m.*, 
                    b.code_name, b.code_description, b.web, b.disk, b.mysql, b.ftp, b.port, b.price_usd, b.price_ph, b.discount
                    FROM member_table AS m
                    INNER JOIN quota_table AS a
                    ON m.Id = a.user_id
                    INNER JOIN quota_reference_table AS b
                    ON a.quota_id = b.Id
                    WHERE m.status = {$sort_id} ORDER BY m.created_at ASC;
                ";
            }
            $members = DB::select($query);
        }

        $types = [
            "id" => $sort_id,
            "name" => $sort_name,
        ];

        return view('admin.clients', compact('helper', 'user', 'members', 'types'));
    }

    public function clients_view_index(Request $request, $sort, $hash) {
        $helper = Helper::ssl_secured($request);
        $user = Helper::getCookies();

        if($user == null) {
            return redirect('/logout');
        }

        if($user[0]->role == 1) {
            return view('layout.404', compact('helper'));
        }

        $sort_id = (int)$sort; 

        $query = "SELECT * FROM member_table WHERE hash_code = '{$hash}' AND status = {$sort_id} ORDER BY created_at ASC";
        if($sort_id > 2) {
            $query = "
                    SELECT m.*, 
                    b.code_name, b.code_description, b.web, b.disk, b.mysql, b.ftp, b.hostname, b.port, b.price_usd, b.price_ph, b.discount
                    FROM member_table AS m
                    INNER JOIN quota_table AS a
                    ON m.Id = a.user_id
                    INNER JOIN quota_reference_table AS b
                    ON a.quota_id = b.Id
                    WHERE m.hash_code = '{$hash}' AND m.status = {$sort_id};
                ";
        }

        $client = DB::select($query);

        return view('admin.view', compact('helper', 'user', 'client'));
    }
}
