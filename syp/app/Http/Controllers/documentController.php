<?php

namespace App\Http\Controllers;

use App\ecdoc_documents;
use Illuminate\Http\Request;
use DB;
use App\ecdoc_categories;
use Input;
use File;
use Image;
use auth;
use Carbon\Carbon;


class documentController extends Controller
{

    public function index()
    {



        $department = Auth::user()->department;


        if($department != 'Safety' && $department != 'ALL'){

            abort(403);

        }



        $show_document = DB::select( DB::raw("select A.id,A.document_code,A.topic,DATE_FORMAT(A.register_date,'%d-%m-%Y') as register_date,B.name,C.user_code,a.filename from ecdoc_documents a
LEFT JOIN ecdoc_categories b on a.categorie_id = b.id
left join users C on A.created_by = C.id
"));




        return view('admin/categorie/document.maindoc')->with('show_document', $show_document);
    }



    public function create()
    {

        $head_cate = DB::select( DB::raw("select DISTINCT id,name from ecdoc_categories WHERE IFNULL(name, '') != '' order by name asc"));


        return view('admin/categorie/document.newdata')->with('head_cate', $head_cate);
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;





        $input = $request->all();

        $file = Input::file('user_file');


        $extension = Input::file('user_file')->getClientOriginalName();




          $fileName  = time() .'.pdf';

            $request->file('user_file')->getClientOriginalExtension();

        $request->file('user_file')->move(
            base_path() . '/public/uploads', $fileName
        );


        $carbon = Carbon::now()->format('Y-m-d H:i:s');

        $request->request->add(['register_date' => $carbon]);
        $request->request->add(['filename' => $fileName]);
        $request->request->add(['created_by' => $user_id]);
        $input = $request->all();
        $item_create = ecdoc_documents::create($input);


        return redirect()->action('documentController@index');




    }


    public function show()
    {


        $show_document = DB::select( DB::raw("select A.id,A.document_code,A.topic,DATE_FORMAT(A.register_date,'%d-%m-%Y') as register_date,B.name,C.user_code,a.filename from ecdoc_documents a
LEFT JOIN ecdoc_categories b on a.categorie_id = b.id
left join users C on A.created_by = C.id
"));




        return view('document.readdocment')->with('show_document', $show_document);
    }




}
