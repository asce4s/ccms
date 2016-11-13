<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Medicio landing page template for Health niche</title>

    <!-- css -->
    <link href="{{ URL::asset('web/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('web/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('web/plugins/cubeportfolio/css/cubeportfolio.min.css') }}">
    <link href="{{ URL::asset('web/css/nivo-lightbox.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('web/css/nivo-lightbox-theme/default/default.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('web/css/owl.carousel.css') }}" rel="stylesheet" media="screen" />
    <link href="{{ URL::asset('web/css/owl.theme.css') }}" rel="stylesheet" media="screen" />
    <link href="{{ URL::asset('web/css/animate.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('web/css/style.css') }}" rel="stylesheet">

    <!-- boxed bg -->
    <link id="bodybg" href="bodybg/bg1.css" rel="stylesheet" type="text/css" />
    <!-- template skin -->
    <link id="t-colors" href="color/default.css" rel="stylesheet">


</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">

<div id="wrapper">

    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="top-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <p class="bold text-left">Monday - Saturday, 8am to 10pm </p>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <p class="bold text-right">Call us now (+94) 055 326 5630</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container navigation">

            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html">
                    <img src="{{ URL::asset('web/img/logo.png') }}" alt="" width="150" height="40" />
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="homepage.html">Home</a></li>
                    <li><a href="#service">Service</a></li>
                    <li><a href="#doctor">Doctors</a></li>
                    <li><a href="#facilities">Facilities</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge custom-badge red pull-right">Extra</span>More <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="register.html">Home form</a></li>
                            <li><a href="homepage.html">Home CTA</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <!-- Section: intro -->
    <section id="intro" class="intro">
        <div class="intro-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="wow fadeInDown" data-wow-offset="0" data-wow-delay="0.1s">
                            <h2 class="h-ultra">Osula  medicare</h2>
                        </div>
                        <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.1s">
                            <h4 class="h-light">Provide <span class="color">best quality healthcare</span> for you</h4>
                        </div>
                        <div class="well well-trans">
                            <div class="wow fadeInRight" data-wow-delay="0.1s">

                                <ul class="lead-list">
                                    <li><span class="fa fa-check fa-2x icon-success"></span> <span class="list"><strong>Choose your favourite doctor</strong><br />Lorem ipsum dolor sit amet, in verterem persecuti vix, sit te meis</span></li>
                                    <li><span class="fa fa-check fa-2x icon-success"></span> <span class="list"><strong>Laboratory Service</strong><br />Sit zril sanctus scaevola ei, ea usu movet graeco</span></li>
                                    <li><span class="fa fa-check fa-2x icon-success"></span> <span class="list"><strong>Only use friendly environment</strong><br />Wisi lobortis eos ex, per at movet delectus, qui no vocent deleniti</span></li>
                                </ul>

                            </div>
                        </div>


                    </div>
                    <div class="col-lg-6">
                        <div class="form-wrapper">
                            <div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s">

                                <div class="panel panel-skin">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Make an appoinment <small>(It's free!)</small></h3>
                                    </div>
                                    <div class="panel-body">
                                        <form role="form" class="lead">
                                            <div class="row">
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" name="first_name" id="first_name" class="form-control input-md">
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" name="last_name" id="last_name" class="form-control input-md">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" name="email" id="email" class="form-control input-md">
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Phone number</label>
                                                        <input type="text" name="phone" id="phone" class="form-control input-md">
                                                    </div>
                                                </div>

                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Doctor</label>
                                                        <select class="form-control select2" style="width: 100%;" ng-model="data.doc_id" name="doc_id">
                                                            @foreach($doc as $i)
                                                                <option value="{{$i->id}}">{{$i->emp->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="submit" value="Submit" class="btn btn-skin btn-block btn-lg">

                                            <p class="lead-footer">* We'll contact you by phone & email later</p>

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- /Section: intro -->

    <!-- Section: boxes -->
    <section id="boxes" class="home-section paddingtop-80">

        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-md-3">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="box text-center">

                            <i class="fa fa-check fa-3x circled bg-skin"></i>
                            <h4 class="h-bold">Make an appoinment</h4>
                            <p>
                                People who want to priority;You have got priority when you are booking for the doctors.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="box text-center">

                            <i class="fa fa-list-alt fa-3x circled bg-skin"></i>
                            <h4 class="h-bold">Pharmacy</h4>
                            <p>
                                Get the high quality service and trusted medicine. you can get the medicine much faster than other pharmas.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="box text-center">
                            <i class="fa fa-user-md fa-3x circled bg-skin"></i>
                            <h4 class="h-bold">Help by specialist</h4>
                            <p>
                                Get the high quality service and trusted medicine. you can get the medicine much faster than other pharmas.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="box text-center">

                            <i class="fa fa-hospital-o fa-3x circled bg-skin"></i>
                            <h4 class="h-bold">Get laboratory report</h4>
                            <p>
                                Get the high quality laboratory report faster.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /Section: boxes -->


    <!-- Section: services -->
    <section id="service" class="home-section nopadding paddingtop-60">

        <div class="container">

            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <img src="{{URL::asset('web/img/dummy/img-1.jpg')}}" class="img-responsive" alt="" />
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="wow fadeInRight" data-wow-delay="0.1s">
                        <div class="service-box">
                            <div class="service-icon">
                                <span class="fa fa-stethoscope fa-3x"></span>
                            </div>
                            <div class="service-desc">
                                <h5 class="h-light">Channeling Doctors</h5>
                                <p>Highest standards of clinical skills and care.</p>
                            </div>
                        </div>
                    </div>

                    <div class="wow fadeInRight" data-wow-delay="0.3s">
                        <div class="service-box">
                            <div class="service-icon">
                                <span class="fa fa-plus-square fa-3x"></span>
                            </div>
                            <div class="service-desc">
                                <h5 class="h-light">Pharmacy</h5>
                                <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="wow fadeInRight" data-wow-delay="0.3s">
                        <div class="service-box">
                            <div class="service-icon">
                                <span class="fa fa-user-md fa-3x"></span>
                            </div>
                            <div class="service-desc">
                                <h5 class="h-light">Dental Unit</h5>
                                <p>Standared service from high class dentist.</p>
                            </div>
                        </div>
                    </div>

                    <div class="wow fadeInRight" data-wow-delay="0.2s">
                        <div class="service-box">
                            <div class="service-icon">
                                <span class="fa fa-filter fa-3x"></span>
                            </div>
                            <div class="service-desc">
                                <h5 class="h-light">Laboratory</h5>
                                <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- /Section: services -->






    <!-- Section: works -->
    <section id="facilities" class="home-section paddingbot-60">
        <div class="container marginbot-50">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="wow fadeInDown" data-wow-delay="0.1s">
                        <div class="section-heading text-center">
                            <h2 class="h-bold">Our facilities</h2>
                            <p>Osula Medicare has world class facilities for our patient,You may forget our name, but you will never forget how we made you feel.</p>
                        </div>
                    </div>
                    <div class="divider-short"></div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12" >
                    <div class="wow bounceInUp" data-wow-delay="0.2s">
                        <div id="owl-works" class="owl-carousel">
                            <div class="item"><a href="{{URL::asset('web/img/photo/1.jpg')}}" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="img/works/1@2x.jpg"><img src="{{URL::asset('web/img/photo/1.jpg')}}" class="img-responsive" alt="img"></a></div>
                            <div class="item"><a href="{{URL::asset('web/img/photo/2.jpg')}}" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="img/works/2@2x.jpg"><img src="{{URL::asset('web/img/photo/2.jpg')}}" class="img-responsive " alt="img"></a></div>
                            <div class="item"><a href="{{URL::asset('web/img/photo/3.jpg')}}" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="img/works/3@2x.jpg"><img src="{{URL::asset('web/img/photo/3.jpg')}}" class="img-responsive " alt="img"></a></div>
                            <div class="item"><a href="{{URL::asset('web/img/photo/4.jpg')}}" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="img/works/4@2x.jpg"><img src="{{URL::asset('web/img/photo/4.jpg')}}" class="img-responsive " alt="img"></a></div>
                            <div class="item"><a href="{{URL::asset('web/img/photo/5.jpg')}}" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="img/works/5@2x.jpg"><img src="{{URL::asset('web/img/photo/5.jpg')}}" class="img-responsive " alt="img"></a></div>
                            <div class="item"><a href="{{URL::asset('web/img/photo/6.jpg')}}" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="img/works/6@2x.jpg"><img src="{{URL::asset('web/img/photo/6.jpg')}}" class="img-responsive " alt="img"></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>

        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="wow fadeInDown" data-wow-delay="0.1s">
                        <div class="widget">
                            <h5>About Olusa Medicare</h5>
                            <p>
                                World class treatment for low cost.
                            </p>
                        </div>
                    </div>
                    <div class="wow fadeInDown" data-wow-delay="0.1s">
                        <div class="widget">
                            <h5>Information</h5>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Laboratory</a></li>
                                <li><a href="#">Medical treatment</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="wow fadeInDown" data-wow-delay="0.1s">
                        <div class="widget">
                            <h5>Medicare center</h5>
                            <p>
                                We promise you can get treatment faster than other hospital.
                            </p>
                            <ul>
                                <li>
								<span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-calendar-o fa-stack-1x fa-inverse"></i>
								</span> Monday - Saturday, 8am to 10pm
                                </li>
                                <li>
								<span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-phone fa-stack-1x fa-inverse"></i>
								</span> (+94) 055 326 5630
                                </li>
                                <li>
								<span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i>
								</span>Olmedi@gmail.com
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="wow fadeInDown" data-wow-delay="0.1s">
                        <div class="widget">
                            <h5>Our location</h5>
                            <p>2nd mile post,Passara road,Baddulla</p>

                        </div>
                    </div>
                    <div class="wow fadeInDown" data-wow-delay="0.1s">
                        <div class="widget">
                            <h5>Follow us</h5>
                            <ul class="company-social">
                                <li class="social-facebook"><a href="http://facebook.com"><i class="fa fa-facebook"></i></a></li>
                                <li class="social-twitter"><a href="http://twiter.com"><i class="fa fa-twitter"></i></a></li>
                                <li class="social-google"><a href="http://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
                                <li class="social-vimeo"><a href="http://vimeo.com"><i class="fa fa-vimeo-square"></i></a></li>
                                <li class="social-dribble"><a href="http://dribbble.com"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="wow fadeInLeft" data-wow-delay="0.1s">
                            <div class="text-left">
                                <p>&copy;Copyright 2016 - Clinic Management System. All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>

<!-- Core JavaScript Files -->
<script src="{{ URL::asset('web/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('web/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('web/js/jquery.easing.min.js') }}"></script>
<script src="{{ URL::asset('web/js/wow.min.js') }}"></script>
<script src="{{ URL::asset('web/js/jquery.scrollTo.js') }}"></script>
<script src="{{ URL::asset('web/js/jquery.appear.js') }}"></script>
<script src="{{ URL::asset('web/js/stellar.js') }}"></script>
<script src="{{ URL::asset('web/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js') }}"></script>
<script src="{{ URL::asset('web/js/owl.carousel.min.js') }}"></script>
<script src="{{ URL::asset('web/js/nivo-lightbox.min.js') }}"></script>
<script src="{{ URL::asset('web/js/custom.js') }}"></script>

</body>

</html>