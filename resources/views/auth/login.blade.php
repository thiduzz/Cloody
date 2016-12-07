@extends('public.master')

@section('content')
<section id="page-title" class="page-title-pattern">

    <div class="container clearfix">
        <h1>Login</h1>
        <span>Login to your account</span>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active"><a href="#">Login</a></li>
        </ol>
    </div>

</section>

<section id="content" style="margin-bottom: 0px;">

    <div class="content-wrap">

        <div class="container clearfix">

            <div class="col-lg-offset-4 col-lg-4 nobottommargin">

                <div class="well well-lg nobottommargin">
                    <form id="login-form" name="login-form" class="nobottommargin" role="form" method="POST" action="{{ url('/login') }}">

                        {{ csrf_field() }}

                        <h3>Login to your Account</h3>



                        <div class="col_full{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-mail Address:</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="col_full{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="password">Password:</label>
                            <input id="password" type="password" class="form-control" name="password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="col_full nobottommargin">
                            <button class="button button-3d nomargin" type="submit" id="login-form-submit" name="login-form-submit" value="login">Login</button>
                            <a href="{{ url('/password/reset') }}" class="fright">Forgot Password?</a>
                        </div>
                        <div class="line line-sm"></div>
                        <div class="center">
                            <h4 style="margin-bottom: 15px;">or Login with:</h4>
                            <a href="{{ url('/auth/facebook') }}" class="button button-rounded si-facebook si-colored">Facebook</a>
                        </div>

                    </form>
                </div>

            </div>

        </div>

    </div>

</section>
@endsection
