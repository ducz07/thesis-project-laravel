@extends('layout')


@section('content')

    <div class="col-sm-12 padding-right">
        <section id="cart_items">
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
                      <?php $contents = Cart::content();?>
                      <?php foreach ($contents as $v_contents){?>
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{ URL::to($v_contents->options->image) }}" alt="" height="80px" width="80px"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $v_contents->name }}</a></h4>
                            <p>{{ $v_contents->id }}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{ $v_contents->price }} Php</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{ URL::to('/update_cart') }}" method="post">
                                {{ csrf_field() }}
                                    <input class="cart_quantity_input" type="number" name="qty" value="{{ $v_contents->qty }}" autocomplete="off" size="2">
                                    <input type="hidden" name="rowId" value="{{ $v_contents->rowId }}">
                                    <input type="submit" name="submit" value="update" class="btn btn-sm btn-default">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{ $v_contents->total }} Php</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{ URL::to('/delete_to_cart/'. $v_contents->rowId) }}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </section> <!--/#cart_items-->

        <section id="do_action">
            <div class="heading">
                <h3>What would you like to do next?</h3>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>{{ Cart::subtotal() }} Php</span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span>{{ Cart::total() }} Php</span></li>
                        </ul>
                        <?php  $customer_id = Session::get('customer_id');
                               $Php = Cart::total();?>
                            <?php
                            if (empty($customer_id) && $Php>0){?>
                        <a class="btn btn-default check_out" href="{{ URL::to('/login_check') }}">Check Out</a>
                        <?php }elseif(!empty($customer_id) && $Php>0){?>
                        <a class="btn btn-default check_out" href="{{ URL::to('/checkout') }}">Check Out</a>
                        <?php }else{?>
                        <a class="btn btn-default check_out" href="{{ URL::to('/') }}">Cart Empty</a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </section><!--/#do_action-->
    </div>

@endsection
