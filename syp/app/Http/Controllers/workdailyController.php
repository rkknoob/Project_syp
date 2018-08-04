<?php

namespace App\Http\Controllers;

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


class workdailyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $department = $request->department;


        $work_daily = DB::select( DB::raw("SELECT a.id,a.user_code,b.description_mistake,a.mistake_code,DATE_FORMAT(a.date_work, '%d/%m/%Y') as date_work,c.department,a.detail,c.fname,c.lname,a.upload_pdf
from datatemp a
INNER JOIN tb_mistake b on a.mistake_code = b.mistake_code
INNER JOIN users c on a.user_code = c.user_code
where flag_con = 'N' 
and department = '$department'
ORDER BY a.date_work desc
")

        );


        $department = DB::select( DB::raw("select  DISTINCT IFNULL(department,'')department from users 
where department != ''
and department != 'ALL'
and department != 'OSM'
and department != 'Option OTM'
and department != 'GM'
and department != 'OM'
and department != 'Inventory1'
and department != 'Operation Support Manager'
and department != 'Option OSM'
and department != 'OTM'
")

        );



        $work_daily2 = DB::table('datatemp')
            ->join('users', 'datatemp.user_code', '=', 'users.user_code')
            ->join('tb_mistake', 'tb_mistake.mistake_code', '=', 'datatemp.mistake_code')
            ->where('flag_con','=','N')
            ->select('tb_mistake.description_mistake','datatemp.id','datatemp.user_code','datatemp.mistake_code','datatemp.date_work','users.department','datatemp.detail','users.fname','users.lname')
            ->get();



        // return view('workdaily.index')->with('items' => $items);
        return view('workdaily.index', ['work_daily' => $work_daily,'department'=>$department]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $user_code,$mistake_code,$id_temp){


        $check_user = Auth::user()->department;



        $user  = User::where('user_code','=',$user_code)->value('user_code');

        if ($user == null){

            return redirect()->back()->with('alert', 'ติดต่อ System!');
        }else {






            $data_user  = User::where('user_code','=',$user_code)->where('status', '=', 'Y')->get();

            $time_working = DB::select( DB::raw("SELECT TIMESTAMPDIFF(month, work_dat,now()) as 'count month'
,FLOOR(TIMESTAMPDIFF(month, work_dat,now()) /12)  as year
, mod(TIMESTAMPDIFF(month, work_dat,now()),12) as month
 
 
 FROM users WHERE user_code= '$user_code'")

            );

            //     $items = tb_mistake::all(['mistake_code', 'description_mistake']);

            $items = DB::table('tb_mistake')
                ->where('mistake_code','=',$mistake_code)->get();



        }

        return view('workdaily.creatework', ['items' => $items, 'user' => $user,'data_user' => $data_user,'time_working' =>$time_working,'id_temp' =>$id_temp]);


        //  return view('workdaily.creatework')->with('user_code', $user_code)->with('mistake_code',$mistake_code)->with('data_user',$data_user)->with('time_working','=', $time_working);
    }

    //  return view('workdaily.creatework')->with('user_code', $user_code)->with('mistake_code',$mistake_code)->with('data_user',$data_user)->with('time_working','=', $time_working);


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $carbon = Carbon::now()->format('Y-m-d H:i:s');

        $request->request->add(['user_date' => $carbon]);
        $input = $request->all();

        $datatemp = $request->id_temp;


        $datatemp_select = DB::table('datatemp')
            ->where('id', '=', $datatemp)
            ->value('flag_con');


        if($datatemp_select == 'Y'){

            $work_daily = DB::select( DB::raw("select A.id,B.position,A.date_work,A.user_code,CONCAT(' ', B.fname,' ',B.lname) AS zName,A.detail
,A.mistake_code
,B.department,A.flag_con from datatemp A LEFT JOIN
users B on A.user_code = B.user_code WHERE flag_con = 'N'")

            );

            alert()->error('ข้อมูลนี้ถูกบันทึกไปเรียบร้อยแล้ว', 'กรุณาเลือกใหม่');


            return view('workdaily.index', ['work_daily' => $work_daily]);


        }




        $type_warning_t = $request->type_warning;
        //  $path_picture_t  = $request->file('path_picture')->getClientOriginalName();
        $mistake_t = $request->mistake_code;


        $user_code = $request->user_code;
        $time_now = Carbon::now('Asia/Bangkok')->format('Y-m-d');

        /*<---  แสดงวค่า เวลา st_dev */
        $st_dev = DB::table('tb_date_dev')
            ->where('user_code', '=', $input['user_code'])
            ->where('mistake_code', '=', $input['mistake_code'])
            ->value('st_date_dev');
        /*<---  แสดงวค่า เวลา en_dev */
        $en_dev = DB::table('tb_date_dev')
            ->where('user_code', '=', $input['user_code'])
            ->where('mistake_code', '=', $input['mistake_code'])
            ->value('en_date_dev');

        if ($type_warning_t == 2) {
            /*check_first เช็คดูเวลา งานแรก ก่อน insert edit by rkknoob*/


            $check_first = DB::table('tb_date_dev')
                ->where('user_code', '=', $input['user_code'])
                ->where('mistake_code', '=', $input['mistake_code'])
                ->value('status');


            $year_check = Carbon::now()->addYear()->format('Y-m-d');

            if($check_first == NULL && $check_first == ''){
                DB::insert('insert into tb_date_dev (user_code, mistake_code, st_date_dev, en_date_dev, status) values (?, ?, ?, ?, ?)', [$input['user_code'], $input['mistake_code'], Carbon::now('Asia/Bangkok')->format('Y-m-d'), $year_check,'Y']);
                // return 'ครั้งแรก';
            }
            else if($check_first == 'Y'){

                DB::table('tb_date_dev')
                    ->where('user_code', $input['user_code'])
                    ->where('mistake_code', $input['mistake_code'])
                    ->update(['st_date_dev' => $time_now,'en_date_dev' => $year_check]);

            }else {

                if($time_now >= $st_dev && $time_now >= $en_dev){
                    DB::table('tb_date_dev')
                        ->where('user_code', $input['user_code'])
                        ->where('mistake_code', $input['mistake_code'])
                        ->update(['st_date_dev' => $time_now,'en_date_dev' => $year_check,'status' => 'Y']);
                }else{


                }



            }
        }

        /*<---  แสดงวค่า cnt_alert */
        $check_mis = DB::table('tb_mistake')
            ->where('mistake_code', '=', $input['mistake_code'])
            ->value('cnt_alert');


        /*<---  แสดงวค่า เวลา st_dev */
        $st_dev = DB::table('tb_date_dev')
            ->where('user_code', '=', $input['user_code'])
            ->where('mistake_code', '=', $input['mistake_code'])
            ->value('st_date_dev');
        /*<---  แสดงวค่า เวลา en_dev */
        $en_dev = DB::table('tb_date_dev')
            ->where('user_code', '=', $input['user_code'])
            ->where('mistake_code', '=', $input['mistake_code'])
            ->value('en_date_dev');

        /*<--- นับ ผลรวม --->*/
        if (($type_warning_t == 2) || ($type_warning_t == 3)) {

            if (($st_dev == NULL) && ($en_dev == NULL)) {
                $data = 0;

            } else {

                $data2 = DB::table('tb_transection')
                    ->select('tb_transection.user_code', 'tb_transection.mistake_code', 'tb_transection.user_date', 'tb_date_dev.st_date_dev')
                    ->leftjoin('tb_date_dev', function ($leftjoin) {
                        $leftjoin->on('tb_transection.user_code', '=', 'tb_date_dev.user_code')
                            ->on('tb_transection.mistake_code', '=', 'tb_date_dev.mistake_code');
                    })
                    ->where('tb_date_dev.user_code', '=', $input['user_code'])
                    ->where('tb_date_dev.mistake_code', '=', $input['mistake_code'])
                    ->where('tb_transection.type_warning', '=', '2')
                    ->where('tb_transection.flag_comfirm', '=', 'Y');
                $data2->whereDate('user_date', '>=', $st_dev)->whereDate('user_date', '<=', $en_dev);


                $data = $data2->count();
            }
        }


        /*
        $data = DB::select( DB::raw("select COUNT(A.user_code) AS total
from tb_transection A
LEFT JOIN tb_date_dev B on A.user_code = B.user_code AND A.mistake_code = B.mistake_code
WHERE A.user_code = '$user_code' AND A.mistake_code ='$mistake_t' AND A.type_warning = '2'
AND NOW() >= '$st_dev' AND NOW() <='$en_dev'")

        );




    dd($data);

*/
        /*<--- เงื่อนไข ใบเตือน  */
        if ($type_warning_t == 3) {

            /*mistake_V เช็ค ค่า flag ใบเตือน  edit by rkknoob*/
            $mistake_V = DB::table('tb_mistake')
                ->where('mistake_code', '=', $input['mistake_code'])
                ->value('warning_flag');


            $year_check = Carbon::now()->addYear()->format('Y-m-d');


            if (($st_dev == NULL) && ($en_dev == NULL)) {
                DB::insert('insert into tb_date_dev (user_code, mistake_code, st_date_dev, en_date_dev, status) values (?, ?, ?, ?, ?)', [$input['user_code'], $input['mistake_code'], Carbon::now('Asia/Bangkok')->format('Y-m-d'), $year_check, 'N']);


            }

            $type_user = $request->input('user_code');
            $path = public_path() . '\images/' . $type_user;

            if (!file_exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }


            $extension = Input::file('path_picture')->getClientOriginalName();
            $image = Image::make(Input::file('path_picture'));

            //  $filename  = time() . '.' . $extension;
            //    dd($filename);
            $path2 = 'C:\xampp\htdocs\syp\public\images/' . $type_user . '/' . $extension;


            if ($image->width() > 500) {

                // resize the image to a width of 300 and constrain aspect ratio (auto height)
                $image->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            if ($image->height() > 500) {

                // resize the image to a height of 200 and constrain aspect ratio (auto width)
                $image->resize(null, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });

            }

            $image->save($path2);

            $request->request->add(['path_picture_Serv' => $path2]);
            $input = $request->all();


            $item_create = tb_transection::create($input);

            $item_create->id;
            $id = $item_create->id;

            return redirect()->action('workdailyController@show', $id);


            /*<--- เงื่อนไข Dev  */
        } else if ($type_warning_t == 2) {
            //---------------------------------------------------------------------------------------

            //---------------------------------------------------------------------------------------


            /*<---  ช่วง Insert ลง  */

            $type_user = $request->input('user_code');
            $D_devolop_txt = (int)$request->input('D_devolop');

            /*<-- หาค่า max ของแต่ละประเภท  ภายในปีนั้นๆ -->*/
            $max_devolop_t = DB::table('tb_transection')
                ->leftjoin('tb_date_dev', 'tb_transection.user_code', '=', 'tb_date_dev.user_code')
                ->where('user_code', '=', $input['user_code'])
                ->where('mistake_code', '=', $input['mistake_code'])
                ->where('type_warning', '=', '2')
                ->where('flag_comfirm', '=', 'Y');


            $max_devolop_t->whereDate('user_date', '>=', $st_dev)->whereDate('user_date', '<=', $en_dev);


            $max_devolop = $data2->max('D_devolop');


            if ($max_devolop == Null) {

                $max_devolop = 0;
            }
            if($max_devolop > $D_devolop_txt ) {


                Session::flash('message', "ข้อมูลนี้อยู่ในระดับที่ต่ำกว่า");
                return Redirect::back();


            }


            if ($max_devolop == $D_devolop_txt) {


                Session::flash('message', "ข้อมูลนี้เคยได้รับแล้ว");
                return Redirect::back();


            }
            if (($max_devolop >= $check_mis) && ($D_devolop_txt != 9) && ($D_devolop_txt != 10) && ($D_devolop_txt != 11)) {


                Session::flash('message', "กรุณาเลือกระดับที่อยู่ในเงื่อนไข");
                return Redirect::back();

            }


            if (($D_devolop_txt > $check_mis) && ($D_devolop_txt != 9) && ($D_devolop_txt != 10) && ($D_devolop_txt != 11)) {


                Session::flash('message', "กรุณาใส่เงื่อนไขตามที่กำหนด");
                return Redirect::back();
            }


            $path = public_path() . '\images/' . $type_user;

            if (!file_exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }


            if (Input::hasFile('path_picture')) {

                $extension = Input::file('path_picture')->getClientOriginalName();

                $image = Image::make(Input::file('path_picture'));


                $filename = time();
                //    dd($filename);
                $path2 = 'C:\xampp\htdocs\syp\public\images/' . $type_user . '/' . $filename . $extension;


                if ($image->width() > 500) {

                    // resize the image to a width of 300 and constrain aspect ratio (auto height)
                    $image->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }

                if ($image->height() > 500) {

                    // resize the image to a height of 200 and constrain aspect ratio (auto width)
                    $image->resize(null, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                }

                $image->save($path2);
                $request->request->add(['path_picture_Serv' => $path2]);
            }


            $input = $request->all();

            /*<---  ช่วง Insert ลง  */
            $item_create = tb_transection::create($input);
            $item_create->id;
            $id = $item_create->id;

            //   return \Redirect::route('/devo/show/');
            //  return redirect()->route('books');
            return redirect()->action('workdailyController@show', $id);
            // return Route('devo', ['user_code' => $input['user_code']]);
            ////        return view('Viewform.view')->with('view_report', $view_report);

        } else if ($type_warning_t == 1) {


            $type_user = $request->input('user_code');


            $path = public_path() . '\images/' . $type_user;

            if (!file_exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            if (Input::hasFile('path_picture')) {

                $extension = Input::file('path_picture')->getClientOriginalName();

                $image = Image::make(Input::file('path_picture'));


                $filename = time();
                //    dd($filename);
                $path2 = 'C:\xampp\htdocs\syp\public\images/' . $type_user . '/' . $filename . $extension;


                if ($image->width() > 500) {

                    // resize the image to a width of 300 and constrain aspect ratio (auto height)
                    $image->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }

                if ($image->height() > 500) {

                    // resize the image to a height of 200 and constrain aspect ratio (auto width)
                    $image->resize(null, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                }

                $image->save($path2);
                $request->request->add(['path_picture_Serv' => $path2]);
            }


            $input = $request->all();


            $item_create = tb_transection::create($input);
            $item_create->id;
            $id = $item_create->id;


            return redirect()->action('workdailyController@show', $id);


        } else if ($type_warning_t == '')
            Alert::error('กรุณาเลือกประเภท');
        return back()->withInput();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $input = DB::table('tb_transection')->where('No', '=', $id)->get();


        $datatamp = DB::table('tb_transection')->where('No', '=', $id)->value('id_temp');


        $mistake_t = DB::table('tb_transection')->where('No', '=', $id)->value('mistake_code');
        $mistake_type = DB::table('tb_transection')->where('No', '=', $id)->value('mistake_type');

        $user_code = DB::table('tb_transection')->where('No', '=', $id)->value('user_code');
        $type_warning_t = DB::table('tb_transection')->where('No', '=', $id)->value('type_warning');
        $no_t = DB::table('tb_transection')->where('No', '=', $id)->value('No');

        $data_devo = DB::table('tb_transection')->where('No', '=', $id)->value('D_devolop');


        $date_datatemp = DB::table('tb_transection')
            ->join('datatemp', 'tb_transection.id_temp', '=', 'datatemp.id')
            ->where('No','=',$id)
            ->select('datatemp.date_work','datatemp.id')
            ->value('datatemp.date_work');





        /*แสดงค่าข้อมูลหลังจาก input แรก  edit by rkknoob*/
        $view_report = DB::select( DB::raw("select * from (Select 
  A.user_code
, CONCAT(' ', A.fname,' ',A.lname) AS zName
,A.signatures AS head1
, A.department
, B.type_warning
, count(*)
, max(B.user_date ) as Last_date
, max(B.path_picture_Serv)  as Last_picture
, max(B.no)  as last_no 
, count(*) as sumt
, max(B.D_devolop) as D_devolop
,A.code_id
,B.mistake_code
,A.position
,case when max(B.D_devolop) ='1' Then 'D1' 
when max(B.D_devolop) ='2' Then 'D2'
when max(B.D_devolop) ='3' Then 'D3' 
when max(B.D_devolop) ='4' Then 'D4' 
when max(B.D_devolop) ='5' Then 'D5' 
when max(B.D_devolop) ='6' Then 'D6'
when max(B.D_devolop) ='7' Then 'D7' 
when max(B.D_devolop) ='8' Then 'D8' 
when max(B.D_devolop) ='9' Then 'V' 
when max(B.D_devolop) ='10' Then 'W' 
when max(B.D_devolop) ='11' Then 'TM' END as test

 from users A
 left join tb_transection B on A.user_code = B.user_code
 left join tb_date_dev D On A.user_code = D.user_code And B.mistake_code = D.mistake_code
left join tb_mistake_basic E On A.user_code = B.user_code
where A.user_code= '$user_code'
 and  B.type_warning = '$type_warning_t'
 and  B.mistake_code = '$mistake_t'

 and  B.user_date  between (case when B.type_warning ='1' Then '1900-01-01' Else D.st_date_dev end) 
                   and     (case when B.type_warning ='1' Then '2500-01-01' Else D.en_date_dev end) 

group by A.user_code,A.`name_et`,A.fname,A.lname,A.department,B.type_warning,A.signatures,A.code_id,B.mistake_code,A.position) A LEFT JOIN 
(select A.No,A.timlength,A.devolop_plan,A.description,A.date_review,A.mistake_type,B.mistake_description from tb_transection A
LEFT JOIN tb_mistake_type B on A.mistake_code = B.mistake_code where No = $id AND B.mistake_type = $mistake_type ) B on A.last_no = B.No


")

        );

        $mistake_basic = DB::select( DB::raw("Select * from tb_mistake_basic WHERE mistake_code = $mistake_t")

        );


        $data_count = DB::select( DB::raw("SELECT COUNT(user_code) as count_user from tb_transection
where user_code = '$user_code'
AND type_warning = '1'
AND mistake_code = '$mistake_t'

"));

        $mistake_t_show_form = DB::table('tb_mistake')->where('mistake_code', '=', $mistake_t)->get();

        if($data_devo <= 8){

            return view ('Viewform.view_dailyday')->with('view_report', $view_report)->with('id', $id)->with('mistake_basic',$mistake_basic)->with('datatamp',$datatamp)->with('data_count',$data_count)->with('mistake_t_show_form',$mistake_t_show_form)->with('data_devo',$data_devo)->with('date_datatemp',$date_datatemp);

        } else if($data_devo > 8 ){


            return view ('Viewform.warning_dailyday')->with('view_report', $view_report)->with('id', $id);
        }
        else {

            return '1';
        }



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

    public function seach(Request $request)
    {

        $input = $request->all();

        $work_daily = DB::table('datatemp')
            ->join('users', 'datatemp.user_code', '=', 'users.user_code')
            ->join('tb_mistake', 'tb_mistake.mistake_code', '=', 'datatemp.mistake_code')
            ->where('flag_con','=','N')
            ->where('users.user_code','=',$input)
            ->select('tb_mistake.description_mistake','datatemp.id','datatemp.user_code','datatemp.mistake_code','datatemp.date_work','users.department','datatemp.detail','users.fname','users.lname')->get();



        return view('workdaily.showlist', ['work_daily' => $work_daily]);
    }
}
