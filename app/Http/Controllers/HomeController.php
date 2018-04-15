<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use App\User;

class HomeController extends Controller
{
    /**
     * Home page
     */
    function index()
    {
        $users = User::count();
        $plans = Plan::count();

        return view('home', [
            'users' => $users,
            'plans' => $plans
        ]);
    }
}
