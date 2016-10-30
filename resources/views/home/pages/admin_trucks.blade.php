@extends('home.master')
@section('quickview-shortcut')
    @include('home.partials.qv-shortcut')
@endsection
@section('quickview-header')
    <li>
        <a href="#quickview-alerts" data-toggle="tab">Alerts</a>
    </li>
@endsection
@section('quickview-tabs')
    <div class="tab-pane fade no-padding" id="quickview-alerts">
        <div class="view-port clearfix" id="alerts">
            <!-- BEGIN Alerts View !-->
            <div class="view bg-white">
                <!-- BEGIN View Header !-->
                <div class="navbar navbar-default navbar-sm">
                    <div class="navbar-inner">
                        <!-- BEGIN Header Controler !-->
                        <a href="javascript:;" class="inline action p-l-10 link text-master" data-navigate="view" data-view-port="#chat" data-view-animation="push-parrallax">
                            <i class="pg-more"></i>
                        </a>
                        <!-- END Header Controler !-->
                        <div class="view-heading">
                            Notications
                        </div>
                        <!-- BEGIN Header Controler !-->
                        <a href="#" class="inline action p-r-10 pull-right link text-master">
                            <i class="pg-search"></i>
                        </a>
                        <!-- END Header Controler !-->
                    </div>
                </div>
                <!-- END View Header !-->
                <!-- BEGIN Alert List !-->
                <div data-init-list-view="ioslist" class="list-view boreded no-top-border">
                    <!-- BEGIN List Group !-->
                    <div class="list-view-group-container">
                        <!-- BEGIN List Group Header!-->
                        <div class="list-view-group-header text-uppercase">
                            Calendar
                        </div>
                        <!-- END List Group Header!-->
                        <ul>
                            <!-- BEGIN List Group Item!-->
                            <li class="alert-list">
                                <!-- BEGIN Alert Item Set Animation using data-view-animation !-->
                                <a href="javascript:;" class="" data-navigate="view" data-view-port="#chat" data-view-animation="push-parrallax">
                                    <p class="col-xs-height col-middle">
                                        <span class="text-warning fs-10"><i class="fa fa-circle"></i></span>
                                    </p>
                                    <p class="p-l-10 col-xs-height col-middle col-xs-9 overflow-ellipsis fs-12">
                                        <span class="text-master">David Nester Birthday</span>
                                    </p>
                                    <p class="p-r-10 col-xs-height col-middle fs-12 text-right">
                                        <span class="text-warning">Today <br></span>
                                        <span class="text-master">All Day</span>
                                    </p>
                                </a>
                                <!-- END Alert Item!-->
                                <!-- BEGIN List Group Item!-->
                            </li>
                            <!-- END List Group Item!-->
                        </ul>
                    </div>
                    <!-- END List Group !-->
                </div>
                <!-- END Alert List !-->
            </div>
            <!-- EEND Alerts View !-->
        </div>
    </div>
@endsection

@section('breadcrumb')
    <li><a href="#" class="active">Manage Trucks</a>
    </li>
@endsection
@section('javascript_before')
    <script type="text/javascript" src="/plugins/sweet-alerts/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/plugins/sweet-alerts/sweetalert.css" />
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

@endsection

@section('content')
    <style>
        .VuePagination
        {
            text-align: center;
        }
        .pagination
        {
            margin-bottom: 5px;
        }
        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover
        {
            color: #fff;
            background-color: #10cfbd;
            border-color: #10cfbd;
        }

        .VuePagination ul > li.disabled a {
            opacity: .35;
        }
        .VuePagination ul > li > a {
            padding: 5px 10px;
            color: #626262;
            opacity: .65;
            -webkit-transition: opacity 0.3s ease;
            transition: opacity 0.3s ease;
            font-size: 14px;
        }
        .VuePagination ul > li > a:hover {
            opacity: 1;
        }
        .VuePagination ul > li.next > a,
        .VuePagination ul > li.prev > a,
        .VuePagination ul > li.active > a
        {
            opacity: 1;
        }
        .VuePagination ul > li.disabled a {
            opacity: .35;
        }
        .VuePagination ul > li.disabled a:hover {
            opacity: .35;
        }
        .VuePagination.paging_bootstrap.pagination {
            padding-top: 0;
            padding-right: 20px;
        }
        .VuePagination ul > li {
            display: inline-block;
            padding-left: 0;
            font-size: 13px;
        }

    </style>
    <foodtrucks-admin></foodtrucks-admin>
@endsection
