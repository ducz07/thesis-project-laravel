@extends('layout')
@section('content')

    <div class="col-sm-12 padding-right" style="margin-bottom: 100px">
        <p style="color: #979795; font-size: 35px;">
            <?php
            $message = Session::get('message');
            if ($message){
                echo $message;
                Session::put('message',null);
            }
            ?>
        </p>
        <div class="content-404">
            <h1>You have Successfully Buy Your Product</h1>
            <p>We will contact you via text message for order approval</p>
            <p>You get your product as soon as possible</p>
            <h2><a href="{{ URL::to('/') }}">Back to Shopping Site</a></h2>
        </div>
    </div>

@endsection
