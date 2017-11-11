<!-- PAGE TITLE -->
			<header id="page-title"> 
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

			<h2 id="mainTitle">Ready, Set, <strong><em>GO!</em></strong></h2>

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

			<form id="contactForm" class="white-row" action="/WeePee/Agency/Sign_Up" method="post">
				<div class="row">
					<div class="form-group">
						<div class="col-md-4">
							<label>Full Name *</label>
							<input 	type="text" value="" 
									data-msg-required="Please enter your name." 
									maxlength="100" 
									class="form-control" 
									name="poc_name" 
									id="poc_name">
						</div>
						<div class="col-md-4">
							<label>E-mail Address *</label>
							<input 	type="email" value="" 
									data-msg-required="Please enter your email address." 
									data-msg-email="Please enter a valid email address." 
									maxlength="100" 
									class="form-control" 
									name="poc_email" 
									id="poc_email">
						</div>
						<div class="col-md-4">
							<label>Phone</label>
							<input 	type="text" value="" 
									data-msg-required="Please enter your phone" 
									data-msg-email="Please enter your phone" 
									maxlength="100" 
									class="form-control"
									 name="poc_phone" 
									 id="poc_phone">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-3">
							<label>Agency Name</label>
							<input 	type="text" value="" 
									data-msg-required="Please enter your Agency's name." 
									maxlength="100" 
									class="form-control" 
									name="agency_name" 
									id="agency_name">
						</div>
						<div class="col-md-3">
							<label>Program Name</label>
							<input 	type="text" value="" 
									data-msg-required="Please enter your Program's name." 
									maxlength="100" 
									class="form-control" 
									name="program_name" 
									id="program_name">
						</div>
						<div class="col-md-3">
							<label>How many participants?</label>
							<input 	type="number" value="" 
									data-msg-required="How many participants are in your program?" 
									value="10"
									class="form-control" 
									name="participant_count" 
									id="participant_count">
						</div>
						<div class="col-md-3">
							<label>Location</label>
							<input 	type="text" value="" 
									data-msg-required="Where is your program located?" 
									maxlength="100" 
									class="form-control" 
									name="program_location" 
									id="program_location">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label>Program Description *</label>
							<textarea 	maxlength="5000" 
										data-msg-required="Describe your program." 
										rows="10" 
										class="form-control" 
										name="program_desc" 
										id="program_desc">
							</textarea>
						</div>
					</div>
				</div>

				<br />

				<div class="row">
					<div class="col-md-12">
						

						<input 	id="contact_submit" type="submit" value="Send Message" 
								class="btn btn-primary btn-lg" 
								data-loading-text="Loading...">
					</div>
				</div>
			</form>
		
		</div>
		<!-- /FORM -->


		<!-- INFO -->
		<div class="col-md-4">

			<h2 id="nextStepTitle">Pending <strong>Submission</strong></h2>

			<div class="white-row">
				<figure>
					<img class="radius6 img-responsive" src="assets/images/demo/test_2.jpg" alt="" />
				</figure>

				<p>
					After submitting your application an email will be sent to you. Please take a minute to click on the verification link in the body of the email. Once verified, we will work to review your appication within 24hrs. 
				</p>
				

			</div>


		</div>
		<!-- /INFO -->

	</div>

</section>



<script type="text/javascript">
	$(document).ready(function() {
		
		<?php
        	echo "var _FormStatus = '". $formStatus ."';";
        ?>

        if(_FormStatus == "PendingSubmission")
        {


        }
        else if(_FormStatus == "PendingApproval")
        {
        	$('#_sent_ok_').removeClass("hide");
        	$('#nextStepTitle').html("Pending <strong>Approval</strong>");
        	$('#mainTitle').remove();
        	//$('#mainTitle').html("Thank you.");

        }


	});


	
	
</script>











