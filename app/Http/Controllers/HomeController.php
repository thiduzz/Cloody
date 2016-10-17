<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.pages.dashboard');
    }

    public function admin_oauth()
    {
        return view('home.pages.admin_oauth');
    }

    public function admin_trucks()
    {
        return view('home.pages.admin_trucks');
    }
}
