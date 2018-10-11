@extends('layout')

@section('content')
    <div class="col-sm-12 padding-right">
        <section id="cart_items">
            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-12 clearfix">
                        <div class="bill-to">
                            <p>Delivery Details</p>
                            <div class="form-one">
                                @if(count($errors)>0)
                                    @foreach($errors->all() as $error)
                                        <p class="alert alert-danger">{{$error}}</p>
                                    @endforeach

                                @endif
                                <form action="{{ URL::to('/save_shipping') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="text" placeholder="Email*" name="shipping_email" required>
                                    <input type="text" placeholder="First Name *" name="shipping_first_name" required>
                                    <input type="text" placeholder="Last Name *" name="shipping_last_name" required>
                                    <input type="text" placeholder="Address" name="shipping_address" required>
                                    <input type="text" placeholder="Mobile Number" name="shipping_mobile_number" required>
                                    <input type="text" placeholder="Current Address" name="shipping_city" required>
                                    <input type="submit" value="DONE" class="btn btn-default">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="review-payment">
                <h2>Review & Payment</h2>
            </div>

            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $contents = Cart::content();
                    foreach ($contents as $v_contents){?>
                    <tr>
                        <td class="cart_product">
                            <a href=""><img  src="{{ URL::to($v_contents->options->image) }}" alt="" height="80px" width="80px"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $v_contents->name }}</a></h4>
                            <p>Product ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>{{ $v_contents->price }} Php</p>
                        </td>
                        <td class="cart_price">
                            <p>{{ $v_contents->qty }}</p>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{ $v_contents->total }} Php</p>
                        </td>
                    </tr>
                    <?php }?>


                    <tr>
                        <td colspan="3">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td>{{ Cart::subtotal() }} Php</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Delivery Cost</td>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span>{{ Cart::total() }} Php</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section> <!--/#cart_items-->
    </div>

@endsection
