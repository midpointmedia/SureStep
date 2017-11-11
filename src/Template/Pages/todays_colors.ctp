<?php
    	$title = "Today's Colors";
		$this->assign('title',$title); 
?>

<!--CF  http://localhost:8500/crm/rest/index.cfm/TodaysColor/Program/C87CB1E0-E5AB-8EF3-891B877E5D4BAE67 -->
<!--PHP http://localhost:8500/crm/rest/index.cfm/TodaysColor/Program/C87CB1E0-E5AB-8EF3-891B877E5D4BAE67 -->
<!--PHP http://localhost/weepee/api/services/options_regions -->

<script type="text/javascript">




jQuery(window).ready(function () {

	_State 		= '';
	_Program 	= '';
	_Color 		= '';
	_asHome 	= false;

	_ajax_count_TodaysColors 	= 0;
	_ajax_count_Locations		= 0;
	_ajax_count_Programs		= 0;
	_ajax_count_Colors			= 0;

	LoadSettings();

	if(_Program != ''){
		//makeChart(_Program, $("#chartGroupBy").val(), $("#dtStartChart").val(), $("#dtEndChart").val());
		$('.todaysColorsContainer').show();
		$('#noProgramContainer').hide();
	}
	else{
		$('.todaysColorsContainer').hide();
		$('#noProgramContainer').show();

	}


	$('#optionsLocations').change(function(){
		_State = $('#optionsLocations').val();
		SaveSettings();
	});

	$('#optionsPrograms').change(function(){
		_Program = $('#optionsPrograms').val();
		if(_Program != ''){
			$('.todaysColorsContainer').show();
			$('#noProgramContainer').hide();
			getTodaysColors(_Program);
			getColorsByProgram(_Program, _Color);
			//makeChart(_Program, $("#chartGroupBy").val(), $("#dtStartChart").val(), $("#dtEndChart").val());
			SaveSettings();
		}else{
			$('.todaysColorsContainer').hide();
			$('#noProgramContainer').show();

		}

	});

	$('#optionsColors').change(function(){
		_Color = $('#optionsColors').val();
		SaveSettings();
	});

	$('#btnSaveSettings').click(function(){
		_asHome = true;
		SaveSettings();
		$('#btnSaveSettings').remove();
	});

	$('#btnReports').click(function(){
		window.location.href='?event=WeePee.ColorReports';
	});



	$('#removeHomePageCookie').click(function(){
		_asHome = false;
		SaveSettings();
		$('#btnSaveSettings').show();
	});

	function LoadSettings(){
		//first check for cookie settings
		try{
			var settings = JSON.parse($.cookie('weepee'));

			_State 		= settings.state;
			_Program 	= settings.program;
			_Color 		= settings.color;
			_asHome 	= settings.colorsAsHome;

			if(_asHome){
				$('#btnSaveSettings').hide();
				$('#removeHomePageCookie').show();
			}


			if(_Program.length == 0){
				$('#settingsIcon').addClass('fa-warning');
				$('#settingsIcon').removeClass('fa-check');
			}
			else{
				$('#settingsIcon').removeClass('fa-warning');
				$('#settingsIcon').addClass('fa-check');
			}
			//console.log(_Color);
			getTodaysColors(_Program);
			getColorsByProgram(_Program, _Color);
			getCourtPrograms(_Program);
			getLocations(_State);
		}
		catch(err){
			getCourtPrograms(_Program);
			getLocations(_State);
			//console.log('No Cookie Found');
		}
		//console.log(settings);
		//if clientId then reload settings & save to cookie
	}

	function SaveSettings(){
		var settings = new Object;
			settings.state 			= _State;
			settings.program 		= _Program;
			settings.color 			= _Color;
			settings.userId			= '';
			settings.colorsAsHome 	= _asHome;

		$.cookie('weepee', JSON.stringify(settings), { expires: 1100, domain: 'WeePeeApp.com', secure: false, raw: false });
		$.cookie('weepee', JSON.stringify(settings), { expires: 1100, domain: 'localhost', secure: false, raw: false });

	}

	function getTodaysColors(inProgram){
		$('#chartLoader').css('display', 'inline-block');
		var xmlRequest = $.ajax({
							  url			: "/weepee/api/services/colors_by_date/?id=" + inProgram,
							  processData	: true,
							  type			: 'get',
							  dataType		: 'json',
							  data			: {}
							});

		xmlRequest.done(function( doc ) {
			//console.log(doc);

			if(doc.length != 0)
			{
				$('#colorTitle').html('<h2>' + doc[0].program_name + ' | Date: ' + doc[0].created_date + '</h2>');
				$colorList = $('#ulColors');
				var list = "";
				for(var i in doc){
					//console.log(doc.colors[i].color);
					var color = doc[i].color;
					var listItem = "<i class='featured-icon fa' style='margin:30px;background-color:" + color + ";border:" + color + ";font-size:20px;text-shadow:-1px 0 black, 0 1px black, 1px 0 black, 0 -1px black'>" + color + "</i>";
						list = list + listItem;
				}
				$colorList.slideDown();
				$colorList.html(list);
			}
			else
			{
				$('#colorTitle').html('<h2>Colors Not Available</h2>');
			}

			$('#chartLoader').css('display', 'none');

		})
		xmlRequest.fail(function( jqXHR, textStatus ) {
			if(_ajax_count_TodaysColors < 6){
				getTodaysColors(_Program);
			}
			_ajax_count_TodaysColors++;
		  //console.log( "Request Failed: " + textStatus + " : " + _ajax_count_TodaysColors );
		});
	}


	//*** Colors ***/
	function getColorsByProgram(inProgram, inColor){
		//console.log('getColors');
		$('#chartLoader').css('display', 'inline-block');
		var xmlRequest = $.ajax({
							  url			: "/weepee/api/services/program_colors/?id=" + inProgram,
							  processData	: true,
							  type			: 'get',
							  dataType		: 'json',
							  data			: {}
							});

		xmlRequest.done(function( doc ) {
			//console.log(doc);
			$colorOptions = $('#optionsColors');
			$colorOptions.empty();
			var list = "";

			for(var i in doc){
				//console.log(doc.colors[i].color);
				var color = doc[i].color;
				var listItem = "<option>" + color + "</option>";
					list = list + listItem;
			}
			$colorOptions.append(list);
			//console.log(inColor);
			$('#optionsColors').val(inColor);
			$('#chartLoader').css('display', 'none');
		})
		xmlRequest.fail(function( jqXHR, textStatus ) {
		  //console.log( "Request Failed: " + textStatus + " : " +  _ajax_count_Colors);
		  _ajax_count_Colors++
		  if(_ajax_count_Colors < 6){
		  	getColorsByProgram(_Program, _Color);
		  }
		});
	}




	//*** courts ***/
	//TODO: actually pass in county
	function getCourtPrograms(inProgram){
		$('#chartLoader').css('display', 'inline-block');
		var xmlRequest = $.ajax({
							  url			: "/weepee/api/services/options_programs/?id=Clark",
							  processData	: true,
							  type			: 'get',
							  dataType		: 'json',
							  data			: {}
							});

		xmlRequest.done(function( doc ) {
			//console.log(doc);
			$programOptions = $('#optionsPrograms');
			var list = "<option value=''>Select a Program</option>";
			for(var i in doc){
				//console.log(doc.colors[i].color);
				var programId = doc[i].program_id;
				var programName = doc[i].program_name;
				var listItem = "<option value='" + programId + "'>" + programName + "</option>";
					list = list + listItem;
			}
			$programOptions.append(list);

			if(inProgram != ''){
				$('#optionsPrograms').val(inProgram);
			}
			$('#chartLoader').css('display', 'none');
		})
		xmlRequest.fail(function( jqXHR, textStatus ) {
		  //console.log( "Request Failed: " + textStatus + " : " + _ajax_count_Programs);
		  _ajax_count_Programs++
		  if(_ajax_count_Programs < 6){
		  	getCourtPrograms(_Program);
		  }
		});
	}


	//*** locations ***/
	function getLocations(inState){
		$('#chartLoader').css('display', 'inline-block');
		var xmlRequest = $.ajax({
							  url			: "/weepee/api/services/options_regions",
							  processData	: true,
							  type			: 'get',
							  dataType		: 'json',
							  data			: {}
							});

		xmlRequest.done(function( doc ) {
			$locOptions = $('#optionsLocations');
			var list = "";
			for(var i in doc){

				var state = doc[i].state;
				var county = doc[i].county;
				var listItem = "<option>" + county + ", " + state + "</option>";
					list = list + listItem;

			}
			$locOptions.append(list);
			$('#optionsLocations').val(inState);

			$('#chartLoader').css('display', 'none');
		})
		xmlRequest.fail(function( jqXHR, textStatus ) {
		  //console.log( "Request Failed: " + textStatus + " : " + _ajax_count_Locations);
		  _ajax_count_Locations++
		  if(_ajax_count_Locations < 6){
		  	getLocations(_State);
		  }
		});
	}




});
</script>

			<div id="blog">

				<!-- PAGE TITLE -->
				<header id="page-title">
					<div class="container">
						<h1>Today's Colors</h1>

						<ul class="breadcrumb">
							<li><a href="/weepee/pages/home">Home</a></li>
							<li class="active">Today's Colors</li>
						</ul>
					</div>
				</header>

				<section class="container">
					<div class="row">
						<div class="col-md-9" style="min-height:150px">
							<img id="chartLoader" src="/weepee/img/images/ajax-loader.gif" width="25px" style="display:none;float:left;margin-right:20px;margin-top:15px">

							<!-- blog item -->
							<div class="item todaysColorsContainer" align="center">

								<div id="colors" class="col-md-2 text-center" align="center" style="width:100%;margin-bottom:0px;margin-top:0px">

									<div id="colorTitle" class=""></div>
									<ul id="ulColors" style="padding:10px">
									<!---
									<i class="featured-icon fa" style="margin:30px;background-color:green;border:green;font-size:20px">Green</i>
									--->
									</ul>
								</div>
							</div>

							<div class="item todaysColorsContainer">


							</div>
							<div id="noProgramContainer" class="item" style="display:none;">
								<h1>Please Select a Program ---></h1>
							</div>
							<!-- /blog item -->

							<!-- Today Leaderboard -->
							<div id="bannerAd" align="center">
							<ins class="adsbygoogle"
							     style="display:inline-block;width:728px;height:90px;margin-top:35px;"
							     data-ad-client="ca-pub-8629035923257563"
							     data-ad-slot="9691158134"></ins>
							</div>
						</div>

						<div class="col-md-3">

							<button type="button" id="btnSaveSettings" class="btn btn-default" style="width:100%;margin-bottom:10px">Set as Homepage</button>
							<button type="button" id="btnReports" class="btn btn-info" style="width:100%;margin-bottom:10px">Reports</button>
							<!---
							<button type="button" class="btn btn-info" style="width:100%">Pee Schedule</button>
							--->
							<br/>
							<div class="panel-group" id="accordion">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#acordion1">
												<i id="settingsIcon" class="fa fa-warning"></i>
												Settings
											</a>
										</h4>
									</div>
									<div id="acordion1" class="collapse in">
										<div class="panel-body">

											<label>State/County:</label>
											<select id="optionsLocations" class="form-control pointer">

											</select>
											<br/>
											<label>Court:</label>
											<select id="optionsPrograms" class="form-control pointer">

											</select>
											<br/>
											<label>Color:</label>
											<select id="optionsColors" class="form-control pointer">

											</select>
										</div>
									</div>
								</div>

								<!---
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#acordion3">
												<i id="bonusSettingsIcon" class="fa fa-warning"></i>
												Bonus Settings
											</a>
										</h4>
									</div>
									<div id="acordion3" class="collapse">
										<div class="panel-body">
											<label>Primary UA Location:</label>
											<select class="form-control pointer">
												<option value="" selected="selected"></option>
												<option value="">Option #1</option>
												<option value="">Option #2</option>

												<optgroup label="Optgroup">
													<option value="">Option #1</option>
													<option value="">Option #2</option>
												</optgroup>
											</select>
											<label>Counseling Location:</label>
											<select class="form-control pointer">
												<option value="" selected="selected"></option>
												<option value="">Option #1</option>
												<option value="">Option #2</option>

												<optgroup label="Optgroup">
													<option value="">Option #1</option>
													<option value="">Option #2</option>
												</optgroup>
											</select>
											<label>Sex:</label>
											<select class="form-control pointer">
												<option value="" selected="selected"></option>
												<option value="">Male</option>
												<option value="">Female</option>
											</select>
										</div>
									</div>

								</div>
								--->
							</div>

							<div id="removeHomePageCookie" style="display:none;text:decorate;margin:5px;text-decoration:underline;">No longer make this the Home Page</div>

							<!--- Today Medium Rectangle
							<ins class="adsbygoogle"
							     style="display:inline-block;width:100%;height:250px"
							     data-ad-client="ca-pub-8629035923257563"
							     data-ad-slot="5260958531"></ins>
 							--->
							<div id="mopub_skyscraper" align="center">...</div>
						</div>
					</div>

				</section>

			</div>



<script>
[].forEach.call(document.querySelectorAll('.adsbygoogle'), function(){
    (adsbygoogle = window.adsbygoogle || []).push({});
});
</script>

