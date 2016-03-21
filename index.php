<!DOCTYPE HTML>
<html>
<head>
	<script   src="https://code.jquery.com/jquery-1.12.2.min.js"   integrity="sha256-lZFHibXzMHo3GGeehn1hudTAP3Sc0uKXBXAzHX1sjtk="   crossorigin="anonymous"></script>
	<script src="js.js" type="text/javascript"></script>
	<link href="css.css" rel="stylesheet" type="text/css" />
	<link href='https://fonts.googleapis.com/css?family=Candal' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
</head>

<body>
<div class="container">
	<input id="address" class="txt-default" type="text" placeholder="Enter address or location">
	<div class="btn-wrapper">
		<input id="btnLocation" class="btn-default btn" type="button" value="My Location">
		<input id="btnInit" class="btn-default btn" type="button" value="Today's Weather">
		<input id="btnYesterday" class="btn-default btn" type="button" value="Yesterday's Weather">
		<input id="btnMapStyles" class="btn-default btn" type="button" value="Change Map Theme">
	</div>
	<div id="mapError"></div>
	<div id="googleMap"></div>	
	<?php include('google-map.php'); ?>
</div>

<div class="map-styles-wrapper">
	<ul class="styles-list">
		<li>Default</li>
		<li>Unsaturated Browns</li>
		<li>Blue Water</li>
		<li>Midnight Commander</li>
		<li>Subtle Grayscale</li>
		<li>Light Dream</li>
		<li>Red Hues</li>
		<li>Avocado World</li>
	</ul>

	<div class='modal-close'>
		<svg>
			<line x1="0" y1="0" x2="40" y2="40" />
			<line x1="40" y1="0" x2="0" y2="40" />
		</svg>
	</div>
</div>

<div class="expanded-details"></div>

<section class="current-details">
	<div class="container">
		<h1 class="current-detailOne"></h1>
		<h1 class="current-detailTwo"></h1>
		<h1 class="current-detailThree"></h1>
		<h1 class="current-detailFour"></h1>
	</div>
</section>

<div class="container-max">
	<div class="container-cards">
		<div id="col-0" class="col"></div>
		<div id="col-1" class="col"></div>
		<div id="col-2" class="col"></div>
		<div id="col-3" class="col"></div>
		<div id="col-4" class="col"></div>
		<div id="col-5" class="col"></div>
		<div id="col-6" class="col"></div>
		<div id="col-7" class="col"></div>
		<div id="col-8" class="col"></div>
	</div>

	<div class='modal-close'>
		<svg>
			<line x1="0" y1="0" x2="40" y2="40" />
			<line x1="40" y1="0" x2="0" y2="40" />
		</svg>
	</div>
</div>


</body>

<script>
	initGoogleMap();
	var address;

	$(document).ready(function(){
		adjustColHeight();
		$(".expanded-details").slideUp("fast");
	});
	$(window).resize(function(){
		adjustColHeight();
	});
	$(document).keydown(function(e) {
	    if(e.which == 13) {
	        address = $("#address").val();
			getGeocode();
	    } else if(e.which == 27) {
	    	closeFunctions();
	    }
	});

	$("#btnLocation").click(function(){
		if (navigator.geolocation) {
        	navigator.geolocation.getCurrentPosition(showPosition);
    	}
	});
	$("#btnInit").click(function(){
		if($("#address").val() !== ""){
			address = $("#address").val();
			getGeocode();
			getWeatherDetail();
		} else {
			$("#address").val(address);
		}
	});
	$("#btnYesterday").click(function(){
		//display cards overlay
		$(".container-max").fadeIn("fast");
	});
	$("#btnMapStyles").click(function(){
		$(".map-styles-wrapper").fadeIn("slow");
	});
	$("li").click(function(){
		styles = $(this).html();
		getGeocode();
		closeFunctions();
	});
	$(".modal-close").click(function(){
		closeFunctions();
	});
	$(".col").click(function(){
		var id = $(this).children().attr('id');
		var bgcolor = $("#" + id).parent().css("background-color");
		var text = $("#" + id).html();
		setCardDetails(id, bgcolor, text);
	});
</script>
</html>