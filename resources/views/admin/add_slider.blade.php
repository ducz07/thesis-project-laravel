@extends('admin_layout')
@section('admin_content')

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add slider</h2>
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
                <form class="form-horizontal" method="post" action="{{ URL::to('save_slider') }}" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <fieldset>
                    <div class="control-group">
                            <label class="control-label" for="fileInput">Slider Image</label>
                            <div class="controls">
                                <input class="input-file uniform_on" name="slider_image" id="fileInput" type="file" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="publication_status">Publication Status :</label>
                            <div class="controls">
                                <input type="checkbox"  name="publication_status" class="input-xlarge" id="publication_status" value="1" required>Publish
                                <input type="checkbox"  name="publication_status" class="input-xlarge" id="publication_status" value="0">Not Publish
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Add Slider</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->

 @endsection