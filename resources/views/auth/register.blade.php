@extends('public.master')

@section('content')
    <section id="page-title" class="page-title-pattern">

        <div class="container clearfix">
            <h1>Register</h1>
            <span>Register your account and find the foodtrucks next to you</span>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active"><a href="#">Register</a></li>
            </ol>
        </div>

    </section>

    <section id="content" style="margin-bottom: 0px;">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="col-lg-6 col-lg-offset-3 nobottommargin">


                    <h3>Don't have an Account? Register now!</h3>

                    <p>Start browsing through all of the best foodtrucks in your area and receive many promotions to enjoy different types of food without much effort.<br>
                        If you are a food truck owner, <a href="{{ url('/register-foodtruck') }}">click here</a></p>
                    <form id="register-form" name="register-form" class="nobottommargin" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="col_half {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">Name:</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="col_half col_last {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">Email Address:</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="clear"></div>

                        <div class="col_half{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Choose Password:</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="col_half col_last{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password_confirmation">Re-enter Password:</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" value="" class="form-control">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <input id="register-type" name="register_type" type="hidden" value="customer">

                        <div class="clear"></div>

                        <div class="col_full nobottommargin">
                            <button type="submit" class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" value="register">Register Now</button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>
@endsection
