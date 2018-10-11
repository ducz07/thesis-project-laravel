<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Illuminate\Support\Facades\Redirect;
use Session;
Session_start();

class CheckoutController extends Controller
{
    //login check
    public function login_check(){
        $this->LogoutCheck();
        return view('pages/login_check');
    }

 //logout check
    public function LogoutCheck(){
        $customer_id = Session::get('customer_id');
        if ($customer_id){
            return Redirect::to('/')->send();
        }
        else{
            return;
        }
    }

    //customer registration
    public function customer_registration(Request $request){
        $this->validate($request,[
            'customer_name' => 'required|max:10',
            'customer_email' => 'required|unique:tbl_customer',
            'mobile_number' => 'required',
            'password' => 'required|min:3'
        ]);

        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['mobile_number'] = $request->mobile_number;
        $data['password'] = md5($request->password);

        $customer_id=DB::table('tbl_customer')
            ->insertGetId($data);

        $value = Cart::total();
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        if ($value == 0){
            return Redirect::to('/');
        }else{
            return Redirect::to('/checkout');
        }
    }

    // cart checkout
    public function checkout(){
        return view('pages/checkout');
    }

    //shipping save
    public function save_shipping(Request $request){
        $this->validate($request,[
            'shipping_email' => 'required',
            'shipping_first_name' => 'required|max:8',
            'shipping_last_name' => 'required|max:8',
            'shipping_address' => 'required',
            'shipping_mobile_number' => 'required',
            'shipping_city' => 'required'
        ]);

        $data = array();
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_first_name'] = $request->shipping_first_name;
        $data['shipping_last_name'] = $request->shipping_last_name;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_mobile_number'] = $request->shipping_mobile_number;
        $data['shipping_city'] = $request->shipping_city;

        $shipping_id=DB::table('tbl_shipping')
            ->insertGetId($data);

        Session::put('shipping_id', $shipping_id);
        return Redirect::to('/payment');
    }


    //customer login with session
    public function customer_login(Request $request){
        $value = Cart::total();
        $customer_email = $request->customer_email;
        $password = md5($request->password);
        $result = DB::table('tbl_customer')
            ->where('customer_email',$customer_email)
            ->where('password',$password)
            ->first();
        if ($result){
            Session::put('customer_email',$result->customer_email);
            Session::put('customer_id',$result->customer_id);
            if ($value == 0){
                return Redirect::to('/');
            }else{
                return Redirect::to('/checkout');
            }
        }
        else{
            Session::put('message','Email or Password Invalid');
            return Redirect::to('/login_check');
        }
    }

    /* customer logout*/
    public function customer_logout(){
        Session ::Flush();
        return Redirect::to('/');
    }

    //payment
    public function payment(){
        $value = str_replace( ',', '', Cart::total() );
        if ($value == 0){
            return Redirect::to('/');
        }else{
            return view('pages/payment', ['total' => $value]);
        }
    }

    //order_place check
    public function order_place(Request $request){
        $payment_gateway = $request->payment_method;

        $pdata = array();
        $pdata['payment_method'] = $payment_gateway;
        $pdata['payment_status'] = 'pending';
        $payment_id = DB::table('tbl_payment')
            ->insertGetId($pdata);

        $odata = array();
        $odata['customer_id'] = Session::get('customer_id');
        $odata['shipping_id'] = Session::get('shipping_id');
        $odata['payment_id'] = $payment_id;
        $odata['order_total'] = Cart::total();
        $odata['order_status'] = 'pending';
        $order_id = DB::table('tbl_order')
            ->insertGetId($odata);

        $contents = Cart::content();
        $oddata=array();
        foreach ($contents as $v_content){
            $oddata['order_id'] = $order_id;
            $oddata['product_id'] = $v_content->id;
            $oddata['product_name'] = $v_content->name;
            $oddata['product_price'] = $v_content->price;
            $oddata['product_sales_quantity'] = $v_content->qty;

            $ordered = DB::table('tbl_order_details')
                ->insert($oddata);

                if($ordered){
                    $product = DB::table('tbl_products')->where('product_id', $oddata['product_id'])->first();

                    $remaining_quantity = $product->product_size-$oddata['product_sales_quantity'];

                    DB::table('tbl_products')->where('product_id', $oddata['product_id'])->update(['product_size'=>$remaining_quantity]);
                }

            if ($payment_gateway=='cod'){
                Cart::destroy();
                Session::put('message','Your Payment via Cash On Delivery!!');
            }elseif ($payment_gateway=='paypal'){
                Cart::destroy();
                Session::put('message','Your Payment via Paypal!!');
            // }elseif ($payment_gateway=='bkash'){
            //     Cart::destroy();
            //     Session::put('message','You Payment by bKash!!');
            //
            }
                else{
                return Redirect::to('/payment');
            }
        }
        return Redirect::to('/congratulate');
    }

    //payment congratulate
    public function congratulate(){
        return view('pages/congratulate');
    }







}
