@extends('public.master')

@section('content')
    <style>
        .device-lg #slider .emphasis-title h1 { font-size: 52px; }
        .device-md #slider .emphasis-title h1 { font-size: 44px; }
    </style>

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="col_one_third nobottommargin center">
                    <a href="#"><img src="{{ asset('images/public/appshowcase/s1.png') }}" alt="Image" class="bottommargin-sm"></a>
                    <h4>Responsive Layout</h4>
                    <p>Powerful Layout with Responsive functionality that can be adapted to any screen size. Resize browser to view.</p>
                </div>

                <div class="col_one_third nobottommargin center">
                    <a href="#"><img src="{{ asset('images/public/appshowcase/s4.png') }}" alt="Image" class="bottommargin-sm"></a>
                    <h4>Retina Ready Graphics</h4>
                    <p>Looks beautiful &amp; ultra-sharp on Retina Screen Displays. Retina Icons, Fonts &amp; all others graphics are optimized.</p>
                </div>

                <div class="col_one_third nobottommargin center col_last">
                    <a href="#"><img src="{{ asset('images/public/appshowcase/s5.png') }}" alt="Image" class="bottommargin-sm"></a>
                    <h4>Powerful Performance</h4>
                    <p>Canvas includes tons of optimized code that are completely customizable and deliver unmatched fast performance.</p>
                </div>

            </div>

            <div class="section nobottommargin" style="padding-bottom: 150px;">

                <div class="hidden-sm hidden-xs" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;background: transparent url('{{ asset('images/public/appshowcase/ipad-section.png') }}') bottom right no-repeat;"></div>

                <div class="container clearfix" style="z-index: 1;">

                    <div class="col-md-6 nobottommargin">

                        <div class="heading-block topmargin-sm">
                            <h2>Awesome Scalable Apps</h2>
                            <span>Our Template acts &amp; behaves truly as a Canvas.</span>
                        </div>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem maiores pariatur voluptatem placeat laborum iste accusamus nam unde, iure id.</p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet cumque, perferendis accusamus porro illo exercitationem molestias, inventore obcaecati ut omnis voluptatibus ratione odio amet magnam quidem tempore necessitatibus quaerat, voluptates excepturi voluptatem, veritatis qui temporibus.</p>

                        <a href="#" class="button button-border button-rounded button-large button-dark noleftmargin">Start Trial</a>

                    </div>

                </div>

            </div>

            <div class="section notopmargin nobottommargin">
                <div class="container clearfix">

                    <div class="col_half nobottommargin topmargin-lg">

                        <img src="{{ asset('images/public/appshowcase/iphone-solid.png') }}" alt="Image" class="center-block">

                    </div>

                    <div class="col_half nobottommargin topmargin-lg col_last">

                        <div class="heading-block topmargin-lg">
                            <h2>Typically Responsive</h2>
                            <span>Our App scales beautifully to different Devices.</span>
                        </div>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet cumque, perferendis accusamus porro illo exercitationem molestias, inventore obcaecati ut omnis voluptatibus ratione odio amet magnam quidem tempore necessitatibus quaerat, voluptates excepturi voluptatem, veritatis qui temporibus.</p>

                        <a href="#" class="button button-border button-rounded button-large button-dark noleftmargin">View Gallery</a>

                    </div>

                </div>
            </div>

            <div class="section dark notopmargin" style="padding-top: 60px;">
                <div class="container clearfix">

                    <div class="col_one_third">
                        <div class="feature-box fbox-plain">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-screen"></i></a>
                            </div>
                            <h3>Responsive Layout</h3>
                            <p>Powerful Layout with Responsive functionality that can be adapted to any screen size. Resize browser to view.</p>
                        </div>
                    </div>

                    <div class="col_one_third">
                        <div class="feature-box fbox-plain">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-eye"></i></a>
                            </div>
                            <h3>Retina Ready Graphics</h3>
                            <p>Looks beautiful &amp; ultra-sharp on Retina Screen Displays. Retina Icons, Fonts &amp; all others graphics are optimized.</p>
                        </div>
                    </div>

                    <div class="col_one_third col_last">
                        <div class="feature-box fbox-plain">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-beaker"></i></a>
                            </div>
                            <h3>Powerful Performance</h3>
                            <p>Canvas includes tons of optimized code that are completely customizable and deliver unmatched fast performance.</p>
                        </div>
                    </div>

                    <div class="clear"></div>

                    <div class="col_one_third nobottommargin">
                        <div class="feature-box fbox-plain">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-ok"></i></a>
                            </div>
                            <h3>12+ Header Designs</h3>
                            <p>We have included 12+ Header + Menu Designs for your convenience so that you can match your style.</p>
                        </div>
                    </div>

                    <div class="col_one_third nobottommargin">
                        <div class="feature-box fbox-plain">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-thumbs-up"></i></a>
                            </div>
                            <h3>Awesome Mega menu</h3>
                            <p>Completely Customizable 2 Columns, 3 Columns, 4 Columns &amp; 5 Columns Mega Menus are available with Canvas.</p>
                        </div>
                    </div>

                    <div class="col_one_third nobottommargin col_last">
                        <div class="feature-box fbox-plain">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-magnet"></i></a>
                            </div>
                            <h3>Attractive Sticky Menu</h3>
                            <p>Smooth &amp; Stylish Sticky Menu is what will make your Website differentiate with others.</p>
                        </div>
                    </div>

                    <div class="clear"></div><div class="line"></div>

                    <div class="heading-block center">
                        <h2>Looks beautiful on all displays.</h2>
                    </div>

                    <div style="position: relative; margin-bottom: -60px;" data-height-lg="415" data-height-md="342" data-height-sm="262" data-height-xs="160" data-height-xxs="102">
                        <img src="{{ asset('images/public/services/chrome.png') }}" style="position: absolute; top: 0; left: 0;" data-animate="fadeInUp" alt="Chrome">
                        <img src="{{ asset('images/public/services/ipad3.png') }}" style="position: absolute; top: 0; left: 0;" data-animate="fadeInUp" data-delay="300" alt="iPad">
                    </div>

                </div>
            </div>

            <div class="container clearfix">

                <div class="heading-block center">
                    <h3>Available on all Major Platforms.</h3>
                    <span>We have made our App available on all Major Platforms</span>
                </div>

                <p class="divcenter center" style="max-width: 800px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo animi ab dolorem deleniti, incidunt, recusandae tenetur eius aut similique delectus nisi labore odit temporibus reprehenderit eum iure natus voluptatem commodi? Quam ea, placeat quia et dignissimos laboriosam unde earum repudiandae?</p>

                <div class="col_full center topmargin nobottommargin">

                    <a href="#" class="social-icon si-appstore si-large si-rounded si-colored inline-block" title="iOS App Store">
                        <i class="icon-appstore"></i>
                        <i class="icon-appstore"></i>
                    </a>

                    <a href="#" class="social-icon si-android si-large si-rounded si-colored inline-block" title="Android Store">
                        <i class="icon-android"></i>
                        <i class="icon-android"></i>
                    </a>

                    <a href="#" class="social-icon si-gplus si-large si-rounded si-colored inline-block" title="Windows Store">
                        <i class="icon-windows3"></i>
                        <i class="icon-windows3"></i>
                    </a>

                </div>

            </div>


        </div>

    </section><!-- #content end -->

@endsection
