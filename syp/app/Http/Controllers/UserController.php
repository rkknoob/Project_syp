<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Test;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mail;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $countries = Department::all()->pluck('depart_description', 'depart_no'); // get all countries

       // $user = Auth::user()->depart_no;



            $items = User::all();





        $department = DB::select( DB::raw("select  DISTINCT IFNULL(department,'')department from users ORDER BY department DESC")

        );

            return view('user_login/index',['users' => $items,'department'=>$department]);






    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {




        $input = $request->all();

        $users_id = $request->all('user_code');



        $check_id  = DB::table('users')->where('user_code', '=', $users_id)->count();



        $items = User::all();


        if($check_id == 0){

            $item_create = User::create($input);



            return 1;
        }
        else {

            return 2;

        }






//        dd($input['name'],$input['price']);





      //  return view('user_login/index',['users' => $items]);



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
     $user = User::find($id);

        $department = DB::select( DB::raw("select  DISTINCT department from users WHERE IFNULL(department, '') != '' order by department asc"));
     return view('user_login.edit',compact('user'))->with('department', $department);
    }


    public function updated(Request $request)
    {
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
                'level'=>$user['level'],
                'status'=>$user['status'],
                'position'=>$user['position'],
                'department'=>$user['department'],
                'code_id'=>$user['code_id'],
               'work_dat'=>$user['work_dat'],
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
