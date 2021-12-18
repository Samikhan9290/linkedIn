@extends('user_layout.app')
@section('title','login')
@section('content')
    <!-- Login 14 start -->
    <div class="login-14">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-section">
                        <div class="form-inner">

                            <div class="details">
                                @if(session('error'))
                                    <p class="alert alert-danger">{{session('error')}}</p>
                                @endif
                                <h3>Sign Into Your Account</h3>
                                <form action="{{url('login_process')}}" method="post">
                                    @csrf
                                    <div class="form-group clearfix">
                                        <input name="email" type="email" class="form-control" placeholder="Email Address" aria-label="Email Address">
                                    </div>
                                    <div class="form-group clearfix">
                                        <input name="password" type="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password">
                                    </div>
                                    <div class="checkbox form-group clearfix">

                                    </div>
                                    <div class="form-group clearfix fg">
                                        <button type="submit" class="btn btn-lg btn-primary btn-theme"><span>Login</span></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                                <div class="clearfix"></div>
                            </div>
                            <p>Don't have an account? <a href="{{url('register')}}" class="thembo"> Register here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login 14 end -->
@endsection
