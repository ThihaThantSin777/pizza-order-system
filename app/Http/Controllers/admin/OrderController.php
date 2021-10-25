<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function order()
    {
        if (Session::has('o_search')) {
            Session::forget('o_search');
        }
        $data = Order::select('orders.*', 'users.name as customer_name', 'pizzas.pizza_name', DB::raw('COUNT(orders.pizza_id )as count'))
            ->join('users', 'users.id', 'orders.customer_id')
            ->join('pizzas', 'pizzas.pizza_id', 'orders.pizza_id')
            ->groupBy('orders.customer_id', 'orders.pizza_id')
            ->paginate(4);
        $empty = count($data) == 0 ? 0 : 1;
        return view('admin.order.order')->with(['order' => $data, 'status' => $empty]);
    }
    public function orderSearch(Request $request)
    {
        $data = Order::select('orders.*', 'users.name as customer_name', 'pizzas.pizza_name', DB::raw('COUNT(orders.pizza_id )as count'))
            ->join('users', 'users.id', 'orders.customer_id')
            ->join('pizzas', 'pizzas.pizza_id', 'orders.pizza_id')
            ->orWhere('users.name', 'like', '%' . $request->table_search . '%')
            ->orWhere('pizzas.pizza_name', 'like', '%' . $request->table_search . '%')
            ->groupBy('orders.customer_id', 'orders.pizza_id')
            ->paginate(4);

        Session::put('o_search', $request->table_search);
        $empty = count($data) == 0 ? 0 : 1;
        $data->appends($request->all());
        return view('admin.order.order')->with(['order' => $data, 'status' => $empty]);

    }

    public function orderDownload()
    {
        if (Session::has('o_search')) {
            $order = Order::select('orders.*', 'users.name as customer_name', 'pizzas.pizza_name', DB::raw('COUNT(orders.pizza_id )as count'))
                ->join('users', 'users.id', 'orders.customer_id')
                ->join('pizzas', 'pizzas.pizza_id', 'orders.pizza_id')
                ->orWhere('users.name', 'like', '%' . Session::get('o_search') . '%')
                ->orWhere('pizzas.pizza_name', 'like', '%' . Session::get('o_search') . '%')
                ->groupBy('orders.customer_id', 'orders.pizza_id')
                ->get();

        } else {
            $order = Order::select('orders.*', 'users.name as customer_name', 'pizzas.pizza_name', DB::raw('COUNT(orders.pizza_id )as count'))
                ->join('users', 'users.id', 'orders.customer_id')
                ->join('pizzas', 'pizzas.pizza_id', 'orders.pizza_id')
                ->groupBy('orders.customer_id', 'orders.pizza_id')
                ->get();

        }

        $csvExporter = new \Laracsv\Export();

        $csvExporter->build($order, [
            'order_id' => 'Order ID',
            'customer_name' => 'Customer Name',
            'pizza_name' => 'Pizza Name',
            'count' => 'Pizza Count',
            'order_time' => 'Order Time',
            'created_at' => 'Created Date',
            'updated_at' => 'Update Date',
        ]);

        $csvReader = $csvExporter->getReader();
        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        $filename = 'orderList.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');

    }

}
