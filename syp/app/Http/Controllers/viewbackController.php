<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_mistake;
use DB;
use PDF;
use App\User;
use Input;

class viewbackController extends Controller
{

    public function index(Request $request)
    {


        $input = $request->input('user_code');



        $user = DB::select( DB::raw("select user_code from users where user_code = '$input'")

        );


        if($user == '' && $user == null){

            alert()->error('Error Message', 'Optional Title');
            return Redirect::back();

        }else {

            $user  = User::where('user_code','=', $input)->value('user_code');
            $items = tb_mistake::all(['mistake_code', 'description_mistake']);

            $data_user  = User::where('user_code','=',$input)->where('status', '=', 'Y')->get();




            /*ข้อมูล วันเริ่มงานอายุงาน*/
            $time_working = DB::select( DB::raw("SELECT TIMESTAMPDIFF(month, work_dat,now()) as 'count month'
,FLOOR(TIMESTAMPDIFF(month, work_dat,now()) /12)  as year
, mod(TIMESTAMPDIFF(month, work_dat,now()),12) as month
 
 
 FROM users WHERE user_code= '$user'")

            );





            DB::statement(DB::raw('SET @prev=0,@row_number=0'));

            $results = DB::select( DB::raw("Select CONCAT(a.mistake_code ,' :' ,a.description_mistake) as Desc1
      ,sum(case when  D_devolop = 1  then 1 else 0 end) as D1
      ,sum(case when  D_devolop = 2  then 1 else 0 end) as D2
			,sum(case when  D_devolop = 3  then 1 else 0 end) as D3
			,sum(case when  D_devolop = 4  then 1 else 0 end) as D4
			,sum(case when  D_devolop = 5  then 1 else 0 end) as D5
			,sum(case when  D_devolop = 6  then 1 else 0 end) as D6
			,sum(case when  D_devolop = 7  then 1 else 0 end) as D7
			,sum(case when  D_devolop = 8  then 1 else 0 end) as D8
			,sum(case when  D_devolop = 9  then 1 else 0 end) as V
			,sum(case when  D_devolop = 10 then 1 else 0 end) as W 
			,sum(case when  D_devolop = 11 then 1 else 0 end) as TM
,c.en_date_dev as last_day    
,DATEDIFF(c.en_date_dev,NOW()) as Day_Now
from tb_mistake a
LEFT JOIN tb_transection  b on a.mistake_code = b.mistake_code
                          
LEFT JOIN tb_date_dev c on b.user_code = c.user_code and a.mistake_code = c.mistake_code  
                       
where      b.user_code= '$user'
       and b.type_warning = '2'
       and b.flag_comfirm = 'Y'  
       and b.user_date BETWEEN c.st_date_dev and c.en_date_dev    
       AND NOW() BETWEEN c.st_date_dev AND c.en_date_dev
group by a.mistake_code  ,a.description_mistake,c.en_date_dev
UNION
Select 'Summary' as Desc1
      ,sum(case when  D_devolop = 1  then 1 else 0 end) as D1
      ,sum(case when  D_devolop = 2  then 1 else 0 end) as D2
			,sum(case when  D_devolop = 3  then 1 else 0 end) as D3
			,sum(case when  D_devolop = 4  then 1 else 0 end) as D4
			,sum(case when  D_devolop = 5  then 1 else 0 end) as D5
			,sum(case when  D_devolop = 6  then 1 else 0 end) as D6
			,sum(case when  D_devolop = 7  then 1 else 0 end) as D7
			,sum(case when  D_devolop = 8  then 1 else 0 end) as D8
			,sum(case when  D_devolop = 9  then 1 else 0 end) as V
			,sum(case when  D_devolop = 10 then 1 else 0 end) as W 
			,sum(case when  D_devolop = 11 then 1 else 0 end) as T
,sum(c.en_date_dev)IS NULL as TM    
,sum(c.en_date_dev)IS NULL as Day_Now        
from tb_mistake a
LEFT JOIN tb_transection  b on a.mistake_code = b.mistake_code
                           and b.user_code= '$user'
                           and b.type_warning = '2'
                           and b.flag_comfirm = 'Y'
                           
                           
                           
LEFT JOIN tb_date_dev c on b.user_code = c.user_code and a.mistake_code = c.mistake_code  
                       and b.user_date BETWEEN c.st_date_dev and c.en_date_dev 
                        WHERE  NOW() BETWEEN c.st_date_dev AND c.en_date_dev   
                            




")



            );



        }





        return view('view_user', ['items' => $items, 'user' => $user,'res' => $results,'data_user' => $data_user,'time_working' =>$time_working,'input' =>$input]);

    }


    public function show(Request $request)
    {

    }

    public function pdfreport(Request $request,$user_code , $last_no, $Divi, $mistake_code ,$type_warning) {













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




        $mistake_basic = DB::select( DB::raw("Select * from tb_mistake_basic WHERE mistake_code = $mistake_code")

        );

        $group = DB::table('tb_mistake')
            ->where('mistake_code' ,'=', $mistake_code)
            ->value('group');



        $type_basic_warning = DB::table('tb_basic_warning')
            ->where('mistake_code' ,'=', $mistake_code)->get();





        if ($Divi == 'V') {




            $pdf = PDF::loadView('viewback.bookpdfwarning', compact(array('group', 'user', 'type_basic_warning')));
            //  return $pdf->download('document.pdf');
            return $pdf->stream('document.pdf');

        } else if($Divi == 'W'){


            $pdf = PDF::loadView('viewback.bookpdfwarning', compact(array('group','user','type_basic_warning')));
            //  return $pdf->download('document.pdf');
            return $pdf->stream('document.pdf');




            }


        else if($Divi == 'TM'){


            $pdf = PDF::loadView('viewback.bookpdfwarning', compact(array('group','user','type_basic_warning')));
            //  return $pdf->download('document.pdf');
            return $pdf->stream('document.pdf');




        }

        else {

            // $pdf = PDF::loadView('viewback.bookpdftest');
            $pdf = PDF::loadView('viewback.bookpdf', compact(array('user','user2','num','value','mistake_basic')));
            //  return $pdf->download('document.pdf');
            return $pdf->stream('document.pdf');


        }


    }


    public function pdfwarning(Request $request)
    {
        $flag_comfirm = 'Y';
        $id2 = Input::get('id2');
        $input = Input::get('imgBase64');
        $suggestion = Input::get('suggestion');

        $mistake_code_t = Input::get('mistake_code');
        $user_code_t = Input::get('user_code');

        DB::table('tb_transection')
            ->where('No','=',$id2)
            ->update(['flag_comfirm'=>'Y','signatures'=> $input,'suggestion'=>$suggestion]);

        DB::table('tb_date_dev')
            ->where('user_code', $user_code_t)
            ->where('mistake_code', $mistake_code_t)
            ->update(['status' => 'N']);
        $test = 1;



        return Response::json($test);

    }

    public function index2(Request $request,$Desc1  ,$Divi,$input)
    {


        $value = str_limit($Desc1, $limit = 2, $end = '');

        $last_no = DB::table('tb_transection')
            ->where('user_code', '=', $input)
            ->where('mistake_code', '=', $value)
            ->where('D_devolop', '=', $Divi)
            ->where('flag_comfirm', '=', 'Y')
            ->value('No');


        $user = DB::select(DB::raw("select B.code_id,A.timlength,A.devolop_plan,C.mistake_description,A.mistake_type,A.date_review,A.NO,A.user_code,B.position,B.fname,B.lname,B.name_et,B.department,A.user_date,A.mistake_code,case when A.D_devolop ='1' Then 'D1' 
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
,A.position
from users A
LEFT JOIN tb_transection B on A.user_code = B.user_login

where No = $last_no


"));





        $mistake_basic = DB::select(DB::raw("Select * from tb_mistake_basic WHERE mistake_code = $value")

        );

        $group = DB::table('tb_mistake')
            ->where('mistake_code', '=', $value)
            ->value('group');


        $type_basic_warning = DB::table('tb_basic_warning')
            ->where('mistake_code', '=', $value)->get();


        $mistake_code = DB::table('tb_mistake')
            ->where('mistake_code', '=', $value)
            ->get();


        if ($Divi < 9) {

            $pdf = PDF::loadView('viewback.bookpdf', compact(array('user', 'user2', 'num', 'value', 'mistake_basic', 'mistake_code')));

            //  return $pdf->download('document.pdf');
            return $pdf->stream('document.pdf');

        } else {
            $pdf = PDF::loadView('viewback.bookpdfwarning', compact(array('group', 'user','user2','type_basic_warning')));

            return $pdf->stream('document.pdf');


        }


    }

}
