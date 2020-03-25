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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('home');
    }

    public function teachers(){
        return view('teachersPanel');
    }

    public function admins(){
        return view('adminsPanel');
    }

    public function units(){
        return view('unitsPanel');
    }

    public function tests(){
        return view('testsPanel');
    }
}
