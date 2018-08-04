<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\datatemp;
use DB;
use File;
use Carbon;
use Validator;
use Illuminate\Support\Facades\Redirect;
use alert;
use Auth;
use App\User;

use DateTime;
use App\daily_load;



class UploadController extends Controller
{
    public function index()
    {

        $upload = DB::table('date_upload')->orderBy('DOCUMENT_NO', 'desc')->get();
        return view('admin/upload.upload',['upload' => $upload]);
    }

    public function importFileIntoDB(Request $request){


        $user = Auth::user()->user_code;
        $time =Carbon\Carbon::now('Asia/Bangkok')->format('Y-m-d');

        $checkdel = DB::table('date_upload')->where('DOCUMENT_DATE', '=', $time)->value('CHECK_DELETE');

        if (($checkdel == '') || ($checkdel == null)) {


            $mx = DB::table('date_upload')->max('DOCUMENT_NO');

            if ($mx == null) {
                $mx = 1;
            } Else {
                $mx = $mx + 1;
            }


            if($request->hasFile('sample_file')){

                $extension = File::extension($request->sample_file->getClientOriginalName());


                if ($extension == 'xlsx'){

                    $path = $request->file('sample_file')->getRealPath();

                    $data = Excel::load($path, function($reader) {})->get();



                    if(!empty($data) && $data->count()){


                        foreach ($data->toArray() as $key => $value) {


                            if(!empty($value)){




                                try{
                                    foreach ($value as $v) {
                                        $insert[] = ['date_work' => $v['date_work'], 'user_code' => $v['user_code'],  'detail' => $v['detail'], 'mistake_code' => $v['mistake_code'], 'flag_con' => 'N','date_upload' => $time];
                                    }


                                    DB::table('date_upload')->insert(
                                        ['DOCUMENT_NO' => $mx, 'DOCUMENT_DATE' => $time, 'USER_ID' => $user, 'CHECK_DELETE' => 'N']

                                    );

                                } catch (\Exception $e){
                                    return redirect()->back()->with('alert', 'Upload ข้อมูลไม่สำเร็จ!');
                                }


                                if(!empty($insert)){
                                    datatemp::insert($insert);
                                    return view ('home');
                                }

                            }else {

                                return redirect()->back()->with('alert', 'Upload ข้อมูลไม่สำเร็จ!');

                            }
                        }


                    }

                }else {

                    return redirect()->back()->with('alert', 'กรุณา Upload ไฟล์ ประเภท xlsx!');

                }





            }


            return redirect()->back()->with('alert', 'กรุณาเลือกไฟล์ Upload');




        } else if ($checkdel == 'N'){

            DB::table('datatemp')->where('date_upload', '=', $time)->delete();


            if($request->hasFile('sample_file')){

                $extension = File::extension($request->sample_file->getClientOriginalName());


                if ($extension == 'xlsx'){

                    $path = $request->file('sample_file')->getRealPath();

                    $data = Excel::load($path, function($reader) {})->get();



                    if(!empty($data) && $data->count()){


                        foreach ($data->toArray() as $key => $value) {


                            if(!empty($value)){




                                try{
                                    foreach ($value as $v) {
                                        $insert[] = ['date_work' => $v['date_work'], 'user_code' => $v['user_code'],  'detail' => $v['detail'], 'mistake_code' => $v['mistake_code'], 'flag_con' => 'N','date_upload' => $time];
                                    }




                                } catch (\Exception $e){
                                    return redirect()->back()->with('alert', 'Upload ข้อมูลไม่สำเร็จ!');
                                }


                                if(!empty($insert)){
                                    datatemp::insert($insert);
                                    return view ('home');
                                }

                            }else {

                                return redirect()->back()->with('alert', 'Upload ข้อมูลไม่สำเร็จ!');

                            }
                        }


                    }

                }else {

                    return redirect()->back()->with('alert', 'กรุณา Upload ไฟล์ ประเภท xlsx!');

                }





            }


            return redirect()->back()->with('alert', 'กรุณาเลือกไฟล์ Upload');


        }else{

            return redirect()->back()->with('alert', 'ไม่สามารถupload ได้เนื่องจากมีการแก้ไขข้อมูลแล้ว');

        }

    }

    public function delete(Request $document_no)
    {


    }

    public function index_upload()
    {


        return view('admin/upload.index');
    }

    public function index_user()
    {

        return view('admin/upload.upload_user');

    }

    public function importFileIntoDB_user(Request $request)
    {

        if($request->hasFile('sample_file')){

            $extension = File::extension($request->sample_file->getClientOriginalName());


            if ($extension == 'xlsx'){

                $path = $request->file('sample_file')->getRealPath();

                $data = Excel::load($path, function($reader) {})->get();


                if(!empty($data) && $data->count()){


                    foreach ($data->toArray() as $key => $value) {


                        if(!empty($value)){




                            try{
                                foreach ($value as $v) {
                                    $insert[] = ['user_code' => $v['user_code'],'name_et' => '','fname' => $v['fname'],'lname' => $v['lname'],'name_e' => '','fname_e' => $v['fname_e'],'lname_e' => $v['lname_e'],'level' => '1','status' => 'Y','position' => $v['position'],'department' => $v['department'],'code_id' => $v['code_id'],'name' => '','email' => '','password' => '$2y$10$TjNX.oJQ/Le7IBAUinWtCup72PfbYTJxHA.cEFkMlgk8MSvJ3pDA2','remember_token' => '','created_at' => NOW()];
                                }



                            } catch (\Exception $e){
                                return redirect()->back()->with('alert', 'Upload ข้อมูลไม่สำเร็จ!');
                            }


                            if(!empty($insert)){
                                User::insert($insert);
                                return view ('home');
                            }

                        }else {

                            return redirect()->back()->with('alert', 'Upload ข้อมูลไม่สำเร็จ!');

                        }
                    }


                }

            }else {

                return redirect()->back()->with('alert', 'กรุณา Upload ไฟล์ ประเภท xlsx!');

            }





        }


        return redirect()->back()->with('alert', 'กรุณาเลือกไฟล์ Upload');



    }

    public function plantrunk()
    {


        return view('admin/upload.upload_trunk');
    }


    public function importFileIntoDB_plan_daily(Request $request)
    {

        if($request->hasFile('sample_file')){

            $extension = File::extension($request->sample_file->getClientOriginalName());


            if ($extension == 'xlsx'){

                $path = $request->file('sample_file')->getRealPath();

                $data = Excel::load($path, function($reader) {})->get();


                if(!empty($data) && $data->count()){


                    foreach ($data->toArray() as $key => $value) {


                        if(!empty($value)){




                            try{
                                foreach ($value as $v) {
                                    $insert[] = ['trin' => $v['trin'], 'trailer_no' => $v['trailer_no'],'arrivestore' => $v['arrivestore'],'day_upload' => $v['day_upload'],'status_trunk' => 'N','type_load' => $v['type_load']];
                                }



                            } catch (\Exception $e){
                                return redirect()->back()->with('alert', 'Upload ข้อมูลไม่สำเร็จ!');
                            }


                            if(!empty($insert)){
                                daily_load::insert($insert);
                                return view ('home');
                            }

                        }else {

                            return redirect()->back()->with('alert', 'Upload ข้อมูลไม่สำเร็จ!');

                        }
                    }


                }

            }else {

                return redirect()->back()->with('alert', 'กรุณา Upload ไฟล์ ประเภท xlsx!');

            }





        }


        return redirect()->back()->with('alert', 'กรุณาเลือกไฟล์ Upload');



    }






}
