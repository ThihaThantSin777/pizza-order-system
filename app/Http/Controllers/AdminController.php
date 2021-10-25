<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{

    public function user()
    {
        return view('admin.user.user');
    }

    public function carrier()
    {
        return view('admin.carrier.carrier');
    }
}
