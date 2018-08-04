<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
        return view('home');
    }

    public function test()
    {
        return view('user');
    }

    public function devo()
    {


        $cities = DB::table("tb_mistake_type")
            ->where("mistake_code",'01')
            ->lists("mistake_code","mistake_type")->get();


        foreach ($cities as $user) {
            echo $user->count_user;
        }


    }

}
