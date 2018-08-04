<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_mistake;
use DB;
use PDF;
use App\User;
use App\tb_transection;
use Auth;


class TestController extends Controller
{
    public function index(Request $request, $Desc1 ,$Divi)
    {

        $user = Auth::user()->user_code;

     //   $value = str_limit($Desc1,2);
        $value = str_limit($Desc1, $limit = 2, $end = '');


        $last_no = DB::table('tb_transection')
            ->where('user_code' ,'=', $user)
            ->where('mistake_code' ,'=', $value)
            ->where('D_devolop','=', $Divi)
            ->where('flag_comfirm','=', 'Y')
            ->value('No');









        $user = DB::select( DB::raw("select B.code_id,A.timlength,A.devolop_plan,C.mistake_description,A.mistake_type,A.date_review,A.NO,A.user_code,B.position,B.fname,B.lname,B.name_et,B.department,A.user_date,A.mistake_code,case when A.D_devolop ='1' Then 'D1' 
when A.D_devolop ='2' Then 'D2'
when A.D_devolop ='3' Then 'D3' 
when A.D_devolop ='4' Then 'D4' 
when A.D_devolop ='5' Then 'D5' 
when A.D_devolop ='6' Then 'D6'
when A.D_devolop ='7' Then 'D7' 
when A.D_devolop ='8' Then 'D8' 
when A.D_devolop ='9' Then 'V' 
when A.D_devolop ='10' Then 'W' 
when A.D_devolop ='11' Then 'TM' END as D_devolop
,CONCAT(B.`name_et`,' ', B.fname,' ',B.lname) AS zName
,A.signatures as sig_trasection
,A.path_picture_Serv

from tb_transection A
LEFT JOIN users B on A.user_code = B.user_code
left join tb_mistake_type C on A.mistake_code = C.mistake_code And A.mistake_type = C.mistake_type

where No = $last_no


"));






        $user2 = DB::select( DB::raw("select CONCAT(A.`name_et`,' ', A.fname,' ',A.lname) AS zName
,A.signatures AS sig_admin
,B.created_at
from users A
LEFT JOIN tb_transection B on A.user_code = B.user_login

where No = $last_no


"));



        $mistake_basic = DB::select( DB::raw("Select * from tb_mistake_basic WHERE mistake_code = $value")

        );

        $group = DB::table('tb_mistake')
            ->where('mistake_code' ,'=', $value)
            ->value('group');



        $type_basic_warning = DB::table('tb_basic_warning')
            ->where('mistake_code' ,'=', $value)->get();



        $mistake_code = DB::table('tb_mistake')
            ->where('mistake_code' ,'=', $value)
            ->get();




        if ($Divi < 9 ){

            $pdf = PDF::loadView('viewback.bookpdf', compact(array('user','user2','num','value','mistake_basic','mistake_code')));

            //  return $pdf->download('document.pdf');
            return $pdf->stream('document.pdf');

        }else {


            $pdf = PDF::loadView('viewback.bookpdfwarning', compact(array('group','user','type_basic_warning')));

            return $pdf->stream('document.pdf');


        }




    }

    public function warning(Request $request,$user_code, $mistake_code,$D_devolop,$lastno)
    {


        $user = DB::select( DB::raw("select B.code_id,A.timlength,A.devolop_plan,C.mistake_description,A.mistake_type,A.date_review,A.NO,A.user_code,B.position,B.fname,B.lname,B.name_et,B.department,A.user_date,A.mistake_code,case when A.D_devolop ='1' Then 'D1' 
when A.D_devolop ='2' Then 'D2'
when A.D_devolop ='3' Then 'D3' 
when A.D_devolop ='4' Then 'D4' 
when A.D_devolop ='5' Then 'D5' 
when A.D_devolop ='6' Then 'D6'
when A.D_devolop ='7' Then 'D7' 
when A.D_devolop ='8' Then 'D8' 
when A.D_devolop ='9' Then 'V' 
when A.D_devolop ='10' Then 'W' 
when A.D_devolop ='11' Then 'TM' END as D_devolop
,CONCAT(B.`name_et`,' ', B.fname,' ',B.lname) AS zName
,A.signatures as sig_trasection
,A.path_picture_Serv


from tb_transection A
LEFT JOIN users B on A.user_code = B.user_code
left join tb_mistake_type C on A.mistake_code = C.mistake_code And A.mistake_type = C.mistake_type

where No = $lastno


"));






        $mistake_basic = DB::select( DB::raw("Select * from tb_mistake_basic WHERE mistake_code = $mistake_code")

        );

        $user2 = DB::select( DB::raw("select CONCAT(A.`name_et`,' ', A.fname,' ',A.lname) AS zName
,A.signatures AS sig_admin
,B.created_at
,A.position
from users A
LEFT JOIN tb_transection B on A.user_code = B.user_login

where No = $lastno


"));

        $group = DB::table('tb_mistake')
            ->where('mistake_code' ,'=', $mistake_code)
            ->value('group');



        $type_basic_warning = DB::table('tb_basic_warning')
            ->where('mistake_code' ,'=', $mistake_code)->get();





        $pdf = PDF::loadView('viewback.bookpdfwarning', compact(array('group','user','user2','type_basic_warning')));
        // $pdf = PDF::loadView('viewback.bookpdftest');

        //  return $pdf->download('document.pdf');
        return $pdf->stream('document.pdf');


    }












}
