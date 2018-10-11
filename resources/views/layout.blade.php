<?php
$site_details = DB::table('tbl_site')
    ->where('site_id',1)
    ->get();
foreach($site_details as $view_site_details)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Ronmar Furniture</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{ asset('frontend/js/html5shiv.js')}}"></script>
    <script src="{{ asset('frontend/js/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ URL::to('images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ URL::to('images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ URL::to('images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ URL::to('images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ URL::to('images/ico/apple-touch-icon-57-precomposed.png') }}">
</head><!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> {{ $view_site_details->site_number }}</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> {{ $view_site_details->site_email }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div style="margin-top: 8px; font-size: 12px;">
                            <?php
                            $datetime = date("d-m-Y, l , h:i a");
                            $utc = new DateTime($datetime, new DateTimeZone('UTC'));
                            $utc->setTimezone(new DateTimeZone('Asia/Dhaka'));
                            echo $utc->format('d-m-Y, l , h:i a');
                            ?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ URL::to( $view_site_details->site_fb ) }}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{ URL::to( $view_site_details->site_tw ) }}"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="{{ URL::to( $view_site_details->site_ln ) }}"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="{{ URL::to( $view_site_details->site_ln ) }}"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="{{ URL::to( $view_site_details->site_ln ) }}"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <h1>Ronmar Furniture</h1>
                        {{-- <a href="{{ config("url") }}"><img src="{{ URL::to( $view_site_details->site_logo ) }}" alt="" /></a> --}}
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            {{--<li><a href="#"><i class="fa fa-user"></i> Account</a></li>--}}
                                <?php  $customer_id = Session::get('customer_id');
                                       $shipping_id = Session::get('shipping_id');
                                       $Tk = Cart::total(); ?>
                                <?php if ( $customer_id != NULL && $shipping_id==NULL && $Tk>0){?>
                            <li><a href="{{ URL::to('/checkout') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <?php }elseif($customer_id != NULL && $shipping_id != NULL && $Tk>0){?>
                            <li><a href="{{ URL::to('/payment') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <?php }elseif($Tk>0){?>
                            <li><a href="{{ URL::to('/login_check') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <?php }else{?>
                            <li><a href="{{ URL::to('/') }}"><i class="fa fa-crosshairs"></i>Empty Cart</a></li>
                                <?php }?>

                                <?php if ($Tk>0){?>
                            <li><a href="{{ URL::to('/show_cart') }}"><i class="fa fa-shopping-cart"></i>Cart ( {{ Cart::total() }} ) </a></li>
                                <?php }?>

                                <?php if (empty($customer_id)){?>
                            <li><a href="{{ URL::to('/login_check') }}"><i class="fa fa-lock"></i>Login</a></li>
                                <?php }else{?>
                            <li><a href="{{ URL::to('/customer_logout') }}"><i class="fa fa-lock"></i>Logout</a></li>
                                <?php }?>
                            {{-- <li><a href="{{ URL::to('/contact_form') }}"><i class="fa fa-user"></i> Contact </a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{ URL::to('/') }}" class="active">Home</a></li>
                            {{-- <li><a href="{{ URL::to('/contact_form') }}">Contact</a></li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <form action="{{ URL::to('/search') }}" method="get">
                            {{ csrf_field() }}
                            <input type="text"  name="search" placeholder="Search"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->

@yield('slider')

<section>
    <div class="container">
        <div class="row">

            @yield('catbrand')
            @yield('content')

        </div>
    </div>
</section>

<footer id="footer"><!--Footer-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="companyinfo">
                        <h2>{{ ( $view_site_details->site_title ) }}</h2>
                        <p>{{ ( $view_site_details->site_address ) }}</p>
                    </div>
                </div>
                <!-- <div class="col-sm-7">
                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="{{ URL::to('frontend/images/home/iframe1.png') }}" alt="" />
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div> -->

                    <!-- <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="{{ URL::to('frontend/images/home/iframe2.png') }}" alt="" />
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div> -->

                    <!-- <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="{{ URL::to('frontend/images/home/iframe3.png') }}" alt="" />
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div> -->

                    <!-- <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="{{ URL::to('frontend/images/home/iframe4.png') }}" alt="" />
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>
                </div>-->
                <div class="col-sm-3">
                    <div class="address">
                        <img src="{{ URL::to('frontend/images/home/map.png') }}" alt="" />
                        <p>Banatayan Island, Cebu, Philippines</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Services</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Online Help</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Order Status</a></li>
                            <li><a href="#">Change Location</a></li>
                            <li><a href="#">FAQ’s</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Policies</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privecy Policy</a></li>
                            <li><a href="#">Refund Policy</a></li>
                            <li><a href="#">Billing System</a></li>
                            <li><a href="#">Ticket System</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>About Ronmar Furniture</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Store Information</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Store Location</a></li>
                            <li><a href="#">Affillate Program</a></li>
                            <li><a href="#">Copyright</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="single-widget">
                        <h2>About Costumers</h2>
                        <form action="#" class="searchform">
                            <input type="text" placeholder="Your email address" />
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                            <p>Get the most recent updates from <br />our site and be updated your self...</p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright by © {{ $view_site_details->site_copyright }} Inc. All rights reserved.</p>
                <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->



<script src="{{ asset('frontend/js/jquery.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('frontend/js/price-range.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script src="{{ asset('frontend/js/bootbox.min.js') }}"></script>

<script>
    $(document).on("click", "#delete", function(e) {
        e.preventDefault();
        var link = $(this).attr("href");
        bootbox.confirm("Are you want to delete!", function(confirmed) {
            if(confirmed){
                window.location.href = link;
            };
        });
    });
</script>
</body>
</html>
