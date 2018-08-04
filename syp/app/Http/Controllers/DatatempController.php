<?php

namespace App\Http\Controllers;

use App\tb_mistake;
use Illuminate\Http\Request;
use DB;
use auth;
use Charts;
use Input;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

use App\Datatemp;
use Session;
use Validator;



class DatatempController extends Controller
{
    public function index()
    {


        // $products = DB::table("datatemp")->where('flag_con','=','N')->get();
        // return view('admin/transection.datatemp_index',compact('products'));
        $items = tb_mistake::all(['mistake_code', 'description_mistake']);







        $datatemp = DB::select( DB::raw("select a.id,DATE_FORMAT(a.date_work,'%Y-%m-%d') as date_work,a.user_code,a.detail,a.mistake_code,b.description_mistake,flag_con,upload_pdf from datatemp a
LEFT JOIN tb_mistake b on a.mistake_code = b.mistake_code
where flag_con = 'N' ORDER BY a.date_work desc 
")

        );





        return view('admin/transection.datatemp_index')->with('datatemp', $datatemp)->with('items', $items);

    }


    public function update(Request $request)
    {



        $data = $request->get('parameter'); //รับค่ามาจาหน้า view
        parse_str($data, $params); //ทำเป็น array
        $arrlength = count($params); //จำนวนที่วน loop
        //echo $arrlength;

        //return Response::json($arrlength);

        foreach($params as $x => $x_value) {


            //where $x_value update flag Y
            $upd =DB::table('datatemp')
                ->where('id', $x_value)
                ->update(['flag_con' => 'Y']);


        }


        $test1 = '1';


        $datatemp  = DB::table('datatemp')->where('flag_con','=','N')->get();


        return Response::json($test1);

    }



    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        //$data = DB::table("datatemp")->whereIn('id',explode(",",$ids))->update(['flag_con' => Y]);

        $results = DB::select( DB::raw("update datatemp set flag_con = 'Y' WHERE ID IN ($ids)")

        );

        Log::useFiles(storage_path().'/logs/updatedatemp.log');
        $check_user = Auth::user()->user_code;
        $ip = $request->ip();
        $loginTime = Carbon::now();
        Log::info('User logged in with '.$check_user.' '.$ip.' at '.$loginTime.' '.$ids);


        return response()->json(['success'=>"Products Deleted successfully."]);
    }

    public function Report_not_clear(Request $request)
    {

        DB::statement(DB::raw('SET @row_num=0'));


        $results = DB::select( DB::raw("Select 

     @row_num := @row_num + 1 AS num
     ,@cnt_no:=cnt_dept as cnt_dept
		 ,Dept_de
  ,old_day
  ,ditss
	, cnt_deptY
	, cnt_deptN
 from (
select B.department As Dept_de,COUNT(B.department) AS cnt_dept,min( case when flag_con = 'N' Then A.date_work Else  null End ) AS old_day,DATEDIFF(NOW(),min( case when flag_con = 'N' Then A.date_work Else  null End )) as ditss 
,SUM(case when flag_con = 'Y' Then 1 Else 0 End) AS cnt_deptY
,SUM(case when flag_con = 'N' Then 1 Else 0 End) AS cnt_deptN
from datatemp A
left join users B ON  A.user_code = B.user_code
where 1=1
and ifnull(B.department, '') !=''



GROUP BY B.department
) A where ifnull(cnt_deptN, '') !='0'


order by  cnt_deptN desc
"));

        $data = DB::table('datatemp')->select('users.department')->join('users','users.user_code','=','datatemp.user_code')
            ->where('flag_con','=','N')
            ->orderBy('department','asc')
            ->get();






        $chart = Charts::database($data, 'bar', 'highcharts')
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(true)
            ->colors(['#2196F3', '#F44336', '#FFC107','#07ffc1','#07ff45','#ff07c1'])

            ->groupBy('department');





        return view('report/datatemp_notclear', ['results' => $results,'chart' => $chart]);
    }


    public function Charts(Request $request)
    {

        $data = DB::table('datatemp')->select('datatemp.user_code','users.department')->join('users','users.user_code','=','datatemp.user_code')
            ->where('flag_con','=','Y')->get();







        $chart = Charts::database($data, 'bar', 'highcharts')
            ->title("My Cool Chart")
            ->elementLabel("Total")
            ->dimensions(1000, 500)
            ->responsive(true)

            ->groupBy('department');




        return view('test', ['chart' => $chart]);

    }

    public function edit(Request $request)
    {
        $user_id = Auth::user()->user_code;
        $id_data = Input::get('id');
        $user_code_t = Input::get('user_code');
        $mistake_code = Input::get('mistake_code');
        $details = Input::get('details');

        $document_date = Input::get('document_date3');

        DB::table('datatemp')
            ->where('id','=',$id_data)
            ->update(['mistake_code'=>$mistake_code,'detail'=>$details,'date_work'=>$document_date,'user_code'=>$user_code_t,'user_update'=>$user_id,'updated_at'=> NOW()]);
        return 1;
    }

    public function report_count1(Request $request)
    {

        $results = DB::select( DB::raw("select count(zone)as total,SUM(status = 'E') as re_turn from count_sheet")); //total and return
        $data_tra = DB::select( DB::raw("select zone,count(zone),SUM(case when status = 'S' Then 1 Else 0 End) AS status_S,SUM(case when status = 'E' Then 1 Else 0 End) AS status_E
,(SUM(case when status = 'E' Then 1 Else 0 End) * 100 ) / (count(zone)) as total

from count_sheet

GROUP BY zone"));


        $data_percetr = DB::select( DB::raw("Select zone
          
            ,sum(status_E) * 100.00 /  count(zone) As total
From (select zone
      ,(case when status = 'S' Then 1 Else 0 End) AS status_S
      ,(case when status = 'E' Then 1 Else 0 End) AS status_E
from count_sheet)  A GROUP BY zone")); // %


        $users2 = DB::table('count_sheet')
            ->select(DB::raw('zone,(SUM(case when status = \'E\' Then 1 Else 0 End) * 100 ) / (count(zone)) as tot'))
            ->groupBy(DB::raw("zone"))
            ->get();


        $chart = Charts::create('bar', 'highcharts')
            ->title("Count Sheet 1")
            ->elementLabel("Progress")
            ->dimensions(1000, 500)
            ->responsive(true)
            ->colors(['#2196F3', '#F44336', '#FFC107','#07ffc1','#07ff45','#ff07c1','#2980B9','#17202A','#78281F','#154360','#F1948A','#A04000','#3498DB'])
            ->labels($users2->pluck('zone'))
            ->values($users2->pluck('tot'))



        ;

        $cout_re = DB::select( DB::raw("select count(zone)as total,SUM(status = 'E') as total2 from count_sheet")); //

        $cout_re_1 = DB::select( DB::raw("select count(zone),(SUM(case when status = 'E' Then 1 Else 0 End) * 100 ) / (count(zone)) as total FROM count_sheet")); //

        $dura = DB::select( DB::raw("Select SUBSTRING(TIMEDIFF(now(),dd_date),1,5) as HH_mm

-- ,TIMEDIFF(now(),dd_date)  As cnt_time
      ,DATE_FORMAT(dd_date, '%H:%i:%s') as dd_date ,NOW()
from
(
select min(STR_TO_DATE(time_start, '%Y-%m-%d %H:%i:%s')) As dd_date
from count_sheet
) A")); //


        return view('report/report_count1', ['results' => $results,'chart' => $chart,'count_re2' =>$cout_re,'sssss' => $cout_re_1,'dura1' => $dura]);
    }



    public function report_count2(Request $request)
    {

        $results = DB::select( DB::raw("select count(zone)as total,SUM(status = 'E') as re_turn from count_sheet2")); //total and return
        $data_tra = DB::select( DB::raw("select zone,count(zone),SUM(case when status = 'S' Then 1 Else 0 End) AS status_S,SUM(case when status = 'E' Then 1 Else 0 End) AS status_E
,(SUM(case when status = 'E' Then 1 Else 0 End) * 100 ) / (count(zone)) as total

from count_sheet2

GROUP BY zone"));


        $data_percetr = DB::select( DB::raw("Select zone
          
            ,sum(status_E) * 100.00 /  count(zone) As total
From (select zone
      ,(case when status = 'S' Then 1 Else 0 End) AS status_S
      ,(case when status = 'E' Then 1 Else 0 End) AS status_E
from count_sheet2)  A GROUP BY zone")); // %


        $users2 = DB::table('count_sheet2')
            ->select(DB::raw('zone,(SUM(case when status = \'E\' Then 1 Else 0 End) * 100 ) / (count(zone)) as tot'))
            ->groupBy(DB::raw("zone"))
            ->get();


        $chart = Charts::create('bar', 'highcharts')
            ->title("Count Sheet 2")
            ->elementLabel("Progress")
            ->dimensions(1000, 500)
            ->responsive(true)
            ->colors(['#2196F3', '#F44336', '#FFC107','#07ffc1','#07ff45','#ff07c1','#2980B9','#17202A','#78281F','#154360','#F1948A','#A04000','#3498DB'])
            ->labels($users2->pluck('zone'))
            ->values($users2->pluck('tot'))

        ;



        $cout_re = DB::select( DB::raw("select count(zone)as total,SUM(status = 'E') as total2 from count_sheet2")); //

        $cout_re_1 = DB::select( DB::raw("select count(zone),(SUM(case when status = 'E' Then 1 Else 0 End) * 100 ) / (count(zone)) as total FROM count_sheet2")); //

        $dura = DB::select( DB::raw("Select SUBSTRING(TIMEDIFF(now(),dd_date),1,5) as HH_mm

-- ,TIMEDIFF(now(),dd_date)  As cnt_time
      ,DATE_FORMAT(dd_date, '%H:%i:%s') as dd_date ,NOW()
from
(
select min(STR_TO_DATE(time_start, '%Y-%m-%d %H:%i:%s')) As dd_date
from count_sheet2
) A")); //


        return view('report/report_count2', ['results' => $results,'chart' => $chart,'count_re2' =>$cout_re,'sssss' => $cout_re_1,'dura1' => $dura]);
    }



    public function insert(Request $request)
    {
        $user_id = Auth::user()->user_code;
        $file = Input::file('filename');
        $input = $request->all();
        $mistake_code_t = Input::get('mistake_code');
        $user_code_t = Input::get('user_code');
        $details = Input::get('details');
        $document_date1 = Input::get('document_date1');
        $count  = DB::table('users')->where('user_code', '=', $user_code_t)->count();
        $document_date2 = Carbon::parse($document_date1)->format('Y-m-d 00:00:00');
        $todayDate = date("Y-m-d 00:00:00");
        $validator = Validator::make($request->all(), [
            'user_code' => 'required',
            "filename" => "required|mimes:pdf|max:10000"
        ]);
        if($count == 0){


            return redirect()->back()->withInput()->withErrors($validator)->with('error', 'User นี้ไม่มีในระบบ กรุณากรอกใหม่');
        }

        if($document_date2 > $todayDate){


            return redirect()->back()->withInput()->withErrors($validator)->with('error', 'กรุณาระบุวันที่น้อยกว่าหรือเท่ากับวันปัจจุบัน');
        }


        if($file == null){

            Log::useFiles(storage_path().'/logs/insertdatatemp.log');
            $check_user = Auth::user()->user_code;
            $ip = $request->ip();
            $loginTime = Carbon::now();
            Log::info('User logged in with '.$check_user.' '.$ip.' at '.$loginTime.' '.$user_code_t.''.$user_code_t);

            DB::table('datatemp')->insert(
                ['date_work' => $document_date2, 'user_code' => $user_code_t, 'mistake_code' => $mistake_code_t, 'detail' => $details, 'flag_con' => 'N','user_created' => $user_id,'created_at' =>NOW(),'updated_at' =>NOW()]

            );

            Session::flash('message', "บันทึกเรียบร้อยแล้ว");
            return redirect()->route('admin/transection.datatamp_index')
                ->with('success','Item created successfully');

        }else{






            if ($validator->passes()) {



                if($count == '1'){


                    $extension = Input::file('filename')->getClientOriginalName();

                    $fileName  = time() .'.pdf';

                    $request->file('filename')->getClientOriginalExtension();

                    $request->file('filename')->move(
                        base_path() . '/public/uploads', $fileName
                    );
                    Log::useFiles(storage_path().'/logs/insertdatatemp.log');
                    $check_user = Auth::user()->user_code;
                    $ip = $request->ip();
                    $loginTime = Carbon::now();
                    Log::info('User logged in with '.$check_user.' '.$ip.' at '.$loginTime.' '.$user_code_t.''.$user_code_t);

                    DB::table('datatemp')->insert(
                        ['date_work' => $document_date2, 'user_code' => $user_code_t, 'mistake_code' => $mistake_code_t, 'detail' => $details, 'flag_con' => 'N','upload_pdf' => $fileName]

                    );


                    Log::useFiles(storage_path().'/logs/insertdatatemp.log');
                    $check_user = Auth::user()->user_code;
                    $ip = $request->ip();
                    $loginTime = Carbon::now();
                    Log::info('User logged in with '.$check_user.' '.$ip.' at '.$loginTime.' '.$user_code_t.''.$user_code_t);


                    Session::flash('message', "บันทึกเรียบร้อยแล้ว");
                    return redirect()->route('admin/transection.datatamp_index')
                        ->with('success','Item created successfully');



                }else {


                    return redirect()->back()->withInput()->withErrors($validator)->with('error', 'User นี้ไม่มีในระบบ กรุณากรอกใหม่');

                }



            }

            return redirect()->back()->withInput()->withErrors($validator)->with('error', 'กรุุณาใส่รูปแบบ pdf');

        }
    }
}
