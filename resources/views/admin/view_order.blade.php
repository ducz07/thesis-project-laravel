@extends('admin_layout')
@section('admin_content')

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>Customer Details </h2>
            </div>
            <div>
                <table class="table table-striped table-bordered ">
                    <thead>
                    <tr>
                        <th>Customer name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($order_by_id as $order_details_by_id)
                    @endforeach

                    <tr>
                        <td class="center">{{ $order_details_by_id->customer_name }}</td>
                        <td class="center">{{ $order_details_by_id->mobile_number }}</td>
                        <td class="center">{{ $order_details_by_id->customer_email }}</td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div><!--/span-->
    </div><!--/row-->
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon road"></i><span class="break"></span>Delivery Address </h2>
            </div>
            <div>
                <table class="table table-striped table-bordered ">
                    <thead>
                    <tr>
                        <th>User name</th>
                        <th>Address</th>
                        <th>Mobile</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($order_by_id as $order_details_by_id)
                    @endforeach

                    <tr>
                        <td class="center">{{ $order_details_by_id->shipping_first_name }} {{ $order_details_by_id->shipping_last_name }}</td>
                        <td class="center">{{ $order_details_by_id->shipping_address }}</td>
                        <td class="center">{{ $order_details_by_id->shipping_mobile_number }}</td>
                        <td class="center">{{ $order_details_by_id->shipping_email }}</td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div><!--/span-->
    </div><!--/row-->
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon briefcase"></i><span class="break"></span><span style="color: red">{{ $order_details_by_id->order_status }}</span>  All order Details</h2>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th>Number</th>
                        <th>product Name</th>
                        <th>Product price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $number = 1; ?>
                    <?php
                    $sum = 0;
                    foreach($order_by_id as $order_details_by_id){
                         ?>
                        <tr>
                            <td>{{ $number++ }}</td>
                            <td class="center">{{ $order_details_by_id->product_name }}</td>
                            <td class="center">{{ $order_details_by_id->product_price }} Php</td>
                            <td class="center">{{ $order_details_by_id->product_sales_quantity }}</td>
                            <td class="center">{{ $order_details_by_id->product_price * $order_details_by_id->product_sales_quantity }} Php</td>
                        </tr>

                    <?php
                    $subtotal = $order_details_by_id->product_price * $order_details_by_id->product_sales_quantity;
                        $sum = $sum+$subtotal;

                    }?>
                        <tfoot>
                            <tr>
                                <td colspan="4">Total</td>
                                <td style="font-weight: bold">{{ $sum }} Php</td>
                            </tr>
                        </tfoot>

                    </tbody>
                </table>
            </div>
            <div class="form-actions">
                <a href="{{ URL::to('/done_order/'. $order_details_by_id->order_id ) }}" class="btn btn-primary">DONE</a>
                <a href="{{ URL::to('/manage_order') }}" class="btn btn-primary">BACK</a>
            </div>
        </div><!--/span-->

    </div><!--/row-->


 @endsection