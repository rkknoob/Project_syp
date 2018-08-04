<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class WarnningControllor extends Controller
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


        $user = DB::select( DB::raw("select B.No,A.user_code,A.fname,A.lname,B.mistake_code,B.type_warning,B.user_login,B.description,B.user_date, C.description_mistake,B.warning_status,B.D_devolop as D_Devo from users A
INNER JOIN tb_transection B on A.user_code = B.user_code
INNER JOIN tb_mistake C on B.mistake_code = C.mistake_code WHERE type_warning = 2 AND flag_print = 'N' AND flag_comfirm ='Y' AND B.D_devolop in('9','10','11')

")



        );




        return view ('doc_warning.index', ['users' => $user]);
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
    public function update_doc(Request $request)
    {
        $temp_data=$request->all();//ข่อมูลที่ส่งมาเป็น array
        $temp_data['no'];






        DB::table('tb_transection')
            ->where('no', $temp_data['no'])
            ->update(['flag_print' =>'Y',

            ]);
       return 1;
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
