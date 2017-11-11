<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$cakeDescription = 'WeePee';

$this->layout = false;
?>


<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
	<head>
		<?= $this->Html->charset() ?>
		<title>
			<?= $cakeDescription ?>:
        	<?= $this->fetch('title') ?>		
		</title>
		<meta name="keywords" content="WeePee Court Color Colors UA Pee" />
		<meta name="description" content="" />
		<meta name="Author" content="Daniel Lopez [www.midpointmedia.com]" />

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
		<!--
		<?= $this->Html->meta('icon') ?>
		--> 
		
		<script type="text/javascript" src="/weepee/plugins/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="/weepee/js/jquery-cookie-master/src/jquery.cookie.js"></script>
		<script type="text/javascript" src="/weepee/js/JSON-js-master/json2.js"></script>
		<script type="text/javascript" src="/weepee/js/Highcharts-4.1.7/js/highcharts.js"></script>
		
		<!-- WEB FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet" type="text/css" />

		<!-- CORE CSS -->
		<link href="/weepee/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />	
		<link href="/weepee/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="/weepee/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
		<link href="/weepee/plugins/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css" />
		<link href="/weepee/plugins/owl-carousel/owl.transitions.css" rel="stylesheet" type="text/css" />
		<link href="/weepee/plugins/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />
		<link href="/weepee/css/animate.css" rel="stylesheet" type="text/css" />
		<link href="/weepee/css/superslides.css" rel="stylesheet" type="text/css" />
		
		<!-- REVOLUTION SLIDER -->
		<link href="/weepee/plugins/revolution-slider/css/settings.css" rel="stylesheet" type="text/css" />
		
		<!-- THEME CSS -->
		<link href="/weepee/css/essentials.css" rel="stylesheet" type="text/css" />
		<link href="/weepee/css/layout.css" rel="stylesheet" type="text/css" />
		<link href="/weepee/css/layout-responsive.css" rel="stylesheet" type="text/css" />
		<link href="/weepee/css/pink.css" rel="stylesheet" type="text/css" />


		<!-- Morenizr -->
		<script type="text/javascript" src="/weepee/plugins/modernizr.min.js"></script>
		
		<!--
		<script type="text/javascript">
		  window.mopub = [{
		    ad_unit: "d0fa653f5c2e43649d4191cf2a4246c9",
		    ad_container_id: "mopub_skyscraper", // Specify the div or container to which you’d like to the mobile web tag
		    ad_width: 300,
		    ad_height: 250,
		    keywords: "", // Optionally pass keywords as a comma separated list
		  } ]; // To load additional ad units, add another object into the array.

		  (function() {
		    var mopubjs = document.createElement("script");
		    mopubjs.async = true;
		    mopubjs.type = "text/javascript";
		    mopubjs.src = "//d1zg4cyg8u4pko.cloudfront.net/mweb/mobileweb.min.js";
		    var node = document.getElementsByTagName("script")[0];
		    node.parentNode.insertBefore(mopubjs, node);
		  })();
		</script>
		-->
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	</head>
	<body><!-- Available classes for body: boxed , pattern1...pattern10 . Background Image - example add: data-background="view/site/weepee/assets/images/boxed_background/1.jpg"  -->


		<header id="topHead">
			<div class="container">
				<span class="quick-contact pull-left hidden-xs">
				<i class="fa fa-phone"></i> 915-443-5501 &bull;
				<a class="" href="mailto:info@WeePeeApp.com">info@WeePeeApp.com</a>
				</span>

				<div class="pull-right socials">
					<a href="http://facebook.com/WeePeeApp" target="_blank" class="pull-left social fa fa-facebook"></a>
					<a href="http://twitter.com/WeePeeApp" target="_blank" class="pull-left social fa fa-twitter"></a>
					<a href="https://plus.google.com/communities/108237592588906466898" target="_blank" class="pull-left social fa fa-google-plus"></a>
				</div>

				<div class="pull-right nav">
					<a href="/weepee/pages/About"><i class="fa fa-angle-right"></i> About Us</a>
					<a href="/weepee/pages/Contact"><i class="fa fa-angle-right"></i> Contact Us</a>
				</div>
			</div>
		</header>

		<!-- TOP NAV -->
		<header id="topNav" class="topHead">
			<div class="container">

				<!-- Mobile Menu Button -->
				<button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
					<i class="fa fa-bars"></i>
				</button>

				<!-- Logo text or image -->
				<a class="logo" href="/weepee/pages/home">
					<img src="/weepee/img/logo_weepee.png" alt="WeePee" />
				</a>

				<!-- Top Nav -->
				<div class="navbar-collapse nav-main-collapse collapse pull-right">
					<nav class="nav-main mega-menu">
						<ul class="nav nav-pills nav-main scroll-menu" id="topMain">
							<!--
							<li class="dropdown active">
								<a class="dropdown-toggle" href="#">
									Home <i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="/weepee/pages/home">Home Page</a>
									</li>
									<li>
										<a href="/weepee/pages/TodaysColors">Today's Colors</a>
									</li>
									<li>
										<a href="/weepee/pages/Reports">Reports</a>
									</li>
								</ul>
							</li>

							
							<li class="dropdown">
								<a class="dropdown-toggle" href="?event=WeePee.about">
									About <i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="?event=WeePee.Contact">Contact Us</a>
									</li>
								</ul>
							</li>
							-->
							<!--
							<li class="dropdown">
								<a class="dropdown-toggle" href="/weepee/pages/Features">
									Features <i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="/weepee/pages/FeaturesPeeSchedule">Pee Schedule</a>
									</li>
									<li>
										<a href="/weepee/pages/FeaturesReporting">Reporting</a>
									</li>
									<li>
										<a href="/weepee/pages/CommunityApproved">Community Approved</a>
									</li>
								</ul>
							</li>
							-->
							<li class="dropdown">
								<!--?event=WeePee.mediakit-->
								<a class="dropdown-toggle" href="/weepee/pages/Home">
									Home 
								</a>
							</li>
							<li class="dropdown">
								<!--?event=WeePee.mediakit-->
								<a class="dropdown-toggle" href="/weepee/pages/Features">
									Features 
								</a>
							</li>
							<li class="dropdown">
								<!--?event=WeePee.mediakit-->
								<a class="dropdown-toggle" href="/weepee/pages/Pricing">
									Pricing 
								</a>
							</li>
							<li class="dropdown">
								<!--?event=WeePee.mediakit-->
								<a class="dropdown-toggle" href="/weepee/Agency/Sign_Up">
									Sign Up 
								</a>
							</li>
							<!--
							<li class="dropdown">
								<a class="dropdown-toggle" href="#">
									Shop <i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu">
									<li><a href="magazine-home.html">Ads</a></li>
									<li><a href="magazine-home.html">Shirts</a></li>
									<li><a href="magazine-home.html">Stickers</a></li>
								</ul>
							</li>
							-->
						</ul>
					</nav>
				</div>
				<!-- /Top Nav -->

			</div>
		</header>

		<span id="header_shadow"></span>
		<!-- /TOP NAV -->


		<!-- WRAPPER -->
		<div id="wrapper">

	<?= $this->Flash->render() ?>

    <div>
        <?= $this->fetch('content') ?>
    </div>

		</div>
		<!-- /WRAPPER -->



		<!-- FOOTER -->
		<footer>

			<!-- copyright , scrollTo Top -->
			<div class="footer-bar">
				<div class="container">
					<span class="copyright">Copyright &copy; WeePee, LLC . All Rights Reserved.</span>
					<a class="toTop" href="#topNav">BACK TO TOP <i class="fa fa-arrow-circle-up"></i></a>
					  <a href="/weepee/pages/Privacy">Privacy</a>
				</div>

			</div>
			<!-- copyright , scrollTo Top -->


			<!-- footer content -->
			<div class="footer-content">
				<div class="container">

					<div class="row">


						<!-- FOOTER CONTACT INFO -->
						<div class="column col-md-4">
							<!--<h3>CONTACT</h3>-->

							<p class="contact-desc">
								WeePee, the easiest way to keep track of when you have to submit a court or probation mandated random urine analysis (UA) test. 
							
							</p>
							<address class="font-opensans">
								<ul>
									<li class="footer-sprite address">
										200 Hoover Ave Suite 1612<br />
										Las Vegas, NV 89101<br />
										<br />
									</li>
									<li class="footer-sprite phone">
										Phone: 1-915-443-5501
									</li>
									<li class="footer-sprite email">
										<a href="mailto:info@WeePeeApp.com">info@WeePeeApp.com</a>
									</li>
								</ul>

							</address>

						</div>
						<!-- /FOOTER CONTACT INFO -->


						<!-- FOOTER LOGO -->
						<div class="column logo col-md-4 text-center">
							<div class="logo-content">
								<img class="animate_fade_in" src="/weepee/img/logo_footer.png" width="200" alt="" />
								<h4></h4>
							</div>

						</div>
						<!-- /FOOTER LOGO -->


						<!-- FOOTER LATEST POSTS -->
						<div class="column col-md-4 text-right">
							<!--<h3>DOWNLOAD TODAY!</h3>-->

							<a href="https://play.google.com/store/apps/details?id=com.midpointmedia.weepee&hl=en" target="_blank">
							<img src="/weepee/img/images/google_badge.png" alt="Download at the Google Play Store" />
							</a>
							<br/>
							<br/>
							<a href="https://itunes.apple.com/us/genre/ios-medical/id6020?mt=8" target="_blank">
							<img src="/weepee/img/images/apple_badge.png" alt="Download at the Apple App Store" />
							</a>
							<!---
							<a href="blog-masonry-sidebar.html" class="view-more pull-right">View Blog <i class="fa fa-arrow-right"></i></a>
							--->
						</div>
						<!-- /FOOTER LATEST POSTS -->

					</div>

				</div>
			</div>
			<!-- footer content -->

		</footer>
		<!-- /FOOTER -->



		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript" src="/weepee/plugins/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="/weepee/plugins/jquery.cookie.js"></script>
		<script type="text/javascript" src="/weepee/plugins/jquery.appear.js"></script>
		<script type="text/javascript" src="/weepee/plugins/jquery.isotope.js"></script>
		<script type="text/javascript" src="/weepee/plugins/masonry.js"></script>
		
		<script type="text/javascript" src="/weepee/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/weepee/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script type="text/javascript" src="/weepee/plugins/owl-carousel/owl.carousel.min.js"></script>
		<script type="text/javascript" src="/weepee/plugins/stellar/jquery.stellar.min.js"></script>
		<script type="text/javascript" src="/weepee/plugins/knob/js/jquery.knob.js"></script>
		<script type="text/javascript" src="/weepee/plugins/jquery.backstretch.min.js"></script>
		<script type="text/javascript" src="/weepee/plugins/superslides/dist/jquery.superslides.min.js"></script>
		<script type="text/javascript" src="/weepee/plugins/styleswitcher/styleswitcher.js"></script>
		
		<script type="text/javascript" src="/weepee/plugins/mediaelement/build/mediaelement-and-player.min.js"></script>
		
		<!-- REVOLUTION SLIDER -->
		<script type="text/javascript" src="/weepee/plugins/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
		<script type="text/javascript" src="/weepee/plugins/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>
		<script type="text/javascript" src="/weepee/js/slider_revolution.js"></script>
		
		<script type="text/javascript" src="/weepee/js/scripts.js"></script>
		

		<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information. -->

		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-20885968-5', 'auto');
		  ga('send', 'pageview');
		</script>


	</body>
</html>




