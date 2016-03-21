var json;

function adjustColHeight(){
	var height = $(window).innerHeight();
	var width = $(window).innerWidth();
	$(".col").css("height", height / 3 );
	//$(".col").css("width", width / 3 );
}

function getWeatherDetail(){
	var url = "http://api.yesterdaysweather.com/api?lat=" + latitude + "&lng=" + longitude + "&callback=?";
	$.getJSON(url, function(data){
		json = data;
		setCurrent(data);
		setYesterday(data);
	});
}

function resetDetails(){
	$(".current-detailOne").html("");
	$(".current-detailTwo").html("");
	$(".current-detailThree").html("");
	$(".current-detailFour").html("");
}

function setCurrent(data){
	$(".current-details").css("display", "block");
	$(".current-details").css("opacity", "1");
	resetDetails();

	$(".current-detailOne").html(data.forecast[0].currentSentence);
	$(".current-detailTwo").html(data.forecast[0].conditions);
	$(".current-detailThree").html(data.forecast[0].highLowSentence);
	$(".current-detailFour").html(data.forecast[0].precipSentence);
}

function setYesterday(data){
	for(var i = 0; i < data.cards.length; i++){
		var html = "<div id='card-" + i + "' class='card-detail'>";
		html += data.cards[i].name + "</div>";
		$("#col-" + i).html(html);
	}
}

function setCardDetails(id, bgcolor, text){
	$(".expanded-details").css("background-color", bgcolor);

	for(var i = 0; i < json.cards.length; i++){
		if(json.cards[i].name == text){
			var html = "<h1>" + text + "</h1>";
			html += "<div class='yesterday-details' id='" + i + "-sentence'>" + json.cards[i].sentence + "</div>"; 
			html += "<div class='yesterday-details' id='" + i + "-today'>Today: " + json.cards[i].today + json.cards[i].unit + "</div>";
			html += "<div class='yesterday-details' id='" + i + "-yesterday'>Yesterday: " + json.cards[i].yesterday + json.cards[i].unit + "</div>";
			$(".expanded-details").html(html);
			$(".expanded-details").fadeIn();
		}
	}	
}

function closeFunctions(){
	if($(".expanded-details").css("display") == "block"){
		//$(".expanded-details").fadeOut("slow");
		$(".expanded-details").css("margin-top", "100%");
		setTimeout(function(){
			$(".expanded-details").css("display", "none");
			$(".expanded-details").css("margin-top", "0");
		}, 500);
	} else if ($(".map-styles-wrapper").css("display") == "block") {
		$(".map-styles-wrapper").fadeOut("fast");
	} else {
		$(".container-max").fadeOut("fast");	
	}
}

function showPosition(position){
	geocodeLatLng(position.coords.latitude, position.coords.longitude);
}