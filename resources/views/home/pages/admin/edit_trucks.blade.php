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
    <tracking-tab type="truck" subject="{!! $id !!}"></tracking-tab>
@endsection

@section('breadcrumb')
    <li>
        <a href="#" class="active">Edit Trucks</a>
    </li>
    <li class="pull-right upper-action">
        <button class="btn btn-sm btn-rounded btn-primary" data-target="#locationModal" data-toggle="modal" id="btnLocationToggler">
                <span><i class="pg-map"></i>
                </span>
        </button>
    </li>
    <breadcrumb-action action="admin-edit-truck"></breadcrumb-action>
@endsection
@section('css')
    <!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" /> -->
    <link rel="stylesheet" type="text/css" href="{!! asset('/css/home/daterange-picker-2.css') !!}" />
@endsection
@section('javascript_before')

    <script src="{!! asset('/plugins/bootstrap-select2/select2.js') !!}"></script>
    <script src="{!! asset('/plugins/sweet-alerts/sweetalert.min.js') !!}"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!--<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script> -->
    <script src="{!! asset('/js/home/daterange-picker-2.js') !!}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1YvebOcyhWtWsGhTiP6tHS3FX39UFYy4"></script>
@endsection
@section('javascript_after')

    <!-- API KEY AIzaSyB1YvebOcyhWtWsGhTiP6tHS3FX39UFYy4
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1YvebOcyhWtWsGhTiP6tHS3FX39UFYy4"
            async defer></script>
    <script src="{!! asset('/js/home/google_map.js') !!}" type="text/javascript"></script>
    -->

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
    <foodtrucks-admin-edit></foodtrucks-admin-edit>

    <foodtrucks-admin-location></foodtrucks-admin-location>
@endsection
