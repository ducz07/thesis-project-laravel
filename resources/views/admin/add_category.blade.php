@extends('admin_layout')
@section('admin_content')

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Category</h2>
            </div>
            <div class="box-content">
                <p style="color: green;font-size: 15px; font-weight: bold;">
                    <?php
                    $message = Session::get('message');
                    if ($message){
                        echo $message;
                        Session::put('message',null);
                    }
                    ?>
                </p>

                @if(count($errors)>0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-dismissible alert-danger">
                            <button type="button" class="close" data-dismiss="alert alert-danger">×</button>
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <form class="form-horizontal" method="post" action="{{ URL::to('save_category') }}" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Category Name</label>
                            <div class="controls">
                                <input type="text" name="category_name" class="span6 typeahead" id="typeahead" required>
                            </div>
                        </div>

                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">Category Description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="category_description" id="textarea2" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="publication_status">Publication Status :</label>
                            <div class="controls">
                                <input type="checkbox"  name="publication_status" class="input-xlarge" id="publication_status" value="1">Publish
                                <input type="checkbox"  name="publication_status" class="input-xlarge" id="publication_status" value="0">Not Publish
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Add Category</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->

 @endsection