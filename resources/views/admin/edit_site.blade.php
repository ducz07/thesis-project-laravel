@extends('admin_layout')
@section('admin_content')

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit site</h2>
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
                <form class="form-horizontal" method="post" action="{{ URL::to('/update_site') }}" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <fieldset>

                        <div class="control-group">
                            <label class="control-label" for="fileInput">Image Logo</label>
                            <div class="controls">
                                <input class="input-file uniform_on" name="previous_image" value="{{ $specific_edit_site->site_logo }}" id="fileInput" type="hidden" >
                                <input class="input-file uniform_on" name="site_logo" id="fileInput" type="file">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="typeahead">Site Title</label>
                            <div class="controls">
                                <input type="text" name="site_title" value="{{ $specific_edit_site->site_title }}" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="typeahead">site number</label>
                            <div class="controls">
                                <input type="text" value="{{ $specific_edit_site->site_number }}" name="site_number" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">site email</label>
                            <div class="controls">
                                <input type="text" value="{{ $specific_edit_site->site_email }}" name="site_email" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Address</label>
                            <div class="controls">
                                <input type="text" value="{{ $specific_edit_site->site_address }}" name="site_address" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Facebook link</label>
                            <div class="controls">
                                <input type="text" value="{{ $specific_edit_site->site_fb }}" name="site_fb" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Twitter Link</label>
                            <div class="controls">
                                <input type="text" value="{{ $specific_edit_site->site_tw }}" name="site_tw" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Linked in</label>
                            <div class="controls">
                                <input type="text" value="{{ $specific_edit_site->site_ln }}" name="site_ln" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Youtube Channel</label>
                            <div class="controls">
                                <input type="text" value="{{ $specific_edit_site->site_yt }}" name="site_yt" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Copyright by</label>
                            <div class="controls">
                                <input type="text" value="{{ $specific_edit_site->site_copyright }}" name="site_copyright" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update site</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->

 @endsection