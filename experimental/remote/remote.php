<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


require_once ('../../php/mainfunctions.php');
$data['location_id'] = 0;
$walls = loadWalls($data, FALSE);
$expos = loadExpoByLocation($data, FALSE);
?>

<html>
	<head>

		<link href="css/bootstrap-responsive.css" rel="stylesheet">
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!-- Le fav and touch icons -->

		<!-- <link type="text/css" href="css/style.css" rel="stylesheet" />
		<link type="text/css" href="css/layout.css" rel="stylesheet" /> -->
		<link type="text/css" href="css/remote.css" rel="stylesheet" />

	</head>
	<body style="padding: 0px; margin: 0;">

		<div class="container">
			<div class="span6">

				<div class="masterSwitchHolder">
					MasterSwitch: (Changes all walls)
					<select id="masterSwitch">
						<?php
foreach($expos as $expo){
						?>
						<option value="<?php echo $expo['id']; ?>"><?php echo $expo['name']; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="wallSwitchHolders">
					<?php

foreach($walls as $index=>$wall){
					?>
					<div class="wallSwitchHolder" data-id="<?php echo $wall['id'];?>")>
						<?php echo $wall['name']; ?>
						<select id="wall" rel="<?php echo $index?>" class="expoSwitch">
							<?php
foreach($expos as $expo){
							?>
							<option value="<?php echo $expo['id']; ?>"><?php echo $expo['name']; ?></option>
							<?php } ?>
						</select>
						Hide expo? <input class="hideToggle" type="checkbox"></input>
						Playlist<input class="playlistToggle" type="checkbox"></input>
						<a href="#" class="togglePlaylist">config playlist</a>
						<div class="playlist" >
							<a href="#" class="saveExpo">Save expo</a><br />
							
							
								<?php
								
								$dataCon['location_id'] = 0;
								$dataCon['wall'] = $wall['id'];
								//var_dump($dataCon);
								$playlist = getPlaylist($dataCon,false);
								//echo "<br />playlist<br />";
								//var_dump($playlist);
								if($playlist!=NULL){
								$expoList = explode(",", $playlist[0]['expos']);
								//echo "<br />expolist<br />";
								//var_dump($expoList);
								?>
								expo's switch every <input class="timer" value="<?php echo $playlist[0]['timer']; ?>"type="text"></input> seconds.
							
								<ul id="wall" class="playlistWalls" data-id="<?php echo $playlist[0]['id'];?>">
								
								<?php
								foreach($expoList as $expo){
									
									$dataCon['id'] = $expo;	
									$expoData = loadExpo($dataCon,false);
									
								?>
									<li data-value="<?php echo $expoData['id']; ?>">
									<?php echo $expoData['name']; ?>
								</li>
								<?php 
								}
								}else{
									?>
											expo's switch every <input class="timer" type="text"></input> seconds.
							<ul id="trash"></ul>
										<ul id="wall" class="playlistWalls">
								<?php
									
								}
								?>
							</ul>

							<ul class="expolist">
								<?php
foreach($expos as $expo){
								?>
								<li data-value="<?php echo $expo['id']; ?>">
									<?php echo $expo['name']; ?>
								</li>
								<?php } ?>
							</ul>
							<ul class="trash"></ul>
						</div>
					</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>

		<script src="js/jquery.js"></script>
		<script src="js/jquery-ui-1.8.17.custom.min.js"></script>
		<script type="text/javascript">

			var activeElement;
var expo = new Object();

$(document).ready(function(){
console.log("really you're gonna console this website? "+Math.floor(Math.random()*200));

//setting up walls, should be dynamic and all, but good enough for now

<?php

if (isset($expo)) {
	echo "expo.id =" . $expo . ";";
}
if (isset($wall)) {
	echo "expo.wall =" . $wall . ";";
}
?>
	expo.location = 0;

	$('#masterSwitch').change(function() {
		console.log("change");
		var value = $('#masterSwitch option:selected').val();
		$(".expoSwitch").val(value);
		$.each($(".wallSwitchHolder"), function(index, object) {
			expoId = $(object).val();
			wall =$(object).parent().attr("data-id");
		hide = $(object).parent().children(".hideToggle").attr("checked");
		if(hide == undefined){
			hide = 0;
		}else{
			hide =1;
		}
		playlistOn = $(object).parent().children(".playlistToggle").attr("checked");
		if(playlistOn == undefined){
			playlistOn = 0;
		}else{
			playlistOn =1;
		}
		playlistNumber = $(object).parent().find(".playlistWalls").attr("data-id");
		timer = $(object).parent().find(".timer").val();
		console.log(playlistOn);	
		setWallExpo(expo, expoId, wall, hide, playlistOn, playlistNumber,timer);
		})
	});
	
	$('.expoSwitch').change(function() {
		expoId = $(this).val();
		wall = $(this).parent().attr("data-id");
		hide =  $(this).parent().children(".hideToggle").attr("checked");
		if(hide == undefined){
			hide = 0;
		}else{
			hide =1;
		}
		playlistOn = $(this).parent().children(".playlistToggle").attr("checked");
		if(playlistOn == undefined){
			playlistOn = 0;
		}else{
			playlistOn =1;
		}
		playlistNumber = $(this).parent().find(".playlistWalls").attr("data-id");
		timer = $(this).parent().find(".timer").val();
		
		setWallExpo(expo, expoId, wall, hide, playlistOn, playlistNumber,timer);
	});
	
	$('.hideToggle').change(function() {
		expoId = $(this).parent().children('.expoSwitch').val();
		wall = $(this).parent().attr("data-id");
		hide = $(this).parent().children(".hideToggle").attr("checked");
		if(hide == undefined){
			hide = 0;
		}else{
			hide =1;
		}
		playlistOn = $(this).parent().children(".playlistToggle").attr("checked");
		if(playlistOn == undefined){
			playlistOn = 0;
		}else{
			playlistOn =1;
		}
		playlistNumber = $(this).parent().find(".playlistWalls").attr("data-id");
		timer = $(this).parent().find(".timer").val();
		
		setWallExpo(expo, expoId, wall, hide, playlistOn, playlistNumber,timer);
	});
	
	$('.playlistToggle').change(function() {
		expoId = $(this).parent().children('.expoSwitch').val();
		wall = $(this).parent().attr("data-id");
		hide = $(this).parent().children(".hideToggle").attr("checked");
		if(hide == undefined){
			hide = 0;
		}else{
			hide =1;
		}
		playlistOn = $(this).parent().children(".playlistToggle").attr("checked");
		if(playlistOn == undefined){
			playlistOn = 0;
		}else{
			playlistOn =1;
		}
		playlistNumber = $(this).parent().find(".playlistWalls").attr("data-id");
		timer = $(this).parent().find(".timer").val();
		
		setWallExpo(expo, expoId, wall, hide, playlistOn, playlistNumber,timer);
	});
	
	jQuery.extend({
		postJSON : function(url, data, callback) {
			return jQuery.post(url, data, callback, "json");
		}
	});
	var activeExpo = -1;

	var expoListContent = $(".expolist").html();
	$(".expolist").sortable({
		connectWith : '.playlistWalls',
		remove : function(event, ui) {
			$(this).html(expoListContent);
		}
	}).disableSelection();

	$(".playlistWalls").sortable({
		connectWith : '.trash'
	}).disableSelection();

	$('.trash').sortable({
		receive : function(event, ui) {
			$(this).html("");
		}
	}).disableSelection();

	$(".playlist").hide();
	
	$(".togglePlaylist").click(function(){
		$(this).parent().children(".playlist").slideToggle();	
	});
	
	$(".saveExpo").click(function(event){
		event.preventDefault();
		expoTemp = new Object();
		expoTemp.location_id = 0;
		expoTemp.wall = $(this).parent().parent().attr("data-id");
		expoTemp.playlistName = "noName";
		//HIER WAS JE
		expolist = new Array();
		$.each($(this).parent().children(".playlistWalls").children(),function(index, value){
			expolist.push($(value).attr("data-value"));
		})
		
		expoTemp.expolist = expolist.join(",");
		expoTemp.timer = $(this).parent().children(".timer").val();
		console.log(expoTemp);
		$.postJSON("php/ajax.php", {
			f : "updatePlaylist",
			s : expoTemp,
			format : "json"
		}, function(data) {
			$(this).parent().find(".playlistWalls").attr("data-id",data.id);
			//console.log("succesful");
		})
	})
	
	function updateActive(data) {
		$.postJSON("php/ajax.php", {
			f : "updateActive",
			s : data,
			format : "json"
		}, function(data) {
			
			//console.log("succesful");
		})
	}

	function setWallExpo(expo, expoId, wall, hide, playlistOn, playlistNumber,timer) {
		expoTemp = expo;
		expoTemp.expoId = expoId;
		expoTemp.wall = wall;
		expoTemp.hide = hide;
		expoTemp.playlistOn = playlistOn;
		expoTemp.playlistNumber = playlistNumber;
		expoTemp.timer = timer;
		console.log(expoTemp);
		$.postJSON("php/ajax.php", {
			f : "remoteAction",
			s : expoTemp,
			format : "json"
		}, function(data) {
			//console.log("succesful");
			
		})
	}

	});
		</script>

	</body>
</html>