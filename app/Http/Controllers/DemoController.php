<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function index()
    {
        $infoStudents = [
            [
                'id' => 1,
                'name' => 'Van Teo',
                'email' => 'vanteo@gmail.com',
                'birthday' => 1998,
                'address' => 'Ha Noi',
                'money' => 2000000
            ],
            [
                'id' => 2,
                'name' => 'Van Ty',
                'email' => 'vanty@gmail.com',
                'birthday' => 1999,
                'address' => 'Hai Duong',
                'money' => 3000000
            ],
            [
                'id' => 3,
                'name' => 'Thi Mo',
                'email' => 'thimo@gmail.com',
                'birthday' => 2000,
                'address' => 'Ha Nam',
                'money' => 2500000
            ]
        ];
        // load 1 giao dien (view)
        return view('demo/index',[
            'infoStudents' => $infoStudents
        ]); // truyen duong dan - nam trong thu muc resource/views
    }
}
