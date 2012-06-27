<?php
require_once ('php/mainfunctions.php');
$expo;
$wall;
if (isset($_GET["expo"])) {
	$expo = $_GET["expo"];
}

if (isset($_GET["wall"])) {
	$wall = $_GET["wall"];
}

$data['id'] = $expo;
$data['location_id'] =0;
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
		#overlay{text-align:center;
			color:#fff;
		font-family:Arial, Helvetica, sans-serif;
		font-size:3.0em;}
		.mouseHide{
			cursor:none;
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
		
//Should be an playlist feature here
var expos = new Array();

			var activeElement;
		var expo = new Object();
		
		//Some regex patterns for double checking things
		var youtubePattern = /youtube.com/;
		var youtubeVideoPattern = /v\=[a-zA-Z0-9_\-]+(?=&|$)/;
		var vimeoPattern = /vimeo.com/;
		var vimeoVideoPattern = /[0-9]+(?=&|$)/;
		var imgPattern = /(.gif|.jpg|.png|.jpeg|.JPG)$/;	

$(document).ready(function(){
console.log("really you're gonna console this website? "+Math.floor(Math.random()*200));

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
	expo.location=0;
	init(expo);

	jQuery.extend({
		postJSON : function(url, data, callback) {
			return jQuery.post(url, data, callback, "json");
		}
	});
	var activeExpo = -1;



	$.postJSON("php/ajax.php", {
			f : "loadPlaylists",
			s : expo,
			format : "json"
		}, function(data) {
			console.log(data);
			expos = data.expos.split(",");
		})
	


	$("body").keyup(function(event) {
		event.preventDefault();
		var direction = null;

		// handle cursor keys
		if(event.keyCode == 37) {
			// go left
			//console.log("left");
			if(activeExpo <= 0) {
				activeExpo = expos.length - 1;
			} else{activeExpo-=1;}
			expo.id = expos[activeExpo];
			$("#overlayText").fadeTo("slow", 0.0, function() {
			getInfo(expo);
			init(expo);
			updateActive(expo);
			});
		} else if(event.keyCode == 39) {
			// go right
			//console.log("right");
			if(activeExpo >= expos.length || activeExpo == -1) {
				activeExpo = 0;
			}else{activeExpo+=1;}
			expo.id = expos[activeExpo];
			
			$("#overlayText").fadeTo("slow", 0.0, function() {
			getInfo(expo);
			init(expo);
			updateActive(expo);
			});
		} else if(event.keyCode == 38) {
			// go right
			//console.log("up");
			$("#overlay").show();
			$("#overlay").fadeTo("slow", 1.0);
		} else if(event.keyCode == 40) {
			// go right
			//  console.log("down");

			$("#overlay").fadeTo("slow", 0.0, function() {
				$(this).hide()
			});

		}else if(event.keyCode == 77) {
			console.log("mouse hide");
			$("body").toggleClass("mouseHide");
		}
	});

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
	
	function updateActive(data){
		$.postJSON("php/ajax.php", {
			f : "updateActive",
			s : data,
			format : "json"
		}, function(data) {
			//console.log("succesful");
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
			//console.log(width)
			;
			//Sometimes the type doesn't get saved right, luckily we can still guess the type from the url.
			//One would wonder why we would still save the type ;)
			//console.log("Type "+ value.type+" unknown");
			src = value.url;
			
			if(value.type == "image" || src.match(imgPattern) !== null) {
				$(".showCanvas").append('<div class="piece image" id="high"  style="left:' + pos_x + 'px;top:' + pos_y + 'px;width:' + width + 'px; height:' + height + 'px; position:absolute;"><img height="100%" width="100%" src="' +  decodeURI(value.url)+ '" /><input type="hidden" id="expo" value="' + value.expo_id + '"/><input type="hidden" id="wall" value="' + value.wall + '"/><input type="hidden" id="pieceTitle" value="' +  unescape(value.title) + '"><input type="hidden" id="pieceDesc" value="' +  unescape(value.description) + '"></div>');

			} else if(value.type == "youtube" || value.type == "vimeo" || src.match(youtubePattern) !== null || src.match(vimeoPattern) !== null) {
				$(".showCanvas").append('<div class="piece movie ' + value.type + '" style="left:' + pos_x + 'px;top:' + pos_y + 'px;width:' + width + 'px; height:' + height + 'px; position:absolute;"><iframe src="' +  decodeURI(value.url) + '" frameborder="0" width="100%" height="100%" allowfullscreen></iframe><input type="hidden" id="expo" value="' + value.expo_id + '"/><input type="hidden" id="wall" value="' + value.wall + '"/>				<input type="hidden" id="pieceTitle" value="' +  unescape(value.title) + '"><input type="hidden" id="pieceDesc" value="' +  unescape(value.description) + '"></div>');

			} else {
				//console.log (value.url nor type was recognised!);
			}
		})
	}
	
	function getInfo(expo){
		data = new Object();
		data.id = expo.id;
		$.postJSON("php/ajax.php", {
			f : "loadExpo",
			s : data,
			format : "json"
		}, function(data) {
			console.log(data);
			$("#expoName").html(unescape(data.name));
			$("#curatorName").html(unescape(data.curator));
			$("#overlayText").fadeTo("slow", 1.0);
			
		});
	}

	});
		</script>

	</body>
</html>