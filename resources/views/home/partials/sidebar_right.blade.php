<div id="quickview" class="quickview-wrapper" data-pages="quickview">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#quickview-chat" data-toggle="tab">Chat</a>
        </li>
        @yield('quickview-header')
    </ul>
    <a class="btn-link quickview-toggle" data-toggle-element="#quickview" data-toggle="quickview"><i class="pg-close"></i></a>
    <div class="tab-content">
        <div class="tab-pane fade in active no-padding" id="quickview-chat">
            <div class="view-port clearfix" id="chat">
                <div class="view bg-white">
                    <!-- BEGIN View Header !-->
                    <div class="navbar navbar-default">
                        <div class="navbar-inner">
                            <!-- BEGIN Header Controler !-->
                            <a href="javascript:;" class="inline action p-l-10 link text-master" data-navigate="view" data-view-port="#chat" data-view-animation="push-parrallax">
                                <i class="pg-plus"></i>
                            </a>
                            <!-- END Header Controler !-->
                            <div class="view-heading">
                                Chat List
                                <div class="fs-11">Show All</div>
                            </div>
                            <!-- BEGIN Header Controler !-->
                            <a href="#" class="inline action p-r-10 pull-right link text-master">
                                <i class="pg-more"></i>
                            </a>
                            <!-- END Header Controler !-->
                        </div>
                    </div>
                    <!-- END View Header !-->
                    <div data-init-list-view="ioslist" class="list-view boreded no-top-border">
                        <div class="list-view-group-container">
                            <div class="list-view-group-header text-uppercase">
                                a</div>
                            <ul>
                                <!-- BEGIN Chat User List Item  !-->
                                <li class="chat-user-list clearfix">
                                    <a data-view-animation="push-parrallax" data-view-port="#chat" data-navigate="view" class="" href="#">
                        <span class="col-xs-height col-middle">
                        <span class="thumbnail-wrapper d32 circular bg-success">
                            <img width="34" height="34" alt="" data-src-retina="/images/home/profiles/1x.jpg" data-src="/images/home/profiles/1.jpg" src="/images/home/profiles/1x.jpg" class="col-top">
                        </span>
                        </span>
                                        <p class="p-l-10 col-xs-height col-middle col-xs-12">
                                            <span class="text-master">ava flores</span>
                                            <span class="block text-master hint-text fs-12">Hello there</span>
                                        </p>
                                    </a>
                                </li>
                                <!-- END Chat User List Item  !-->
                            </ul>
                        </div>
                        <div class="list-view-group-container">
                            <div class="list-view-group-header text-uppercase">b</div>
                            <ul>
                                <!-- BEGIN Chat User List Item  !-->
                                <li class="chat-user-list clearfix">
                                    <a data-view-animation="push-parrallax" data-view-port="#chat" data-navigate="view" class="" href="#">
                        <span class="col-xs-height col-middle">
                        <span class="thumbnail-wrapper d32 circular bg-success">
                            <img width="34" height="34" alt="" data-src-retina="/images/home/profiles/2x.jpg" data-src="/images/home/profiles/2.jpg" src="/images/home/profiles/2x.jpg" class="col-top">
                        </span>
                        </span>
                                        <p class="p-l-10 col-xs-height col-middle col-xs-12">
                                            <span class="text-master">bella mccoy</span>
                                            <span class="block text-master hint-text fs-12">Hello there</span>
                                        </p>
                                    </a>
                                </li>
                                <!-- END Chat User List Item  !-->
                                <!-- BEGIN Chat User List Item  !-->
                                <li class="chat-user-list clearfix">
                                    <a data-view-animation="push-parrallax" data-view-port="#chat" data-navigate="view" class="" href="#">
                        <span class="col-xs-height col-middle">
                        <span class="thumbnail-wrapper d32 circular bg-success">
                            <img width="34" height="34" alt="" data-src-retina="/images/home/profiles/3x.jpg" data-src="/images/home/profiles/3.jpg" src="/images/home/profiles/3x.jpg" class="col-top">
                        </span>
                        </span>
                                        <p class="p-l-10 col-xs-height col-middle col-xs-12">
                                            <span class="text-master">bob stephens</span>
                                            <span class="block text-master hint-text fs-12">Hello there</span>
                                        </p>
                                    </a>
                                </li>
                                <!-- END Chat User List Item  !-->
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- BEGIN Conversation View  !-->
                <div class="view chat-view bg-white clearfix">
                    <!-- BEGIN Header  !-->
                    <div class="navbar navbar-default">
                        <div class="navbar-inner">
                            <a href="javascript:;" class="link text-master inline action p-l-10" data-navigate="view" data-view-port="#chat" data-view-animation="push-parrallax">
                                <i class="pg-arrow_left"></i>
                            </a>
                            <div class="view-heading">
                                John Smith
                                <div class="fs-11 hint-text">Online</div>
                            </div>
                            <a href="#" class="link text-master inline action p-r-10 pull-right ">
                                <i class="pg-more"></i>
                            </a>
                        </div>
                    </div>
                    <!-- END Header  !-->
                    <!-- BEGIN Conversation  !-->
                    <div class="chat-inner" id="my-conversation">
                        <!-- BEGIN From Me Message  !-->
                        <div class="message clearfix">
                            <div class="chat-bubble from-me">
                                Hello there
                            </div>
                        </div>
                        <!-- END From Me Message  !-->
                        <!-- BEGIN From Them Message  !-->
                        <div class="message clearfix">
                            <div class="profile-img-wrapper m-t-5 inline">
                                <img class="col-top" width="30" height="30" src="/images/home/profiles/avatar_small.jpg" alt="" data-src="/images/home/profiles/avatar_small.jpg" data-src-retina="/images/home/profiles/avatar_small2x.jpg">
                            </div>
                            <div class="chat-bubble from-them">
                                Hey
                            </div>
                        </div>
                        <!-- END From Them Message  !-->
                        <!-- BEGIN From Me Message  !-->
                        <div class="message clearfix">
                            <div class="chat-bubble from-me">
                                Did you check out Pages framework ?
                            </div>
                        </div>
                        <!-- END From Me Message  !-->
                        <!-- BEGIN From Me Message  !-->
                        <div class="message clearfix">
                            <div class="chat-bubble from-me">
                                Its an awesome chat
                            </div>
                        </div>
                        <!-- END From Me Message  !-->
                        <!-- BEGIN From Them Message  !-->
                        <div class="message clearfix">
                            <div class="profile-img-wrapper m-t-5 inline">
                                <img class="col-top" width="30" height="30" src="/images/home/profiles/avatar_small.jpg" alt="" data-src="/images/home/profiles/avatar_small.jpg" data-src-retina="/images/home/profiles/avatar_small2x.jpg">
                            </div>
                            <div class="chat-bubble from-them">
                                Yea
                            </div>
                        </div>
                        <!-- END From Them Message  !-->
                    </div>
                    <!-- BEGIN Conversation  !-->
                    <!-- BEGIN Chat Input  !-->
                    <div class="b-t b-grey bg-white clearfix p-l-10 p-r-10">
                        <div class="row">
                            <div class="col-xs-1 p-t-15">
                                <a href="#" class="link text-master"><i class="fa fa-plus-circle"></i></a>
                            </div>
                            <div class="col-xs-8 no-padding">
                                <input type="text" class="form-control chat-input" data-chat-input="" data-chat-conversation="#my-conversation" placeholder="Say something">
                            </div>
                            <div class="col-xs-2 link text-master m-l-10 m-t-15 p-l-10 b-l b-grey col-top">
                                <a href="#" class="link text-master"><i class="pg-camera"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- END Chat Input  !-->
                </div>
                <!-- END Conversation View  !-->
            </div>
        </div>
        @yield('quickview-tabs')
    </div>
</div>