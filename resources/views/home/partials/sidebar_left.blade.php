
<div class="page-sidebar" data-pages="sidebar">
    <div id="appMenu" class="sidebar-overlay-slide from-top">
    </div>
    <!-- BEGIN SIDEBAR HEADER -->
    <div class="sidebar-header">
        <img src="/images/home/logo_white.png" alt="logo" class="brand" data-src="/images/home/logo_white.png" data-src-retina="/images/home/logo_white_2x.png" width="78" height="22">
        <div class="sidebar-header-controls">
            <button data-pages-toggle="#appMenu" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" type="button"><i class="fa fa-angle-down fs-16"></i>
            </button>
            <button data-toggle-pin="sidebar" class="btn btn-link visible-lg-inline" type="button"><i class="fa fs-12"></i>
            </button>
        </div>
    </div>
    <!-- END SIDEBAR HEADER -->
    <!-- BEGIN SIDEBAR MENU -->
    <div class="sidebar-menu">
        <ul class="menu-items">
            <li class="m-t-30">
                <a href="#" class="detailed">
                    <span class="title">Dashboard</span>
                    <span class="details">234 notifications</span>
                </a>
                <span class="bg-success icon-thumbnail"><i class="pg-home"></i></span>
            </li>
            <li class="">
                <a href="#" class="detailed">
                    <span class="title">Messages</span>
                    <span class="details">234 new messages</span>
                </a>
                <span class="icon-thumbnail "><i class="pg-social"></i></span>
            </li>
            @if(Auth::user()->hasRole('admin'))
            <li class="">
                <a href="javascript:;">
                    <span class="title">Admin</span>
                    <span class=" arrow"></span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-star"></i></span>
                <ul class="sub-menu">
                    <li class="">
                        <a href="{!! url('/admin_trucks') !!}">Trucks</a>
                        <span class="icon-thumbnail">Tr</span>
                    </li>
                    <li class="">
                        <a href="#">Orders Payment</a>
                        <span class="icon-thumbnail">Op</span>
                    </li>
                    <li class="">
                        <a href="#">Promotions Payment</a>
                        <span class="icon-thumbnail">Pp</span>
                    </li>
                    <li class="">
                        <a href="#">World Map</a>
                        <span class="icon-thumbnail">Wm</span>
                    </li>
                    <li class="">
                        <a href="#">Users</a>
                        <span class="icon-thumbnail">Us</span>
                    </li>
                    <li class="">
                        <a href="{!! url('/admin_oauth') !!}">OAuth</a>
                        <span class="icon-thumbnail">OA</span>
                    </li>
                    <li class="">
                        <a href="#">New Blog Post</a>
                        <span class="icon-thumbnail">Bp</span>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- END SIDEBAR MENU -->
</div>