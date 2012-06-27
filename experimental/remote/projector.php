<?php
require_once ('../../php/mainfunctions.php');
$expo;
$wall;
if (isset($_GET["expo"])) {
	$expo = $_GET["expo"];
} else {$expo = 1;
}

if (isset($_GET["wall"])) {
	$wall = $_GET["wall"];
} else {$wall = 1;
}

$data['id'] = $expo;
$data['location_id'] = 0;
$walls = loadWalls($data, false);

$targetWall;
foreach ($walls as $wallTemp) {

	if ($wallTemp['wallNumber'] == $wall) {
		$targetWall = $wallTemp;
		break;
	}

}
$height = $targetWall['height'];
$width = $targetWall['width'];
?>

<html>
	<head><style>
		#overlay {
			text-align: center;
			color: #fff;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 3.0em;
		}
		.mouseHide {
			cursor: none;
		}
	</style></head>
	<body style="padding: 0px; margin: 0; overflow:hidden;">
<div id="overlay" style="background:#000; z-index:2; height:<?php echo $height . 'px'; ?>; width: <?php echo $width . 'px'; ?>; position:absolute;">
					<div id="overlayText">
					<br />
					<br />
					<h1 id="expoName">SETUP EXPO EXTRAVAGANZA</h1>
					<h2 id="curatorName">OG183</h2>
					</div>
		</div>

		<div class="showCanvas" style="background:#000; height: <?php echo $height . 'px'; ?>; width: <?php echo $width . 'px'; ?>; position:absolute;">

		</div>

		<script src="js/jquery.js"></script>
		<script src="js/showfunctions.js"></script>
		<script src="js/modalfunctions.js"></script> 
		<script type="text/javascript">

		var activeElement;
		var expo = new Object();
		
		//Some regex patterns for double checking things
		var youtubePattern = /youtube.com/;
		var youtubeVideoPattern = /v\=[a-zA-Z0-9_\-]+(?=&|$)/;
		var vimeoPattern = /vimeo.com/;
		var vimeoVideoPattern = /[0-9]+(?=&|$)/;
		var imgPattern = /(.gif|.jpg|.png|.jpeg|.JPG)$/;	

		var dataHolder;
$(document).ready(function(){


//setting up walls, should be dynamic and all, but good enough for now

<?php
//If expo is set let's check for the password
if (isset($expo)) {
	echo "expo.id =" . $expo . ";";
}
if (isset($wall)) {
	echo "expo.wall =" . $wall . ";";
}
?>
	expo.location_id = 0;
	init(expo);

	jQuery.extend({
		postJSON : function(url, data, callback) {
			return jQuery.post(url, data, callback, "json");
		}
	});
	var activeExpo = -1;
	var hidden = 1;
	var playlistOn = 0;
	var playlistNumber =0;
	var playlist = new Array();
	var playlistCounter = 0;

	var playlistInterval;
	var updateInterval = setInterval(checkUpdate, 5000);
	checkUpdate();
	function checkUpdate() {
		$.postJSON("php/ajax.php", {
			f : "checkUpdate",
			s : expo,
			format : "json"
		}, function(data) {
			
			dataHolder = data;
			if(activeExpo != parseInt(data[0].active)) {
				expo.id = parseInt(data[0].active);
				init(expo);
				activeExpo = parseInt(data[0].active);
			}
			
			if(parseInt(data[0].hide) != hidden) {
			
				if(parseInt(data[0].hide) ==0) {
					$("#overlay").fadeTo("slow", 0.0, function() {
						$(this).hide()
					});
				} else {
					$("#overlay").show();
					$("#overlay").fadeTo("slow", 1.0);
				}
				hidden = parseInt(data[0].hide);
			}
			if(playlistOn != parseInt(data[0].playlist_on)){
				console.log("playlist difference! "+parseInt(data[0].playlist_on));
				if(parseInt(data[0].playlist_on) == 1){
					console.log("time to load some playlists!!");
					$.postJSON("php/ajax.php", {
						f : "getPlaylist",
						s : expo,
						format : "json"
						}, function(data2) {
							console.log("playlist");
							console.log(data2);
							playlist = data2[0].expos.split(",");
							playlistInterval = setInterval(nextExpo,parseInt(data2[0].timer)*1000);
							playlistCounter = 0;
						})
					
				}else{
					clearTimeout(playlistInterval);
				}
				
				playlistOn = parseInt(data[0].playlist_on);
			}
		});
	}

	function nextExpo(){
		playlistNumber++;
		if(playlistNumber >=playlist.length){
			playlistNumber=0;
		}
		console.log("next expo "+playlistNumber);
		expo.id = playlist[playlistNumber];
		init(expo);
	}
	
	function init(expo) {
		data = new Object();
		data.id = expo.id;
		data.wall = expo.wall;
		$.postJSON("php/ajax.php", {
			f : "loadWallSources",
			s : data,
			format : "json"
		}, function(data) {
			//console.log(data);
			if(data.message !== undefined) {
				$("body").prepend('<div class="alert alert-block fade in" id="expoError"><a class="close" data-dismiss="alert">×</a> Combinatie expo en muur bestaat niet.</div>');
			} else {
				buildExpo(data);
				//$('.modal.in').modal('hide');}
			}
		})
	}


	function buildExpo(data) {
		//expo.id = data.id;
		//console.log(activeExpo);
		$(".showCanvas").html("");
		$.each(data, function(index, value) {
			pos_x = Math.round(parseFloat(value.position_x) * $(".showCanvas").width());
			pos_y = Math.round(parseFloat(value.position_y) * $(".showCanvas").height());
			width = Math.round(parseFloat(value.width) * $(".showCanvas").width());
			height = Math.round(parseFloat(value.heigth) * $(".showCanvas").height());

			//console.log(value.width);
			//console.log($(".canvas").width());
			//console.log(width);

			if(value.type == "image") {
				$(".showCanvas").append('<div class="piece image" id="high"  style="left:' + pos_x + 'px;top:' + pos_y + 'px;width:' + width + 'px; height:' + height + 'px; position:absolute;"><img height="100%" width="100%" src="' + value.url + '" /><input type="hidden" id="expo" value="' + value.expo_id + '"/><input type="hidden" id="wall" value="' + value.wall + '"/><input type="hidden" id="pieceTitle" value="' + value.title + '"><input type="hidden" id="pieceDesc" value="' + value.description + '"></div>');

			} else if(value.type == "youtube" || value.type == "vimeo") {
				$(".showCanvas").append('<div class="piece movie ' + value.type + '" style="left:' + pos_x + 'px;top:' + pos_y + 'px;width:' + width + 'px; height:' + height + 'px; position:absolute;"><iframe src="' + value.url + '" frameborder="0" width="100%" height="100%" allowfullscreen></iframe><input type="hidden" id="expo" value="' + value.expo_id + '"/><input type="hidden" id="wall" value="' + value.wall + '"/>				<input type="hidden" id="pieceTitle" value="' + value.title + '"><input type="hidden" id="pieceDesc" value="' + value.description + '"></div>');

			} else {
				//Sometimes the type doesn't get saved right, luckily we can still guess the type from the url.
				//One would wonder why we would still save the type ;)
				//console.log("Type "+ value.type+" unknown");
				src = value.url;
				//console.log(value.url);
				if(src.match(imgPattern) !== null) {

					$(".showCanvas").append('<div class="piece image" id="high"  style="left:' + pos_x + 'px;top:' + pos_y + 'px;width:' + width + 'px; height:' + height + 'px; position:absolute;"><img height="100%" width="100%" src="' + value.url + '" /><input type="hidden" id="expo" value="' + value.expo_id + '"/><input type="hidden" id="wall" value="' + value.wall + '"/><input type="hidden" id="pieceTitle" value="' + value.title + '"><input type="hidden" id="pieceDesc" value="' + value.description + '"></div>');
				} else if(src.match(youtubePattern) !== null) {
					//console.log("youtube");
					$(".showCanvas").append('<div class="piece movie youtube ' + value.type + '" style="left:' + pos_x + 'px;top:' + pos_y + 'px;width:' + width + 'px; height:' + height + 'px; position:absolute;"><iframe src="' + value.url + '" frameborder="0" width="100%" height="100%" allowfullscreen></iframe><input type="hidden" id="expo" value="' + value.expo_id + '"/><input type="hidden" id="wall" value="' + value.wall + '"/>				<input type="hidden" id="pieceTitle" value="' + value.title + '"><input type="hidden" id="pieceDesc" value="' + value.description + '"></div>');
				} else if(src.match(vimeoPattern) !== null) {
					//console.log("vimeo");
					$(".showCanvas").append('<div class="piece movie vimeo ' + value.type + '" style="left:' + pos_x + 'px;top:' + pos_y + 'px;width:' + width + 'px; height:' + height + 'px; position:absolute;"><iframe src="' + value.url + '" frameborder="0" width="100%" height="100%" allowfullscreen></iframe><input type="hidden" id="expo" value="' + value.expo_id + '"/><input type="hidden" id="wall" value="' + value.wall + '"/>				<input type="hidden" id="pieceTitle" value="' + value.title + '"><input type="hidden" id="pieceDesc" value="' + value.description + '"></div>');
				}
			}

		})
	}

	function getInfo(expo) {
		data = new Object();
		data.id = expo.id;
		$.postJSON("php/ajax.php", {
			f : "loadExpo",
			s : data,
			format : "json"
		}, function(data) {
			console.log(data);
			$("#expoName").html(data.name);
			$("#curatorName").html(data.curator);
			$("#overlayText").fadeTo("slow", 1.0);
		});
	}

	});
		</script>

	</body>
</html>