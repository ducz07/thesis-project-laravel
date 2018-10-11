<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
Session_start();

class BrandController extends Controller
{

    //add brand
    public function add_brand(){
        return view('admin/add_brand');
    }

    //insert brand
    public function save_brand(Request $request){
        $this->validate($request,[
            'brand_name' => 'required|max:30',
            'brand_description' => 'required',
            'publication_status' => 'required'
        ]);
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_description'] = $request->brand_description;
        $data['publication_status'] = $request->publication_status;

        DB::table('tbl_brand')
            ->insert($data);
        Session::put('message', 'Brand added successfully!!');
        return Redirect::to('/add_brand');
    }

    //View ALL brand
    public function all_brand(){
        $allbrand_info=DB::table('tbl_brand')
            ->orderBy('brand_id', 'asc')
            ->get();
        $manage_brand=view('admin/all_brand')
            ->with('all_brand_info',$allbrand_info);// all info put in ""all_brand_info""
        return view('admin_layout')
            ->with('all_brand',$manage_brand);
    }

    //active to unactive_brand
    public function unactive_brand($brand_id){
        DB::table('tbl_brand')
            ->where('brand_id',$brand_id)
            ->update(['publication_status' => 0]);
        Session::put('message', 'Unactive brand Updated successfully!!');
        return Redirect::to('/all_brand');
    }

    //unactive to active_brand
    public function active_brand($brand_id){
        DB::table('tbl_brand')
            ->where('brand_id',$brand_id)
            ->update(['publication_status' => 1]);
        Session::put('message', 'Active brand Updated successfully!!');
        return Redirect::to('/all_brand');
    }

    //edit brand
    public function edit_brand($brand_id){
        $brand_description_view = DB::table('tbl_brand')
            ->select('*')
            ->where('brand_id',$brand_id)
            ->first();
        $manage_description_brand=view('admin/edit_brand')
            ->with('specific_edit_brand',$brand_description_view);
        return view('admin_layout')
            ->with('student_edit',$manage_description_brand);
    }
    //Update brand
    public function update_brand(Request $request,$brand_id ){
        $this->validate($request,[
            'brand_name' => 'required|max:30',
            'brand_description' => 'required'
        ]);
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_description'] = $request->brand_description;

        DB::table('tbl_brand')
            ->where('brand_id',$brand_id)
            ->update($data);
        Session::put('message', 'brand Updated successfully!!');
        return Redirect::to('/all_brand');
    }


    //brand delete specific
    public function delete_brand($brand_id){
        DB::table('tbl_brand')
            ->where('brand_id',$brand_id)
            ->delete();
        Session::put('message','Delete brand successfully!!');
        return Redirect::to('/all_brand');
    }










}
