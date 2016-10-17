@extends('home.master')
@section('javascript')
@endsection
@section('breadcrumb')
    <li><a href="#" class="active">Manage OAuth</a>
    </li>
@endsection
@section('content')
    <passport-clients></passport-clients>
    <passport-authorized-clients></passport-authorized-clients>
    <passport-personal-access-tokens></passport-personal-access-tokens>
@endsection
