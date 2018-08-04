<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\tb_mistake;
use DB;
use Alert;

class view_userController extends Controller
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




/*ข้อมูล วันเริ่มงาน*/
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
                       
where      b.user_code= 'BOONKHRU'
       and b.type_warning = '2'
       and b.flag_comfirm = 'Y'  
       and b.user_date BETWEEN c.st_date_dev and c.en_date_dev     
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
,count(c.en_date_dev) as TM    
,count(c.en_date_dev) as Day_Now          
from tb_mistake a
LEFT JOIN tb_transection  b on a.mistake_code = b.mistake_code
                           and b.user_code= 'BOONKHRU'
                           and b.type_warning = '2'
                           and b.flag_comfirm = 'Y'
LEFT JOIN tb_date_dev c on b.user_code = c.user_code and a.mistake_code = c.mistake_code  
                       and b.user_date BETWEEN c.st_date_dev and c.en_date_dev       




")



            );





        }





        return view('view_user', ['items' => $items, 'user' => $user,'res' => $results,'data_user' => $data_user,'time_working' =>$time_working]);
    }


    public function show(Request $request)
    {



      $input  = $request->all();
        $user_code = $request->input('user_code');
        $mistake_code = $request->input('mistake_code');

        $st_dev = DB::table('tb_date_dev')
            ->where('user_code' ,'=', $user_code)
            ->where('mistake_code' ,'=', $mistake_code)
            ->value('st_date_dev');
        /*<---  แสดงวค่า เวลา en_dev */
        $en_dev = DB::table('tb_date_dev')
            ->where('user_code' ,'=', $user_code)
            ->where('mistake_code' ,'=',  $mistake_code)
            ->value('en_date_dev');

        DB::statement(DB::raw('SET @prev=0,@row_number=0'));

        $view_report_warning = DB::select( DB::raw("Select   @row_number:=@row_number+1 AS num
 , A.user_code
, CONCAT(A.`name_et`,' ', A.fname,' ',A.lname) AS zName
, A.department
, (B.user_date ) as Last_date
, (B.path_picture_Serv)  as Last_picture
, (B.no)  as last_no 

, B.mistake_code
,B.user_login
,B.user_date
,C.description_mistake,
case when B.type_warning ='1' Then 'สอนงาน' 
when B.type_warning ='2' Then 'แผนพัฒนา' 
when B.type_warning ='3' Then 'ใบเตือน' END as type_warning
 from users A
 left join tb_transection B on A.user_code = B.user_code
 left join tb_date_dev D On A.user_code = D.user_code And B.mistake_code = D.mistake_code
 left join tb_mistake C on B.mistake_code = C.mistake_code
 
where A.user_code= '$user_code'
 and  B.type_warning ='2'
 and  B.mistake_code = $mistake_code
 and  B.user_date  between (case when B.type_warning ='1' Then '1900-01-01' Else D.st_date_dev end) 
                   and     (case when B.type_warning ='1' Then '2500-01-01' Else D.en_date_dev end) 

order by B.user_date desc,B.no desc
")

        );



    return json_encode($view_report_warning);





    }


    public function showwarning(Request $request)
    {

        $input  = $request->all();
        $user_code = $request->input('user_code');
        $mistake_code = $request->input('mistake_code');



        DB::statement(DB::raw('SET @prev=0,@row_number=0'));

        $view_report = DB::select( DB::raw("Select   @row_number:=@row_number+1 AS num
 , A.user_code
, CONCAT(A.`name_et`,' ', A.fname,' ',A.lname) AS zName
, A.department
, (B.user_date ) as Last_date
, (B.path_picture_Serv)  as Last_picture
, (B.no)  as last_no 

, B.mistake_code
,B.user_login
,B.user_date
,C.description_mistake,
case when B.type_warning ='1' Then 'สอนงาน' 
when B.type_warning ='2' Then 'แผนพัฒนา' 
when B.type_warning ='3' Then 'ใบเตือน' END as type_warning
 from users A
 left join tb_transection B on A.user_code = B.user_code
 left join tb_date_dev D On A.user_code = D.user_code And B.mistake_code = D.mistake_code
 left join tb_mistake C on B.mistake_code = C.mistake_code
 
where A.user_code= '$user_code'
 and  B.type_warning ='3'
 and  B.mistake_code = $mistake_code
 and  B.user_date  between (case when B.type_warning ='1' Then '1900-01-01' Else D.st_date_dev end) 
                   and     (case when B.type_warning ='1' Then '2500-01-01' Else D.en_date_dev end) 

order by B.user_date desc,B.no desc
")





        );


        //$ttt =  $view_report;
        return json_encode($view_report);




    }


}
