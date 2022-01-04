<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueriesTestController extends Controller
{
    public function insertRole()
    {
        $insert = DB::table('roles')->insert([
            [
                'name' => 'CTV-3',
                'display_name' => 'Cong tac vien 03',
                'description' => 'Cing tac vien 03',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null
            ],
            [
                'name' => 'CTV-4',
                'display_name' => 'Cong tac vien 04',
                'description' => 'Cong tac vien 04',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null
            ]
        ]);
        if($insert) {
            return "OK";
        } else {
            return "Fail";
        }
    }

    public function updateRole()
    {
        $update = DB::table('roles')
                    ->where('id', 2)
                    ->update([
                        'description' => 'Cong tac vien 01',
                        'name' => 'CTV-01',
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);

        if($update) {
            return "OK";
        } else {
            return "Fail";
        }
    }

    public function deleteRole(Request $request)
    {
        $id = $request->id; // truyen tham so tu route len
        if(is_numeric($id) && $id > 0) {
            $del = DB::table('roles')
                    ->where('id', $id)
                    ->delete();
            if($del) {
                return "OK";
            } else {
                return "Fail";
            }
        }
    }

    public function selectRole()
    {
        $data = DB::table('roles')
                    ->select('id', 'name')
                    ->where('id', '=', 1)
                    ->first(); 
        // tra ve object - ko phai array
        // get : lay nhieu dong data
        // first: lay ra 1 dong data
        //dd($data);
        if($data !== null){
            // convert object to array - vi query ko dung dc ham toArray
            $data = json_decode(json_encode($data),true);
        }
        return $data['id'];
    }
}
