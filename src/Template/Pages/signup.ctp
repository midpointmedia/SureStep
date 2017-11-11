<?php
    	$title = 'Sign Up';
		$this->assign('title',$title); 
?>

  
			<!-- PAGE TITLE -->
			<header id="page-title"> <!-- style="background-image:url('assets/images/demo/parallax_bg.jpg')" -->
				<!--
					Enable only if bright background image used
					<span class="overlay"></span>
				-->

				<div class="container">
					<h1>Sign Up</h1>

					<ul class="breadcrumb">
						<li><a href="/weepee/pages/home">Home</a></li>
						<li class="active">Sign Up</li>
					</ul>
				</div>
			</header>

			<section id="contact" class="container">


				<div class="row">

					<!-- FORM -->
					<div class="col-md-8">

						<h2>Ready to get this party <strong><em>Started?</em></strong></h2>

						<!--
							if you want to use your own contact script, remove .hide class
						-->

						<!-- SENT OK -->
						<div id="_sent_ok_" class="alert alert-success fade in fsize16 hide">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Thank You!</strong> Your message successfully sent!
						</div>
						<!-- /SENT OK -->

						<!-- SENT FAILED -->
						<div id="_sent_required_" class="alert alert-danger fade in fsize16 hide">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Failed!</strong> Please complete all mandatory (*) fields!
						</div>
						<!-- /SENT FAILED -->

						<form id="contactForm" class="white-row" action="php/contact.php" method="post">
							<div class="row">
								<div class="form-group">
									<div class="col-md-4">
										<label>Full Name *</label>
										<input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="contact_name" id="contact_name">
									</div>
									<div class="col-md-4">
										<label>E-mail Address *</label>
										<input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="contact_email" id="contact_email">
									</div>
									<div class="col-md-4">
										<label>Phone</label>
										<input type="text" value="" data-msg-required="Please enter your phone" data-msg-email="Please enter your phone" maxlength="100" class="form-control" name="contact_phone" id="contact_phone">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-md-12">
										<label>Subject</label>
										<input type="text" value="" data-msg-required="Please enter the subject." maxlength="100" class="form-control" name="contact_subject" id="contact_subject">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-md-12">
										<label>Message *</label>
										<textarea maxlength="5000" data-msg-required="Please enter your message." rows="10" class="form-control" name="contact_message" id="contact_message"></textarea>
									</div>
								</div>
							</div>

							<br />

							<div class="row">
								<div class="col-md-12">
									<span class="pull-right"><!-- captcha -->
										<label class="block text-right fsize12">Antispam Code</label>
										<img alt="" rel="nofollow,noindex" width="50" height="18" src="php/captcha.php?bgcolor=ffffff&amp;txtcolor=000000">
										<input type="text" name="contact_captcha" id="contact_captcha" value="" data-msg-required="Please enter the subject." maxlength="6" style="width:100px; margin-left:10px;">
									</span>

									<input id="contact_submit" type="submit" value="Send Message" class="btn btn-primary btn-lg" data-loading-text="Loading...">
								</div>
							</div>
						</form>

					</div>
					<!-- /FORM -->


					<!-- INFO -->
					<div class="col-md-4">

						<h2>Upload Content</h2>

						<div class="white-row">
							<div id="gmap"><!-- google map --></div>
							<script type="text/javascript">
								var	$googlemap_latitude 	= -37.812344,
									$googlemap_longitude	= 144.968900,
									$googlemap_zoom			= 13;
							</script>

							<div class="divider white half-margins"><!-- divider -->
								<i class="fa fa-star"></i>
							</div>

							<p class="nomargin-bottom">
								<span class="block"><strong><i class="fa fa-map-marker"></i> Address:</strong> <br/>200 Hoover Ave, #1612 <br/>Las Vegas, NV <br/><br/></span>
								<span class="block"><strong><i class="fa fa-phone"></i> Phone:</strong> 915-443-5501</span>
								<span class="block"><strong><i class="fa fa-envelope"></i> Email:</strong> <a href="mailto:info@WeePeeApp.com">info@WeePeeApp.com</a></span>
							</p>

						</div>


					</div>
					<!-- /INFO -->

				</div>

			</section>

