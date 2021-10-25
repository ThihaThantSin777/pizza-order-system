<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Response;

class APIController extends Controller
{
    public function categoryList()
    {
        $category = Category::get();
        $response = [
            'status' => 'success',
            'data' => $category,
        ];
        return Response::json($category);

    }
    public function createCategory(Request $request)
    {
        $data = [
            'category_name' => $request->categoryName,
        ];
        Category::create($data);
        $response = [
            'status' => 200,
            'message' => 'success',
        ];
        return Response::json($response);
    }

    public function updateCategory(Request $request)
    {
        $data = Category::where('category_id', $request->id)->first();
        if (empty($data)) {
            $response = [
                'status' => 200,
                'message' => 'no data with that id',
            ];
            return Response::json($response);
        }
        $data = [
            'category_name' => $request->name,
        ];
        Category::where('category_id', $request->id)->update($data);
        $response = [
            'status' => 200,
            'message' => 'success',
        ];
        return Response::json($response);

    }
    public function detailCategory($id)
    {
        $data = Category::where('category_id', $id)->first();
        if (!empty($data)) {
            $response = [
                'status' => 200,
                'message' => 'success',
            ];
            return Response::json($response);

        } else {
            $response = [
                'status' => 200,
                'message' => 'fail',
            ];
            return Response::json($response);

        }
    }
    public function deleteCategory($id)
    {
        $data = Category::where('category_id', $id)->first();
        if (empty($data)) {
            $response = [
                'status' => 200,
                'message' => 'no data with that id',
            ];
            return Response::json($response);

        }

        Category::where('category_id', $id)->delete();
        $response = [
            'status' => 200,
            'message' => 'success',
        ];
        return Response::json($response);

    }
}
