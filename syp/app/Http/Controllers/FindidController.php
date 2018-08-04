<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use auth;
class FindidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $tt = $request->all();

        $user_code = $request->input('txtname');
        $type_user = $request->input('type_user');

        $check_user = Auth::user()->department;

        if ($check_user == 'System' ||$check_user == 'Inventory' || $check_user == 'Trunking')
        {
            abort(403);
        }

        $user = DB::table('users');


        if ($type_user == 'name') {

            $user->where('fname_e', $user_code)->orWhere('fname_e', 'like', '%' . $user_code . '%')->get();

        }

            else if ($type_user == 'user_code_e'){

                $user->where('user_code', $user_code)->orWhere('user_code', 'like', '%' . $user_code . '%')->get();




        } else {

            $user->where('user_code', '');
        }
        /* if ($d1 != ''){

             $show->where('document_no',  $d1)->Where('document_date', $d2)->where('flag', '=', $d3);

         }else {



         }*/





        $result = $user->get();

        //dd($result);




      //  return view('Workdaily/index',['users' => $result, 'user1'=> $user]);



        return view('find_user/index',['users' => $result, 'user1'=> $user]);







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
