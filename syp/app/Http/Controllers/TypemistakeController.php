<?php

namespace App\Http\Controllers;

use App\tb_mistake;
use Illuminate\Http\Request;
use DB;

class TypemistakeController extends Controller
{
    public function index(Request $request){

        $tb_mistake_sum = DB::table('tb_mistake')->get();



        //return view('admin.typemistake')->with('items' => $items);

          return view('admin.typemistakeindex')->with('tb_mistake_sum', $tb_mistake_sum);


    }



    public function create(Request $request){

      //  $order = DB::table('tb_mistake')->where('mistake_code', DB::raw("(select max(`mistake_code`) from tb_mistake)"))->value('mistake_code');
        $order = DB::table('tb_mistake')->count();

        $mistakemax = $order+1;




        //return view('admin.typemistake')->with('items' => $items);
        return view('admin.typemistake')->with(compact('mistakemax'));


    }


    public function store(Request $request){



       $input = $request->all();

      //  $insert = DB::table('tb_mistake')->insert($data);

        $item_create = tb_mistake::create($input);
        return redirect('admin/typemistakeindex');

    }



    public function destroy($mistake_code)
    {




        $item_delete = DB::select( DB::raw("DELETE FROM tb_mistake
WHERE mistake_code = $mistake_code"));

        return $mistake_code;
    }


    public function update($mistake_code)
    {



        $items = DB::select( DB::raw("select * from tb_mistake where mistake_code = '$mistake_code'")

        );

        $department = DB::select( DB::raw("select DISTINCT group_department from tb_mistake WHERE IFNULL(group_department, '') != '' "));



        return view('admin.typemistakeedit')->with('items',$items)->with('department',$department);



    }

    public function updated(Request $request,$mistake_code)
    {
        $input = $request->all();

        $item_find = DB::table('tb_mistake')->where('mistake_code','=',$mistake_code);


        DB::table('tb_mistake')
            ->where('mistake_code', $request['mistake_code'])
            ->update(['mistake_code' =>$request['mistake_code'],
                'cnt_alert' =>$request['cnt_alert'],
                'description_mistake' =>$request['description_mistake'],
                'group_department' =>$request['group_department'],




            ]);



        return redirect('admin/typemistakeindex');

    }


}
