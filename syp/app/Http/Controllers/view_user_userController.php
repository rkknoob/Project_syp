<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\tb_mistake;
use DB;
use Alert;
use Auth;

class view_user_userController extends Controller
{
    public function index(Request $request)
    {


        $input = Auth::user()->user_code;


       // $input = $request->input('user_code');

        $user = DB::select( DB::raw("select user_code from users where user_code = '$input'")

        );




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
,count(c.en_date_dev) as TM    
,count(c.en_date_dev) as Day_Now          
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








        return view('view_user2', ['items' => $items, 'user' => $user,'res' => $results,'data_user' => $data_user,'time_working' =>$time_working]);
    }

}
