<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;

class TestController extends Controller
{
    const PRIVATE_KEY = '12345';

    public function createToken(Request $request)
    {
        $payload = [
            'abc' => $request->name
        ];
        $token = JWT::encode($payload, self::PRIVATE_KEY, 'HS256');
        return $token;
    }
}
