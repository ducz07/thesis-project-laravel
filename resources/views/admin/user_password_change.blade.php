@extends('admin_layout')
@section('admin_content')

<div class="row-fluid sortable">
    <div class="box span8">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>User password Change</h2>
        </div>
        <div class="box-content">
            @if(count($errors)>0)
                @foreach($errors->all() as $error)
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert alert-danger">×</button>
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            <p style="color: green;font-size: 15px; font-weight: bold;">
                <?php
                $message = Session::get('message');
                if ($message){
                    echo $message;
                    Session::put('message',null);
                }
                ?>
            </p>
            <form class="form-horizontal" method="post" action="{{ URL::to('user_password_update',$user_password_change->admin_id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <fieldset>
                    <div class="control-group">
                        <div class="controls">
                            <input type="hidden" name="data_pass" value="{{ $user_password_change->admin_password }}" class="span6 typeahead" id="typeahead"  required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Old Password</label>
                        <div class="controls">
                            <input type="text" name="old_pass" class="span6 typeahead" id="typeahead"  required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">New Password</label>
                        <div class="controls">
                            <input type="text" name="new_pass" class="span6 typeahead" id="typeahead"  required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Confirm Password</label>
                        <div class="controls">
                            <input type="text" name="confirm_pass" class="span6 typeahead" id="typeahead"  required>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Update Password</button>
                        <button type="reset" class="btn">Cancel</button>
                    </div>
                </fieldset>
            </form>

        </div>
    </div><!--/span-->
    <div class="box span4">
        <div class="box-content">
            <div class="control-group">
                <label class="control-label" for="typeahead"></label>
                <div class="controls">
                    <img src="{{ URL::to($user_password_change->admin_image) }}" alt="no image">
                </div>
            </div>
        </div>
    </div><!--/span-->

</div><!--/row-->

 @endsection