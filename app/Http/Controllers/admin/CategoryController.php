<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function category()
    {
        if (Session::has('c_search')) {
            Session::forget('c_search');
        }
        $data = Category::select('categories.*', DB::raw('COUNT(pizzas.category_id) as count'))
            ->leftjoin('pizzas', 'pizzas.category_id', 'categories.category_id')
            ->groupBy('pizzas.category_id')
            ->orderBy('categories.category_id')
            ->paginate(5);
        $empty = count($data) == 0 ? 0 : 1;
        return view('admin.category.list')->with(['pizza_data' => $data, 'status' => $empty]);
    }
    public function addCategory()
    {
        return view('admin.category.addCategory');
    }
    public function createCategory(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',

        ]);

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }
        $c_name = Category::select('category_name')->where('category_name', $request->name)->first();
        if (empty($c_name['category_name'])) {
            $data = [
                'category_name' => $request->name,
            ];
            Category::create($data);

            return redirect()->route('admin#category')->with(['category_status' => '1 category is created']);
        } else {
            return back()->with(['already' => 'This category is already in category list']);
        }

    }
    public function confirmDelete($id)
    {
        $data = Category::where('category_id', $id)->first();
        return view('admin.category.confirm_delete')->with(['comfirm_delte_data' => $data]);
    }

    public function delete($id)
    {
        $data = Category::where('category_id', $id)->first();
        $name = $data->toArray()['category_name'];

        Category::where('category_id', $id)->delete();
        return redirect()->route('admin#category')->with(['deleteSuccess' => $name . " is deleted."]);
    }

    public function edit($id)
    {

        $data = Category::where('category_id', $id)->first();
        return view('admin.category.edit')->with(['data' => $data]);
    }

    public function update($id, Request $request)
    {
        $validation = Validator::make($request->all(), [
            'after_name' => 'required',
        ],
            [
                'after_name.required' => "Please enter new category name",
            ]

        );

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }
        $name = ['category_name' => $request->after_name];
        Category::where('category_id', $id)->update($name);
        return redirect()->route('admin#category')->with(['updateSuccess' => 'Category is Updated']);

    }
    public function getCategoryItem($id)
    {
        $data = Pizza::select('pizzas.*', 'categories.category_name as categoryName')
            ->join('categories', 'categories.category_id', 'pizzas.category_id')
            ->where('pizzas.category_id', $id)
            ->paginate(4);
        return view('admin.category.category_items')->with(['data' => $data]);

    }
    public function search(Request $request)
    {

        $data = Category::select('categories.*', DB::raw('COUNT(pizzas.category_id) as count'))
            ->leftjoin('pizzas', 'pizzas.category_id', 'categories.category_id')
            ->where('categories.category_name', 'like', '%' . $request->table_search . '%')
            ->groupBy('pizzas.category_id')
            ->orderBy('categories.category_id')
            ->paginate(4);
        Session::put('c_search', $request->table_search);
        $empty = count($data) == 0 ? 0 : 1;
        $data->appends($request->all());
        return view('admin.category.list')->with(['pizza_data' => $data, 'status' => $empty]);
    }

    public function categoryDownload()
    {
        if (Session::has('c_search')) {
            $category = Category::select('categories.*', DB::raw('COUNT(pizzas.category_id) as count'))
                ->leftjoin('pizzas', 'pizzas.category_id', 'categories.category_id')
                ->where('categories.category_name', 'like', '%' . Session::get('c_search') . '%')
                ->groupBy('pizzas.category_id')
                ->orderBy('categories.category_id')
                ->get();

        } else {
            $category = Category::select('categories.*', DB::raw('COUNT(pizzas.category_id) as count'))
                ->leftjoin('pizzas', 'pizzas.category_id', 'categories.category_id')
                ->groupBy('pizzas.category_id')
                ->orderBy('categories.category_id')
                ->get();

        }

        $csvExporter = new \Laracsv\Export();

        $csvExporter->build($category, [
            'category_id' => 'ID',
            'category_name' => 'Name',
            'count' => 'Product Count',
            'created_at' => 'Created Date',
            'updated_at' => 'Update Date',
        ]);

        $csvReader = $csvExporter->getReader();
        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        $filename = 'categoryList.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');

    }
}
