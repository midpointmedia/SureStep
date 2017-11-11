<?php
    	$title = 'Contact Us';
		$this->assign('title',$title); 
?>

<script type="text/javascript">

jQuery(window).ready(function () {

	$('#contact_submit').click(function(){

		$('#sent_failed').addClass('hide');
		$('#sent_ok').addClass('hide');
		$('#sent_required').addClass('hide');
		$('#send_another').addClass('hide');

		var btnSubmit	= $('#contact_submit').val();

		$('#contact_submit').attr('disable',true);

		var fullName 	= $('#contact_name').val();
		var email 		= $('#contact_email').val();
		var phone		= $('#contact_phone').val();
		var subject		= $('#contact_subject').val();
		var message		= $('#contact_message').val();

		if(fullName.length > 0 && email.length > 0 && message.length > 0){

			var xmlRequest = $.ajax({
								  url			: "/crm/rest/index.cfm/SendEmailMessage/",
								  processData	: true,
								  type			: 'post',
								  dataType		: 'json'
								  ,data			: {'fullName' : fullName, 'email': email, 'phone': phone, 'subject': subject, 'message': message}
								});

			xmlRequest.done(function( doc ) {
				//console.log(doc);

				$('#contactForm').hide();
				$('#sent_ok').removeClass('hide');
				$('#send_another').removeClass('hide');

			})
			xmlRequest.fail(function( jqXHR, textStatus ) {

				//console.log( "Request Failed: " + textStatus );

				$('#contact_submit').attr('disable',false);
				$('#sent_failed').removeClass('hide');

			});
		}else{

			$('#sent_required').removeClass('hide');
		}

	});

	$('#send_another').click(function(){
		$('#sent_ok').addClass('hide');
		$('#send_another').addClass('hide');
		$('#contact_subject').val('');
		$('#contact_message').val('');
		$('#contactForm').show();

	});

});
</script>

			<!-- PAGE TITLE -->
			<header id="page-title"> <!-- style="background-image:url('assets/images/demo/parallax_bg.jpg')" -->
				<!--
					Enable only if bright background image used
					<span class="overlay"></span>
				-->

				<div class="container">
					<h1>Contact Us</h1>

					<ul class="breadcrumb">
						<li><a href="/weepee/pages/home">Home</a></li>
						<li class="active">Contact</li>
					</ul>
				</div>
			</header>

			<section id="contact" class="container">


				<div class="row">

					<!-- FORM -->
					<div class="col-md-8">

						<h2 id="messageTitle">Drop us a line or just say <strong><em>Hello!</em></strong></h2>

						<!--
							if you want to use your own contact script, remove .hide class
						-->

						<!-- SENT OK -->
						<div id="sent_ok" class="alert alert-success fade in fsize16 hide">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Thank You!</strong> Your message successfully sent!
						</div>
						<div id="send_another" class="hide"><a href="#">Send Another</a></div>
						<!-- /SENT OK -->

						<!-- SENT FAILED -->
						<div id="sent_required" class="alert alert-danger fade in fsize16 hide">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Failed!</strong> Please complete all mandatory (*) fields!
						</div>
						<div id="sent_failed" class="alert alert-danger fade in fsize16 hide">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Failed!</strong> Please try again.
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
									<!--
									<span class="pull-right">
										<label class="block text-right fsize12">Antispam Code</label>
										<img alt="" rel="nofollow,noindex" width="50" height="18" src="php/captcha.php?bgcolor=ffffff&amp;txtcolor=000000">
										<input type="text" name="contact_captcha" id="contact_captcha" value="" data-msg-required="Please enter the subject." maxlength="6" style="width:100px; margin-left:10px;">
									</span>
									-->
									<input id="contact_submit" type="button" value="Send Message" class="btn btn-primary btn-lg" data-loading-text="Loading...">
								</div>
							</div>

						</form>

					</div>
					<!-- /FORM -->


					<!-- INFO -->
					<div class="col-md-4">

						<h2><strong>Visit Us</strong> <small>(by Appointment)</small></h2>

						<div class="white-row">
							<div id="gmap"><!-- google map --></div>
							<script type="text/javascript">
								var	$googlemap_latitude 	= 36.161491,
									$googlemap_longitude	= -115.149693,
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

