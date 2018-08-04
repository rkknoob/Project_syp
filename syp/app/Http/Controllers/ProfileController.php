<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



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
    public function edit()
    {
        $user_id = Auth::user()->id;


        $user = User::find($user_id);


        $department = DB::select( DB::raw("select  DISTINCT department from users WHERE IFNULL(department, '') != '' order by department asc"));
        return view('profile_user',compact('user'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = $request->all();
        $user1 = DB::table('users')
            ->where('user_code', $user['user_code'])
            ->update(['user_code' =>$user['user_code'],
                'name_et'=>$user['name_et'],
                'fname'=>$user['fname'],
                'lname'=>$user['lname'],
                'name_e'=>$user['name_e'],
                'fname_e'=>$user['fname_e'],
                'lname_e'=>$user['lname_e'],

                'signatures'=>$user['signatures'],

                'password'=>bcrypt($user['password']),
            ]);

        return "1";









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
