@extends('public.master')

@section('content')
    <section id="page-title" class="page-title-pattern">

        <div class="container clearfix">
            <h1>Register</h1>
            <span>Register your foodtruck and start expanding your reach</span>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active"><a href="#">Register</a></li>
            </ol>
        </div>

    </section>

    <section id="content" style="margin-bottom: 0px;">
        <script>
            window.Laravel = <?php echo json_encode([
                    'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        <div class="content-wrap">
            <foodtruck-register></foodtruck-register>

        </div>

    </section>
@endsection
