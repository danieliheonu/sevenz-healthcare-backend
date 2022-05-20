<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create_a_category(Request $request)
    {
        $request->validate([
            "name" => "required"
        ]);

        $category = Category::create($request->all());

        return response()->json([
            "status" => 201,
            "message" => "category created",
            "data" => $category
        ]);
    }

    public function update_a_category(Request $request, $id)
    {
        $category = Category::find($id);
        if($category == null){
            return response()->json([
                "status" => 404,
                "message" => "category not found",
                "data" => []
            ]);
        }

        $category->update($request->all());
        return response()->json([
            "status" => 200,
            "message" => "category updated",
            "data" => $category
        ]);
    }

    public function retrieve_a_category($id)
    {
        $category = Category::find($id);
        if($category == null){
            return response()->json([
                "status" => 404,
                "message" => "category not found",
                "data" => []
            ]);
        }

        return response()->json([
            "status" => 200,
            "message" => "category retrieved",
            "data" => $category
        ]);
    }

    public function retrieve_all_categories()
    {
        $category = Category::all();
        return response()->json([
            "status" => 200,
            "message" => "categories retrieved",
            "data" => $category
        ]);
    }

    public function delete_a_category($id)
    {
        $category = Category::find($id);
        if($category == null){
            return response()->json([
                "status" => 404,
                "message" => "category not found",
                "data" => []
            ]);
        }

        $category->delete();
        return response()->json([
            "status" => 200,
            "message" => "successfully deleted"
        ]);
    }
}
