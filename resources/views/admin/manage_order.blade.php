@extends('admin_layout')
@section('admin_content')

    <div class="row-fluid sortable">
        <div class="box span12">
            <p style="color: green;font-size: 15px; font-weight: bold;">
                <?php
                $message = Session::get('message');
                if ($message){
                    echo $message;
                    Session::put('message',null);
                }
                ?>
            </p>
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All order </h2>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th>Number</th>
                        <th>Customer Name</th>
                        <th>Contact No.</th>
                        <th>Address to Deliver</th>
                        <th>Product name</th>
                        <th>Ordered quantity</th>
                        <th>Payment method</th>
                        <th>Total Amount</th>
                        <th>Order Status</th>
                        <th>Payment Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $number = 1; ?>
                    @foreach($all_order_info as $view_order)

                    <tr>
                        <td>{{ $number++ }}</td>
                        <td class="center">{{ $view_order->customer_name }}</td>
                        <td class="center">{{ $view_order->mobile_number }}</td>
                        <td class="center">{{ $view_order->shipping_city }}</td>
                        <td class="center">{{ $view_order->product_name }}</td>
                        <td class="center">{{ $view_order->product_sales_quantity }}</td>
                        <td class="center">{{ $view_order->payment_method }}</td>
                        <td class="center">{{ $view_order->order_total }} Php</td>
                        <td class="center">
                            @if($view_order->order_status == 'pending')
                                <span class="label label-warning">{{ 'pending' }}</span>
                            @elseif($view_order->order_status == 'done')
                                <span class="label label-success">{{ 'done' }}</span>
                            @else
                                <span class="label label-info">{{ 'Not Defined' }}</span>
                            @endif
                        </td>
                        <td class="center">
                            @if($view_order->payment_status == 'pending')
                                <span class="label label-warning">{{ 'pending' }}</span>
                            @elseif($view_order->payment_status == 'done')
                                <span class="label label-success">{{ 'done' }}</span>
                            @else
                                <span class="label label-info">{{ 'Not Defined' }}</span>
                            @endif
                        </td>

                        <td class="center">
                            @if($view_order->order_status == 'pending')
                               <a class="btn btn-warning" href="{{ URL::to('/done_order/'. $view_order->order_id ) }}">
                                  <i class="halflings-icon white thumbs-down"></i>
                                </a>
                            @else
                                <a class="btn btn-success" href="{{ URL::to('pending_order/'. $view_order->order_id ) }}">
                                    <i class="halflings-icon white thumbs-up"></i>
                                </a>
                            @endif

                            @if($view_order->order_status == 'pending')
                                <a class="btn btn-warning" href="{{ URL::to('view_pending_order/'.$view_order->customer_id ) }}">
                                    <i class="halflings-icon white bookmark"></i>
                                </a>
                            @else
                                <a class="btn btn-success" href="{{ URL::to('view_done_order/'.$view_order->customer_id ) }}">
                                    <i class="halflings-icon white bookmark"></i>
                                </a>
                            @endif

                            @if($view_order->payment_status == 'pending')
                                <a class="btn btn-warning" href="{{ URL::to('pending_payment/'.$view_order->payment_id ) }}">
                                    <i class="halflings-icon white shopping-cart"></i>
                                </a>
                            @else
                                <a class="btn btn-success" href="{{ URL::to('done_payment/'.$view_order->payment_id ) }}">
                                    <i class="halflings-icon white check"></i>
                                </a>
                            @endif

                            <a id="delete" class="btn btn-danger" href="{{ URL::to('delete_order/'. $view_order->order_id ) }}">
                                <i class="halflings-icon white trash" id="delete"></i>
                            </a>
                        </td>

                    </tr>

                   @endforeach


                    </tbody>
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->

 @endsection