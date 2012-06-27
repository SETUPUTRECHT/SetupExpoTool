<?php
require_once ('../../php/mainfunctions.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Expo extravangza gids</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>

		<!-- Soundmanager -->

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="apple-touch-icon" href="img/icon.png">
		<script src="http://api.html5media.info/1.1.5/html5media.min.js"></script>
		<script type="text/javascript">
			var activeExpo = -1;
			//var activeExpo =-1;
			var youtubePattern = /youtube.com/;
			var youtubeVideoPattern = /v\=[a-zA-Z0-9_\-]+(?=&|$)/;
			var youtubeEmbedVideoPattern = /[a-zA-Z0-9_\-]+(?=\?)/;
			var vimeoPattern = /vimeo.com/;
			var vimeoVideoPattern = /[0-9]+(?=&|$)/;
			var imgPattern = /(.gif|.jpg|.png|.jpeg|.JPG)$/;
			var youtubeEmbedPattern = /youtube.com\/embed/;
			var vimeoEmbedPattern = /player.vimeo.com\/video/;

			$(function() {
				jQuery.ajaxSetup({async:false});
				jQuery.extend({
					postJSON : function(url, data, callback) {
						return jQuery.post(url, data, callback, "json");
					}
				});
				
				
				data = new Object();
				data.location = 0;
					
				function updateExpo() {

					$.postJSON("../../php/ajax.php", {
						f : "checkExpo",
						s : data,
						format : "json"
					}, function(data) {
						console.log(data.active);
						if(activeExpo != data.active) {
							$("#wall1").html("");
							$("#wall2").html("");
							activeExpo = data.active
							data2 = new Object();
							data2.id = data.active;
							$.postJSON("../../php/ajax.php", {
								f : "loadSourcesBooklet",
								s : data2,
								format : "json"
							}, function(data3) {
								//Hier gaan we dan shit laden baby!!! Sort op muur en dan op x positie
								$.each(data3, function(index, value) {
									//console.log(value);
									newSection = "";
									newSection = "<h1>" + value.title + "</h1>";
									
									if(value.type == "image" || value.url.match(imgPattern)) {
											newSection += "<img src='"+value.url+"' width='100%'/>";
									}
									
									else if(value.type == "youtube" || value.url.match(youtubeEmbedPattern)) {
											video = value.url.match(youtubeEmbedVideoPattern);
											newSection += "<img src='http://img.youtube.com/vi/"+video[0]+"/0.jpg' width='100%'/>";
									}
									//Eist Vimeo een apart JSON call? that would suck
									else if(value.type == "vimeo" || value.url.match(vimeoEmbedPattern) ) {
										console.log("vimeo!");
										video = new Object();
										video.id = value.url.match(youtubeEmbedVideoPattern)[0];
										//console.log(video);
										$.postJSON("../../php/ajax.php", {
											f : "vimeoThumb",
											s : video,
											format : "json"
										}, function(img) {
											//console.log(img);
											newSection += "<img src='" + img+"' width='100%'/>"
											newSection += "<p>" + value.description + "</p>";
											//newSection += "<p>original source" + value.url + "</p>";
											wallnumber =parseInt(value.wall)+1;
											//console.log("#wall"+wallnumber);
											$("#wall" + wallnumber).append(newSection);
										});
										//break
									} 
									
									if(value.type != "vimeo" && value.url.match(vimeoEmbedPattern) == null){
										//console.log("geen vimeo");
									newSection += "<p>" + value.description + "</p>";
									//newSection += "<p>original source: " + value.url + "</p>";
									//console.log(newSection);
									
									wallnumber =parseInt(value.wall)+1;
									//console.log("#wall"+wallnumber);
									$("#wall" + wallnumber).append(newSection);
									}
								})
							});

						}

					});
				

			}
			var timer = setInterval( updateExpo, 15000);
			updateExpo(); 
			});
		</script>
		<style type="text/css">
			/* ADDED BY TIJMEN */
			
			h1, h2 {
				padding-left: 10px;
			}
			audio {
				width: 90%;
				padding: 15px;
			}
			
			 */
			p {
				padding: 0 15px 0 15px;
				font-size: 1.1em
			}
			p.vet {
				font-size: 1.2em;
			}
			p.colofon {
				font-size: 1em;
				font-style: italic
			}
			p a {/*text-decoration:none;*/
				color: #cc0000
			}
			.nav-glyphish-example .ui-btn .ui-btn-inner {
				padding-top: 40px !important;
			}
			.nav-glyphish-example .ui-btn .ui-icon {
				width: 30px !important;
				height: 30px !important;
				margin-left: -15px !important;
				box-shadow: none !important;
				-moz-box-shadow: none !important;
				-webkit-box-shadow: none !important;
				-webkit-border-radius: none !important;
				border-radius: none !important;
			}
			#introbtn .ui-icon {
				background: url(icons2/96-book.png) 50% 50% no-repeat;
				background-size: 18px 26px;
			}
			#kaartbtn .ui-icon {
				background: url(icons2/103-map.png) 50% 50% no-repeat;
				background-size: 26px 21px;
			}
			#lijstbtn .ui-icon {
				background: url(icons2/179-notepad.png) 50% 50% no-repeat;
				background-size: 22px 28px;
			}
			#gpsbtn .ui-icon {
				background: url(icons2/193-location-arrow.png) 50% 50% no-repeat;
				background-size: 24px 24px;
			}
			#twitterbtn .ui-icon {
				background: url(icons2/08-chat.png) 50% 50% no-repeat;
				background-size: 24px 22px;
			}
			
			.ui-bar-a {
				background: -moz-linear-gradient(#851947, #750937) repeat scroll 0 0 #111111;
				border: 1px solid #2A2A2A;
				color: #FFFFFF;
				font-weight: bold;
				text-shadow: 0 -1px 1px #000000;
			}
			.ui-content .ui-listview {
				margin-left: 0px
			}
			.ui-li-heading {
				white-space: normal
			}
			a:hover * .ui-btn-text {
				color: #750937
			}
			.imgwidth100 {
				width: 100%
			}

		</style>
	</head>
	<body>
		<div data-role="page" data-url="one">
			<div data-role="header" data-position="fixed" class="ui-header ui-bar-d ui-header-fixed fade ui-fixed-overlay">
				<div class="ui-header-fixed fade ui-fixed-overlay nav-glyphish-example"	data-position="fixed" data-role="navbar" data-grid="c">
					<?php
					showMenu(1);
					?>
				</div>
			</div>
			<div class="ui-content ui-body-c" data-role="content" role="main">
				<div id="wall1"></div>
			</div>
		</div><!-- /page -->
		<div id="list" data-role="page" data-url="two">
			<div data-role="header" data-position="fixed" class="ui-header ui-bar-d ui-header-fixed fade ui-fixed-overlay">
				<div class="ui-header-fixed fade ui-fixed-overlay nav-glyphish-example"	data-position="fixed" data-role="navbar" data-grid="c">

					<?php
					showMenu(1);
					?>

				</div>
			</div>
			<div class="ui-content ui-body-c" data-role="content" role="main">
				<div id="wall2"></div>
			</div>
		</div><!-- /page -->
		<div id="map" data-role="page" data-url="three">
			<div data-role="header" data-position="fixed" class="ui-header ui-bar-d ui-header-fixed fade ui-fixed-overlay">
				<div class="ui-header-fixed fade ui-fixed-overlay nav-glyphish-example"	data-position="fixed" data-role="navbar" data-grid="c">
					<?php
					showMenu(1);
					?>
				</div>
			</div>

			<div class="ui-content ui-body-c" data-role="content" role="main">
				<div id="expolist"></div>
			</div>

		</div><!-- /page -->
		<div id="mapper" data-role="page" data-url="four">
			<div data-role="header" data-position="fixed" class="ui-header ui-bar-d ui-header-fixed fade ui-fixed-overlay">
				<div class="ui-header-fixed fade ui-fixed-overlay nav-glyphish-example"	data-position="fixed" data-role="navbar" data-grid="c">
					<?php
					showMenu(1);
					?>
				</div>
			</div>
			<div class="ui-content ui-body-c" data-role="content" role="main">
				<div id="about">
					<p>
						Prachtig verhaal over wat dit allemaal is.
					</p>
					<p>

						Concept - Tijmen Schep
						<br />
						Productie - Krista en Lara Coomans
						<br />
						Software- Heinze Havinga
						<br />
						Countdown timer - Frank Jan van Lunteren
						<br />
					</p>

				</div>
			</div>

		</div><!-- /page -->

	</body>
</html>

<?php
function showMenu($number = 1) {
	//class="ui-btn-active"
	echo '
<ul>
	<li>
		<a href="#one" id="introbtn" data-icon="custom" >Muur 1</a>
	</li>
	<li>
		<a href="#two" id="kaartbtn" data-icon="custom" >Muur 2</a>
	</li>
	

</ul>';

}
?>