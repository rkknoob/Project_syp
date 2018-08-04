<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_mistake;
use App\tb_transection;
use DB;

class TransectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/transection.index');
    }

    public function index_main()
    {
        $items = tb_mistake::all(['mistake_code', 'description_mistake']);

        return view('admin/transection.index_main',['items' => $items]);
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


      //  $data_trann = tb_transection::where('No', '=', $id)->get();


        $items = tb_mistake::all(['mistake_code', 'description_mistake']);



        $data_trann = DB::select( DB::raw("select * from tb_transection A
LEFT JOIN tb_mistake B ON A.mistake_code = B.mistake_code
Left join tb_mistake_type C ON A.mistake_type = C.mistake_type AND A.mistake_code = C.mistake_code
where No = '$id'
")

        );
        return view('admin/transection.transection_index_edit',compact('data_trann',$data_trann,'items',$items));

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

        $input = $request->all();
        $id = $request->No;
        $user_code = $request->user_code;

        $article =  tb_transection::find($id)->update($request->all());

        $tb_transec = DB::select( DB::raw("select A.NO,A.user_code,C.description_mistake,A.D_devolop,A.user_date from tb_transection A
LEFT JOIN tb_date_dev B ON A.user_code = B.user_code AND A.mistake_code = B.mistake_code
LEFT JOIN tb_mistake C ON A.mistake_code = C.mistake_code

where A.user_code = '$user_code'
AND type_warning = '2'
AND flag_comfirm = 'Y'
AND user_date  between B.st_date_dev and B.en_date_dev

GROUP BY A.No,st_date_dev,A.user_code,C.description_mistake,A.D_devolop,A.user_date
")

        );



        return view('admin/transection.transection_index')->with('tb_transec', $tb_transec);
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


    public function index_datamaster(Request $request)
    {
        $input = $request->all();


        $user_code = $request->input('user_code');

      /*  $tb_transec  = DB::table('tb_transection')
            ->leftJoin('tb_mistake', 'tb_transection.mistake_code', '=', 'tb_mistake.mistake_code')
            ->where('user_code','=',$user_code)->where('flag_comfirm','=','Y')
            ->where('tb_transection.type_warning','=','2')
            ->orderBy('tb_transection.mistake_code','desc')
            ->get();

*/

        $tb_transec = DB::select( DB::raw("select A.NO,A.user_code,C.description_mistake,A.D_devolop,A.user_date from tb_transection A
LEFT JOIN tb_date_dev B ON A.user_code = B.user_code AND A.mistake_code = B.mistake_code
LEFT JOIN tb_mistake C ON A.mistake_code = C.mistake_code

where A.user_code = '$user_code'
AND type_warning = '2'
AND flag_comfirm = 'Y'
AND user_date  between B.st_date_dev and B.en_date_dev
GROUP BY A.No,st_date_dev,A.user_code,C.description_mistake,A.D_devolop,A.user_date
")

        );




        return view('admin/transection.transection_index')->with('tb_transec', $tb_transec);
    }


    public function Coach(Request $request)
    {
       return 1;
    }


}
