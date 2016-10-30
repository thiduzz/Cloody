<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Home | Cloody</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{!! asset('/plugins/pace/pace-theme-flash.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('/plugins/bootstrapv3/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('/plugins/font-awesome/css/font-awesome.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('/plugins/jquery-scrollbar/jquery.scrollbar.css') !!}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{!! asset('/plugins/bootstrap-select2/select2.css') !!}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{!! asset('/plugins/switchery/css/switchery.min.css') !!}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{!! asset('/css/home/pages-icons.css') !!}" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="{!! asset('/css/home/pages.css') !!}" rel="stylesheet" type="text/css" />
    <!--[if lte IE 9]>
    <link href="{!! asset('/css/home/ie9.css') !!}" rel="stylesheet" type="text/css" />
    <![endif]-->
    @yield('css')
    <script type="text/javascript">    
        window.onload = function()
        {
            // fix for windows 8
            if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="{!! asset('/css/home/windows.chrome.fix.css') !!}" />'
        }
    </script>
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="fixed-header">

@include('home.partials.sidebar_left')

<div class="page-container">

    @include('home.partials.header')

    <div class="page-content-wrapper">
        <div class="content">

            @include('home.partials.breadcrumb')
            <div class="container-fluid container-fixed-lg">
                @yield('content')
            </div>
        </div>
        @include('home.partials.footer')
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
</div>

@include('home.partials.sidebar_right')

@include('home.partials.search_overlay')
<!-- END OVERLAY -->
<!-- BEGIN VENDOR JS -->
<script>
    paceOptions = {
        ajax: true, // disabled
        document: true, // enabled
        eventLag: false, // disabled
    };
</script>
<script src="{!! asset('/plugins/pace/pace.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('/plugins/jquery/jquery-1.11.1.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('/plugins/modernizr.custom.js') !!}" type="text/javascript"></script>
<script src="{!! asset('/plugins/jquery-ui/jquery-ui.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('/plugins/bootstrapv3/js/bootstrap.min.js') !!}" type="text/javascript"></script>

@yield('javascript_before')
<script src="{!! asset('/js/home/vue-tables.min.js') !!}"></script>
<script src="{!! asset('/plugins/jquery/jquery-easy.js') !!}" type="text/javascript"></script>
<script src="{!! asset('/plugins/jquery-unveil/jquery.unveil.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('/plugins/jquery-bez/jquery.bez.min.js') !!}"></script>
<script src="{!! asset('/plugins/jquery-ios-list/jquery.ioslist.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('/plugins/imagesloaded/imagesloaded.pkgd.min.js') !!}"></script>
<script src="{!! asset('/plugins/jquery-actual/jquery.actual.min.js') !!}"></script>
<script src="{!! asset('/plugins/jquery-scrollbar/jquery.scrollbar.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/plugins/classie/classie.js') !!}"></script>
<script src="{!! asset('/plugins/switchery/js/switchery.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('/js/home/pages.js') !!}"></script>

@yield('javascript_middle')

<script src="/js/app.js"></script>

@yield('javascript_after')

</body>
</html>