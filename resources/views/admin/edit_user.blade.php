@extends('admin_layout')
@section('admin_content')

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit User</h2>
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
                <form class="form-horizontal" method="post" action="{{ URL::to('update_user',$specific_edit_admin->admin_id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">User Name</label>
                            <div class="controls">
                                <input type="text" name="admin_name" value="{{ $specific_edit_admin->admin_name }}" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">User Email</label>
                            <div class="controls">
                                <input type="email" name="admin_email" value="{{ $specific_edit_admin->admin_email }}" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">User Phone</label>
                            <div class="controls">
                                <input type="text" name="admin_phone" value="{{ $specific_edit_admin->admin_phone }}" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>
                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">User Description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="admin_details" id="textarea2" rows="3">
                                    {{ $specific_edit_admin->admin_details }}
                                </textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="fileInput">Image input</label>
                            <div class="controls">
                                <input class="input-file uniform_on"
                                       name="previous_image" value="{{ $specific_edit_admin->admin_image }}" id="fileInput" type="hidden" >
                                <input class="input-file uniform_on" name="admin_image" id="fileInput" type="file">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">User Role</label>
                            <div class="controls">
                                <select name="admin_role" id="">
                                    <option value="">Select Role</option>
                                    <option value="0" <?php if ($specific_edit_admin->admin_role == '0'){ echo " selected";}?> >Admin</option>
                                    <option value="1" <?php if ($specific_edit_admin->admin_role == '1'){ echo " selected";}?> >Author</option>
                                    <option value="2" <?php if ($specific_edit_admin->admin_role == '2'){ echo " selected";}?> >Writter</option>
                                    <option value="3" <?php if ($specific_edit_admin->admin_role == '3'){ echo " selected";}?> >Editor</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update User</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->

 @endsection