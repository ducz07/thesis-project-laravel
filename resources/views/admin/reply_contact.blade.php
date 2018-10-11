@extends('admin_layout')
@section('admin_content')

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Reply Contact</h2>
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
                <form class="form-horizontal" method="post" action="#" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">To :</label>
                            <div class="controls">
                                <input type="text" name="email" value="{{ $specific_show_contact->contact_email }}" class="span6 typeahead" id="typeahead" readonly  required>
                            </div>
                        </div>
                            <?php
                            $site_details = DB::table('tbl_site')
                                ->where('site_id',1)
                                ->get();
                            foreach($site_details as $view_site_details)
                                ?>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">From :</label>
                            <div class="controls">
                                <input type="text" name="email" value="{{ $view_site_details->site_email }}" class="span6 typeahead" id="typeahead" readonly  required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="typeahead">Subject :</label>
                            <div class="controls">
                                <input type="text" name="subject" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>
                        
                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">Description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="message" id="textarea2" rows="3" required>
                                </textarea>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Send</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->

 @endsection