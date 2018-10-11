@php
    /*specific student profile................*/
   $admin_id = Session::get('admin_id');
   $admin_role = Session::get('admin_role');
   $admin_profile=DB::table('tbl_admin')
       ->select('*')
       ->where('admin_id',$admin_id)
       ->first();

   if (empty($admin_id)){
        return Redirect::to('/admin')->send();
        }

@endphp

<?php
$admin_id = Session::get('admin_id');
$admin_role = Session::get('admin_role');
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <!-- start: Meta -->
    <meta charset="utf-8">
    <title>Ronmar Admin Dashboard</title>
    <meta name="description" content="Bootstrap Metro Dashboard">
    <meta name="author" content="Dennis Ji">
    <meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->

    <!-- start: CSS -->
    <link id="bootstrap-style" href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
    <link id="base-style" href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
    <link id="base-style-responsive" href="{{ asset('backend/css/style-responsive.css') }}" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
    <!-- end: CSS -->


    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link id="ie-style" href="css/ie.css" rel="stylesheet">
    <![endif]-->

    <!--[if IE 9]>
    <link id="ie9style" href="css/ie9.css" rel="stylesheet">
    <![endif]-->

    <!-- start: Favicon -->
    <link rel="shortcut icon" href="{{ URL::to('backend/img/favicon.ico') }}">
    <!-- end: Favicon -->




</head>

<body>
<!-- start: Header -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <?php
            $site_details = DB::table('tbl_site')
                ->where('site_id',1)
                ->get();
            foreach($site_details as $view_site_details)
            ?>
            <a class="brand" href="{{ URL::to('/admin') }}"><span>{{ $view_site_details->site_title }}</span></a>

            <!-- start: Header Menu -->
            <div class="nav-no-collapse header-nav">
                <ul class="nav pull-right">
                    <li>
                        <img src="{{ URL::to( $admin_profile->admin_image) }}" alt="" style="width: 40px;height: 40px;border-radius: 50%;margin: 5px">
                    </li>
                    <!-- start: User Dropdown -->
                    <li class="dropdown">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="halflings-icon white user"></i> {{ $admin_profile->admin_name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu-title">
                                <span>Account Settings</span>
                            </li>
                            <!-- <li><a href="{{ URL::to('/profile/'.$admin_id) }}"><i class="halflings-icon user"></i>Profile</a></li> -->
                            <li><a href="{{ URL::to('/user_password_change/'.$admin_id) }}"><i class="halflings-icon user"></i>Change Password</
                                a></li>
                            <li><a href="{{ URL::to('/logout') }}"><i class="halflings-icon off"></i> Logout</a></li>
                        </ul>
                    </li>
                    <!-- end: User Dropdown -->
                </ul>
            </div>
            <!-- end: Header Menu -->

        </div>
    </div>
</div>
<!-- start: Header -->

<div class="container-fluid-full">
    <div class="row-fluid">

        <!-- start: Main Menu -->
        <div id="sidebar-left" class="span2">
            <div class="nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                    <li><a href="{{ URL::to('admin_dashboard') }}"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
                    <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet">User</span></a>
                        <ul>
                                    <?php if ($admin_role == '0'){ ?>
                            <li><a class="submenu" href="{{ URL::to('/add_user') }}"><i class="icon-file-alt"></i><span class="hidden-tablet">Add User</span></a></li>
                                    <?php } ?>
                            <li><a class="submenu" href="{{ URL::to('/all_user') }}"><i class="icon-file-alt"></i><span class="hidden-tablet">All User</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet">Category</span></a>
                        <ul>
                            <li><a class="submenu" href="{{ URL::to('/add_category') }}"><i class="icon-file-alt"></i><span class="hidden-tablet">Add Category</span></a></li>
                            <li><a class="submenu" href="{{ URL::to('/all_category') }}"><i class="icon-file-alt"></i><span class="hidden-tablet">All Category</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Brands</span></a>
                        <ul>
                            <li><a class="submenu" href="{{ URL::to('/add_brand') }}"><i class="icon-file-alt"></i><span class="hidden-tablet">Add Brands</span></a></li>
                            <li><a class="submenu" href="{{ URL::to('/all_brand') }}"><i class="icon-file-alt"></i><span class="hidden-tablet">All Brands</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Products</span></a>
                        <ul>
                            <li><a class="submenu" href="{{ URL::to('/add_product') }}"><i class="icon-file-alt"></i><span class="hidden-tablet">Add product</span></a></li>
                            <li><a class="submenu" href="{{ URL::to('/all_product') }}"><i class="icon-file-alt"></i><span class="hidden-tablet">All Products</span></a></li>
                        </ul>
                    </li>

                     <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Reports</span></a>
                        <ul>
                            <li><a class="submenu" href="{{ URL::to('/reports') }}"><i class="icon-file-alt"></i><span class="hidden-tablet">Sales</span></a></li>
                            <li><a class="submenu" href="{{ URL::to('/inventory') }}"><i class="icon-file-alt"></i><span class="hidden-tablet">Inventory</span></a></li>
                        </ul>
                    </li>

                   {{--  <li><a href="{{ URL::to('/reports') }}"><i class="icon-edit"></i><span class="hidden-tablet">Reports</span></a></li>
 --}}
                     <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Slider</span></a>
                        <ul>
                            <li><a class="submenu" href="{{ URL::to('/add_slider') }}"><i class="icon-file-alt"></i><span class="hidden-tablet">Add Slider</span></a></li>
                            <li><a class="submenu" href="{{ URL::to('/all_slider') }}"><i class="icon-file-alt"></i><span class="hidden-tablet">All Slider</span></a></li>
                        </ul>
                    <li><a href="{{ URL::to('/manage_order') }}"><i class="icon-edit"></i><span class="hidden-tablet">Manage Order</span></a></li>
                    {{-- <li><a href="{{ URL::to('/all_contact') }}"><i class="icon-edit"></i><span class="hidden-tablet">All Message (
                                                @php
                                                $totalUnseen = DB::table('tbl_contact')
                                                ->where('contact_status',0)
                                                ->count('contact_id');
                                                @endphp
                                                {{ $totalUnseen }} )</span></a></li> --}}
                    <li><a href="{{ URL::to('/edit_site') }}"><i class="icon-edit"></i><span class="hidden-tablet">Website Option</span></a></li>
                </ul>
            </div>
        </div>
        <!-- end: Main Menu -->

        <!-- start: Content -->
        <div id="content" class="span10">


            <ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="{{ URL::to('/admin') }}">Home</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li><a href="{{ URL::to('/admin') }}">Dashboard</a></li>
            </ul>




            @yield('admin_content')




        </div><!--/.fluid-container-->

        <!-- end: Content -->
    </div><!--/#content.span10-->
</div><!--/fluid-row-->

<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Settings</h3>
    </div>
    <div class="modal-body">
        <p>Here settings can be configured...</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>

<div class="clearfix"></div>

<footer>
    <div class="container">
        <div class="row">
            <div class="span6">
                <p>
                    <span style="text-align:left;float:left">Copyright by &copy; {{ $view_site_details->site_copyright }}</span>
                </p>
            </div>
            <div class="span6">
                <?php
                $datetime = date("d-m-Y, l , h:i a");
                $utc = new DateTime($datetime, new DateTimeZone('UTC'));
                $utc->setTimezone(new DateTimeZone('Asia/Dhaka'));
                echo $utc->format('d-m-Y, l , h:i a');
                ?>
            </div>
        </div>
    </div>
</footer>

<!-- start: JavaScript-->
<script src="{{ asset('backend/js/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery-migrate-1.0.0.min.js') }}"></script>

<script src="{{ asset('backend/js/jquery-ui-1.10.0.custom.min.js') }}"></script>

<script src="{{ asset('backend/js/jquery.ui.touch-punch.js') }}"></script>

<script src="{{ asset('backend/js/modernizr.js') }}"></script>

<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('backend/js/jquery.cookie.js') }}"></script>

<script src="{{ asset('backend/js/fullcalendar.min.js') }}"></script>

<script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('backend/js/excanvas.js') }}"></script>
<script src="{{ asset('backend/js/jquery.flot.js') }}"></script>
<script src="{{ asset('backend/js/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('backend/js/jquery.flot.stack.js') }}"></script>
<script src="{{ asset('backend/js/jquery.flot.resize.min.js') }}"></script>

<script src="{{ asset('backend/js/jquery.chosen.min.js') }}"></script>

<script src="{{ asset('backend/js/jquery.uniform.min.js') }}"></script>

<script src="{{ asset('backend/js/jquery.cleditor.min.js') }}"></script>

<script src="{{ asset('backend/js/jquery.noty.js') }}"></script>

<script src="{{ asset('backend/js/jquery.elfinder.min.js') }}"></script>

<script src="{{ asset('backend/js/jquery.raty.min.js') }}"></script>

<script src="{{ asset('backend/js/jquery.iphone.toggle.js') }}"></script>

<script src="{{ asset('backend/js/jquery.uploadify-3.1.min.js') }}"></script>

<script src="{{ asset('backend/js/jquery.gritter.min.js') }}"></script>

<script src="{{ asset('backend/js/jquery.imagesloaded.js') }}"></script>

<script src="{{ asset('backend/js/jquery.masonry.min.js') }}"></script>

<script src="{{ asset('backend/js/jquery.knob.modified.js') }}"></script>

<script src="{{ asset('backend/js/jquery.sparkline.min.js') }}"></script>

<script src="{{ asset('backend/js/counter.js') }}"></script>

<script src="{{ asset('backend/js/retina.js') }}"></script>

<script src="{{ asset('backend/js/custom.js') }}"></script>
<script src="{{ asset('backend/js/bootbox.min.js') }}"></script>


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
<!-- end: JavaScript-->

</body>
</html>
