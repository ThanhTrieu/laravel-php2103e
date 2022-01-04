<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRoles as RolesRequest;
use voku\helper\AntiXSS;
use Illuminate\Support\Facades\DB;
use Config;

class RoleController extends Controller
{
    public function index()
    {
        $limit = Config::get('common.limit_page');
       
        $roles = DB::table('roles')->paginate($limit); // phan trang
        return view('backend.roles.index',[
            'roles' => $roles
        ]);
    }

    public function addRole(RolesRequest $request, AntiXSS $antiXSS)
    {
        $nameRole = $request->input('nameRole');
        $nameRole = $antiXSS->xss_clean($nameRole);

        $displayNameRole = $request->input('displayNameRole');
        $displayNameRole = $antiXSS->xss_clean($displayNameRole);

        $description = $request->input('description');
        $description = $antiXSS->xss_clean($description);

        $createdTime = date('Y-m-d H:i:s');

        $insert = DB::table('roles')->insert([
            'name' => $nameRole,
            'display_name' => $displayNameRole,
            'description' => $description,
            'created_at' => $createdTime,
            'updated_at' => null
        ]);
        if($insert){
            return redirect()->route('admin.roles')->with('statusAddOk', 'Role created !');
        } else {
            return redirect()->route('admin.roles')->with('statusAddFail', 'Role created error !');
        }
    }
}
