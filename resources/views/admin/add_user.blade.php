@extends('admin_layout')
@section('admin_content')

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add User</h2>
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
                <form class="form-horizontal" method="post" action="{{ URL::to('save_admin') }}" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">User Name</label>
                            <div class="controls">
                                <input type="text" name="admin_name" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">User Email</label>
                            <div class="controls">
                                <input type="email" name="admin_email" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">User Password</label>
                            <div class="controls">
                                <input type="password" name="admin_password" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">User Phone</label>
                            <div class="controls">
                                <input type="text" name="admin_phone" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>
                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">User Description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="admin_details" id="textarea2" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="fileInput">Image input</label>
                            <div class="controls">
                                <input class="input-file uniform_on" name="admin_image" id="fileInput" type="file">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">User Role</label>
                            <div class="controls">
                                <select name="admin_role" id="">
                                    <option value="5">Select Role</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Employee</option>
                                    {{-- <option value="2">Writter</option>
                                    <option value="3">Editor</option> --}}
                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Add User</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->

 @endsection