<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Excel;
use App\tb_mistake;
use PDF;
use Response;
use Carbon\Carbon;
use Input;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view ('report.index');
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

    public function week(Request $request)
    {

        $items = tb_mistake::all(['mistake_code', 'description_mistake']);

        /*function ตัวนี้มาจาก  week.blade   edit by rkknoob*/
        $input = $request->all();
        $date1 = $request->input('document_date1');
        $date2 = $request->input('document_date2');
        $mistake_code = $request->input('mistake_code');

        $D_devolop = $request->input('D_devolop');
        $date111 = date('Y-m-d', strtotime("+1 day", strtotime($date2)));


        /*function ตัวนี้มาจาก  week.blade  sql report  edit by rkknoob*/
        if(($mistake_code == null) && ( $D_devolop == null)){

            $user = DB::select( DB::raw("select B.No,A.user_code,A.fname,A.lname,B.mistake_code,B.type_warning,B.user_login,B.description,B.user_date,C.description_mistake,D.fname as name_login,D.lname as lname_login,

CASE when B.D_devolop ='1' Then 'D1'
when B.D_devolop ='2' Then 'D2'
when B.D_devolop ='3' Then 'D3'
when B.D_devolop ='4' Then 'D4'
when B.D_devolop ='5' Then 'D5'
when B.D_devolop ='6' Then 'D6'
when B.D_devolop ='7' Then 'D7'
when B.D_devolop ='8' Then 'D8'
when B.D_devolop ='9' Then 'V'
when B.D_devolop ='10' Then 'W'
when B.D_devolop ='11' Then 'TM' END as D_devolop, 

case when B.type_warning ='1' Then 'สอนงาน' 
when B.type_warning ='2' Then 'แผนพัฒนา/แผนพัฒนา' 
when B.type_warning ='3' Then 'ใบเตือน' END as type_warning 
from users A
INNER JOIN tb_transection B on A.user_code = B.user_code
INNER JOIN tb_mistake C on C.mistake_code = B.mistake_code
INNER JOIN users D on D.user_code = B.user_login

WHERE  1=1

and flag_comfirm ='Y'
and user_date >= '$date1'
and user_date  < '$date111'


ORDER BY A.user_code,B.mistake_code,B.D_devolop DESC"));

            return view('report.week',['users' => $user,$date1,$date111,'items' => $items]);

        }else if (($mistake_code !== null) && ( $D_devolop !== null)){

            $user = DB::select( DB::raw("select B.No,A.user_code,A.fname,A.lname,B.mistake_code,B.type_warning,B.user_login,B.description,B.user_date,C.description_mistake,D.fname as name_login,D.lname as lname_login,

CASE when B.D_devolop ='1' Then 'D1'
when B.D_devolop ='2' Then 'D2'
when B.D_devolop ='3' Then 'D3'
when B.D_devolop ='4' Then 'D4'
when B.D_devolop ='5' Then 'D5'
when B.D_devolop ='6' Then 'D6'
when B.D_devolop ='7' Then 'D7'
when B.D_devolop ='8' Then 'D8'
when B.D_devolop ='9' Then 'V'
when B.D_devolop ='10' Then 'W'
when B.D_devolop ='11' Then 'TM' END as D_devolop, 

case when B.type_warning ='1' Then 'สอนงาน' 
when B.type_warning ='2' Then 'แผนพัฒนา/แผนพัฒนา' 
when B.type_warning ='3' Then 'ใบเตือน' END as type_warning 
from users A
INNER JOIN tb_transection B on A.user_code = B.user_code
INNER JOIN tb_mistake C on C.mistake_code = B.mistake_code
INNER JOIN users D on D.user_code = B.user_login

WHERE  1=1

and flag_comfirm ='Y'
and user_date >= '$date1'
and user_date  < '$date111'
and B.D_devolop = '$D_devolop'
and B.mistake_code = '$mistake_code'

ORDER BY A.user_code,B.mistake_code,B.D_devolop DESC"));

            return view('report.week',['users' => $user,$date1,$date111,'items' => $items]);
        }else if (($mistake_code !== null) && ( $D_devolop == null)){



            $user = DB::select( DB::raw("select B.No,A.user_code,A.fname,A.lname,B.mistake_code,B.type_warning,B.user_login,B.description,B.user_date,C.description_mistake,D.fname as name_login,D.lname as lname_login,

CASE when B.D_devolop ='1' Then 'D1'
when B.D_devolop ='2' Then 'D2'
when B.D_devolop ='3' Then 'D3'
when B.D_devolop ='4' Then 'D4'
when B.D_devolop ='5' Then 'D5'
when B.D_devolop ='6' Then 'D6'
when B.D_devolop ='7' Then 'D7'
when B.D_devolop ='8' Then 'D8'
when B.D_devolop ='9' Then 'V'
when B.D_devolop ='10' Then 'W'
when B.D_devolop ='11' Then 'TM' END as D_devolop, 

case when B.type_warning ='1' Then 'สอนงาน' 
when B.type_warning ='2' Then 'แผนพัฒนา/แผนพัฒนา' 
when B.type_warning ='3' Then 'ใบเตือน' END as type_warning 
from users A
INNER JOIN tb_transection B on A.user_code = B.user_code
INNER JOIN tb_mistake C on C.mistake_code = B.mistake_code
INNER JOIN users D on D.user_code = B.user_login

WHERE  1=1

and flag_comfirm ='Y'
and user_date >= '$date1'
and user_date  < '$date111'
and B.mistake_code = '$mistake_code'

ORDER BY A.user_code,B.mistake_code,B.D_devolop DESC"));

            return view('report.week',['users' => $user,$date1,$date111,'items' => $items]);
        }else if (($mistake_code == null) && ( $D_devolop !== null)){


            $user = DB::select( DB::raw("select B.No,A.user_code,A.fname,A.lname,B.mistake_code,B.type_warning,B.user_login,B.description,B.user_date,C.description_mistake,D.fname as name_login,D.lname as lname_login,

CASE when B.D_devolop ='1' Then 'D1'
when B.D_devolop ='2' Then 'D2'
when B.D_devolop ='3' Then 'D3'
when B.D_devolop ='4' Then 'D4'
when B.D_devolop ='5' Then 'D5'
when B.D_devolop ='6' Then 'D6'
when B.D_devolop ='7' Then 'D7'
when B.D_devolop ='8' Then 'D8'
when B.D_devolop ='9' Then 'V'
when B.D_devolop ='10' Then 'W'
when B.D_devolop ='11' Then 'TM' END as D_devolop, 

case when B.type_warning ='1' Then 'สอนงาน' 
when B.type_warning ='2' Then 'แผนพัฒนา/แผนพัฒนา' 
when B.type_warning ='3' Then 'ใบเตือน' END as type_warning 
from users A
INNER JOIN tb_transection B on A.user_code = B.user_code
INNER JOIN tb_mistake C on C.mistake_code = B.mistake_code
INNER JOIN users D on D.user_code = B.user_login

WHERE  1=1

and flag_comfirm ='Y'
and user_date >= '$date1'
and user_date  < '$date111'
and B.D_devolop = '$D_devolop'

ORDER BY A.user_code,B.mistake_code,B.D_devolop DESC"));

            return view('report.week',['users' => $user,$date1,$date111,'items' => $items]);

        }



    }


    public function person(Request $request)
    {


        $user_id = Auth::user()->user_code;
        $input = $request->all();

        $date_time = $request->document_date1;

        if($date_time == null){

            $date_time = Carbon::now()->format('Y-m-d');
        }


        $user = DB::select( DB::raw("select a.mistake_code ,b.description_mistake

,sum(case when  type_warning = 1  then 1 else 0 end) as Coach
,sum(case when  type_warning = 2  then 1 else 0 end) as Devolop 
from tb_transection a
LEFT JOIN tb_mistake b on a.mistake_code = b.mistake_code
where user_login = '$user_id'
and DATE_FORMAT(a.user_date, '%Y-%m-%d') = '$date_time'
and flag_comfirm = 'Y'
GROUP BY a.mistake_code,b.description_mistake
UNION
Select   'Summary' as Desc1
,'ทุกเรื่อง' as Desc2
      ,sum(case when  type_warning = 1  then 1 else 0 end) as Coach
      ,sum(case when  type_warning = 2  then 1 else 0 end) as Devolop
   from tb_transection  a 
LEFT JOIN tb_mistake b on a.mistake_code = b.mistake_code
where flag_comfirm = 'Y'
and user_login = '$user_id'
and DATE_FORMAT(a.user_date, '%Y-%m-%d') = '$date_time'"));




        return view('report.person',['users' => $user,'user_id' => $user_id,'date_time'=> $date_time]);
    }



    public function pdf(Request $request, $No)
    {
        $last_no = DB::table('tb_transection')
            ->where('No', '=', $No)
            ->value('No');

        $Divi = DB::table('tb_transection')
            ->where('No', '=', $No)
            ->value('D_devolop');


        $value = DB::table('tb_transection')
            ->where('No', '=', $No)
            ->value('mistake_code');


        $user = DB::select(DB::raw("select B.code_id,A.timlength,A.devolop_plan,C.mistake_description,A.mistake_type,A.date_review,A.NO,A.user_code,B.position,B.fname,B.lname,B.name_et,B.department,A.user_date,A.mistake_code,
case 

when A.D_devolop ='1' Then 'D1' 
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
            ->where('mistake_code', '=', '01')->get();


        $mistake_code = DB::table('tb_mistake')
            ->where('mistake_code', '=', $value)
            ->get();




        if($Divi == null){


            $pdf = PDF::loadView('viewback.bookpdfcoach', compact(array('user', 'user2', 'num', 'value', 'mistake_basic', 'mistake_code')));
            return $pdf->stream('document.pdf');

        }




        if ($Divi < 9) {

            $pdf = PDF::loadView('viewback.bookpdf', compact(array('user', 'user2', 'num', 'value', 'mistake_basic', 'mistake_code')));

            //  return $pdf->download('document.pdf');
            return $pdf->stream('document.pdf');

        } else {
            $pdf = PDF::loadView('viewback.bookpdfwarning', compact(array('group', 'user','user2','type_basic_warning')));

            return $pdf->stream('document.pdf');


        }


    }


    public function PersonalShow(Request $request)
    {
        $user_log = Input::get('user_code');

        $date_mistake = $request->input('mistake_code');
        $date = $request->input('date_time');


        $report = DB::select( DB::raw("select CONCAT(b.fname,':',b.lname) as namet,DATE_FORMAT(user_date,'%Y-%m-%d %H:%i') as date_time,user_login 
,(case when A.type_warning ='1' Then 'สอนงาน' 
      when A.type_warning ='2' Then 'แผนพัฒนา/ใบเตือน' 
 END) as type_warning

from tb_transection a
 LEFT JOIN users b on a.user_code = b.user_code
 where user_login = 'admin1'
 and mistake_code = '$date_mistake'
 and flag_comfirm = 'Y'

 and DATE_FORMAT(user_date,'%Y-%m-%d') = '$date'")
        );
        return Response::json($report);
    }

}


