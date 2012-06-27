<?php
require_once ('php/mainfunctions.php');
$expo;

if (isset($_GET["expo"])) {
	$expo = $_GET["expo"];
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Expo Extravaganza!</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Expo maker voor Setup Utrecht">
		<meta name="author" content="Heinze Havinga">
		<!-- Le styles -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<style>
			body {
				padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
			}
		</style>
		<link href="css/bootstrap-responsive.css" rel="stylesheet">
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="ico/favicon.ico">
		<link type="text/css" href="css/blitzer/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
		<link type="text/css" href="css/style.css" rel="stylesheet" />
		<link type="text/css" href="css/layout.css" rel="stylesheet" />
	</head>
	<body>
		
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
					<a class="brand" href="index.php">Expo Extravaganza!</a>
					<div class="nav-collapse">
						<ul class="nav">
							<li>
								<a href="#" data-toggle="modal" data-target="#expo-props" href="#expo-props"><i class="icon-white icon-picture"></i> Expo Properties </a>
							</li>
							<li>
								<a href="#" data-toggle="modal" data-target="#dialog-new" href="#dialog-new"><i class="icon-white icon-plus"></i> New Element</a>
							</li>
							<li>
								<a href="#" id="saveExpo"><i class="icon-white icon-ok"></i> Save Expo </a>
							</li>
							<li>
								<a href="#" data-toggle="modal" data-target="#dialog-delete" href="#dialog-delete"><i class="icon-white icon-trash"></i> Delete Expo </a>
							</li>
							<li>
								<a target="_blank" href="index.php" id="helpbtn" rel="popover" data-content="This will open in a new screen." data-original-title="<strong>Beware!</strong>" href="#myModal"><i class="icon-white icon-question-sign"></i> Help</a>
							</li>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<div id="canvasHolder">	
		<!-- This was only practical for our 3 beamer setup, so commented out for the moment -->
		<!-- 	<div class="rulerHolder">
			<div class="beamerRuler"></div>
			<div class="beamerRuler"></div>
			</div> -->
				<div id="myCarousel" class="carousel">
  <!-- Carousel items -->
  <div class="carousel-inner">

  </div>
  <!-- Carousel nav -->
</div>
</div>
		<div class="slidebar">
			 <a id="left" class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
			 <div id="slidelabel"><h1 id="wallLabel">Wall 1</12></div>
  			<a id="right" class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
		</div>
		<div class="infobar" style="width:96%;">
			
		</div>
		
<!-- 	Modal overlay for different situations	 -->
	<?php 	
	include("php/modal-password.php");
	include("php/modal-expo.php");
	include("php/modal-element.php");
	include("php/modal-delete.php");    	
	?>
	
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="js/jquery.js"></script>
		<script src="js/modalfunctions.js"></script>
		<script src="js/bootstrap-transition.js"></script>
		<script src="js/bootstrap-alert.js"></script>
		<script src="js/bootstrap-modal.js"></script>
		<script src="js/bootstrap-dropdown.js"></script>
		<script src="js/bootstrap-scrollspy.js"></script>
		<script src="js/bootstrap-tab.js"></script>
		<script src="js/bootstrap-tooltip.js"></script>
		<script src="js/bootstrap-popover.js"></script>
		<script src="js/bootstrap-button.js"></script>
		<script src="js/bootstrap-collapse.js"></script>
		<script src="js/bootstrap-carousel.js"></script>
		<script src="js/bootstrap-typeahead.js"></script>
		<script src="js/bootstrap-transition.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
		<script type="text/javascript" src="js/md5.js"></script>
		<script type="text/javascript" src="js/jquery-validate.js"></script>
		<script type="text/javascript">
		
			//The expo Object will be the data object that is send along with all Ajax functions
			var expo = new Object();
			
			<?php		
			if (isset($expo)) {
				echo "expo.id =". $expo .";";
			}
			?>
			
			//This is a var to track which expo element is active
			var activeElement;
			
			//var securityHash;
			
			//This array will hold all the Wall objects
			var wall = new Array();
			
			var data = new Object();
			//TODO: we should prepare the system on multiple locations
			data.location_id = 0;
			
	 $(document).ready(function(){
	 
	 //LOADING WALLS AND SETTING THEM TO SCALE
	 	$.postJSON("php/ajax.php", {
					f : "loadWalls",
					s : data,
					format : "json"
				}, function(data) {
					
						wall=data;
						$.each(wall, function(index,value){
							
							wallHolder = $(".carousel-inner").append('<div class=" item canvas" data-id="'+value.wallNumber+'" data-name="'+value.name+'" style="height:500px; width:95%;"></div>');
							
							if(parseFloat(value.width)*0.60>parseFloat(value.height)){
								scalingFactor = wallHolder.children().eq(index).width()/parseInt(value.width);
								wallHolder.children().eq(index).height(parseInt(value.height)*scalingFactor);
							} else{
								scalingFactor = wallHolder.children().eq(index).height()/parseInt(value.height);
								wallHolder.children().eq(index).width(parseInt(value.width)*scalingFactor);
							}
								
						})
							$(".canvas:first").addClass("active");
				})
		
		

		//Setting up tooltips
		$('.tltip').tooltip();		
		//Setting up alerts
		$("#passwordAlert").alert();
		
		//Setting up modals, if people want to edit an existing expo we'll check the password, otherwise we'll show the new expo form
		if(expo.id != undefined){
			$('#dialog-password').modal({backdrop:"static",keyboard:false});
			$('#expo-props').modal({show: false});
		} else{
			$('#dialog-password').modal({show: false});
			$('#expo-props').modal({backdrop:"static",keyboard:false});
		}
		$('#dialog-new').modal({show: false});
		
		//We don't want people to be able to edit expo's without saving it first
		//show we're hiding the close and cancel button if the expo propeties form is from an unsaved expo
		$('#expo-props').on("shown", function(){
			if(expo.id == undefined){
				$("#closeExpo").hide();
				$("#cancelExpo").hide();
			} else{
				$("#closeExpo").show();
				$("#cancelExpo").show();
			}
		});
		
		$('#dialog-new').on("hidden", function(){
		//The delete button for expo elements is something we only want to show if the element is already on the canvas
			$("#deletePiece").hide();
			$("#changePiece").hide();
			$("#submitPiece").show();			
		});
		
		$('#dialog-delete').modal({show: false});
	
	
		//WALL CAROUSEL SCRIPT
		
		//FIXME: This is such an ugly way to "pause" the carousel but i coudn't get the pause function working after sliding
		$('#myCarousel').carousel({
  			interval: 90000000
  		});
			
		$('#myCarousel').carousel('pause');
		
		$('#myCarousel').bind("slid",function(){
			activeWall = $(".carousel-inner .active").attr("data-name");
			$("#wallLabel").html(activeWall);
			//FIXME: The pause function should really work like this, but alas it doesn't
			$('#myCarousel').carousel('pause');
		});
		
		
		//HELP BUTTON SCRIPT	
		//This help button pop-over isn't the most useful thing every, but I wanted to try it ;)
		$('#helpbtn').popover({placement:"bottom"});
		
		$(".piece").live("dblclick", function() {
			activeElement = $(this);
			$(".form-horizontal #pieceTitle").val(unescape(activeElement.find("#pieceTitle").val()));
			$(".form-horizontal #pieceDesc").val(unescape(activeElement.find("#pieceDesc").val()));
			if(activeElement.hasClass("youtube") || activeElement.hasClass("vimeo")){
				$(".form-horizontal #new-src").val(activeElement.find("iframe").attr("src"));	
			} else if(activeElement.hasClass("image")){
				$(".form-horizontal #new-src").val(activeElement.find("img").attr("src"));
				//console.log(activeElement.find("img").attr("src"));
			}
			
			//Setting up the right buttons
			$("#deletePiece").show();
			$("#changePiece").show();
			$("#submitPiece").hide();
			$('#dialog-new').modal("show");
			return false;
		})

		//TODO: Would be nice if there was i kind of trigger when to and not to show this alert
		// A little warning to remind people they should save.
		window.onbeforeunload = function() { return "Don't forget to save!"; };
		
	});

			
		</script>
	</body>
</html>