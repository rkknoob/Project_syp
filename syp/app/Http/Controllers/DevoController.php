<?php

namespace App\Http\Controllers;

use App\tb_date_dev;
use App\tb_mistake;
use App\tb_transection;
use App\tb_mistake_basic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
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
use Hash;
use Response;


class DevoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index2(Request $request)
    {
        $user = $request->imgBase64();






        return $user;


    }
    public function index($user_code)
    {



        $user  = User::where('user_code','=',$user_code)->value('user_code');



        $items = tb_mistake::all(['mistake_code', 'description_mistake']);

        DB::statement(DB::raw('SET @prev=0,@row_number=0'));

        $results = DB::select( DB::raw("Select @row_number:=@row_number+1 AS num,A.* from(
select  
       A.user_code,A.mistake_code ,B.description_mistake
                       ,sum(case when A.type_warning ='1' then 1 else 0 END) AS cnt_coch
                       ,sum(case when A.type_warning ='2' then 1 else 0 END) AS cnt_dev
                       ,sum(case when A.type_warning ='3' then 1 else 0 END) AS cnt_warn  
       ,C.st_date_dev,C.en_date_dev
FROM tb_transection  A
left join TB_mistake B on A.mistake_code =  B.mistake_code
left join tb_date_dev C On A.user_code = C.user_code And A.mistake_code = C.mistake_code
where A.user_code= '$user_code'
 and  A.flag_comfirm ='Y'
 and  A.user_date  between (case when A.type_warning ='1' Then '1900-01-01' Else C.st_date_dev end) 
                   and     (case when A.type_warning ='1' Then '2500-01-01' Else C.en_date_dev end) 
group by  A.user_code,A.mistake_code,B.description_mistake,C.st_date_dev,C.en_date_dev 
 ) A order by A.mistake_code")

        );



        return view('devo', ['items' => $items, 'user' => $user,'res' => $results]);
        //      return view('find_user/index',['users' => $result, 'user1'=> $user]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {





        $carbon = Carbon::now()->format('Y-m-d H:i:s');

        $request->request->add(['user_date' => $carbon]);
        $input = $request->all();



        $type_warning_t =  $request->type_warning;
        //  $path_picture_t  = $request->file('path_picture')->getClientOriginalName();
        $mistake_t = $request->mistake_code;


        $user_code = $request->user_code;
        $time_now = Carbon::now('Asia/Bangkok')->format('Y-m-d');

        /*<---  แสดงวค่า เวลา st_dev */
        $st_dev = DB::table('tb_date_dev')
            ->where('user_code' ,'=', $input['user_code'])
            ->where('mistake_code' ,'=', $input['mistake_code'])
            ->value('st_date_dev');
        /*<---  แสดงวค่า เวลา en_dev */
        $en_dev = DB::table('tb_date_dev')
            ->where('user_code' ,'=', $input['user_code'])
            ->where('mistake_code' ,'=', $input['mistake_code'])
            ->value('en_date_dev');

        if($type_warning_t == 2) {
            /*check_first เช็คดูเวลา งานแรก ก่อน insert edit by rkknoob*/


            $check_first = DB::table('tb_date_dev')
                ->where('user_code' ,'=', $input['user_code'])
                ->where('mistake_code' ,'=', $input['mistake_code'])
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
            ->where('mistake_code' ,'=',  $input['mistake_code'])
            ->value('cnt_alert');





        /*<---  แสดงวค่า เวลา st_dev */
        $st_dev = DB::table('tb_date_dev')
            ->where('user_code' ,'=', $input['user_code'])
            ->where('mistake_code' ,'=', $input['mistake_code'])
            ->value('st_date_dev');
        /*<---  แสดงวค่า เวลา en_dev */
        $en_dev = DB::table('tb_date_dev')
            ->where('user_code' ,'=', $input['user_code'])
            ->where('mistake_code' ,'=', $input['mistake_code'])
            ->value('en_date_dev');

        /*<--- นับ ผลรวม --->*/
        if(($type_warning_t == 2) || ($type_warning_t == 3)) {

            if (($st_dev == NULL) && ($en_dev == NULL)){
                $data = 0;

            }
            else{

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
        if($type_warning_t == 3){

            /*mistake_V เช็ค ค่า flag ใบเตือน  edit by rkknoob*/
            $mistake_V = DB::table('tb_mistake')
                ->where('mistake_code' ,'=', $input['mistake_code'])
                ->value('warning_flag');


            $year_check = Carbon::now()->addYear()->format('Y-m-d');



            if (($st_dev == NULL) && ($en_dev == NULL)){
                DB::insert('insert into tb_date_dev (user_code, mistake_code, st_date_dev, en_date_dev, status) values (?, ?, ?, ?, ?)', [$input['user_code'], $input['mistake_code'], Carbon::now('Asia/Bangkok')->format('Y-m-d'), $year_check,'N']);


            }

            $type_user = $request->input('user_code');
            $path = public_path().'\images/' . $type_user;

            if (!file_exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }



            $extension = Input::file('path_picture')->getClientOriginalName();
            $image = Image::make(Input::file('path_picture'));

            //  $filename  = time() . '.' . $extension;
            //    dd($filename);
            $path2 = 'C:\xampp\htdocs\syp\public\images/' .$type_user .'/' . $extension;


            if($image->width() > 500){

                // resize the image to a width of 300 and constrain aspect ratio (auto height)
                $image->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            if($image->height() > 500){

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

            return redirect()->action('DevoController@show', $id);



            /*<--- เงื่อนไข Dev  */
        }else if($type_warning_t == 2) {
            //---------------------------------------------------------------------------------------

            //---------------------------------------------------------------------------------------


            /*<---  ช่วง Insert ลง  */

            $type_user = $request->input('user_code');
            $D_devolop_txt = (int)$request->input('D_devolop');

            /*<-- หาค่า max ของแต่ละประเภท  ภายในปีนั้นๆ -->*/
            $max_devolop_t = DB::table('tb_transection')
                ->leftjoin('tb_date_dev','tb_transection.user_code','=','tb_date_dev.user_code')
                ->where('user_code' ,'=', $input['user_code'])
                ->where('mistake_code' ,'=', $input['mistake_code'])
                ->where('type_warning', '=','2')
                ->where('flag_comfirm', '=', 'Y');




            $max_devolop_t->whereDate('user_date', '>=', $st_dev)->whereDate('user_date', '<=', $en_dev);


            $max_devolop = $data2->max('D_devolop');




            if($max_devolop == Null){

                $max_devolop = 0;
            }


            if($max_devolop == $D_devolop_txt ) {


                Session::flash('message', "ข้อมูลนี้เคยได้รับแล้ว");
                return Redirect::back();


            }

            if($max_devolop > $D_devolop_txt ) {


                Session::flash('message', "ข้อมูลนี้อยู่ในระดับที่ต่ำกว่า");
                return Redirect::back();


            }
            if(($max_devolop >= $check_mis) && ($D_devolop_txt != 9) && ($D_devolop_txt != 10) && ($D_devolop_txt != 11)){


                Session::flash('message', "กรุณาเลือกระดับที่อยู่ในเงื่อนไข");
                return Redirect::back();

            }



            if(($D_devolop_txt > $check_mis) && ($D_devolop_txt != 9) && ($D_devolop_txt != 10) && ($D_devolop_txt != 11)){




                Session::flash('message', "กรุณาใส่เงื่อนไขตามที่กำหนด");
                return Redirect::back();
            }






            $path = public_path().'\images/' . $type_user;

            if (!file_exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }



            if(Input::hasFile('path_picture')){

                $extension = Input::file('path_picture')->getClientOriginalName();

                $image = Image::make(Input::file('path_picture'));


                $filename  = time();
                //    dd($filename);
                $path2 = 'C:\xampp\htdocs\syp\public\images/' .$type_user .'/'.$filename  . $extension;


                if($image->width() > 500){

                    // resize the image to a width of 300 and constrain aspect ratio (auto height)
                    $image->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }

                if($image->height() > 500){

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


            $hashed_password = base64_encode($id);

            return redirect()->action('DevoController@show', $hashed_password);
            // return Route('devo', ['user_code' => $input['user_code']]);
            ////        return view('Viewform.view')->with('view_report', $view_report);

        }else if ($type_warning_t == 1){



            $type_user = $request->input('user_code');


            $path = public_path().'\images/' . $type_user;

            if (!file_exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            if(Input::hasFile('path_picture')){

                $extension = Input::file('path_picture')->getClientOriginalName();

                $image = Image::make(Input::file('path_picture'));


                $filename  = time();
                //    dd($filename);
                $path2 = 'C:\xampp\htdocs\syp\public\images/' .$type_user .'/'.$filename  . $extension;


                if($image->width() > 500){

                    // resize the image to a width of 300 and constrain aspect ratio (auto height)
                    $image->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }

                if($image->height() > 500){

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


            $hashed_password = base64_encode($id);





            return redirect()->action('DevoController@show', $hashed_password);


        }else if($type_warning_t == '')
            Alert::error('กรุณาเลือกประเภท');
        return back()->withInput();

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


    public function showlist(Request $request)
    {
        print_r($request);


        return '1';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id2)
    {

        $id =  base64_decode($id2);


        $input = DB::table('tb_transection')->where('No', '=', $id)->get();

        $datatamp = DB::table('tb_transection')->where('No', '=', $id)->value('id_temp');


        $mistake_t = DB::table('tb_transection')->where('No', '=', $id)->value('mistake_code');
        $mistake_type = DB::table('tb_transection')->where('No', '=', $id)->value('mistake_type');

        $user_code = DB::table('tb_transection')->where('No', '=', $id)->value('user_code');
        $type_warning_t = DB::table('tb_transection')->where('No', '=', $id)->value('type_warning');
        $no_t = DB::table('tb_transection')->where('No', '=', $id)->value('No');

        $data_devo = DB::table('tb_transection')->where('No', '=', $id)->value('D_devolop');



        $data_count = DB::select( DB::raw("SELECT COUNT(user_code) as count_user from tb_transection
where user_code = '$user_code'
AND type_warning = '1'
AND mistake_code = '$mistake_t'

"));

        $mistake_t_show_form = DB::table('tb_mistake')->where('mistake_code', '=', $mistake_t)->get();







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





        if($data_devo <= 8){

            return view ('Viewform.view')->with('view_report', $view_report)->with('id', $id)->with('mistake_basic',$mistake_basic)->with('datatamp',$datatamp)->with('data_count',$data_count)->with('mistake_t_show_form',$mistake_t_show_form)->with('data_devo',$data_devo);

        } else if($data_devo > 8 ){


            return view ('Viewform.warning')->with('view_report', $view_report)->with('id', $id);
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

    public function updated()
    {

    }


    public function coach(Request $request, $user_code)
    {

        $input = $request->all();
        $type_mistake_code =  $request->mistake_code;


        if($type_mistake_code == null){

            $type_mistake_code = '00';
        }

       // $user  = tb_transection::where('user_code','=',$user_code);
     //   $user = DB::table('tb_transection')->where('user_code', '=', $user_code)->where('flag_comfirm', '=','Y')->get();

        $items = tb_mistake::all(['mistake_code', 'description_mistake']);
        DB::statement(DB::raw('SET @prev=0,@row_number=0'));
        $user = DB::select( DB::raw("Select   @row_number:=@row_number+1 AS num
 , A.user_code
, CONCAT(A.`name_et`,' ', A.fname,' ',A.lname) AS zName
, A.department
, (B.user_date ) as Last_date
, (B.path_picture_Serv)  as Last_picture
, (B.no)  as last_no 
, B.type_warning
,case when B.D_devolop ='1' Then 'D1' 
when B.D_devolop ='2' Then 'D2'
when B.D_devolop ='3' Then 'D3' 
when B.D_devolop ='4' Then 'D4' 
when B.D_devolop ='5' Then 'D5' 
when B.D_devolop ='6' Then 'D6'
when B.D_devolop ='7' Then 'D7' 
when B.D_devolop ='8' Then 'D8' 
when B.D_devolop ='9' Then 'V' 
when B.D_devolop ='10' Then 'W' 
when B.D_devolop ='11' Then 'TM' END as D_devolop
, B.mistake_code
,B.user_login
, C.description_mistake as mistake_detail
 from users A
 left join tb_transection B on A.user_code = B.user_code
 left join tb_date_dev D On A.user_code = D.user_code And B.mistake_code = D.mistake_code
 left join tb_mistake C On B.mistake_code = C.mistake_code
where A.user_code = '$user_code'
and  B.type_warning ='1'
and B.mistake_code = $type_mistake_code

 and  B.user_date  between (case when B.type_warning ='1' Then '1900-01-01' Else D.st_date_dev end) 
                   and     (case when B.type_warning ='1' Then '2500-01-01' Else D.en_date_dev end) 


order by B.user_date desc,B.no desc

limit 400")
        );

       // return view('devo', ['items' => $items, 'user' => $user,'res' => $results]);
        return view ('coach',['user' =>$user,'items' =>$items,'user_code'=>$user_code]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /*ยืนยันลายเซ็น กลับ  edit by rkknoob*/
        $flag_comfirm = 'Y';
        $id2 = Input::get('id2');
        $input = Input::get('imgBase64');

        DB::table('tb_transection')
            ->where('No','=','17')
            ->update(['flag_comfirm'=>'Y']);






        return Response::json($input);


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


    public function test(Request $request)
    {


        $input = $request->all();

        $user_code = $request->input('txtname');

        $department  = User::where('user_code','=',$user_code)->value('department');



        $user  = User::where('user_code','=',$user_code)->value('user_code');

        if ($user == '' && $user == null ){

            Alert::error('ไม่พบรายชื่อนี้');

            return back()->withInput();

        } else {

            $data_user  = User::where('user_code','=',$user_code)->where('status', '=', 'Y')->get();


            $time_working = DB::select( DB::raw("SELECT TIMESTAMPDIFF(month, work_dat,now()) as 'count month'
,FLOOR(TIMESTAMPDIFF(month, work_dat,now()) /12)  as year
, mod(TIMESTAMPDIFF(month, work_dat,now()),12) as month
 
 
 FROM users WHERE user_code= '$user_code'")

            );

            if($department == 'System'){
                  $items = DB::table('tb_mistake')->where('group_department', '=', 'ALL')->orWhere('group_department','=','System')->get();
            }else if($department == 'Trunking'){
                $items = DB::table('tb_mistake')->where('group_department', '=', 'ALL')->orWhere('group_department','=','Trunking')->get();
            }else if($department == 'CS'){

                $items = DB::table('tb_mistake')->where('group_department', '=', 'ALL')->orWhere('group_department','=','CS')->get();

            }else if($department == 'Inventory'){
                $items = DB::table('tb_mistake')->where('group_department', '=', 'ALL')->orWhere('group_department','=','Inventory')->get();

            }else if($department == 'Inbound'){
                $items = DB::table('tb_mistake')->where('group_department', '=', 'ALL')->orWhere('group_department','=','Inbound')->get();

            }else if($department == 'Audit Equipment'){
                $items = DB::table('tb_mistake')->where('group_department', '=', 'ALL')->orWhere('group_department','=','Audit Equipment')->get();

            }else if($department == 'LPS'){
                $items = DB::table('tb_mistake')->where('group_department', '=', 'ALL')->orWhere('group_department','=','LPS')->get();

            }else if($department == 'Safety'){
                $items = DB::table('tb_mistake')->where('group_department', '=', 'ALL')->orWhere('group_department','=','Safety')->get();

            }else if($department == 'FM'){
                $items = DB::table('tb_mistake')->where('group_department', '=', 'ALL')->orWhere('group_department','=','FM')->get();

            }else if($department == 'HR'){
                $items = DB::table('tb_mistake')->where('group_department', '=', 'ALL')->orWhere('group_department','=','HR')->get();

            }else if($department == 'Planning & Performance'){
                $items = DB::table('tb_mistake')->where('group_department', '=', 'ALL')->orWhere('group_department','=','Planning & Performance')->get();

            }else if($department == 'BOL Audit'){
                $items = DB::table('tb_mistake')->where('group_department', '=', 'ALL')->orWhere('group_department','=','BOL Audit')->get();

            }else if($department == 'Transport'){
                $items = DB::table('tb_mistake')->where('group_department', '=', 'ALL')->orWhere('group_department','=','Transport')->get();

            }else if(($department == 'Receiving') || ($department == 'FLT Operation') || ($department == 'Picking Ambient') || ($department == 'Picking Fresh') || ($department == 'Shipping')|| ($department == 'พนักงานกรีดกล่อง')){


                $items = DB::table('tb_mistake')->where('group_department', '=', 'ALL')->orWhere('group_department','=','Receiving')->orWhere('group_department','=','FLT Operation')->orWhere('group_department','=','Picking Ambient')
                    ->orWhere('group_department','=','Picking Fresh')->orWhere('group_department','=','พนักงานกรีดกล่อง')->orWhere('group_department','=','Shipping')->get();

            }




               else {

                $items = tb_mistake::all(['mistake_code', 'description_mistake']);

            }




            DB::statement(DB::raw('SET @prev=0,@row_number=0'));

            $results = DB::select( DB::raw("Select @row_number:=@row_number+1 AS num,A.* from(
select  
       A.user_code,A.mistake_code ,B.description_mistake
                       ,sum(case when A.type_warning ='1' then 1 else 0 END) AS cnt_coch
                       ,sum(case when A.type_warning ='2' then 1 else 0 END) AS cnt_dev
                       ,sum(case when A.type_warning ='3' then 1 else 0 END) AS cnt_warn  
       ,C.st_date_dev,C.en_date_dev
FROM tb_transection  A
left join TB_mistake B on A.mistake_code =  B.mistake_code
left join tb_date_dev C On A.user_code = C.user_code And A.mistake_code = C.mistake_code
where A.user_code= '$user_code'
 and  A.flag_comfirm ='Y'
 and  A.user_date  between (case when A.type_warning ='1' Then '1900-01-01' Else C.st_date_dev end) 
                   and     (case when A.type_warning ='1' Then '2500-01-01' Else C.en_date_dev end) 
group by  A.user_code,A.mistake_code,B.description_mistake,C.st_date_dev,C.en_date_dev 
 ) A order by A.mistake_code")

            );





            return view('devo', ['items' => $items, 'user' => $user,'res' => $results,'data_user' => $data_user,'time_working' =>$time_working]);

        }

        //      return view('find_user/index',['users' => $result, 'user1'=> $user]);


    }

    public function text_test(Request $request)
    {


        $carbon = Carbon::now()->format('Y-m-d H:i:s');

        $request->request->add(['user_date' => $carbon]);
        $input = $request->all();

        $type_warning_t =  $request->type_warning;

        if ($type_warning_t == 1){

            $type_user = $request->input('user_code');



            $path = public_path().'\images/' . $type_user;

            if (!file_exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }



            $extension = Input::file('path_picture')->getClientOriginalName();

            $image = Image::make(Input::file('path_picture'));

            print_r($extension);


            $filename  = time();
            //    dd($filename);
            $path2 = 'C:\xampp\htdocs\syp\public\images/' .$type_user .'/'.$filename  . $extension;


            if($image->width() > 500){

                // resize the image to a width of 300 and constrain aspect ratio (auto height)
                $image->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            if($image->height() > 500){

                // resize the image to a height of 200 and constrain aspect ratio (auto width)
                $image->resize(null, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });

            }

            $image->save($path2);
            $request->request->add(['path_picture_Serv' => $path2]);



            $input = $request->all();


            $item_create = tb_transection::create($input);

        }


    }

    public function coach2(Request $request)
    {


        $mistake_code_t = Input::get('mistake_code');
        $user_code_t = Input::get('user_code');

     //   $users = DB::table('tb_transection')->first();


        return Response::json($user_code_t);


    }


    public function showalert(Request $request)
    {

        $mistake_code_t = Input::get('mistake_code');
        $cnt_alert  = tb_mistake::where('mistake_code','=',$mistake_code_t)->value('cnt_alert');



        return Response::json($cnt_alert);


    }



}
