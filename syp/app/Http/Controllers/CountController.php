<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Input;
use Carbon\Carbon;
use App\count_sheet;

use Session;
class CountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{


    return view('count.index');
}

    public function index2()
    {


        return view('count.index2');
    }


    public function reci()
    {
        return view('count.reci');
    }

    public function reci2()
    {
        return view('count.reci2');
    }



    public function insert(Request $request)
    {
    $input= $request->all();

    $trip = $input['location'];


    $t2 = Input::get('location');
    $t3 = Input::get('user_code');





    $st_dev = DB::table('count_sheet')
        ->where('zone' ,'=', $t2)
        ->value('status');

    if(($st_dev == 'S') || ($st_dev == 'E')){

        return 2;
    }else{


        DB::statement("UPDATE count_sheet
SET status= 'S',user_borrow = '$t3',time_start = NOW()
WHERE zone = '$t2'");
        return 1;
    }

}


    public function insert2(Request $request)
    {

        $input= $request->all();

        $trip = $input['location'];


        $t2 = Input::get('location');
        $t3 = Input::get('user_code');

        $st_dev = DB::table('count_sheet')
            ->where('location' ,'=', $t2)
            ->value('status');

        if($st_dev != 'S') {


        return 2;
        }else {

            DB::statement("UPDATE count_sheet
SET status= 'E',user_receive = '$t3',time_end = NOW()
WHERE location = '$t2'");

            return 1;

        }




    }


    public function insert3(Request $request)
    {

        $input= $request->all();

        $trip = $input['location'];


        $t2 = Input::get('location');
        $t3 = Input::get('user_code');

        $st_dev = DB::table('count_sheet2')
            ->where('location' ,'=', $t2)
            ->value('status');

        if($st_dev != 'N') {


            return 2;
        }else {

            DB::statement("UPDATE count_sheet2
SET status= 'S',user_borrow = '$t3',time_start = NOW()
WHERE location = '$t2'");

            return 1;

        }




    }


    public function insert4(Request $request)
    {

        $input= $request->all();

        $trip = $input['location'];


        $t2 = Input::get('location');
        $t3 = Input::get('user_code');

        $check_id  = DB::table('count_sheet2')->where('location', '=', $t2)->count();
        $check__user  = DB::table('users')->where('user_code', '=', $t3)->count();

        $status_location = DB::table('count_sheet2')
            ->where('location' ,'=', $t2)
            ->value('status');

        if(($check_id == 1) &&( $check__user == 1)){ ///เช็ค user  กับ location ว่ามีไหม  แบบนี้คือ มี

                if($status_location != 'S'){

                    return 1.1;
                }else {

                    DB::statement("UPDATE count_sheet2
SET status= 'E',user_receive = '$t3',time_end = NOW()
WHERE location = '$t2'");

                    return 1;

                }

        }else if(($check_id == 1) && ( $check__user == 0)){ ////เช็ค  user กับ check ว่าเป็น 1 0 ไหม


            return 2;

        }else if(($check_id == 0) && ( $check__user == 1)){


            return 3;

        }else if(($check_id == 0) && ( $check__user == 0)){


            return 4;

        }







    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function data()
    {
        return view('count.data');
    }

    public function data_round2(Request $request)
    {


        $input= $request->all();

        $t2 = Input::get('location');

        $check_id  = DB::table('count_sheet2')->where('location', '=', $t2)->count();

        if($check_id == 0){

            DB::insert('insert into count_sheet2 (location,round,status) values (?, ?, ?)', [$t2,'2','N']);
            return 1;
        }else {


            return 2;
        }



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
