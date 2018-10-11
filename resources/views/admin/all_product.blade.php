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
                <h2><i class="halflings-icon user"></i><span class="break"></span>All product </h2>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th>Number</th>
                        <th>product Name</th>
                        <th>Stock quantity</th>
                        <th>Image</th>
                        <th>Category Name</th>
                        <th>Brand Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $number = 1; ?>
                    @foreach($all_product_info as $view_product)

                    <tr>
                        <td>{{ $number++ }}</td>
                        <td class="center">{{ $view_product->product_name }}</td>
                        @if($view_product->product_size > 5)
                        <td class="center">{{ $view_product->product_size }}</td>
                        @else
                        <td class="center" style="color: red;">{{ $view_product->product_size }}</td>
                        @endif
                        <td class="center"><img src="{{ URL::to($view_product->product_image) }}" alt="no image" style="height: 80px;width: 100px;"></td>
                        <td class="center">{{ $view_product->category_name }}</td>
                        <td class="center">{{ $view_product->brand_name }}</td>
                        <td class="center">{{ $view_product->product_price }} Php</td>
                        <td class="center">
                            @if($view_product->publication_status == 0)
                                <span class="label label-warning">{{ 'not active' }}</span>
                            @elseif($view_product->publication_status == 1)
                                <span class="label label-success">{{ 'active' }}</span>
                            @else
                                <span class="label label-info">{{ 'Not Defined' }}</span>
                            @endif
                        </td>
                        <td class="center">

                            @if($view_product->publication_status == 0)
                               <a class="btn btn-warning" href="{{ URL::to('/active_product/'. $view_product->product_id ) }}">
                                  <i class="halflings-icon white thumbs-down"></i>
                                </a>
                            @else
                                <a class="btn btn-success" href="{{ URL::to('unactive_product/'. $view_product->product_id ) }}">
                                    <i class="halflings-icon white thumbs-up"></i>
                                </a>
                            @endif

                            <a class="btn btn-info" href="{{ URL::to('edit_product/'. $view_product->product_id ) }}">
                                <i class="halflings-icon white edit"></i>
                            </a>
                            <a id="delete" class="btn btn-danger" href="{{ URL::to('delete_product/'. $view_product->product_id ) }}">
                                <i class="halflings-icon white trash" id="delete"></i>
                            </a>
                                @if($view_product->product_slider == 0)
                                    <a class="btn btn-warning" href="{{ URL::to('/active_slider/'. $view_product->product_id ) }}">
                                        <i class="halflings-icon white exclamation-sign"></i>
                                    </a>
                                @else
                                    <a class="btn btn-success" href="{{ URL::to('unactive_slider/'. $view_product->product_id ) }}">
                                        <i class="halflings-icon white ok"></i>
                                    </a>
                                @endif
                        </td>
                    </tr>

                   @endforeach


                    </tbody>
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->

 @endsection