<?php
    	$title = 'Pricing';
		$this->assign('title',$title); 
?>

	<!-- PAGE TITLE -->
			<header id="page-title"> <!-- style="background-image:url('assets/images/demo/parallax_bg.jpg')" -->
				<!--
					Enable only if bright background image used
					<span class="overlay"></span>
				-->

				<div class="container">
					<h1>Pricing</h1>

					<ul class="breadcrumb">
						<li><a href="?event=WeePee.index">Home</a></li>
						<li class="active">Pricing</li>
					</ul>
				</div>
			</header>

			<section class="container">

				<h2><strong>Explore</strong> our simple pricing structure</h2>
				<p class="lead"><strong>Metered Services</strong> - only pay for what you use. Our pricing is based on the number of participants you service. </p>


				<!--
					BOOTSTRAP GRID
					4 columns: col-md-3
					3 columns: col-md-4
					2 columns: col-md-2

					For more info about bootstrap grid
					http://getbootstrap.com/css/#grid
				-->

				<!-- FOUR COLUMNS -->
				<div class="row pricetable-container">

					<div class="col-md-3 price-table">
						<h3>Get Started</h3>
						<p>
							FREE
							
						</p>

						<ul>
							<li>10 Participants</li>
							<li>3 Administrative Accounts</li>
							<li>Random Color Generator</li>
							<li>Schedule Analysis</li>
							<li>Participant Mobile App</li>
							<li>Free Setup</li>
						</ul>
						<a href="/weepee/pages/Signup?pkg=Barebones" class="btn btn-primary btn-sm">SIGN UP</a>
					</div>

					<div class="col-md-3 price-table popular">
						<h3>Colors</h3>
						<p id="colorCalcCost">
							$0.10
							<span>Per Day/ Per Participant</span>
						</p>
						<ul>
							<li>
								<input 	name="colorUserCount"
										id="colorUserCount" 
										type="number" 
										style="color:black; width: 50px; text-align: right;" 
										value="1" /> 
								participants
							</li>
							<li>unlimited Administrative Accounts</li>
							<li>Random Color Generator</li>
							<li>Schedule Analysis</li>
							<li>Participant Mobile App</li>
							<li>Remove Advertisements</li>
							<li>Free Setup</li>
						</ul>
						<a href="/WeePee/Agency/sign_up" class="btn btn-default btn-sm">SIGN UP</a>
					</div>

					<div class="col-md-3 price-table">
						<h3>+Location</h3>
						<p id="locCalcCost">
							$0.10
							<span>Per Day/ Per Participant</span>
						</p>
						<ul class="pricetable-items">
							<li>
								<input 	name="locUserCount"
										id="locUserCount" 
										type="number" 
										style="color:black; width: 50px; text-align: right;" 
										value="1" /> 
								participants
							</li>
							<li>Participant Check-in Reports</li>
							<li>Geofencing Alerts</li>
							<li>Location Analysis</li>
							<li>Participant Mobile App</li>
							<li>Free Setup</li>
						</ul>
						<a href="/WeePee/Agency/sign_up" class="btn btn-primary btn-sm">SIGN UP</a>
					</div>

					<div class="col-md-3 price-table">
						<h3>+Journal</h3>
						<p id="journalCalcCost">
							$0.05
							<span>Per Day/ Per Participant</span>
						</p>
						<ul>
							<li>
								<input 	name="journalUserCount"
										id="journalUserCount" 
										type="number" 
										style="color:black; width: 50px; text-align: right;" 
										value="1" /> 
								participants
							</li>
							<li>Participant Reports</li>
							<li>Journal Analysis</li>
							<li>Sentiment Analysis</li>
							<li>Participant Mobile App</li>
							<li>Free Setup</li>
						</ul>
						<a href="/WeePee/Agency/sign_up" class="btn btn-primary btn-sm">SIGN UP</a>
					</div>

				</div>
				<!-- /FOUR COLUMNS -->

				<div class="divider"><!-- divider -->
					<i class="fa fa-star"></i>
				</div>

				<h3>Kick the Tires</h3>
				<p>
					Check out our Demo Project. Please be noted that the data entered here is regularly refreshed. Feel free to setup a Free account to keep your data safe. 
				</p>
				<a href="#" class="btn btn-primary btn-sm">DEMO</a>
				<a href="/WeePee/Agency/sign_up" class="btn btn-primary btn-sm">FREE ACCOUNT</a>
				<p></p>


			</section>

<script>
	 $(document).ready(function() {
	 	
	 	$('#colorUserCount').on('change',function(){
	 		
	 		var colorTotal = parseFloat(Math.round((0.10 * this.value) * 100) / 100).toFixed(2);
	 		$('#colorCalcCost').html('$'+colorTotal).append("<span>Per Day</span>");
	 	});

	 	$('#locUserCount').on('change',function(){
	 		
	 		var colorTotal = parseFloat(Math.round((0.10 * this.value) * 100) / 100).toFixed(2);
	 		$('#locCalcCost').html('$'+colorTotal).append("<span>Per Day</span>");
	 	});

	 	$('#journalUserCount').on('change',function(){
	 		
	 		var colorTotal = parseFloat(Math.round((0.05 * this.value) * 100) / 100).toFixed(2);
	 		$('#journalCalcCost').html('$'+colorTotal).append("<span>Per Day</span>");
	 	});
	 });
</script>
