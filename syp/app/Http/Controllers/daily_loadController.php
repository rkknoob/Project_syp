<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Response;
use Auth;
use Input;

class daily_loadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {




        return view('daily_load.index');
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


    public function trunk(Request $request)
    {

        $check_department = Auth::user()->department;
        $check_user = Auth::user()->user_code;
        if(($check_department == 'Trunking') || ($check_user == 'admin1' || $check_user == 'AMARAHIA')){

            $data_trunk = DB::table('daily_load')
                ->where('status_trunk' ,'=', 'N')->get();



            return view ('daily_load.trunking')->with('data_trunk', $data_trunk);

        }else{

            abort('403');

        }




    }
    public function receive(Request $request)
    {

        $check_department = Auth::user()->department;
        $check_user = Auth::user()->user_code;




            $data_receive = DB::table('daily_load')
                ->where('status_receive' ,'=', 'N')->get();




            return view ('daily_load.receive')->with('data_receive', $data_receive);




    }

    public function updated_receive(Request $request)
    {
        $input= $request->all();

        $trip = $input['trip_id'];
        $input = Auth::user()->user_code;

        $check_status = DB::table('daily_load')
            ->where('trin' ,'=', $trip)
            ->value('status_receive');
        if($check_status == 'N'){

            $Token = 'PfXLjN3sHsErMXmTBIeyyzHYkDfrO5gGvY9paKcxIdI';

            $str = "เริ่มจับเวลา";

            $message =  $str.$trip;
            $lineapi = $Token; // ใส่ token key ที่ได้มา
            $mms =  trim($message); // ข้อความที่ต้องการส่ง
            date_default_timezone_set("Asia/Bangkok");
            $chOne = curl_init();
            curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
            // SSL USE
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
            //POST
            curl_setopt( $chOne, CURLOPT_POST, 1);

            curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms");

            curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);

            $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$lineapi.'', );
            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);

            curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec( $chOne );
            //Check error




            DB::table('daily_load')
                ->where('trin', $trip)
                ->update(['status_receive'=>'Y','time_receive'=>Carbon::now('Asia/Bangkok')->format('Y-m-d H:i:s'),'status_transport'=>'N','user_update_receive'=>$input]);


            return 1;

        }else {

            return 2;


        }


    }


    public function transport(Request $request)
    {


        $data_transport = DB::select( DB::raw("select day_upload,trin,type_load,trailer_no,time_trunk,arrivestore,time_receive,time_transport,CONCAT((HOUR(TIMEDIFF(time_trunk,IFNULL(time_transport,NOW())))), '.', MINUTE(TIMEDIFF(time_trunk,IFNULL(time_transport,NOW())))) AS duration_trun,
(Case when ((IFnull(time_trunk,'') ='') or (STR_TO_DATE(arrivestore, '%Y-%m-%d %H:%i:%s') =null)) Then 3         
                       when STR_TO_DATE(time_trunk, '%Y-%m-%d %H:%i:%s') > STR_TO_DATE(arrivestore, '%Y-%m-%d %H:%i:%s') Then 1 Else 0 End) AS Stat,
											 CONCAT((HOUR(TIMEDIFF(time_trunk,IFNULL(time_receive,NOW())))), '.', MINUTE(TIMEDIFF(time_trunk,IFNULL(time_receive,NOW())))) AS duration_trun_receive,
											  CONCAT((HOUR(TIMEDIFF(time_receive,IFNULL(time_transport,NOW())))), '.', MINUTE(TIMEDIFF(time_receive,IFNULL(time_transport,NOW())))) AS duration_receive_tran




FROM daily_load where status_transport = 'N'
ORDER BY trin DESC")

        );



        //  return view ('daily_load.receive')->with('data_receive', $data_receive);

        return view('daily_load.transport')->with('data_transport', $data_transport);
    }


    public function updated_trunk(Request $request)
    {

        $input= $request->all();

        $trip = $input['trip_id'];
        $trailer_no = $input['trailer_no'];

        $input = Auth::user()->user_code;

        $check_status = DB::table('daily_load')
            ->where('trin' ,'=', $trip)
            ->value('status_trunk');







        if($check_status == 'N'){


            $Token = 'qgxwTJZeWypsBv9CmI8e6VfMgC9oV8gJaNERv6kIbdG';

            $str = "test";

            $message =  $str.$trailer_no;
            $lineapi = $Token; // ใส่ token key ที่ได้มา
            $mms =  trim($message); // ข้อความที่ต้องการส่ง
            date_default_timezone_set("Asia/Bangkok");
            $chOne = curl_init();
            curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
            // SSL USE
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
            //POST
            curl_setopt( $chOne, CURLOPT_POST, 1);

            curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms");

            curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);

            $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$lineapi.'', );
            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);

            curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec( $chOne );
            //Check error

            DB::table('daily_load')
                ->where('trin', $trip)
                ->update(['status_trunk'=>'Y','time_trunk'=>Carbon::now('Asia/Bangkok')->format('Y-m-d H:i:s'),'status_receive'=>'N','user_update_trunk'=>$input]);


            return 1;

        }  else {

            return 2;
        }
    }


    public function updated_transport(Request $request)
    {
        $input= $request->all();

        $trip = $input['trip_id'];
        $input = Auth::user()->user_code;

        $check_status = DB::table('daily_load')
            ->where('trin' ,'=', $trip)
            ->value('status_transport');
        if($check_status == 'N'){

            $Token = 'j0OdtcghaHE3u1fiDxah17P8w1UQrDiArF5MxaALhAM';

            $str = "เริ่มจับเวลา";

            $message =  $str.$trip;
            $lineapi = $Token; // ใส่ token key ที่ได้มา
            $mms =  trim($message); // ข้อความที่ต้องการส่ง
            date_default_timezone_set("Asia/Bangkok");
            $chOne = curl_init();
            curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
            // SSL USE
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
            //POST
            curl_setopt( $chOne, CURLOPT_POST, 1);

            curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms");

            curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);

            $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$lineapi.'', );
            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);

            curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec( $chOne );

            DB::table('daily_load')
                ->where('trin', $trip)
                ->update(['status_transport'=>'Y','time_transport'=>Carbon::now('Asia/Bangkok')->format('Y-m-d H:i:s'),'user_update_transport'=>$input]);


            return 1;

        }  else {

            return 2;
        }



    }

    public function Summary(Request $request)
    {


        $input = $request->all();

        $date1 = $request->input('document_date1');
        $date2 = $request->input('document_date2');
        $date111 = date('Y-m-d', strtotime("+1 day", strtotime($date2)));


        if($input == null){

            $Summary_time = DB::select( DB::raw("select str_to_date(day_upload, '%Y-%m-%d') as day_upload2,trin,type_load,trailer_no,time_trunk,str_to_date(arrivestore, '%Y-%m-%d %H:%i:%s') as arrivestore2,time_receive,time_transport,CONCAT((HOUR(TIMEDIFF(time_trunk,IFNULL(time_transport,NOW())))), '.', MINUTE(TIMEDIFF(time_trunk,IFNULL(time_transport,NOW())))) AS duration_trun,
(Case when ((IFnull(time_trunk,'') ='') or (STR_TO_DATE(arrivestore, '%Y-%m-%d %H:%i:%s') =null)) Then 3         
                       when STR_TO_DATE(time_trunk, '%Y-%m-%d %H:%i:%s') > STR_TO_DATE(arrivestore, '%Y-%m-%d %H:%i:%s') Then 1 Else 0 End) AS Stat,
            CONCAT((HOUR(TIMEDIFF(time_trunk,IFNULL(time_receive,NOW())))), '.', MINUTE(TIMEDIFF(time_trunk,IFNULL(time_receive,NOW())))) AS duration_trun_receive,
             CONCAT((HOUR(TIMEDIFF(time_receive,IFNULL(time_transport,NOW())))), '.', MINUTE(TIMEDIFF(time_receive,IFNULL(time_transport,NOW())))) AS duration_receive_tran




FROM daily_load
ORDER BY str_to_date(day_upload, '%Y-%m-%d') DESC,type_load asc,str_to_date(arrivestore, '%Y-%m-%d %H:%i:%s') asc limit 60")

            );





            return view('daily_load.Summary')->with('Summary_time', $Summary_time);

        }else {


            $Summary_time = DB::select( DB::raw("select str_to_date(day_upload, '%Y-%m-%d') as day_upload2,trin,type_load,trailer_no,time_trunk,str_to_date(arrivestore, '%Y-%m-%d %H:%i:%s') as arrivestore2,time_receive,time_transport,CONCAT((HOUR(TIMEDIFF(time_trunk,IFNULL(time_transport,NOW())))), '.', MINUTE(TIMEDIFF(time_trunk,IFNULL(time_transport,NOW())))) AS duration_trun,
(Case when ((IFnull(time_trunk,'') ='') or (STR_TO_DATE(arrivestore, '%Y-%m-%d %H:%i:%s') =null)) Then 3         
                       when STR_TO_DATE(time_trunk, '%Y-%m-%d %H:%i:%s') > STR_TO_DATE(arrivestore, '%Y-%m-%d %H:%i:%s') Then 1 Else 0 End) AS Stat,
            CONCAT((HOUR(TIMEDIFF(time_trunk,IFNULL(time_receive,NOW())))), '.', MINUTE(TIMEDIFF(time_trunk,IFNULL(time_receive,NOW())))) AS duration_trun_receive,
             CONCAT((HOUR(TIMEDIFF(time_receive,IFNULL(time_transport,NOW())))), '.', MINUTE(TIMEDIFF(time_receive,IFNULL(time_transport,NOW())))) AS duration_receive_tran




FROM daily_load   where day_upload BETWEEN '$date1' AND '$date111'
ORDER BY str_to_date(day_upload, '%Y-%m-%d') DESC,type_load asc,str_to_date(arrivestore, '%Y-%m-%d %H:%i:%s') asc limit 60")

            );
            return view('daily_load.Summary')->with('Summary_time', $Summary_time);


        }



    }


    public function created(Request $request)
    {

        return view('daily_load.creat_plan_load');


    }

    public function createdd(Request $request)
    {

        $user_code_t = Input::get('trin');
        $trailer_no = Input::get('trailer_no');
        $day_upload = Input::get('day_upload');
        $arrivestore = Input::get('arrivestore');
        $type_load = Input::get('type_load');

        $check_trid  = DB::table('daily_load')->where('trin', '=', $user_code_t)->count();


        if($check_trid == 0){



            DB::insert('insert into daily_load (trin, trailer_no, day_upload,arrivestore,type_load,status_trunk) values (?, ?, ?, ?, ?, ?)', [$user_code_t, $trailer_no, $day_upload, $arrivestore, $type_load, 'N']);


            $test = '1';

            return Response::json($test);


        }elseif ($check_trid == 1){

            $test = '2';
            return Response::json($test);

        }


    }
}
