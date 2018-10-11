@extends('layout')

@section('slider')

    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php
                            $all_slider=DB::table('tbl_slider')->get();
                            ?>
                            @foreach( $all_slider as $view_slider )
                                <li data-target="#slider-carousel" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>

                        <div class="carousel-inner">
                            <?php
                                $i=1;
                                foreach ($all_slider as $view_slider){
                                if ($i==1){
                                    echo '<div class="item active">';
                                }else{
                                    echo '<div class="item">';
                                }?>
                            <div class="col-sm-6">
                                <h1>Ronmar Furniture</h1>
                                <!-- <h2>{{ $view_slider->slider_id }}</h2> -->
                               <!--  <a href="{{ URL::to('/product_details/'.$view_slider->slider_id) }}"><button type="button" class="btn btn-default get">Get it now</button></a> -->
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ URL::to( $view_slider->slider_image ) }}" class="girl img-responsive" alt="" width="100%" />
                                <!-- <div class="pricing" style="background-color: #E74C3C;height: 40%;width: 35%;border-radius: 50%;text-align: center;">
                                    <div style="background-color: #FE980F;height: 83%; width: 83%;border-radius: 50%; text-align: center;margin-top: 15px;margin-left: 15px;">
                                        <div style="background-color: #F0F0E9;height: 66%;width: 66%;border-radius: 50%;margin-left: 15px;position: absolute; margin-top: 15px;">
                                            <h2 style="text-align: center;color: #E74C3C;font-weight: bold;margin-top: 28%;margin-bottom: 0%;">ONLY</h2>
                                        </div>
                                    </div>
                                </div> -->
                                {{--<img src="{{ URL::to('frontend/images/home/pricing.png') }}"  class="pricing" alt="" />--}}
                            </div>
                        </div>
                        <?php $i++;}?>

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </section><!--/slider-->

@endsection

@section('catbrand')
    <div class="col-sm-3">
        <div class="left-sidebar">
            <h2>Category</h2>
            <div class="panel-group category-products" id="accordian"><!--category-productsr-->

                <?php
                $all_published_category = DB::table('tbl_category')
                    ->where('publication_status',1)
                    ->get();
                foreach ($all_published_category as $view_category){
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="{{ URL::to('/product_by_category/'.$view_category->category_id) }}">{{ $view_category->category_name }} (

                            @php
                            $id = $view_category->category_id;
                            $subproduct = DB::table('tbl_products')
                                        ->where('tbl_products.publication_status',1)
                                        ->where('tbl_products.category_id',$id)
                                       ->count('category_id');
                        @endphp
                        {{ $subproduct }}

                        )</a></h4>
                    </div>
                </div>
                <?php
                }
                ?>

            </div><!--/category-products-->

            <div class="brands_products"><!--brands_products-->
                <h2>Brands</h2>
                <div class="brands-name">
                    <ul class="nav nav-pills nav-stacked">

                        <?php
                        $all_published_brand = DB::table('tbl_brand')
                            ->where('publication_status',1)
                            ->get();
                        foreach ($all_published_brand as $view_brand){
                        ?>
                        <li><a href="{{ URL::to('/product_by_brand/'.$view_brand->brand_id) }}">{{ $view_brand->brand_name }}</a></li>
                        <?php
                        }
                        ?>

                    </ul>
                </div>
            </div><!--/brands_products-->

            <div class="price-range"><!--price-range-->
                <h2>Price Range</h2>
                @php
                    $minprice = DB::table('tbl_products')->min('product_price');
                    $minlevel =$minprice+10;
                    $maxprice = DB::table('tbl_products')->max('product_price');
                    $maxlevel =$maxprice-20;
                @endphp
                <div class="well text-center">
                    <form action="{{ URL::to('/price_range') }}" method="get">
                        {{ csrf_field() }}
                        <input type="text" class="span2" name="price_range" value="0,600" data-slider-min="{{ $minprice }}" data-slider-max="{{ $maxprice }}" data-slider-step="5" data-slider-value="[{{ $minlevel }},{{ $maxlevel }}]" id="sl2" ><br />
                        <b class="pull-left"> {{ $minprice }}</b> <b class="pull-right">{{ $maxprice }}</b>
                        <input type="submit" value="FILTER" class="btn btn-info" style="margin: 15px"/>
                    </form>
                </div>
            </div><!--/price-range-->


        </div>
    </div>
@endsection

@section('content')

    <div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Featured Items</h2>

        <?php
        foreach ($all_published_product as $view_product){
            ?>

        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{ URL::to( $view_product->product_image ) }}" alt="" />
                        <h2>{{ $view_product->product_price }} Php</h2>
                        <p>{{ $view_product->product_name }}</p>
                        @if($view_product->product_size > 5)
                        <p><strong>Stock : {{ $view_product->product_size }}</strong></p>
                        @else
                        <p style="color: red;"><strong>Stock : {{ $view_product->product_size }}</strong></p>
                        @endif
                        <a href="{{ URL::to('/product_details/'.$view_product->product_id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{ $view_product->product_price }} Php</h2>
                            <p>{{ $view_product->product_name }}</p>
                            <a href="{{ URL::to('/product_details/'.$view_product->product_id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        {{--<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>--}}
                        <li><a href="{{ URL::to('/product_details/'.$view_product->product_id) }}"><i class="fa fa-plus-square"></i>View Details</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <?php
        }
        ?>

    </div><!--features_items-->
        {{ $all_published_product->links() }} <!--pagination-->


    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">Recommended Products</h2>
        <div class="row">
            <div class="col-sm-12">
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">

                <?php
                $all_product=DB::table('tbl_products')
                    ->get();
                $i=1;
                foreach ($all_product as $view){
                    if ($i==1){
                        echo '<div class="item active">';
                    }else{
                        echo '<div class="item">';
                    }
                    ?>


                  <?php
                    $all_published_product=DB::table('tbl_products')
                        ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                        ->join('tbl_brand','tbl_products.brand_id','=','tbl_brand.brand_id')
                        ->select('tbl_products.*','tbl_category.category_name','tbl_brand.brand_name')
                        ->where('tbl_products.publication_status',1)
                        ->orderByRaw("RAND()")
                        ->limit(3)
                        ->get();

                    foreach ($all_published_product as $views_product){?>

                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ URL::to( $views_product->product_image) }}" alt="" />
                                    <h2>{{ $views_product->product_price }} Php</h2>
                                    <p>{{ $views_product->product_name }}</p>
                                     @if($view_product->product_size > 5)
                        <p><strong>Stock : {{ $view_product->product_size }}</strong></p>
                        @else
                        <p style="color: red;"><strong>Stock : {{ $view_product->product_size }}</strong></p>
                        @endif
                                    <a href="{{ URL::to('/product_details/'.$views_product->product_id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>

                   <?php } ?>

                </div>
            <?php $i++;}?>

            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
        </div>
    </div>
    </div><!--/recommended_items-->


@endsection
