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
                <h2><i class="halflings-icon user"></i><span class="break"></span>All brand </h2>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th>Number</th>
                        <th>brand Name</th>
                        <th>brand Details</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $number = 1; ?>
                    @foreach($all_brand_info as $view_brand)

                    <tr>
                        <td>{{ $number++ }}</td>
                        <td class="center">{{ $view_brand->brand_name }}</td>
                        <td class="center">{{strip_tags($view_brand->brand_description )  }}</td>
                        <td class="center">
                            @if($view_brand->publication_status == 0)
                                <span class="label label-warning">{{ 'not active' }}</span>
                            @elseif($view_brand->publication_status == 1)
                                <span class="label label-success">{{ 'active' }}</span>
                            @else
                                <span class="label label-info">{{ 'Not Defined' }}</span>
                            @endif


                        </td>
                        <td class="center">

                            @if($view_brand->publication_status == 0)
                               <a class="btn btn-warning" href="{{ URL::to('/active_brand/'. $view_brand->brand_id ) }}">
                                  <i class="halflings-icon white thumbs-down"></i>
                                </a>
                            @else
                                <a class="btn btn-success" href="{{ URL::to('unactive_brand/'. $view_brand->brand_id ) }}">
                                    <i class="halflings-icon white thumbs-up"></i>
                                </a>
                            @endif

                            <a class="btn btn-info" href="{{ URL::to('edit_brand/'. $view_brand->brand_id ) }}">
                                <i class="halflings-icon white edit"></i>
                            </a>
                            <a id="delete" class="btn btn-danger" href="{{ URL::to('delete_brand/'. $view_brand->brand_id ) }}">
                                <i class="halflings-icon white trash" id="delete"></i>
                            </a>
                        </td>
                        </td>
                    </tr>

                   @endforeach


                    </tbody>
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->

 @endsection