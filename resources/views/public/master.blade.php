<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Vizad" />

    <!-- Stylesheets
    ============================================= -->
    <link rel="stylesheet" href="{!! asset('/css/app.css') !!}">
    <link rel="stylesheet" href="{!! asset('/css/public/style.css') !!}" type="text/css" />
    <link rel="stylesheet" href="{!! asset('/css/public/dark.css') !!}" type="text/css" />
    <link rel="stylesheet" href="{!! asset('/css/public/font-icons.css') !!}" type="text/css" />
    <link rel="stylesheet" href="{!! asset('/css/public/animate.css') !!}" type="text/css" />
    <link rel="stylesheet" href="{!! asset('/css/public/magnific-popup.css') !!}" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css" />
    <link rel="stylesheet" href="{!! asset('/css/public/select2-bootstrap.min.css') !!}" type="text/css" />

    <link rel="stylesheet" href="/css/public/bs-switches.css" type="text/css">
    <link rel="stylesheet" href="{!! asset('/css/public/responsive.css') !!}" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <!-- Document Title
    ============================================= -->
    <title>Cloody - New food closer to you</title>

</head>

<body class="stretched sticky-responsive-menu">

    @include('public.partials.header')

    @yield('content')

    @include('public.partials.footer')
<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- External JavaScripts
============================================= -->
<script type="text/javascript" src="{!! asset('/js/public/jquery.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/js/public/plugins.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/js/public/components/bs-switches.js') !!}"></script>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>