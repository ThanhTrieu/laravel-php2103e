<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use voku\helper\AntiXSS;
use App\Http\Requests\PostLoginAdmin as RequestLogin;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('backend.login.index');
    }

    public function handleLogin(RequestLogin $request, AntiXSS $antiXSS)
    {
        //dd($request->all()); // var_dump + die
        $username = $request->input('username'); // nhap lieu tu the input trong form
        //$user = $request->username; // lay gia tri tu request co name la : username
        //dd($username, $user); //
        $username = $antiXSS->xss_clean($username);

        $password = $request->input('password'); // $_POST['password']
        $password = $antiXSS->xss_clean($password);

        $infoUser = DB::table('admins')
                        ->select('id','username','email', 'phone', 'status')
                        ->where([
                            'email' => $username,
                            'password' => $password,
                            'status' => 1
                        ])->first();

        if($infoUser !== null) {
            // luu session
            $request->session()->put('username', $infoUser->username);
            $request->session()->put('idUser', $infoUser->id);
            $request->session()->put('emailUser', $infoUser->email);

            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('invalidLogin', 'account not exist');
        }

    }

    public function logout(Request $request)
    {
        // xoa session
        $request->session()->forget(['username', 'idUser', 'emailUser']);
        //quay ve form login
        return redirect()->route('admin.login');
    }
}
