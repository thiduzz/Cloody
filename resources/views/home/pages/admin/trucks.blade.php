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
    <tracking-tab type="trucks"></tracking-tab>
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
