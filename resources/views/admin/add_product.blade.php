@extends('admin_layout')
@section('admin_content')

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add product</h2>
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
                <form class="form-horizontal" method="post" action="{{ URL::to('save_product') }}" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">product Name</label>
                            <div class="controls">
                                <input type="text" name="product_name" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Category Name</label>
                            <div class="controls">
                                <select name="category_id" id="" required>
                                    <option>Select category</option>

                                    <?php
                                    $all_published_category = DB::table('tbl_category')
                                        ->where('publication_status',1)
                                        ->get();
                                    foreach ($all_published_category as $view_category){
                                        ?>
                                    <option value="{{ $view_category->category_id }}">{{ $view_category->category_name }}</option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Brand Name</label>
                            <div class="controls">
                                <select name="brand_id" id="" required>
                                    <option>Select brand</option>

                                    <?php
                                    $all_published_brand = DB::table('tbl_brand')
                                        ->where('publication_status',1)
                                        ->get();
                                    foreach ($all_published_brand as $view_brand){
                                        ?>
                                    <option value="{{ $view_brand->brand_id }}">{{ $view_brand->brand_name }}</option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">Product Description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="product_description" id="textarea2" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Product Price</label>
                            <div class="controls">
                                <input type="text" name="product_price" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="fileInput">Image input</label>
                            <div class="controls">
                                <input class="input-file uniform_on" name="product_image" id="fileInput" type="file" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Product quantity</label>
                            <div class="controls">
                                <input type="text" name="product_size" class="span6 typeahead" id="typeahead"  required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Product Color</label>
                            <div class="controls">
                                <input type="text" name="product_color" class="span6 typeahead" id="typeahead"  required>
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
                            <button type="submit" class="btn btn-primary">Add product</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->

 @endsection