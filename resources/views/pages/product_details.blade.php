@extends('layout')

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

            <div class="product-details"><!--product-details-->
                <div class="col-sm-5">
                    <div class="view-product">
                        <img src="{{ URL::to($details_published_product->product_image) }}" alt="" />
                    
                    </div>
                    <div id="similar-product" class="carousel slide" data-ride="carousel">

                        <!-- Controls -->
                        <a class="left item-control" href="#similar-product" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right item-control" href="#similar-product" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
                <div class="col-sm-7">
                    <div class="product-information"><!--/product-information-->
                        
                        <img src="frontend/images/product-details/new.jpg" class="newarrival" alt="" />
                        <h2>{{ $details_published_product->product_name }}</h2>
                        <img src="frontend/images/product-details/rating.png" alt="" />

                        <span>
                            <form action="{{ URL::to('/add_to_cart') }}" method="post">
                                {{ csrf_field() }}
                                <span>{{ $details_published_product->product_price }} Php</span>
                                    <label>Quantity:</label>
                                    <input name="qty" type="number" value="1" />
                                    <input name="product_id" type="hidden" value="{{ $details_published_product->product_id }}" />
                                    <button type="submit" class="btn btn-fefault cart">
                                        <i class="fa fa-shopping-cart"></i>
                                         Add to cart
                                   </button>
                            </form>
                        </span>
                        @if($details_published_product->product_size > 5)
                        <p><b>Availability:<strong>{{ $details_published_product->product_size }}</strong>
                        @else
                        <p style="color: red;"><b>Availability:<strong>{{ $details_published_product->product_size }}</strong>
                        @endif
                        <p><b>Category:</b> {{ $details_published_product->category_name }}</p>
                        <p><b>Brand:</b> {{ $details_published_product->brand_name }}</p>
                        <a href=""><img src="frontend/images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                    </div><!--/product-information-->
                </div>
            </div><!--/product-details-->

        </div><!--features_items-->
        <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li><a href="#details" data-toggle="tab">Details</a></li>
                    <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
                    <li><a href="#tag" data-toggle="tab">Tag</a></li>
                    <li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade" id="details" >
                    <div class="col-sm-12">
                        <p>{{ strip_tags( $details_published_product->product_description )  }}</p>
                    </div>
                </div>

                <div class="tab-pane fade" id="companyprofile" >
                    <div class="col-sm-12">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    </div>
                </div>

                <div class="tab-pane fade" id="tag" >
                    <div class="col-sm-12">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    </div>
                </div>

                <div class="tab-pane fade active in" id="reviews" >
                    <div class="col-sm-12">
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                            <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                            <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <p><b>Write Your Review</b></p>

                        <form action="#">
                                            <span>
                                                <input type="text" placeholder="Your Name"/>
                                                <input type="email" placeholder="Email Address"/>
                                            </span>
                            <textarea name="" ></textarea>
                            <b>Rating: </b> <img src="fronted/images/product-details/rating.png" alt="" />
                            <button type="button" class="btn btn-default pull-right">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div><!--/category-tab-->
    </div>

@endsection
