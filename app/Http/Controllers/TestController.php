<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __construct()
    {
        // goi middleware trong controller
        //$this->middleware('test.user.login:admin'); // tac dong vao tat cac cac phuong thuc cua class

        //$this->middleware('test.user.login:admin')->only(['demo','check']); // neu ro phuong nao trong class bi middleware no tac dong

        $this->middleware('test.user.login:admin')->except(['demo','check']);// loai tru nhung phuong thuc trong class se khong bi middleware tac dong
    }

    public function demo()
    {
        return "this is demo method";
    }

    public function check()
    {
        return "this is check method";
    }

    public function index(Request $request)
    {
        $id = $request->id;
        $age = $request->age;
        $name = $request->name;
        return "My name is {$name} - age: {$age} - id: {$id}";
        //return "This is function : " . __FUNCTION__ . " of " . __CLASS__;
    }
}
