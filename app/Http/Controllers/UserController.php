<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Test;
use Mail;

class UserController extends Controller
{
    public function user_take_test(Request $request, $id)
    {
        $request->validate([
            'test_id' => 'required'
        ]);

        $user = User::find($id);
        if($user == null){
            return response()->json([
                "status" => 404,
                "message" => "user not found",
                "data" => []
            ]);
        }

        $test = Test::find($request->test_id);
        if($user == null){
            return response()->json([
                "status" => 404,
                "message" => "test not found",
                "data" => []
            ]);
        }

        $user->test()->attach($request->test_id);
        Mail::send([], [], function($message) use($request) {
            $message->to('iheonu6@gmail.com')
            ->subject(''.$request->user.' medical data')
            ->setBody($test->user);
            });
   
        return response()->json([
            "status" => 200,
            "message" => "test added",
            "data" => $test->user
        ]);
    }

    public function retrieve_user_tests($id)
    {
        $user = User::find($id);
        if($user == null){
            return response()->json([
                "status" => 404,
                "message" => "test not found",
                "data" => []
            ]);
        }

        return response()->json([
            "status" => 200,
            "message" => "test added",
            "data" => $user->test
        ]);
    }
}
