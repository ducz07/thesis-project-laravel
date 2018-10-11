@extends('admin_layout')
@section('admin_content')

    <div class="row-fluid">

        <div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
            <div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div>
            <div class="number">
                @php
                    $totalUser = DB::table('tbl_admin')
                               ->count('admin_id');
                @endphp
                {{ $totalUser }}
                <i class="icon-arrow-up"></i></div>
            <div class="title">User</div>

        </div>
        <div class="span3 statbox green" onTablet="span6" onDesktop="span3">
            <div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
            <div class="number">
                @php
                    $totalCategory = DB::table('tbl_category')
                               ->count('category_id');
                @endphp
                {{ $totalCategory }}
                <i class="icon-arrow-up"></i></div>
            <div class="title">Category</div>
        </div>
        <div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
            <div class="boxchart">5,6,7,2,0,-4,-2,4,8,2,3,3,2</div>
            <div class="number">
                @php
                    $totalbrand = DB::table('tbl_brand')
                               ->count('brand_id');
                @endphp
                {{ $totalbrand }}
                <i class="icon-arrow-up"></i></div>
            <div class="title">Bands</div>
        </div>
        <div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
            <div class="boxchart">7,2,2,2,1,-4,-2,4,8,,0,3,3,5</div>
            <div class="number">@php
                    $totalProducts = DB::table('tbl_products')
                               ->count('product_id');
                @endphp
                {{ $totalProducts }}
                <i class="icon-arrow-down"></i></div>
            <div class="title">visits</div>
        </div>
    </div>

    



@endsection