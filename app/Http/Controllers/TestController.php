<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    public function create_a_test(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required'
        ]);

        $test = Test::create([
            'name' => $request->name,
            'category_id' => $request->category_id
        ]);

        return response()->json([
            "status" => 201,
            "message" => "test created",
            "data" => $test
        ]);
    }

    public function update_a_test(Request $request, $id)
    {
        $test = Test::find($id);

        if($test == null){
            return response()->json([
                "status" => 404,
                "message" => "test not found",
                "data" => []
            ]);
        }

        $test->update($request->all());
        return response()->json([
            "status" => 200,
            "message" => "test updated",
            "data" => $test
        ]);
    }

    public function retrieve_a_test($id)
    {
        $test = Test::find($id);
        if($test == null){
            return response()->json([
                "status" => 404,
                "message" => "test not found",
                "data" => []
            ]);
        }

        return response()->json([
            "status" => 200,
            "message" => "test retrieved",
            "data" => $test
        ]);
    }

    public function retrieve_all_tests()
    {
        $test = Test::all();
        
        return response()->json([
            "status" => 200,
            "message" => "tests retrieved",
            "data" => $test
        ]);
    }

    public function delete_a_test()
    {
        $test = Test::find($id);
        if($test == null){
            return response()->json([
                "status" => 404,
                "message" => "test not found",
                "data" => []
            ]);
        }

        return response()->json([
            "status" => 200,
            "message" => "successfully deleted"
        ]);
    }
}
