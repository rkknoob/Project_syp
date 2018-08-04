<?php

namespace App\Http\Controllers;

use App\ecdoc_categories;
use Illuminate\Http\Request;
use Alert;
use Session;
use auth;

class ContentController extends Controller
{
    public function index(Request $request)
    {


        $department = Auth::user()->department;


        if($department != 'Safety' && $department != 'ALL'){

            abort(403);

        }

        $car = ecdoc_categories::orderBy('id', 'desc')->get();



        return view('admin/categorie.mainpage',['car' => $car]);


    }

    public function create(Request $request)
    {


        return view('admin/categorie.newdata');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $book = new ecdoc_categories();
        $book->name = $request->name;
        $book->description = $request->description;
        $book->save();





        Session::flash('message', "บันทึกเรียบร้อยแล้ว");
        return redirect()->route('admin/categorie.mainpage')
            ->with('success','Item created successfully');
    }






    public function destroy(Request $request)
    {

        $input= $request->all();

        $id = $input['id'];




        $book = ecdoc_categories::find($id);
        $book->delete($id);

        return 1;

    }



}
