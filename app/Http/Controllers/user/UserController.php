<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Pizza;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home()
    {
        if (Session::has('pizza_details')) {
            session()->forget('pizza_details');
        }
        $data = Pizza::where('publish_status', 1)->paginate(9);
        $empty = count($data) == 0 ? 0 : 1;

        $category = Category::get();
        return view('user.home')->with(['pizza' => $data, 'category' => $category, 'status' => $empty]);
    }

    public function pizzaDetails($id)
    {
        $data = Pizza::where('pizza_id', $id)->first();
        Session::put('pizza_details', $data);
        return view('user.details')->with(['data' => $data]);
    }

    public function categorySearch($id)
    {
        $pizzaCategory = Pizza::where('category_id', $id)->paginate(9);
        $empty = count($pizzaCategory) == 0 ? 0 : 1;
        $category = Category::get();
        return view('user.home')->with(['pizza' => $pizzaCategory, 'category' => $category, 'status' => $empty]);
    }

    public function searchPizza(Request $request)
    {
        $data = Pizza::where('pizza_name', 'like', '%' . $request->search . '%')->paginate(9);
        $empty = count($data) == 0 ? 0 : 1;
        $category = Category::get();
        return view('user.home')->with(['pizza' => $data, 'category' => $category, 'status' => $empty]);

    }

    public function searchPizzaByItem(Request $request)
    {
        $min = $request->minPrice;
        $max = $request->maxPrice;
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        $query = Pizza::select('*');

        if (!is_null($startDate) && is_null($endDate)) {
            $query = $query->whereDate('created_at', '>=', $startDate);

        } else if (is_null($startDate) && !is_null($endDate)) {
            $query = $query->whereDate('created_at', '<=', $endDate);

        } else if (!is_null($startDate) && !is_null($endDate)) {
            $query = $query->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate);

        }

        if (!is_null($min) && is_null($max)) {
            $query = $query->where('price', '>=', $min);
        } else if (is_null($min) && !is_null($max)) {
            $query = $query->where('price', '<=', $max);
        } else if (!is_null($min) && !is_null($max)) {
            $query = $query->where('price', '>=', $min)->where('price', '<=', $max);
        }
        $query = $query->paginate(9);
        $query->appends($request->all());
        $empty = count($query) == 0 ? 0 : 1;
        $category = Category::get();
        return view('user.home')->with(['pizza' => $query, 'category' => $category, 'status' => $empty]);

    }

    public function orderPage()
    {
        $pizzaData = Session::get('pizza_details');

        return view('user.order')->with(['pizza' => $pizzaData]);
    }

    public function placeorder(Request $request)
    {
        $pizzaData = Session::get('pizza_details');

        $userId = auth()->user()->id;

        $count = $request->number;

        $validation = Validator::make($request->all(), [
            'number' => 'required',
        ],

            [
                'number.required' => 'please enter pizza quantity you want',
            ]
        );

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }
        $data = $this->requestOrderData($pizzaData, $userId, $request);
        for ($i = 1; $i <= $count; $i++) {
            Order::create($data);
        }
        $wtTime = $pizzaData['waiting_time'] * $count;
        return back()->with(['totalTime' => $wtTime]);
    }
    private function requestOrderData($pizzaData, $userId, $request)
    {
        return [
            'customer_id' => $userId,
            'pizza_id' => $pizzaData['pizza_id'],
            'pay_status' => $request->payment,
            'order_time' => Carbon::now(),
        ];
    }
}
