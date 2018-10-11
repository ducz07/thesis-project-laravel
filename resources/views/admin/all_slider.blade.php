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
                <h2><i class="halflings-icon user"></i><span class="break"></span>All SLider </h2>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th>Slider id</th>
                        <th>Slider image</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    
                    @foreach( $all_slider as $view_slider )
                        <tr>
                            
                            <td class="center">{{ $view_slider->slider_id }}</td>
                            <td class="center"><img src="{{ URL::to($view_slider->slider_image) }}" alt="no image" style="height: 80px;width: 100px;"></td>
                            <td class="center">
                                @if($view_slider->publication_status == 0)
                                    <span class="label label-warning">{{ 'not active' }}</span>
                                @elseif($view_slider->publication_status == 1)
                                    <span class="label label-success">{{ 'active' }}</span>
                                @else
                                    <span class="label label-info">{{ 'Not Defined' }}</span>
                                @endif
                            </td>
                            <td class="center">

                                @if($view_slider->publication_status == 0)
                                    <a class="btn btn-warning" href="{{ URL::to('/active_product/'. $view_slider->slider_id ) }}">
                                        <i class="halflings-icon white thumbs-down"></i>
                                    </a>
                                @else
                                    <a class="btn btn-success" href="{{ URL::to('unactive_product/'. $view_slider->slider_id ) }}">
                                        <i class="halflings-icon white thumbs-up"></i>
                                    </a>
                                @endif
                                <a id="delete" class="btn btn-danger" href="{{ URL::to('delete_slider/'. $view_slider->slider_id ) }}">
                                    <i class="halflings-icon white trash" id="delete"></i>
                        
                            </td>
                        </tr>

                    @endforeach


                    </tbody>
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->

@endsection