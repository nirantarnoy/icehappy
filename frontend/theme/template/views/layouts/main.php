<?php
use yii\helpers\Html;
use frontend\assets\TemplateAsset;


TemplateAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9 no-js" lang="en"><![endif]-->
<!--[if gt IE 9 | !IE]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>บริษัทน้ำแข็งแฮปปี้</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="icon" href="img/favicon.ico">

    <!--<![endif]-->

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody()?>
<div class="site">
    <div class="site-loader">
        <div class="site-loader-spinner"></div>
    </div> <!-- .site-loader -->

    <div class="site-canvas">
        <header class="site-header">
            <nav class="navbar navbar-theme">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="navbar-brand-wrap">
                            <a class="navbar-brand" href="#">
                                <img src="img/logo.png" alt="" style="width: 50px;height: 100px;">
                            </a>
                        </div>
                    </div> <!-- .navbar-header -->

                    <div class="collapse navbar-collapse" id="navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active"><a href="#home">หน้าแรก</a></li>
                            <li><a href="#about">เกี่ยวกับเรา</a></li>
                            <li><a href="#brief_1">Brief</a></li>
                            <li><a href="#pricing">Pricing</a></li>
                            <li><a href="#download">Download</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li class="audio-toggle"><a href="#"><i class="fa fa-volume-up"></i></a></li>
                        </ul>
                    </div> <!-- .navbar-collapse -->
                </div>
            </nav>
        </header> <!-- .site-header -->
        <main class="site-main">
            <div id="home" class="section block-primary position-r align-c-xs-max">
                <div id="particles-js" class="site-bg">
                    <div class="site-bg-img"></div>
                    <div class="site-bg-video"></div>
                    <div class="site-bg-overlay"></div>
                    <div class="site-bg-effect layer" data-depth=".30"></div>
                    <canvas class="site-bg-canvas layer" data-depth=".30"></canvas>
                </div> <!-- .site-bg -->

                <div class="container">
                    <div class="row row-table">
                        <div class="col-sm-6">
                            <div class="col-inner" data-sr="left">
                                <div class="section-heading">
                                    <h5>Flat Style Landing Page</h5>
                                    <h1>A Flat Style Landing Page For Your App / Product</h1>
                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum</p>
                                </div> <!-- .section-heading -->
                                <div class="section-content">
                                    <a class="btn btn-pink m-y-5" href="#about">Learn More</a>
                                    <a class="btn btn-warning m-y-5" href="#download">Get The App</a>
                                </div> <!-- .section-content -->
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-p-l-1 m-t-60-xs-max">
                            <div class="col-inner clearfix">
                                <img class="img-responsive float-r-sm-min m-x-auto-xs-max" src="img/item/home.png" alt="" data-sr="right">
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- #home -->

            <div id="about" class="section p-a-0 align-c">
                <div class="container-fluid p-x-0">
                    <div class="row row-table">
                        <div class="col-sm-4 block-invert p-x-30-sm-max p-x-60-md-min p-t-20-sm-min align-t-sm-min">
                            <div class="col-inner p-y-50-sm-min p-y-30-xs-max max-width m-x-auto-xs-max">
                                <div class="icon-box _center">
                                    <div class="icon-box-media">
                                        <img src="img/icon/rocket.png" alt="" data-sr="bottom">
                                    </div>
                                    <div class="icon-box-heading">
                                        <h3>About App / Product</h3>
                                    </div>
                                    <div class="icon-box-content">
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 block-pink p-x-30-sm-max p-x-60-md-min p-t-20-sm-min align-t-sm-min">
                            <div class="col-inner p-y-50-sm-min p-y-30-xs-max max-width m-x-auto-xs-max">
                                <div class="icon-box _center">
                                    <div class="icon-box-media">
                                        <img src="img/icon/crown.png" alt="" data-sr="bottom">
                                    </div>
                                    <div class="icon-box-heading">
                                        <h3>About App / Product</h3>
                                    </div>
                                    <div class="icon-box-content">
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 block-light p-x-30-sm-max p-x-60-md-min p-t-20-sm-min align-t-sm-min">
                            <div class="col-inner p-y-50-sm-min p-y-30-xs-max max-width m-x-auto-xs-max">
                                <div class="icon-box _center">
                                    <div class="icon-box-media">
                                        <img src="img/icon/diamond.png" alt="" data-sr="bottom">
                                    </div>
                                    <div class="icon-box-heading">
                                        <h3>About App / Product</h3>
                                    </div>
                                    <div class="icon-box-content">
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- #about -->

            <div id="brief_1" class="section block-default align-c-xs-max">
                <div class="container">
                    <div class="row row-table">
                        <div class="col-sm-6">
                            <div class="col-inner">
                                <div class="section-heading">
                                    <h5>Flat Style Landing Page</h5>
                                    <h2>App Brief Section #1</h2>
                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores.</p>
                                </div> <!-- .section-heading -->
                                <div class="section-content">
                                    <ul class="icon-list align-l m-t-30">
                                        <li><img src="img/icon/chat.png" alt=""> Quisque sapien metus, ornare ac suscipit eget.</li>
                                        <li><img src="img/icon/pencil.png" alt=""> Quisque sapien metus, ornare ac suscipit eget.</li>
                                        <li><img src="img/icon/skull.png" alt=""> Quisque sapien metus, ornare ac suscipit eget.</li>
                                    </ul>
                                    <a class="btn btn-primary m-y-5" href="#brief_2">Learn More</a>
                                    <a class="btn btn-invert m-y-5" href="#brief_2">More Button</a>
                                </div> <!-- .section-content -->
                            </div>
                        </div>
                        <div class="col-sm-6 m-t-60-xs-max p-l-60-md-min">
                            <div class="col-inner clearfix">
                                <img class="img-responsive float-r-sm-min m-x-auto-xs-max" src="img/item/brief-1.png" alt="" data-sr="right">
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- #brief_1 -->

            <div id="brief_2" class="section block-warning align-c-xs-max">
                <div class="container">
                    <div class="row row-table">
                        <div class="col-sm-6 m-b-60-xs-max p-r-60-md-min">
                            <div class="col-inner clearfix">
                                <img class="img-responsive float-l-sm-min m-x-auto-xs-max" src="img/item/brief-2.png" alt="" data-sr="left">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-inner">
                                <div class="section-heading">
                                    <h5>Flat Style Landing Page</h5>
                                    <h2>App Brief Section #2</h2>
                                </div> <!-- .section-heading -->
                                <div class="section-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam in scelerisque nisi, a convallis nibh. Etiam posuere faucibus lectus, quis volutpat urna consequat et. Aenean rutrum dui in turpis feugiat, at facilisis dui laoreet.</p>
                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores.</p>
                                    <a class="btn btn-success m-y-5" href="#brief_3">Learn More</a>
                                    <a class="btn btn-pink m-y-5" href="#brief_3">More Button</a>
                                </div> <!-- .section-content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- #brief_2 -->

            <div id="brief_3" class="section block-success align-c-xs-max">
                <div class="container">
                    <div class="row row-table">
                        <div class="col-sm-6">
                            <div class="col-inner">
                                <div class="section-heading">
                                    <h5>Flat Style Landing Page</h5>
                                    <h2>App Brief Section #3</h2>
                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores.</p>
                                </div> <!-- .section-heading -->
                                <div class="section-content">
                                    <ul class="icon-list align-l m-t-30">
                                        <li><img src="img/icon/camera.png" alt=""> Quisque sapien metus, ornare ac suscipit eget.</li>
                                        <li><img src="img/icon/support.png" alt=""> Quisque sapien metus, ornare ac suscipit eget.</li>
                                        <li><img src="img/icon/paint.png" alt=""> Quisque sapien metus, ornare ac suscipit eget.</li>
                                    </ul>
                                    <a class="btn btn-primary m-y-5" href="#pricing">Our Plan</a>
                                    <a class="btn btn-invert m-y-5" href="#pricing">More Button</a>
                                </div> <!-- .section-content -->
                            </div>
                        </div>
                        <div class="col-sm-6 m-t-60-xs-max p-l-60-md-min">
                            <div class="col-inner clearfix">
                                <img class="img-responsive float-r-sm-min m-x-auto-xs-max" src="img/item/brief-3.png" alt="" data-sr="right">
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- #brief_3 -->

            <div id="pricing" class="section block-light align-c">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-inner">
                                <div class="section-heading">
                                    <h5>Pricing Table Section</h5>
                                    <h2>Free And Business Plan</h2>
                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>
                                </div>
                                <div class="section-content m-t-60-sm-min">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="pricing-table m-t-0-xs-max">
                                                <div class="pricing-table-header block-invert">
                                                    <h5 class="pricing-table-caption">Checkmark pricing table</h5>
                                                    <h2 class="pricing-table-title">FREE</h2>
                                                </div>
                                                <div class="pricing-table-content block-light">
                                                    <ul class="pricing-table-list">
                                                        <li><i class="fa fa-check"></i> Up to 25 users</li>
                                                        <li><i class="fa fa-check"></i>500 messages</li>
                                                        <li><i class="fa fa-check"></i>Normal options</li>
                                                        <li><i class="fa fa-check"></i>Phone support</li>
                                                    </ul>
                                                </div>
                                                <div class="pricing-table-footer block-light">
                                                    <a class="btn btn-primary" href="#download">Download</a>
                                                </div>
                                            </div> <!-- .pricing-table -->
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="pricing-table">
                                                <div class="pricing-table-header block-primary">
                            <span class="pricing-table-badge">
                              <i class="fa fa-star"></i>
                            </span>
                                                    <h5 class="pricing-table-caption">With badge</h5>
                                                    <h2 class="pricing-table-title"><span>$</span>45<span>/ mo.</span></h2>
                                                </div>
                                                <div class="pricing-table-content block-light">
                                                    <ul class="pricing-table-list">
                                                        <li><i class="fa fa-check"></i> Up to 150 users</li>
                                                        <li><i class="fa fa-check"></i> 2000 messages</li>
                                                        <li><i class="fa fa-check"></i> Advanced options</li>
                                                        <li><i class="fa fa-check"></i> Phone support</li>
                                                    </ul>
                                                </div>
                                                <div class="pricing-table-footer block-light">
                                                    <a class="btn btn-primary" href="#download">Download</a>
                                                </div>
                                            </div> <!-- .pricing-table -->
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="pricing-table">
                                                <div class="pricing-table-header block-pink">
                                                    <h5 class="pricing-table-caption">Icon pricing table</h5>
                                                    <h2 class="pricing-table-title"><span>$</span>75<span>/ mo.</span></h2>
                                                </div>
                                                <div class="pricing-table-content block-light">
                                                    <ul class="pricing-table-list">
                                                        <li><i class="fa fa-user-plus"></i> Up to 500 users</li>
                                                        <li><i class="fa fa-envelope"></i> <span class="color-pink">Unlimited</span> messages</li>
                                                        <li><i class="fa fa-cog"></i> Advanced options</li>
                                                        <li><i class="fa fa-support"></i> Phone support</li>
                                                    </ul>
                                                </div>
                                                <div class="pricing-table-footer block-light">
                                                    <a class="btn btn-primary" href="#download">Download</a>
                                                </div>
                                            </div> <!-- .pricing-table -->
                                        </div>
                                    </div>
                                </div> <!-- .section-content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- #download -->

            <div id="download" class="section block-primary align-c">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-inner">
                                <div class="section-heading">
                                    <h5>Download Available</h5>
                                    <h2>Get It Right Now!</h2>
                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>
                                </div>
                                <div class="section-content">
                                    <a class="btn btn-pink m-y-5"><i class="fa fa-android"></i>Google Play</a>
                                    <a class="btn btn-warning m-y"><i class="fa fa-apple"></i>App Store</a>
                                </div> <!-- .section-content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- #download -->

            <div id="contact" class="section block-default">
                <div class="container">
                    <div class="section-heading text-center">
                        <h5>Flat Style Landing Page</h5>
                        <h2>Get in touch with us</h2>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>
                    </div>
                    <div class="row section-content m-t-60-sm-min">
                        <div class="col-sm-6 col-md-5">
                            <div class="col-inner">
                                <div class="icon-box _left">
                                    <div class="icon-box-media">
                                        <img src="img/icon/mobile.png" alt="" data-sr="bottom">
                                    </div>
                                    <div class="icon-box-heading">
                                        <h4>Phone Number</h4>
                                    </div>
                                    <div class="icon-box-content font-sub font-italic">
                                        <span>(00) 123-4567890 (tel-1)</span>
                                        <br>
                                        <span>(00) 123-4567890 (tel-2)</span>
                                    </div>
                                </div>

                                <div class="icon-box _left">
                                    <div class="icon-box-media">
                                        <img src="img/icon/mail.png" alt="" data-sr="bottom">
                                    </div>
                                    <div class="icon-box-heading">
                                        <h4>Email Address</h4>
                                    </div>
                                    <div class="icon-box-content font-sub font-italic">
                                        <span>email_1@example.com</span>
                                        <br>
                                        <span>email_2@example.com</span>
                                    </div>
                                </div>

                                <div class="icon-box _left">
                                    <div class="icon-box-media">
                                        <img src="img/icon/pin.png" alt="" data-sr="bottom">
                                    </div>
                                    <div class="icon-box-heading">
                                        <h4>Business address</h4>
                                    </div>
                                    <div class="icon-box-content font-sub font-italic">
                                        <span>631 Main Street Cottage,</span>
                                        <br>
                                        <span>Long Branch, P.O Box 55016</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-offset-1 m-t-60-xs-max">
                            <div class="col-inner">
                                <form class="_default" id="contactForm" novalidate="novalidate">
                                    <div class="form-group required">
                                        <label class="form-label" for="contactName">Your name</label>
                                        <input class="form-control" id="contactName" type="text" name="name">
                                    </div>
                                    <div class="form-group required">
                                        <label class="form-label" for="contactEmail">Email address</label>
                                        <input class="form-control" id="contactEmail" type="text" name="email">
                                    </div>
                                    <div class="form-group required">
                                        <label class="form-label" for="contactMessage">Message</label>
                                        <textarea class="form-control" id="contactMessage" rows="4" name="message"></textarea>
                                    </div>
                                    <div class="btn-wrap">
                                        <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                                    </div>
                                    <div class="form-notify"></div>
                                </form> <!-- #contactForm -->
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- #contact -->
<!--            <div id="map-canvas"></div> <!-- #map-canvas -->-->
        </main> <!-- .site-main -->
        <footer class="site-footer block-invert">
            <div class="container">
                <img class="site-footer-logo img-responsive" src="img/site-footer-logo.png" data-sr="bottom">
                <ul class="site-footer-social-list">
                    <li><a href="https://www.facebook.com/" target="_blank">Facebook</a></li>
                    <li><a href="https://twitter.com/" target="_blank">Twitter</a></li>
                    <li><a href="https://instagram.com/" target="_blank">Instagram</a></li>
                    <li><a href="https://www.linkedin.com/" target="_blank">LinkedIn</a></li>
                    <li><a href="https://www.pinterest.com/" target="_blank">Pinterest</a></li>
                </ul>
                <p class="site-footer-copyright">2018 © <a href="#" target="_blank">icehappy</a> | all rights reserved.</p>
            </div>
        </footer> <!-- .site-footer -->
    </div>
</div>


<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<!--
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='https://www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
-->
<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage() ?>
