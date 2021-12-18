@extends('user_layout.app')
@section('title','register')
@section('content')
    <!-- Login 14 start -->
    <div class="login-14">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-section">
                        <div class="form-inner">

                            <div class="details">
                                <h3>Create An Cccount
                                </h3>
                                <form action="{{url('/register')}}" method="post">
                                    @csrf
                                    <div class="form-group clearfix">
                                        <input required name="name" type="text" class="form-control" placeholder="Full Name" aria-label="Full Name">

                                    </div>
                                    @error('name')
                                    <p class="alert alert-danger">
                                        {{$message}}
                                    </p>

                                    @enderror
                                    <div class="form-group clearfix">
                                        <input required name="email" type="email" class="form-control" placeholder="Email Address" aria-label="Email Address">

                                    </div>
                                    @error('email')
                                    <p class="alert alert-danger">
                                        {{$message}}
                                    </p>

                                    @enderror
                                    <div class="form-group clearfix">
                                        <input required name="password" type="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password">

                                    </div>
                                    @error('password')
                                    <p class="alert alert-danger ">
                                        {{$message}}
                                    </p>

                                    @enderror
                                    <div class="form-group clearfix">

                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary btn-theme"><span>Register</span></button>
                                    </div>
                                    <div class="clearfix"></div>

                                </form>
                                <div class="clearfix"></div>
                            </div>
                            <p>Already a member? <a href="{{url('/login_here')}}">Login here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login 14 end -->
@endsection
