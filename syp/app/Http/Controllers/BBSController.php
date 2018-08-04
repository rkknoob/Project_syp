<?php

namespace App\Http\Controllers;

use App\Bbs_card;
use Illuminate\Http\Request;
use DB;
use App\tb_date_dev;
use App\tb_mistake;
use App\tb_transection;
use App\User;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Providers\SweetAlertServiceProvider;
use UxWeb\SweetAlert;
use Alert;
use Image;
use Illuminate\Support\Facades\Input;
use File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Session;
use Response;

class BBSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        return view('BBS.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $user_id = Auth::user()->user_code;

        $input = $request->all();
        $safaty_1 = $request->input('safaty_1');
        $safaty_2 = $request->input('safaty_2');
        $safaty_3 = $request->input('safaty_3');
        $safaty_4 = $request->input('safaty_4');
        $safaty_5 = $request->input('safaty_5');
        $safaty_6 = $request->input('safaty_6');
        $safaty_7 = $request->input('safaty_7');
        $safaty_8 = $request->input('safaty_8');

        $user_bbs = $request->input('user_bbs');
        $etc = $request->input('etc');
        $drive = $request->input('drive');


        if($request->ajax()){


            $values = array('date_time' => NOW(),'user_login' => $user_id,'user_bbs'=>$user_bbs,'safaty_1' => $safaty_1,'safaty_2' => $safaty_2,'safaty_3' => $safaty_3,'safaty_4' => $safaty_4,'safaty_5' => $safaty_5,'safaty_6' => $safaty_6,'safaty_7' => $safaty_7,'safaty_8' => $safaty_8,'etc' => $etc,'drive'=>$drive,'date_time_created' =>NOW());
            DB::table('bbs_card')->insert($values);
            $data = 1;
            return response()->json($data);


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

    public function report(Request $request)
    {
        $input = $request->all();

        $date1 = $request->input('document_date1');
        $date2 = $request->input('document_date2');
        $user_code = $request->input('user_code');

        $date111 = date('Y-m-d', strtotime("+1 day", strtotime($date2)));

        $carbon = Carbon::today();
        $format = $carbon->format('Y-m-d');


        if ($date1 == '') {
            $report = DB::select( DB::raw("select A.date_time,A.user_login,CONCAT(' ', B.fname,' ',B.lname) AS name_r,COUNT(A.date_time) As bbs from bbs_card A
LEFT JOIN users B on A.user_login = B.user_code 
WHERE date_time = '$format'
GROUP BY A.user_login,A.date_time,name_r")

            );


        }else {

            $report = DB::select( DB::raw("select A.date_time,A.user_login,CONCAT(' ', B.fname,' ',B.lname) AS name_r,COUNT(A.date_time) As bbs from bbs_card A
LEFT JOIN users B on A.user_login = B.user_code 
WHERE date_time >= '$date1'
and date_time  < '$date111'
GROUP BY A.user_login,A.date_time,name_r")

            );

        }



        return view('report.bbs', ['report' => $report]);
    }

    public function query(Request $request)
    {

        $user_log = Input::get('user_log');

        $date_bbs = $request->input('date_bbs');


        $report = DB::select( DB::raw("select user_login,user_bbs,
CASE safaty_1
WHEN 'Y' THEN 'ปลอดภัย'
WHEN 'N' THEN 'ไม่ปลอดภัย'
ELSE 'ไม่ได้กรอก'
END AS S1,
CASE safaty_2
WHEN 'Y' THEN 'ปลอดภัย'
WHEN 'N' THEN 'ไม่ปลอดภัย'
ELSE 'ไม่ได้กรอก'
END AS S2,
CASE safaty_3
WHEN 'Y' THEN 'ปลอดภัย'
WHEN 'N' THEN 'ไม่ปลอดภัย'
ELSE 'ไม่ได้กรอก'
END AS S3,
CASE safaty_4
WHEN 'Y' THEN 'ปลอดภัย'
WHEN 'N' THEN 'ไม่ปลอดภัย'
ELSE 'ไม่ได้กรอก'
END AS S4,
CASE safaty_5
WHEN 'Y' THEN 'ปลอดภัย'
WHEN 'N' THEN 'ไม่ปลอดภัย'
ELSE 'ไม่ได้กรอก'
END AS S5,
CASE safaty_7
WHEN 'Y' THEN 'ปลอดภัย'
WHEN 'N' THEN 'ไม่ปลอดภัย'
ELSE 'ไม่ได้กรอก'
END AS S7,
CASE safaty_8
WHEN 'Y' THEN 'มีใบขับขี่'
WHEN 'N' THEN 'ไม่มีใบขับขี่'
ELSE 'ไม่ได้กรอก'
END AS S8
,IFNULL(CONCAT(B.fname,' ' ,B.lname), 'ไม่มีชื่อนี้') as name_user_bbs
,IFNULL(drive, 'ไม่ได้กรอก') as drive1
,etc,
CASE safaty_6
WHEN 'Y' THEN 'ปลอดภัย'
WHEN 'N' THEN 'ไม่ปลอดภัย'
ELSE 'ไม่ได้กรอก'
END AS S6

from bbs_card A 
LEFT JOIN users B on A.user_bbs = B.user_code 
where user_login = '$user_log'
and date_time = '$date_bbs'

")

        );
        return Response::json($report);
    }


}
