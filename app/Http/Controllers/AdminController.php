<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use PDF;
Session_start();

class AdminController extends Controller{

    public function index(){
        $this->LogoutCheck();
        return view('admin_login');
    }
    //logout check
    public function LogoutCheck(){
        $admin_id = Session::get('admin_id');
        if ($admin_id){
            return Redirect::to('/admin_dashboard')->send();
        }
        else{
            return;
        }
    }

    //admin login with session
    public function admin_login(Request $request){
        $email = $request->admin_email;
        $password = md5($request->admin_password);
        $result = DB::table('tbl_admin')->where('admin_email',$email)
            ->where('admin_password',$password)
            ->first();
        if ($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_email',$result->admin_email);
            Session::put('admin_id',$result->admin_id);
            Session::put('admin_role',$result->admin_role);
            return Redirect::to('/admin_dashboard');
        }
        else{
            Session::put('exception','Email or Password Invalid');
            return Redirect::to('/admin');
        }
    }

    //admin dashboard
    public function admin_dashboard(){
        $this->AdminAuthCheck();
        return view('admin.dashboard');
    }

    //session check
    public function AdminAuthCheck(){
        $admin_id = Session::get('admin_id');
        if ($admin_id){
            return;
        }
        else{
            return Redirect::to('/admin')->send();
        }
    }


    //add user by admin
    public function add_user(){
        $admin_role = Session::get('admin_role');
        if ($admin_role == '0') {
            return view('admin.add_user');
        }
        else{
            return Redirect::to('/admin_dashboard')->send();
        }
    }

    // insert admin
    public function save_admin(Request $request){
            $this->validate($request,[
                'admin_name' => 'required|max:10',
                'admin_email' => 'required|unique:tbl_admin',
                'admin_password' => 'required|min:3',
                'admin_phone' => 'required',
                'admin_details' => 'required',
                'admin_role' => 'required'
            ]);
            $data = array();
            $data['admin_name'] = $request->admin_name;
            $data['admin_email'] = $request->admin_email;
            $data['admin_password'] = md5($request->admin_password);
            $data['admin_phone'] = $request->admin_phone;
            $data['admin_details'] = $request->admin_details;
            $data['admin_role'] = $request->admin_role;

            //image upload
            $image = $request->file('admin_image');
            if ($image) {
                /*$image_name=str_random(5);*/
                $image_name=$data['admin_name'];
                $ext=strtolower($image->getClientOriginalExtension());
                $image_full_name=$image_name.'.'.$ext;
                $upload_path='uploads/admin/';
                $image_url=$upload_path.$image_full_name;
                $success=$image->move($upload_path,$image_full_name);
                if ($success) {
                    $data['admin_image']=$image_url;
                    DB::table('tbl_admin')
                        ->insert($data);
                    Session::put('message', 'User added successfully!!');
                    return Redirect::to('/add_user');
                }
            }
            //else
            $data['admin_image'] = '';
            DB::table('tbl_admin')
                ->insert($data);
            Session::put('message', 'User added successfully!!');
            return Redirect::to('/add_user');
    }
    
    
   //View ALL user
    public function all_user(){
        $all_user_info=DB::table('tbl_admin')
            ->orderBy('admin_id', 'asc')
            ->get();
        $manage_user=view('admin/all_user')
            ->with('all_user_info',$all_user_info);// all info put in ""all_user_info""
        return view('admin_layout')
            ->with('all_user',$manage_user);
    }

    //edit user by admin
    public function edit_user($admin_id){
        $this->EditUserCheck();
        $admin_description_view = DB::table('tbl_admin')
            ->select('*')
            ->where('admin_id',$admin_id)
            ->first();
        $manage_description_admin=view('admin/edit_user')
            ->with('specific_edit_admin',$admin_description_view);
        return view('admin_layout')
            ->with('edit_user',$manage_description_admin);
    }
    //edit control check
    public function EditUserCheck(){
        $admin_role = Session::get('admin_role');
        if ($admin_role != '0'){
            return Redirect::to('/admin_dashboard')->send();
        }
        else{
            return;
        }
    }

    // update admin
    public function update_user(Request $request, $admin_id){
        $this->validate($request,[
            'admin_name' => 'required|max:10',
            'admin_email' => 'required|unique:tbl_admin',
            'admin_phone' => 'required',
            'admin_details' => 'required',
            'admin_role' => 'required'
        ]);
        $data = array();
        $data['admin_name'] = $request->admin_name;
        $data['admin_email'] = $request->admin_email;
        $data['admin_phone'] = $request->admin_phone;
        $data['admin_details'] = $request->admin_details;
        $data['admin_role'] = $request->admin_role;

        //image upload
        $image = $request->file('admin_image');
        if ($image) {
            $image_name=$admin_id;
            /*$image_name=str_random(5);*/
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='uploads/admin/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['admin_image']=$image_url;
                DB::table('tbl_admin')
                    ->where('admin_id',$admin_id)
                    ->update($data);
                Session::put('message', 'User added successfully!!');
                return Redirect::to('/all_user');
            }
        }
        //else
        $data['admin_image'] = '';
        $previous_image = $request->previous_image;
        $data['admin_image'] = $previous_image;
        DB::table('tbl_admin')
            ->where('admin_id',$admin_id)
            ->update($data);
        Session::put('message', 'User added successfully!!');
        return Redirect::to('/all_user');
    }

    //profile view
    public function profile_view($admin_id){
        $id = Session::get('admin_id');
        $admin_role = Session::get('admin_role');
        if ($admin_role == '0' || $id == $admin_id){
            $admin_description_view = DB::table('tbl_admin')
                ->select('*')
                ->where('admin_id',$admin_id)
                ->first();
            $manage_description_admin=view('admin/profile')
                ->with('specific_edit_admin',$admin_description_view);
            return view('admin_layout')
                ->with('profile',$manage_description_admin);
        }else{
            return Redirect::to('/profile/'.$id)->send();
        }
    }

    // update profile by user
    public function update_profile(Request $request, $admin_id){
        $this->validate($request,[
            'admin_name' => 'required|max:10',
            'admin_phone' => 'required',
            'admin_details' => 'required',
        ]);
        $data = array();
        $data['admin_name'] = $request->admin_name;
        $data['admin_phone'] = $request->admin_phone;
        $data['admin_details'] = $request->admin_details;

        //image upload
        $image = $request->file('admin_image');
        if ($image) {
            $image_name=$admin_id;
            /*$image_name=str_random(5);*/
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='uploads/admin/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['admin_image']=$image_url;
                DB::table('tbl_admin')
                    ->where('admin_id',$admin_id)
                    ->update($data);
                Session::put('message', 'profile updated successfully!!');
                return Redirect::to('/profile/'.$admin_id)->send();
            }
        }
        //else
        $data['admin_image'] = '';
        $previous_image = $request->previous_image;
        $data['admin_image'] = $previous_image;
        DB::table('tbl_admin')
            ->where('admin_id',$admin_id)
            ->update($data);
        Session::put('message', 'profile updated successfully!!');
        return Redirect::to('/profile/'.$admin_id);
    }


    //user_password_change
    public function user_password_change($admin_id){
        $id = Session::get('admin_id');
        $admin_role = Session::get('admin_role');

        if ($admin_role == '0' || $id == $admin_id){
        $user_password_change = DB::table('tbl_admin')
            ->select('*')
            ->where('admin_id',$admin_id)
            ->first();
        $manage_description_user=view('admin/user_password_change')
            ->with('user_password_change',$user_password_change);
        return view('admin_layout')
            ->with('user_password_change',$manage_description_user);
        }else{
            return Redirect::to('/user_password_change/'.$id)->send();
        }
    }

    // user_password_update
    public function user_password_update(Request $request,$admin_id ){
        $this->validate($request,[
            'data_pass' => 'required',
            'old_pass' => 'required',
            'new_pass' => 'required|min:3',
            'confirm_pass' => 'required|min:3'
        ]);
        $data_pass = $request->data_pass;
        $old = md5($request->old_pass);
        $new = md5($request->new_pass);
        $con = md5($request->confirm_pass);

        if ($data_pass == $old){
            if ($new == $con){
                DB::table('tbl_admin')
                    ->where('admin_id',$admin_id)
                    ->update(['admin_password' => $new]);
                Session::put('message', 'Password Change successfully!!');
                return Redirect::to('/user_password_change/'.$admin_id);
            }else{
                Session::put('message', 'confirm password wrong!!');
                return Redirect::to('/user_password_change/'.$admin_id);
            }
        }else{
            Session::put('message', 'Old Password wrong!!');
            return Redirect::to('/user_password_change/'.$admin_id);
        }
    }


    //admin delete specific
    public function delete_admin($admin_id){
        $admin_role = Session::get('admin_role');
        if ($admin_role == '0') {
            DB::table('tbl_admin')
                ->where('admin_id', $admin_id)
                ->delete();
            Session::put('message', 'Admin deleted successfully!!');
            return Redirect::to('/all_user');
        }else{
            return Redirect::to('/admin_dashboard');
        }
    }

    /*logout*/
    public function logout(){
        /*Session::put('admin_name',null);
        Session::put('admin_email',null);
        Session::put('admin_id',null);*/
        Session ::Flush();
        return Redirect::to('/admin');
    }

    public function reports()
        {

            return view('admin.reports');
       
    }

    public function inventory()
        {

            return view('admin.inventory');
       
    }



public function getdata(Request $request)
    {
         $records=DB::table('tbl_order')
         ->Join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')
         ->Join('tbl_payment', 'tbl_order.payment_id', '=', 'tbl_payment.payment_id')
         ->select('tbl_order.*', 'tbl_order.created_at', 'tbl_order_details.product_name', 'tbl_order_details.product_sales_quantity', 'tbl_order.order_total', 'tbl_payment.payment_method')
      ->get();

        
       Session::put('data', $records);
       Session::put('start', $request->Name);
       Session::put('end', $request->company);
       


      if($records)

      {
        return Response($records);
      }
 
    echo "No ajax request";
  }

   public function getInventoryData(Request $request)
    {
         $records=DB::table('tbl_products')
         ->Join('tbl_order_details', 'tbl_products.product_id', '=', 'tbl_order_details.product_id')
         ->Join('tbl_category', 'tbl_products.category_id', '=', 'tbl_category.category_id')
         ->select('tbl_products.*', 'tbl_products.product_name', 'tbl_order_details.product_sales_quantity', 'tbl_category.category_name')
            ->get();

        
       Session::put('data', $records);
       Session::put('start', $request->Name);
       Session::put('end', $request->company);
       


      if($records)

      {
        return Response($records);
      }
 
    echo "No ajax request";
  }

    

      public function pdfview(Request $request)
    {
      
        
        if($request->has('download')){

           
               
               $records = Session::get('data');

            $start = Session::get('start');
             $end = Session::get('end');
             

                view()->share('records',$records);
                view()->share('start', $start);
                view()->share('end',$end);
                

             $pdf = PDF::loadView('admin.pdfview');
           
            return $pdf->download('pdfview.pdf');
        }


        return view('admin.pdfview');
    }

    public function pdfviewInventory(Request $request)
    {
      
        
        if($request->has('download')){

           
               
               $records = Session::get('data');

            $start = Session::get('start');
             $end = Session::get('end');
             

                view()->share('records',$records);
                view()->share('start', $start);
                view()->share('end',$end);
                

             $pdf = PDF::loadView('admin.pdfviewInventory');
           
            return $pdf->download('pdfviewInventory.pdf');
        }


        return view('admin.pdfviewInventory');
    }










}
