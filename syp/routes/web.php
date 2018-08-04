<?php

Route::get('/', function () {
    return view('auth.login');
});

Route::group(
    ['middleware'=>['Profile']],function (){
    Route::get('/profile', 'ProfileController@edit')->name('profile_user');
    Route::POST('/profile/updated','ProfileController@updated');

});

Route::group(
    ['middleware'=>['admin','checkstatus']],function (){

    Route::get('/count', 'Countcontroller@index')->name('count.index');
    Route::get('/count/borrow', 'Countcontroller@index')->name('count.borrow');
    Route::get('/count/receive', 'Countcontroller@reci')->name('count.reci');
    Route::get('/count/update/borrow/', 'Countcontroller@insert');
    Route::get('/count/update/receive/', 'Countcontroller@insert2');

    Route::get('/count/data', 'Countcontroller@data')->name('count.data');
    Route::get('/count/update/data/', 'Countcontroller@data_round2');

    Route::get('/count/borrow2', 'Countcontroller@index2')->name('count.borrow2');
    Route::get('/count/receive2', 'Countcontroller@reci2')->name('count.reci2');
    Route::get('/count/update/borrow2/', 'Countcontroller@insert3');
    Route::get('/count/update/receive2/', 'Countcontroller@insert4');



    Route::get('report/count1/', 'DatatempController@report_count1')->name('report.report_count1');
    Route::get('report/count2/', 'DatatempController@report_count2')->name('report.report_count2');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/test', 'datatempController@Charts')->name('test');

    Route::get('/find_user', 'FindidController@index')->name('find_user.index');



//Route::get('/user_login/update/{id}','UserloginController@update')->name('user_login.update');

    Route::post('/user_login/create','UserController@create');


    Route::get('/devo/','DevoController@test')->name('devo');
    Route::POST('/devo/create/','DevoController@create')->name('devo.create');
    Route::POST('/devo/updated/','DevoController@updated');
    Route::get('/devo/showlist','DevoController@showlist');

    Route::get('/devo/showalert','DevoController@showalert');

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );
    Route::get('/doc_warning/','WarnningControllor@index')->name('doc_warning.index');
    Route::get('/doc_warning/update_doc/','WarnningControllor@update_doc');
    Route::get('/Document/{id}','DevoController@show');
    Route::any('books', 'ViewformController@index');
    Route::get('report', 'ReportController@index')->name('report.index');
    Route::get('report/week/', 'ReportController@week')->name('report.week');

    Route::get('report/Person/', 'ReportController@person')->name('report.person');
    Route::get('report/Person/show', 'ReportController@PersonalShow');

    Route::get('BBS/index/', 'BBSController@index')->name('BBS.index');
    Route::POST('BBS/index/create', 'BBSController@create');
    Route::get('BBS/Report/', 'BBSController@Report')->name('report.bbs');
    Route::get('BBS/Report/query', 'BBSController@query');
    Route::get('Datatemp/Report/not_clear', 'DatatempController@Report_not_clear')->name('report.datatemp_notclear');


    Route::get('viewback', 'viewbackController@index')->name('viewback.index');


    Route::get('viewback/pdfreport/{user_code}/{last_no}/{Divi}/{mistake_code}/{type_warning}', 'viewbackController@pdfreport')->name('viewback.bookpdf');


    Route::get('viewback/show', 'viewbackController@show')->name('viewback.show');


    Route::get('/admin', 'adminController@index')->name('admin.index');


    Route::GET('/workdaily', 'workdailyController@index')->name('workdaily.index');
    Route::GET('/workdaily/show/', 'workdailyController@seach')->name('workdaily.seach');


    Route::GET('/workdaily/create/{mistake_code}/{user_code}/{id_temp}', 'workdailyController@create')->name('workdaily.create');

    // Route::POST('/workdaily/store', 'workdailyController@store');
    Route::POST('/workdaily/store/','workdailyController@store')->name('warning.store');
    Route::any('/dailyday/{id}','workdailyController@show');

    Route::get('coach/','DevoController@coach')->name('coach.coach');

    Route::get('coach2/','DevoController@coach2')->name('coach.coach');

    Route::get('daily_load/index/', 'daily_loadController@index')->name('daily_load.index');
    Route::get('daily_load/index/trunk', 'daily_loadController@trunk')->name('daily_load.trunking');
    //Route::get('daily_load/index/trunk/update','daily_loadController@update_trunk');
    Route::get('/daily_load/index/trunk/update','daily_loadController@updated_trunk')->name('daily_load.updated_trunk');


    Route::get('daily_load/index/receive', 'daily_loadController@receive')->name('daily_load.receive');
    Route::get('/daily_load/index/receive/update','daily_loadController@updated_receive')->name('daily_load.updated_receive');
    Route::get('/daily_load/index/transport/update','daily_loadController@updated_transport')->name('daily_load.updated_transport');
    Route::get('daily_load/index/created', 'daily_loadController@created')->name('daily_load.created');
    Route::get('daily_load/index/createdd', 'daily_loadController@createdd');



    Route::get('daily_load/index/transport', 'daily_loadController@transport')->name('daily_load.transport');


    Route::get('daily_load/index/Summary', 'daily_loadController@Summary')->name('daily_load.Summary');



});


Auth::routes();

Route::group(
    ['middleware'=>['auth','checkstatus']],function (){
    Route::get('/view_user_user', 'view_user_userController@index')->name('view_user2');
    Route::get('/user', 'HomeController@test')->name('user');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

});




Route::get('/ajax-subcat',function (){

    $mistake_code_t = Input::get('mistake_code');
    $user_code_t = Input::get('user_code');
    // $test = DB::table('tb_transection')->where('mistake_code', '=', $mistake_code_t)->get();

    $st_dev = DB::table('tb_date_dev')
        ->where('user_code' ,'=', $user_code_t)
        ->where('mistake_code' ,'=', $mistake_code_t)
        ->value('st_date_dev');
    /*<---  แสดงวค่า เวลา en_dev */
    $en_dev = DB::table('tb_date_dev')
        ->where('user_code' ,'=',  $user_code_t)
        ->where('mistake_code' ,'=', $mistake_code_t)
        ->value('en_date_dev');

    $test = DB::select( DB::raw("select 
A.user_code,A.mistake_code,C.description_mistake,B.st_date_dev,D.fname,D.lname,B.en_date_dev,


DATE_FORMAT(DATE_ADD(B.en_date_dev, INTERVAL 543 YEAR),'%d/%m/%Y') AS en_date_dev2,

case when A.type_warning ='1' Then 'สอนงาน' 
when A.type_warning ='2' Then 'แผนพัฒนา/ใบเตือน' 
when A.type_warning ='3' Then 'ใบเตือน' END as type_warning


,

case when D_devolop ='1' Then 'D1' 
when D_devolop ='2' Then 'D2'
when D_devolop ='3' Then 'D3' 
when D_devolop ='4' Then 'D4' 
when D_devolop ='5' Then 'D5' 
when D_devolop ='6' Then 'D6'
when D_devolop ='7' Then 'D7' 
when D_devolop ='8' Then 'D8' 
when D_devolop ='9' Then 'V' 
when D_devolop ='10' Then 'W' 
when D_devolop ='11' Then 'TM' END as D_devolop
,
user_date,user_login
, (
   select COUNT(*) as SumCoaching from tb_transection WHERE user_code = '$user_code_t'
   AND type_warning = '1' AND mistake_code = '$mistake_code_t'
  ) As SumCoaching
 
FROM tb_transection A
left JOIN tb_date_dev B on A.user_code = B.user_code 
AND A.mistake_code = B.mistake_code
LEFT JOIN tb_mistake C on A.mistake_code = C.mistake_code 
LEFT JOIN users D on A.user_login = D.user_code
WHERE A.user_code = '$user_code_t' 
AND A.flag_comfirm = 'Y'
AND A.mistake_code = '$mistake_code_t' 
AND user_date >= '$st_dev' AND user_date <= '$en_dev'
AND NOW() BETWEEN '$st_dev' AND '$en_dev'
AND type_warning = '2'
ORDER BY user_date DESC

")  );







    return Response::json($test);





});

Route::POST('/ajax-subcat2',function (){

    $flag_comfirm = 'Y';
    $id2 = Input::get('id2');
    $input = Input::get('imgBase64');
    $suggestion = Input::get('suggestion');
    $id_temp = Input::get('id_temp');




    $datatemp_select = DB::table('datatemp')
        ->where('id', '=', $id_temp)
        ->value('flag_con');


    if($datatemp_select == 'Y'){

        $test = 2;



        return Response::json($test);


    }else{

        $mistake_code_t = Input::get('mistake_code');
        $user_code_t = Input::get('user_code');




        DB::table('datatemp')
            ->where('id','=',$id_temp)
            ->update(['flag_con'=>'Y']);

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





});


Route::get('/ajax-subcat3',function (){



    $mistake_code_t = Input::get('mistake_code');
    $user_code_t = Input::get('user_code');
    // $test = DB::table('tb_transection')->where('mistake_code', '=', $mistake_code_t)->get();



    $data_count = DB::select( DB::raw("SELECT COUNT(user_code) as count_user from tb_transection
where user_code = '$user_code_t'
AND type_warning = '1'
AND mistake_code = '$mistake_code_t'

"));
    //ใช้นนี้นะ
    foreach ($data_count as $user) {
        echo $user->count_user;
    }




});



Route::get('/ajax-subcat4',function (){



    $mistake_code_t = Input::get('mistake_code');
    // $user_code_t = Input::get('user_code');
    // $test = DB::table('tb_transection')->where('mistake_code', '=', $mistake_code_t)->get();




    $data_count = DB::select( DB::raw("SELECT mistake_description from tb_mistake_type
where mistake_code = '$mistake_code_t'
"));
    //ใช้นนี้นะ

    // return json_encode($data_count);
    return Response::json($data_count);
});


Route::POST('/ajax-subcat5','viewbackController@pdfwarning');

Route::POST('/ajax-subcat5',function (){

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


});


Route::get('/ajax-subcat6',function (){



    $mistake_code_t = Input::get('mistake_code');
    $user_code_t = Input::get('user_code');




    DB::statement(DB::raw('set @row=0'));
    $users = DB::select( DB::raw("select @row:=@row+1 as row,A.user_code,B.fname,B.lname,mistake_code,A.user_login,C.fname AS user_loginf,C.lname as user_loginl from tb_transection A 
LEFT JOIN  users B on B.user_code = A.user_code
LEFT JOIN	users C on A.user_login = C.user_code




WHERE A.user_code = '$user_code_t' AND A.type_warning = '1' AND mistake_code ='01' AND flag_comfirm ='Y'"));

    //return $users['user_code'];
    return Response::json($user_code_t);


});




Route::GET('/excel',function (){








});

Route::POST('/devo/update/','DevoController@update');


//Route::get('/view_user', 'view_userController@index')->name('view_user');




//Route::get('/view_user', 'view_userController@index')->name('view_user');
Route::get('sendemail', 'MailController@sendemail');
Route::get('/test/pdf/{Desc1}/{Divi}', 'TestController@index');

Route::get('/test/pdf/admin/{Desc1}/{Divi}/{input}', 'viewbackController@index2');
Route::get('/test/pdf/admin/report/{No}/', 'ReportController@pdf');

Route::get('/warnning/pdf/{user_code}/{mistake_code}/{D_devolop}/{lastno}', 'TestController@warning')->name('Viewform.warning');






//Route::get('myform/ajax/{id}',('HomeController@myformAjax'));

Route::get('myform/ajax/{id}',array('as'=>'devo.ajax','uses'=>'HomeController@devo'));

Route::get('/document/read', 'documentController@show')->name('document.readdocment');


Route::group(
    ['middleware'=>['admin_master']],function (){

    Route::get('/admin/type_miskate_master', 'Type_mistake_masterController@index')->name('admin/type_mistake_master.datamaster');

    Route::get('/admin/transection', 'TransectionController@index')->name('admin/transection.index');
    Route::get('/admin/transection/inde_main', 'TransectionController@index_main')->name('admin/transection.index_main');
    Route::get('/admin/transection/datatemp/index', 'DatatempController@index')->name('admin/transection.datatamp_index');
    Route::get('/admin/transection/datatemp/index/update', 'DatatempController@deleteAll');
    Route::get('/admin/transection/datatemp/index/insert', 'DatatempController@insert');
    Route::post('/admin/transection/datatemp/index/insert', ['as'=>'/admin/transection/datatemp/index/insert','uses'=>'DatatempController@insert']);
    Route::get('/admin/transection/datatemp/index/edit', 'DatatempController@edit');

    Route::get('/admin/transection/transection/index/', 'TransectionController@index')->name('transection_index');




    Route::get('/admin/transection/datamaster/index', 'TransectionController@index_datamaster')->name('admin/transection.transection_index');
    Route::get('/admin/transection/transection/index/{id}/edit', 'TransectionController@edit')->name('admin/transection.transection_index.edit');
    Route::PUT('/admin/transection/transection/index/update', 'TransectionController@update')->name('admin/transection.transection.update');




    Route::get('/admin/typemistakeindex', 'TypemistakeController@index')->name('admin.typemistakeindex');
    Route::get('/admin/typemistake/create', 'TypemistakeController@create')->name('admin.typemistake');
    // Route::post('/admin/typemistake/create2', 'TypemistakeController@create2')->name('admin.typemistake');





    Route::get('/admin/type_mistake_des', 'Type_mistake_t1Controller@index')->name('admin/type_mistake_des.type_mistake');

    Route::post('/admin/typemistake','TypemistakeController@store')->name('typemistake.store');
    Route::get('/admin/typemistake/{mistake_code}','TypemistakeController@destroy')->name('typemistakeindex.destroy');

    Route::get('/admin/update/{mistake_code}','TypemistakeController@update')->name('typemistakeedit.update');
    Route::PUT('/admin/updated/{mistake_code}','TypemistakeController@updated')->name('typemistakeedit.updated');

    Route::get('/user_login','UserController@index')->name('user_login.index');
    Route::get('/user_login/update/{id}','UserController@update')->name('user_login.update');
    Route::post('/user_login/updated','UserController@updated')->name('user_login.updated');


    Route::get('/upload', 'UploadController@index_upload')->name('admin/upload.index');

    Route::get('/upload/datatemp', 'UploadController@index')->name('admin/upload.upload');
    Route::get('/upload/upload_user', 'UploadController@index_user')->name('admin/upload.upload_user');
    Route::get('/upload/plan_trunk', 'UploadController@plantrunk')->name('admin/upload.upload_trunk');
    Route::post('import-csv-excel/user',array('as'=>'import-csv-excel/user','uses'=>'UploadController@importFileIntoDB_user'));
    Route::post('import-csv-excel',array('as'=>'import-csv-excel','uses'=>'UploadController@importFileIntoDB'));
    Route::post('import-csv-excel/plan_daily',array('as'=>'import-csv-excel/plan_daily','uses'=>'UploadController@importFileIntoDB_plan_daily'));




    Route::get('download-excel-file/{type}', array('as'=>'excel-file','uses'=>'UploadController@downloadExcelFile'));
    Route::get('import-export-csv-excel',array('as'=>'excel.import','uses'=>'UploadController@importExportExcelORCSV'));
    Route::any('/upload/{document_no}', 'UploadController@stop')->name('upload.stop');

    Route::get('/upload/delete/{DOCUMENT_NO}', 'UploadController@delete');






    /*
     * จัดการเอกสาร
     *
     * */


    Route::get('/admin/categorie', 'ContentController@index')->name('admin/categorie.mainpage');
    Route::get('/admin/categorie/create', 'ContentController@create')->name('admin/categorie.newdata');
    Route::post('/admin/categorie/store','ContentController@store')->name('admin/categorie.store');
    Route::get('/admin/categorie/del/', 'ContentController@destroy')->name('admin/categorie.destroy');




    Route::get('/admin/categorie/document', 'documentController@index')->name('admin/categorie/document.maindoc');

    Route::get('/admin/categorie/document/create', 'documentController@create')->name('admin/categorie/document.newdata');
    Route::post('/admin/categorie/document/store', 'documentController@store')->name('admin/categorie/document.store');








});