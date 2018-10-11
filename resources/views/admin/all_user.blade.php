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
                <h2><i class="halflings-icon user"></i><span class="break"></span>All User </h2>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th>Number</th>
                        <th>User Name</th>
                        <th>User Image</th>
                        <th>User Email</th>
                        <th>user Phone</th>
                        <th>User Role</th>
                            <?php
                            $admin_id = Session::get('admin_id');
                            $admin_role = Session::get('admin_role');
                            ?>
                            <?php if ($admin_role == '0'){ ?>
                        <th>Actions</th>
                           <?php } ?>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $number = 1; ?>
                    @foreach($all_user_info as $view_admin)

                    <tr>
                        <td>{{ $number++ }}</td>
                        <td class="center">{{ $view_admin->admin_name }}</td>
                        <td class="center"><img src="{{ URL::to($view_admin->admin_image) }}" alt="no image" style="height: 80px;width: 100px;"></td>
                        <td class="center">{{ $view_admin->admin_email }}</td>
                        <td class="center">{{ $view_admin->admin_phone }}</td>
                        <td class="center">
                         <?php
                            if( $view_admin->admin_role == '0'){
                               echo "Admin";
                            }elseif ( $view_admin->admin_role == '1'){
                                echo "Employee";
                            }elseif ( $view_admin->admin_role == '2'){
                                echo "Editor";
                            }elseif ( $view_admin->admin_role == '3'){
                                echo "Writter";
                            }else{
                                echo "Not Defined";
                            }
                            ?>
                        </td>

                            <?php if ($admin_role == '0'){ ?>

                        <td class="center">

                            <a class="btn btn-info" href="{{ URL::to('edit_user/'. $view_admin->admin_id ) }}">
                                <i class="halflings-icon white edit"></i>
                            </a>
                            <a id="delete" class="btn btn-danger" href="{{ URL::to('delete_admin/'.$view_admin->admin_id ) }}">
                                <i class="halflings-icon white trash" id="delete"></i>
                            </a>
                        </td>
                            <?php } ?>
                    </tr>

                   @endforeach


                    </tbody>
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->

 @endsection