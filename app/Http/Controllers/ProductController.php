<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
Session_start();

class ProductController extends Controller
{

    ///add product
    public function add_product(){
        return view('admin/add_product');
    }

    // insert product
    public function save_product(Request $request){
        $this->validate($request,[
            'product_name' => 'required|max:50',
            'category_id' => 'required',
            'brand_id' => 'required',
            'product_description' => 'required',
            'product_price' => 'required',
            'product_size' => 'required',
            'product_color' => 'required',
            'product_image' => 'required|image|mimes:jpeg,jpg,bmp,png|max:1024',
            'publication_status' => 'required'
        ]);

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_description'] = $request->product_description;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['publication_status'] = $request->publication_status;

        //image upload
        $image = $request->file('product_image');
        if ($image) {
            $image_name=str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='uploads/product/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['product_image']=$image_url;
                DB::table('tbl_products')
                    ->insert($data);
                Session::put('message', 'Product added successfully!!');
                return Redirect::to('/add_product');
            }
        }
        //else
        $data['product_image'] = '';
        DB::table('tbl_products')
            ->insert($data);
        Session::put('message', 'Product added successfully!!');
        return Redirect::to('/add_product');

    }

    ///all product
    public function all_product(){
        $allproduct_info=DB::table('tbl_products')
            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
            ->join('tbl_brand','tbl_products.brand_id','=','tbl_brand.brand_id')
            ->select('tbl_products.*','tbl_category.category_name','tbl_brand.brand_name')
            ->orderBy('product_id', 'desc')
            ->get();
        $manage_product=view('admin/all_product')
            ->with('all_product_info',$allproduct_info);// all info put in ""all_product_info""
        return view('admin_layout')
            ->with('all_product',$manage_product);
    }

    //active to unactive_product
    public function unactive_product($product_id){
        DB::table('tbl_products')
            ->where('product_id',$product_id)
            ->update(['publication_status' => 0]);
        Session::put('message', 'Unactive product Updated successfully!!');
        return Redirect::to('/all_product');
    }

    //unactive to active_product
    public function active_product($product_id){
        DB::table('tbl_products')
            ->where('product_id',$product_id)
            ->update(['publication_status' => 1]);
        Session::put('message', 'Active product Updated successfully!!');
        return Redirect::to('/all_product');
    }

    ///edit product
    public function edit_product($product_id){
        $product_description_view = DB::table('tbl_products')
            ->select('*')
            ->where('product_id',$product_id)
            ->first();
        $manage_description_product=view('admin/edit_product')
            ->with('specific_edit_product',$product_description_view);
        return view('admin_layout')
            ->with('edit_product',$manage_description_product);
    }

    // update product
    public function update_product(Request $request, $product_id){
        $this->validate($request,[
            'product_name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'product_description' => 'required',
            'product_price' => 'required',
            'product_size' => 'required',
            'product_color' => 'required'
        ]);

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_description'] = $request->product_description;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;

        //image upload
        $image = $request->file('product_image');
        if ($image) {
            $image_name= $product_id;
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='uploads/product/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['product_image']=$image_url;
                DB::table('tbl_products')
                    ->where('product_id',$product_id)
                    ->update($data);
                Session::put('message', 'Product added successfully!!');
                return Redirect::to('/all_product');
            }
        }
        //else
        $data['product_image'] = '';
        $previous_image = $request->previous_image;
        $data['product_image'] = $previous_image;
        DB::table('tbl_products')
            ->where('product_id',$product_id)
            ->update($data);
        Session::put('message', 'Product updated successfully!!');
        return Redirect::to('/all_product');

    }

    //product delete specific
    public function delete_product($product_id){
        DB::table('tbl_products')
            ->where('product_id',$product_id)
            ->delete();
        Session::put('message','Delete product successfully!!');
        return Redirect::to('/all_product');
    }



    //active to unactive_product  slider
    public function unactive_slider($product_id){
        DB::table('tbl_products')
            ->where('product_id',$product_id)
            ->update(['product_slider' => 0]);
        Session::put('message', 'Updated successfully!!');
        return Redirect::to('/all_slider');
    }

    //unactive to active_product slider
    public function active_slider($product_id){
        DB::table('tbl_products')
            ->where('product_id',$product_id)
            ->update(['product_slider' => 1]);
        Session::put('message', 'Updated successfully!!');
        return Redirect::to('/all_slider');
    }




}
