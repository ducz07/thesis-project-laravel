<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
Session_start();

class CategoryController extends Controller
{
    //add category
    public function add_category(){
        return view('admin/add_category');
    }

    //insert category
    public function save_category(Request $request){
        $this->validate($request,[
            'category_name' => 'required|max:20',
            'category_description' => 'required',
            'publication_status' => 'required'
        ]);
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        $data['publication_status'] = $request->publication_status;

        DB::table('tbl_category')
            ->insert($data);
        Session::put('message', 'Category added successfully!!');
        return Redirect::to('/add_category');
    }

    //View ALL Category
    public function all_category(){
        $allcategory_info=DB::table('tbl_category')
            ->orderBy('category_id', 'asc')
            ->get();
        $manage_category=view('admin/all_category')
            ->with('all_category_info',$allcategory_info);// all info put in ""all_category_info""
        return view('admin_layout')
            ->with('all_category',$manage_category);
    }

    //active to unactive_category
    public function unactive_category($category_id){
        DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->update(['publication_status' => 0]);
        Session::put('message', 'Unactive Category Updated successfully!!');
        return Redirect::to('/all_category');
    }

    //unactive to active_category
    public function active_category($category_id){
        DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->update(['publication_status' => 1]);
        Session::put('message', 'Active Category Updated successfully!!');
        return Redirect::to('/all_category');
    }

    //edit category
    public function edit_category($category_id){
        $category_description_view = DB::table('tbl_category')
            ->select('*')
            ->where('category_id',$category_id)
            ->first();
        $manage_description_category=view('admin/edit_category')
            ->with('specific_edit_category',$category_description_view);
        return view('admin_layout')
            ->with('student_edit',$manage_description_category);
    }
    //Update category
    public function update_category(Request $request,$category_id ){
        $this->validate($request,[
            'category_name' => 'required|max:20',
            'category_description' => 'required'
        ]);
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;

        DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->update($data);
        Session::put('message', 'Category Updated successfully!!');
        return Redirect::to('/all_category');
    }


    //Category delete specific
    public function delete_category($category_id){
        DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->delete();
        Session::put('message','Delete Category successfully!!');
        return Redirect::to('/all_category');
    }












}
