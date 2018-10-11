<?php

namespace App\Http\Controllers;
use DB;
use Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Srmklive\PayPal\Services\ExpressCheckout;
use Cart;
use App\Invoice;

class PaypalController extends Controller
{
    //


protected $provider;

public function __construct() {
    $this->provider = new ExpressCheckout();
}

//we need our expressCheckout method, that will redirect user to PayPal, so he can approve the payment.
public function expressCheckout(Request $request, $total) {
  // check if payment is recurring
  $recurring = $request->input('recurring', false) ? true : false;

  // get new invoice id
  $invoice_id = Invoice::count() + 1;

  // Get the cart data
  $cart = $this->getCart($invoice_id, $total);

  // create new invoice
  $invoice = new Invoice();
  $invoice->title = $cart['invoice_description'];
  $invoice->price = $cart['total'];
  $invoice->save();

  // send a request to paypal
  // paypal should respond with an array of data
  // the array should contain a link to paypal's payment system
  $response = $this->provider->setExpressCheckout($cart);

  // if there is no link redirect back with error message
  if (!$response['paypal_link']) {
    return redirect('/payment')->with(['code' => 'danger', 'message' => 'Something went wrong with PayPal']);
    // For the actual error message dump out $response and see what's o there
  }
  // redirect to paypal
  // after payment is done paypal
  // will redirect us back to $this->expressCheckoutSuccess
  return redirect($response['paypal_link']);
}

//At this point we should take a look at the $this->getCart() method to find out what information PayPal wants from us in order to make a payment.
private function getCart($invoice_id, $total)
    {

      $contents = Cart::content();

      // let's loop through the number of items added to cart and pass it to the array

        $lists = [];
        foreach ($contents as $key => $value){
            $lists[] = ['name' => $value->name, 'price' =>$value->total, 'qty' => $value->qty];
          }
//dd($lists);
        return [
            // if payment is not recurring cart can have many items
            // with name, price and quantity

            'items' => $lists,

            // return url is the url where PayPal returns after user confirmed the payment
            'return_url' => url('/paypal/express-checkout-success'),
            // every invoice id must be unique, else you'll get an error from paypal
            'invoice_id' => config('paypal.invoice_prefix') . '_' . $invoice_id,
            'invoice_description' => "Order #" . $invoice_id . " Invoice",
            'cancel_url' => url('/payment'),
            // total is calculated by multiplying price with quantity of all cart items and then adding them up
            // in this case total is 20 because Product 1 costs 10 (price 10 * quantity 1) and Product 2 costs 10 (price 5 * quantity 2)
            'total' => $total,
        ];
    }

    //Now that we got the cart figured out we can proceed to the expressCheckoutSuccess() method. This method is executed when user confirms the payment in PayPal and is returned to our application.
    public function expressCheckoutSuccess(Request $request) {

        // check if payment is recurring
        //dd(4);


        $recurring = $request->input('recurring', false) ? true : false;

        $token = $request->get('token');

        $PayerID = $request->get('PayerID');

        // initially  paypal redirects us back with a token
        // but doesn't provide us any additional data
        // so we use getExpressCheckoutDetails($token)
        // to get the payment details
        $response = $this->provider->getExpressCheckoutDetails($token);

        // if response ACK value is not SUCCESS or SUCCESSWITHWARNING
        // we return back with error
        if (!in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return redirect('/payment')->with(['code' => 'danger', 'message' => 'Error processing PayPal payment']);
        }

        // invoice id is stored in INVNUM
        // because we set our invoice to be xxxx_id
        // we need to explode the string and get the second element of array
        // witch will be the id of the invoice
        $invoice_id = explode('_', $response['INVNUM'])[1];

        // get cart data
        $cart = $this->getCart($recurring, $invoice_id);

        // check if our payment is recurring
        if ($recurring === true) {

            // if recurring then we need to create the subscription
            // you can create monthly or yearly subscriptions
            $response = $this->provider->createMonthlySubscription($response['TOKEN'], $response['AMT'], $cart['subscription_desc']);

            $status = 'Invalid';
            // if after creating the subscription paypal responds with activeprofile or pendingprofile
            // we are good to go and we can set the status to Processed, else status stays Invalid
            if (!empty($response['PROFILESTATUS']) && in_array($response['PROFILESTATUS'], ['ActiveProfile', 'PendingProfile'])) {
                $status = 'Processed';
            }

        } else {


            // if payment is not recurring just perform transaction on PayPal
            // and get the payment status
            $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'] ?? false;

        }

        // find invoice by id
        $invoice = Invoice::find($invoice_id);

        // set invoice status
        $invoice->payment_status = $status;

        // if payment is recurring lets set a recurring id for latter use
        if ($recurring === true) {
            $invoice->recurring_id = $response['PROFILEID'];
        }

        // save the invoice
        //this is my work function
        $idd=$invoice->save();









        // App\Invoice has a paid attribute that returns true or false based on payment status
        // so if paid is false return with error, else return with success message
        if ($invoice->paid) {




            $payment_gateway = $request->payment_method;


           // dd($payment_gateway);

            $pdata = array();
            $pdata['payment_method'] = 'PayPal';
            $pdata['payment_status'] = 'done';
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
            $oddata = array();
            foreach ($contents as $v_content) {
                $oddata['order_id'] = $order_id;
                $oddata['product_id'] = $v_content->id;
                $oddata['product_name'] = $v_content->name;
                $oddata['product_price'] = $v_content->price;
                $oddata['product_sales_quantity'] = $v_content->qty;

                $ordered = DB::table('tbl_order_details')
                    ->insert($oddata);

                if ($ordered) {
                    $product = DB::table('tbl_products')->where('product_id', $oddata['product_id'])->first();

                    $remaining_quantity = $product->product_size - $oddata['product_sales_quantity'];

                    DB::table('tbl_products')->where('product_id', $oddata['product_id'])->update(['product_size' => $remaining_quantity]);
                }

                Cart::destroy();


               if ($pdata['payment_method']=='cod'){
                Cart::destroy();
                Session::put('message','Your Payment by Cash On Delivery!!');
            }elseif ($pdata['payment_method']=='PayPal'){
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
        }

        return Redirect::to('/congratulate');
    }

    //Instant Payment Notifications
    public function notify(Request $request)
    {

        // add _notify-validate cmd to request,
        // we need that to validate with PayPal that it was realy
        // PayPal who sent the request
        $request->merge(['cmd' => '_notify-validate']);
        $post = $request->all();

        // send the data to PayPal for validation
        $response = (string) $this->provider->verifyIPN($post);

        //if PayPal responds with VERIFIED we are good to go
        if ($response === 'VERIFIED') {

            /**
            *This is the part of the code where you can process recurring payments as you like
            *in this case we will be checking for recurring_payment that was completed
            *if we find that data we create new invoice
            */
            if ($post['txn_type'] == 'recurring_payment' && $post['payment_status'] == 'Completed') {

                dd(4);

                $invoice = new Invoice();
                $invoice->title = 'Recurring payment';
                $invoice->price = $post['amount'];
                $invoice->payment_status = 'Completed';
                $invoice->recurring_id = $post['recurring_payment_id'];
                $invoice->save();
            }

            // I leave this code here so you can log IPN data if you want
            // PayPal provides a lot of IPN data that you should save in real world scenarios
            /*
                $logFile = 'ipn_log_'.Carbon::now()->format('Ymd_His').'.txt';
                Storage::disk('local')->put($logFile, print_r($post, true));
            */

        }

    }

}
