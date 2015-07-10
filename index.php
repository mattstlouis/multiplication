<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	/* Create the grid */	
	$("#container").append("<div class='label'></div>");

	for(var i = 1; i < 13; i++){
		$("#container").append("<div class='label'>" + i + "</div>");
	}
	
	$("#container").append("<div style='clear: left'></div>");

	for(var i = 1; i < 13; i++){
		$("#container").append("<div class='label'>" + i + "</div>");
		for(var j = 1; j < 13; j++){
			var new_div = "<div id='" + i + "x" + j + "' class='block'></div>";
			$("#container").append(new_div);	
		}
		$("#container").append("<div style='clear: left;'></div>");	
	}

	$(".block").on('click', function(){
		if (!$(this).hasClass('selected')){
			$(this).addClass('selected');
		}else{
			$(this).removeClass('selected');
		}
	});

	$("#make_pdf").on('click', function(){
		var selected = Array();
		$(".selected").each(function(index, val){
			selected.push(val.id);
		});
		
		var serialized = "data=" + JSON.stringify(selected);
	
		window.location = 'makepdf.php?' + serialized;
	});
});
</script>
<style>
#container{
	width: 700px;
	height: 700px;
	border: 1px dashed black;
	margin: 0 auto;
	position: relative;
}
#make_pdf{
	position: absolute;
	bottom: 15px;
	right: 50px;
}
.selected{
	background-color: #3ADF00 !important;
}
.label{
	float: left;
	width: 20px;
	height: 20px;
	padding: 15px;
	text-align: center;
}
.block{
	float: left;
	width: 48px;
	height: 48px;
	background-color: #00BFFF;
	border: 1px solid black;
	cursor: pointer;
}
</style>
</head>
<body>
<div id="container">
	<button id="make_pdf">Make Print Out!</button>
</div>
</body>
</html>
