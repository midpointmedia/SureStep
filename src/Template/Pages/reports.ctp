<?php
    	$title = 'Reports';
		$this->assign('title',$title); 
?>
<!---http://localhost:8500/crm/rest/index.cfm/TodaysColor/Program/C87CB1E0-E5AB-8EF3-891B877E5D4BAE67 --->
<script type="text/javascript">

jQuery(window).ready(function () {

	_State = '';
	_Program = '';
	_Color = '';
	_asHome = false;

	_ajax_count_TodaysColors 	= 0;
	_ajax_count_Locations		= 0;
	_ajax_count_Programs		= 0;
	_ajax_count_ColorList		= 0;


	LoadSettings();

	if(_Program != ''){
		makeChart(_Program, $("#chartGroupBy").val(), $("#dtStartChart").val(), $("#dtEndChart").val());
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
			//getTodaysColors(_Program);
			getColorsByProgram(_Program, _Color);
			makeChart(_Program, $("#chartGroupBy").val(), $("#dtStartChart").val(), $("#dtEndChart").val());
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

	$('#btnTodaysColors').click(function(){
		window.location.href='?event=WeePee.TodaysColors';
	});

	function LoadSettings(){
		//first check for cookie settings
		try{
			var settings = JSON.parse($.cookie('weepee'));

			_State = settings.state;
			_Program = settings.program;
			_Color = settings.color;
			_asHome = settings.colorsAsHome;

			if(_asHome){
				$('#btnSaveSettings').remove();
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
			//getTodaysColors(_Program);
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
			settings.state 		= _State;
			settings.program 	= _Program;
			settings.color 		= _Color;
			settings.userId		= '';
			settings.colorsAsHome = _asHome;

		$.cookie('weepee', JSON.stringify(settings), { expires: 1100, domain: 'WeePeeApp.com', secure: false, raw: false });
	}




	//*** Colors ***/
	function getColorsByProgram(inProgram, inColor){
		//console.log('getColors');
		var xmlRequest = $.ajax({
							  url			: "/crm/rest/index.cfm/ColorOptions/Program/" + inProgram,
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

			for(var i in doc.colors){
				//console.log(doc.colors[i].color);
				var color = doc.colors[i].color;
				var listItem = "<option>" + color + "</option>";
					list = list + listItem;
			}
			$colorOptions.append(list);
			//console.log(inColor);
			$('#optionsColors').val(inColor);
		})
		xmlRequest.fail(function( jqXHR, textStatus ) {
		  //alert( "Request Failed: " + textStatus );
		  _ajax_count_Colors++
		  if(_ajax_count_Colors < 6){
		  	getColorsByProgram(_Program, _Color);
		  }
		});
	}




	//*** courts ***/
	function getCourtPrograms(inProgram){

		var xmlRequest = $.ajax({
							  url			: "/crm/rest/index.cfm/ProgramOptions",
							  processData	: true,
							  type			: 'get',
							  dataType		: 'json',
							  data			: {}
							});

		xmlRequest.done(function( doc ) {
			//console.log(doc);
			$programOptions = $('#optionsPrograms');
			var list = "<option value=''>Select a Program</option>";
			for(var i in doc.programs){
				//console.log(doc.colors[i].color);
				var programId = doc.programs[i].programId;
				var programName = doc.programs[i].programName;
				var listItem = "<option value='" + programId + "'>" + programName + "</option>";
					list = list + listItem;
			}
			$programOptions.append(list);

			if(inProgram != ''){
				$('#optionsPrograms').val(inProgram);
			}
		})
		xmlRequest.fail(function( jqXHR, textStatus ) {
		  //alert( "Request Failed: " + textStatus );
		  _ajax_count_Programs++
		  if(_ajax_count_Programs < 6){
		  	getCourtPrograms(_Program);
		  }
		});
	}


	//*** locations ***/
	function getLocations(inState){
		var xmlRequest = $.ajax({
							  url			: "/crm/rest/index.cfm/ProgramLocations",
							  processData	: true,
							  type			: 'get',
							  dataType		: 'json',
							  data			: {}
							});

		xmlRequest.done(function( doc ) {
			$locOptions = $('#optionsLocations');
			var list = "";
			for(var i in doc.locs){

				var state = doc.locs[i].state;
				var county = doc.locs[i].county;
				var listItem = "<option>" + county + ", " + state + "</option>";
					list = list + listItem;

			}
			$locOptions.append(list);
			$('#optionsLocations').val(inState);
		})
		xmlRequest.fail(function( jqXHR, textStatus ) {
		  //alert( "Request Failed: " + textStatus );
		  _ajax_count_Locations++
		  if(_ajax_count_Locations < 6){
		  	getLocations(_State);
		  }
		});
	}



	/* CHART */
	timelineChart = new Highcharts.Chart({
        chart: {
        renderTo: 'container',
        type: 'column'
    }, title: {
            text: 'Color Timeline'
        }, xAxis: {

        },yAxis: {
		            min: 0,
		            title: {
		                text: 'Colors'
		            },
		            stackLabels: {
		                enabled: true,
		                style: {
		                    fontWeight: 'bold',
		                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
		                }
		            }
		        },
		        plotOptions: {
		            column: {
		                stacking: 'normal',
		                dataLabels: {
		                    enabled: true,
		                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
		                    style: {
		                        textShadow: '0 0 3px black'
		                    }
		                }
		            }
		        }
	});
	function makeChart(inProgram, inGroup, inStartDate, inEndDate){
		$('#chartLoader').css('display', 'inline-block');
		var xmlRequest = $.ajax({
							  url			: "/crm/rest/index.cfm/ColorsByDateGroup/Program/" + inProgram + "/DateGroup/" + inGroup + "/StartDate/" + inStartDate + "/EndDate/" + inEndDate,
							  processData	: true,
							  type			: 'get',
							  dataType		: 'json',
							  data			: {}
							});

		xmlRequest.done(function( doc ) {
			//console.log(doc);
			//timelineChart.clearSeries();
			var chart = $('#container').highcharts();
		        var seriesLength = chart.series.length;
		        for(var i = seriesLength -1; i > -1; i--) {
		            chart.series[i].remove();
	        }

			chart.xAxis[0].setCategories(doc.groupTitles);

            $.each(doc.colors, function (key, value) {
            	//console.log(value);
                timelineChart.addSeries({
                    name: value.name,
                    data: value.data,
                    color: value.color
                }); ;
            });
			$('#chartLoader').css('display', 'none');

		})
		xmlRequest.fail(function( jqXHR, textStatus ) {
		  //alert( "Request Failed: " + textStatus );
		});
	}



	$( "#dtStartChart" ).change(function(){
		var dateGroup = $("#chartGroupBy").val();
		var startDate = $("#dtStartChart").val();
		var endDate = $("#dtEndChart").val();

		makeChart(_Program, dateGroup, startDate, endDate);

	});

	$( "#dtEndChart" ).change(function(){
		var dateGroup = $("#chartGroupBy").val();
		var startDate = $("#dtStartChart").val();
		var endDate = $("#dtEndChart").val();

		makeChart(_Program, dateGroup, startDate, endDate);
	});

	$("#chartGroupBy").change(function(){

		var dateGroup = $("#chartGroupBy").val();
		var startDate = $("#dtStartChart").val();
		var endDate = $("#dtEndChart").val();
		//console.log(dateGroup);
		makeChart(_Program, dateGroup, startDate, endDate);
	});

});
</script>
			<div id="blog">

				<!-- PAGE TITLE -->
				<header id="page-title">
					<div class="container">
						<h1>Color Reports</h1>

						<ul class="breadcrumb">
							<li><a href="/weepee/pages/home">Home</a></li>
							<li class="active">Color Reports</li>
						</ul>
					</div>
				</header>

				<section class="container">
					<div class="row">
						<div class="col-md-9" style="min-height:150px">

							<div class="item todaysColorsContainer">

								<cfoutput>
								<div align="right" style="margin-top:0px;margin-bottom:5px">


									<img id="chartLoader" src="/weepee/img/images/ajax-loader.gif" width="25px" style="display:none;float:left;margin-right:20px;margin-top:15px">

									from:
									<input type="date" id="dtStartChart" name="chartStartDate" value="#DateFormat(DateAdd('d',-10,Now()),'YYYY-MM-DD')#"  style="width:135px">
									&nbsp;&nbsp;&nbsp;
									to:
									<input type="date" id="dtEndChart" name="chartEndDate" value="#DateFormat(Now(),'YYYY-MM-DD')#" style="width:135px">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									group by:
									<select id="chartGroupBy">
										<option>Day</option>
										<option>Week</option>
										<option>Month</option>
									</select>

									<div id="container" style="min-width: 100%; height: 400px; margin: 0 auto"></div>
								</div>
								</cfoutput>



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

							<button type="button" id="btnTodaysColors" class="btn btn-info" style="width:100%;margin-bottom:10px">Today's Colors</button>
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

							</div>
							<!-- Today Medium Rectangle -->
							<ins class="adsbygoogle"
							     style="display:inline-block;width:100%;height:250px;"
							     data-ad-client="ca-pub-8629035923257563"
							     data-ad-slot="5260958531"></ins>

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

