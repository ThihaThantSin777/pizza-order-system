<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
    public function pizza()
    {
        if (Session::has('p_search')) {
            Session::forget('p_search');
        }

        $data = Pizza::paginate(4);
        $empty = count($data) == 0 ? 0 : 1;
        return view('admin.pizza.list')->with(['pizza_data' => $data, 'status' => $empty]);
    }

    public function addPizza()
    {
        $category = Category::get();
        return view('admin.pizza.add_pizza')->with(['category' => $category]);
    }

    public function confirmDelete($id)
    {
        $data = Pizza::where('pizza_id', $id)->first();
        return view('admin.pizza.confirm_delete')->with(['confirm_data' => $data]);
    }

    public function delete($id)
    {
        $image = Pizza::select('image')->where('pizza_id', $id)->first();
        $dataAll = Pizza::where('pizza_id', $id)->first();
        Pizza::where('pizza_id', $id)->delete();
        $name = $dataAll->pizza_name;

        if (File::exists(public_path() . '/uploads/' . $image['image'])) {
            File::delete(public_path() . '/uploads/' . $image['image']);
        }
        return redirect()->route('admin#pizza')->with(['pizza_status' => $name . " is deleted"]);
    }

    public function createPizza(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'img' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'time' => 'required',
            'desc' => 'required',
        ]);

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }

        $file = $request->file('img');
        $fileName = uniqid() . '_' . $file->getClientOriginalName();
        $file->move(public_path() . '/uploads/', $fileName);
        $data = $this->getPizzaData($request, $fileName);
        Pizza::create($data);
        return redirect()->route('admin#pizza')->with(['pizza_success' => "1 pizza is added"]);
    }

    public function pizzaInfo($id)
    {
        $data = Pizza::where('pizza_id', $id)->first();
        $cat_name = Category::select('category_name')->where('category_id', $data->ToArray()['category_id'])->first();
        return view('admin.pizza.info')->with(['pizza' => $data, 'c_data' => $cat_name]);
    }

    public function pizzaedit($id)
    {
        $category = Category::get();
        $data = Pizza::select('pizzas.*', 'categories.*')->join('categories', 'pizzas.category_id', 'categories.category_id')->where('pizza_id', $id)->first();
        return view('admin.pizza.edit')->with(['p_data' => $data, 'category' => $category]);
    }

    public function pizzaupdate($id, Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'time' => 'required',
            'desc' => 'required',
        ]);

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }
        $imgStatus = $this->requestImage($request);
        if (isset($imgStatus['image'])) {
            $image = Pizza::select('image')->where('pizza_id', $id)->first();
            if (File::exists(public_path() . '/uploads/' . $image['image'])) {
                File::delete(public_path() . '/uploads/' . $image['image']);
            }
            $file = $request->file('img');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $fileName);
            $data = $this->getPizzaData($request, $fileName);
            Pizza::where('pizza_id', $id)->update($data);
        } else {
            Pizza::where('pizza_id', $id)->update($imgStatus);
        }

        return redirect()->route('admin#pizza')->with(['update_success' => "Update Success"]);
    }

    public function pizzaSearch(Request $request)
    {
        $search = $request->table_search;
        $data = Pizza::orWhere('pizza_name', 'like', '%' . $request->table_search . '%')
            ->orWhere('price', $request->table_search)
            ->paginate(4);
        $data->appends($request->all());

        $empty = count($data) == 0 ? 0 : 1;
        Session::put('p_search', $request->table_search);

        return view('admin.pizza.list')->with(['pizza_data' => $data, 'status' => $empty]);
    }
    private function requestImage($request)
    {
        $arr = ['pizza_name' => $request->name,
            'price' => $request->price,
            'publish_status' => $request->publish,
            'category_id' => $request->category,
            'discort_price' => $request->discount,
            'buy_one_get_one_status' => $request->buy_one,
            'waiting_time' => $request->time,
            'description' => $request->desc,
        ];
        if (isset($request->img)) {
            $arr['image'] = $request->img;
        }
        return $arr;
    }

    private function getPizzaData($request, $fileName)
    {
        return [
            'pizza_name' => $request->name,
            'image' => $fileName,
            'price' => $request->price,
            'publish_status' => $request->publish,
            'category_id' => $request->category,
            'discort_price' => $request->discount,
            'buy_one_get_one_status' => $request->buy_one,
            'waiting_time' => $request->time,
            'description' => $request->desc,
        ];
    }
    public function pizzaDownload()
    {
        if (Session::has('p_search')) {
            $pizza = Pizza::orWhere('pizza_name', 'like', '%' . Session::get('p_search') . '%')
                ->orWhere('price', Session::get('p_search'))
                ->get();

        } else {
            $pizza = Pizza::get();
        }

        $csvExporter = new \Laracsv\Export();

        $csvExporter->build($pizza, [
            'pizza_id' => 'ID',
            'pizza_name' => 'Pizza Name',
            'price' => 'Pizza Price',
            'publish_status' => 'Publish Date',
            'buy_one_get_one_status' => 'Buy one get One',
            'created_at' => 'Created Date',
            'updated_at' => 'Update Date',
        ]);

        $csvReader = $csvExporter->getReader();
        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        $filename = 'pizzaList.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');

    }

}
