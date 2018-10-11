@extends('layout')

@section('content')

    <div class="col-sm-12 padding-right">
        <section id="form"><!--form-->
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
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
                        <h2>Login to your account</h2>
                        <form action="{{ URL::to('/customer_login') }}" method="post">
                            {{ csrf_field() }}
                            <input type="email" placeholder="Email Address" name="customer_email" required/>
                            <input type="password" placeholder="Password" name="password" required/>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form action="{{ URL::to('/customer_registration') }}" method="post">
                            {{ csrf_field() }}
                            <input type="text" placeholder="Name" name="customer_name" required/>
                            <input type="email" placeholder="Email Address" name="customer_email" required/>
                            <input type="number" placeholder="Mobile Number" name="mobile_number" required/>
                            <input type="password" placeholder="Password" name="password" required/>
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </section><!--/form-->
    </div>

@endsection
