<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class PhotoController extends Controller
{
    const PRIVATE_KEY = '12345';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'id' => 1,
            'name' => 'photo',
            'description' => 'api'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'id' => 10,
            'name' => 'photo 123',
            'description' => 'api'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $token = $request->token;
        if($token !== null){
            $decoded = JWT::decode($token, new Key(self::PRIVATE_KEY, 'HS256'));
            if($decoded !== null){
                // xu ly
                return response()->json([
                    'code' => 200,
                    'message' => 'token is valid',
                ]);
            }
            return response()->json([
                'code' => 500,
                'message' => 'Token Invalid'
            ]);
        }
        return response()->json([
            'code' => 500,
            'message' => 'Token Invalid'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
