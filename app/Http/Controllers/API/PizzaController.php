<?php

namespace App\Http\Controllers\API;
use App\Models\Pizza;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
class PizzaController extends Controller
{
    public function getPizza(){
        $pizza=Pizza::get();
        return Response::json($pizza);
    }
}
