@extends('admin_layout')
@section('admin_content')

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Update brand</h2>
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
                <form class="form-horizontal" method="post" action="{{ URL::to('/update_brand',$specific_edit_brand->brand_id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">brand Name</label>
                            <div class="controls">
                                <input type="text" name="brand_name" class="span6 typeahead" id="typeahead" value="{{ $specific_edit_brand->brand_name }}"  required>
                            </div>
                        </div>

                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">brand Description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="brand_description" id="textarea2" rows="3" required> {{ $specific_edit_brand->brand_description }}</textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update brand</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->

 @endsection