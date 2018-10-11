@extends('layout')
@section('content')

    <div class="col-sm-8 col-sm-offset-3 padding-right" style="margin-bottom: 100px">
        <section id="cart_items">

    @if (Session::has('message'))
     <div class="alert alert-{{ Session::get('code') }}">
      <p>{{ Session::get('message') }}</p>
     </div>
    @endif

            <div class="review-payment">
                <h2>Select Your Payment Option</h2>
            </div>
                <div class="btn-group">
                    <form action="{{ URL::to('/order_place') }}" method="post">
                        {{ csrf_field() }}
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                   <!--  <img src="frontend/images/home/iframe1.png" alt="" /><br> -->
                                    Pay Php{{ $total }} via: <button type="submit" name="payment_method" value="cod" id="cod" class="btn btn-warning">Cash On Delivery</button><label class="control-label" for="cod"></label>
                                </div>
                                <div class="col-sm-8">
                                    <!-- <img src="frontend/images/home/iframe4.png" alt="" /><br> -->
                                    Pay Php{{ $total }} via: <a href="{{ url('paypal/express-checkout') }}/{{ $total }}" class='btn-info btn'>PayPal</a>
                                </div>
                                <!-- <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary">Done</button>
                                </div> -->
                            </div>
                        </div>
                    </form>
                </div>
        </section> <!--/#cart_items-->
    </div>

@endsection
