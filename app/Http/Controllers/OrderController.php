<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Illuminate\Support\Facades\Redirect;
use Session;
Session_start();

class OrderController extends Controller
{
     //manage order
  /*  public function manage_order(){
        $all_order_info=DB::table('tbl_order')
            ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
            ->select('tbl_order.*','tbl_customer.customer_name')
            ->orderBy('order_id', 'desc')
            ->get();
        $manage_order=view('admin/manage_order')
            ->with('all_order_info',$all_order_info);// all info put in ""all_order_info""
        return view('admin_layout')
            ->with('admin/manage_order',$manage_order);
    }*/

    public function manage_order(){
        $all_order_info=DB::table('tbl_order')
            ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
            ->join('tbl_payment','tbl_order.payment_id','=','tbl_payment.payment_id')
            ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
            ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
            ->select('tbl_order.*','tbl_customer.customer_name','tbl_customer.mobile_number','tbl_payment.payment_method','tbl_payment.payment_status','tbl_order_details.product_name','tbl_order_details.product_sales_quantity', 'tbl_shipping.shipping_city')
            ->orderBy('tbl_order.order_id', 'desc')
            ->get();
        $manage_order=view('admin/manage_order')
            ->with('all_order_info',$all_order_info);// all info put in ""all_order_info""
        return view('admin_layout')
            ->with('admin/manage_order',$manage_order);
    }


    //view pending order
    public function view_pending_order($customer_id){
        $order_by_id=DB::table('tbl_order')
            ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
            ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
            ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
            ->select('tbl_order.*','tbl_order_details.*','tbl_shipping.*','tbl_customer.*')
            ->where('tbl_order.customer_id',$customer_id)
            ->where('tbl_order.order_status','pending')
            ->get();

            /*print_r($order_by_id);*/
        $view_order=view('admin/view_order')
            ->with('order_by_id',$order_by_id);// all info put in ""order_by_id""
        return view('admin_layout')
            ->with('admin/view_order',$view_order);
    }

    //view done order
    public function view_done_order($customer_id){
        $order_by_id=DB::table('tbl_order')
                        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
                        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
                        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
                        ->select('tbl_order.*','tbl_order_details.*','tbl_shipping.*','tbl_customer.*')
                        ->where('tbl_order.customer_id',$customer_id)
                        ->where('tbl_order.order_status','done')
                        ->get();

        /*print_r($order_by_id);*/
        $view_order=view('admin/view_order')
            ->with('order_by_id',$order_by_id);// all info put in ""order_by_id""
        return view('admin_layout')
            ->with('admin/view_order',$view_order);
    }


    //order delete specific
    public function delete_order($order_id){
        $result = DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->first();
        if ($result){
            $order_id=$result->order_id;
            $shipping_id=$result->shipping_id;
            $payment_id=$result->payment_id;

            DB::table('tbl_order')
                ->where('order_id',$order_id)
                ->delete();

            DB::table('tbl_shipping')
                ->where('shipping_id',$shipping_id)
                ->delete();

            DB::table('tbl_order_details')
                ->where('order_id',$order_id)
                ->delete();

            DB::table('tbl_payment')
                ->where('payment_id',$payment_id)
                ->delete();

            Session::put('message','Order deleted successfully!!');
            return Redirect::to('/manage_order');
        }
    }

    //pending to done
    public function done_order($order_id){
        DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->update(['order_status' => 'done']);
        Session::put('message', 'Order Updated successfully!!');
        return Redirect::to('/manage_order');
    }

    //done to pending_order
    public function pending_order($order_id){
        DB::table('tbl_order')
            ->where('order_id',$order_id)
            ->update(['order_status' => 'pending']);
        Session::put('message', 'Order Updated successfully!!');
        return Redirect::to('/manage_order');
    }

    //pending to done payment
    public function pending_payment($payment_id){
        DB::table('tbl_payment')
            ->where('payment_id',$payment_id)
            ->update(['payment_status' => 'done']);
        Session::put('message', 'payment Updated successfully!!');
        return Redirect::to('/manage_order');
    }

    //done to pending_payment
    public function done_payment($payment_id){
        DB::table('tbl_payment')
            ->where('payment_id',$payment_id)
            ->update(['payment_status' => 'pending']);
        Session::put('message', 'payment Updated successfully!!');
        return Redirect::to('/manage_order');
    }



}
