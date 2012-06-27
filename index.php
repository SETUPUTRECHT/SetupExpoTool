<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Expo Extravaganza!</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Expo maker voor SETUP Utrecht">
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
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
	</head>
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
					<a class="brand" href="#">Expo Extravaganza!</a>
					<div class="nav-collapse">
						<ul class="nav">
							<li class="active">
								<a href="#">Explanation</a>
							</li>
							<li>
								<a href="expo.php">New expo</a>
							</li>
							<!-- <li>
							<a href="#contact" data-toggle="modal" data-target="#myModal" href="#myModal">Wijzig bestaande expo</a>
							</li> -->
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
		<div class="container">
			<div class="span12">
				<div class="hero-unit">
					<h1>Welkom to the SETUP expo builder!</h1>
					<p>
						The expo builder was created for an experiment of the Setup medialab in the Netherlands to see if opening twelve expo’s on one night could be successful. With this experiment we wanted to see what was possible is you would start using digital techniques on the old fashion gallery space.
					</p>
				</div>
				<p style="text-align: center;"><img src="http://farm8.staticflickr.com/7078/7209407630_34ea7741d3_b.jpg"/>
				<p>
					The event was a huge success and because of that we wanted to share to code with everybody to organize their own event of hack away and created new tools.
				</p>
				<p>
					<blockquote>
						Be warned this code is in a prototype stage and uses some stuff that won’t work in every browser and some things will require you to add things into database tables manually. To be absolutely sure everything works please use the latest version of Chrome. Firefox and Safari seem okay too but haven’t been tested as extensively.
					</blockquote>
				</p>

				<h1>How to install the expo builder</h1>
				
				</p>
				<p>
					To run the expo builder you will need to create a database and add the files in dump.sql. If that’s done. you need to edit settings.php in the php folder. In this file you’ll have to enter the database name, database host, username and password.
				</p>
				<p>
					After that you will have to create some walls for your expo space. I haven’t build any interface for that so you will have to enter it in phpmyadmin. Walls are defined in the walls table. There are some examples wall already in place to give you an idea how to add some wall, or the quickly edit some walls.
				</p>
				<p>
					the fields for the tables are:
					<li>
					<strong>id:</strong> leave this blank, to system will take care of it
					</li><li>
					<strong>location_id:</strong> this should always be 0 at te moment,
					</li><li>
					<strong>wallNumber:</strong> This should be a unique number
					</li><li>
					<strong>name:</strong> Could be anything
					</li><li>
					<strong>width:</strong> the is the width of the resolution of the beamer or screen you will show this on.
					</li><li>
					<strong>height:</strong> the is the height of the resolution of the beamer or screen you will show this on.
					</li><li>
					<strong>width_real:</strong> isn't used at the moment, but would be used for the actual projection size width
					</li><li>
					<strong>height_real:</strong> isn't used at the moment, but would be used for the actual projection size height
					</li>
					
					</ul><br /><br />
				</p>
				<h1>Important files</h1>
				<p>After you installed to files it’s nice to know which files are important.</p>
				<p>Index.php is this file, that only shows some basic explanation.</p>
				<p>expo.php is the expo creation tool</p>
				<p>show.php to make it work you’ll have to enter some parameters. The first parameter is the wall and the second is the starting expo. So in the end it will look something like show.php?wall=1&expo=1.<br /><br /></p>
				
				<h1>Creating your own expo</h1>
				<p style="text-align: center;"><img src="img/form1.jpg" alt="formulier"/>
				</p>
				<p>
					We tried to make creating of the expo as easy as possible. The whole process can be done right here on in the expo tool. Just fill in the name of your expo, your name and email, a password you want to use and a description of your expo.
				</p>
				<p>
					If this is done, it’s time to get to work!
				</p>
				<p>
<br /><br />
				</p>

				<h2>step 2: Gathering pieces and giving them a description</h2>
				<p>
					Pieces at the moment can be images (yes, you can use animated gifs) and Youtube or Vimeo video's. For images we’ll need the direct url of the image.
				</p>

				<p>
					<br />
				<p style="text-align: center;"><img src="img/vimeo.jpg" alt="Vimeo" />
				</p>
				Video’s are easier because they will work by copying a Youtube or Vimeo url from your browser. Trough the magic of regex the expo builder makes sure it works fine.
				</p>

				<p>
					<blockquote>
						Be warned that video’s can require some processing power so don’t try to add a lot of video’s in one expo. <small></small>
					</blockquote>
				</p>
				<p>
					To use images we'll need the direct URL of the image, in most browsers this can be done by right clicking on an image and select "copy image URL". Because of the checks the url has to end
					in .jpg, .gif or .png.
				</p>
				<p>
					All the images and video’s can be moved and scaled over the wall, so the expo will look just as you want.
				</p>

				<p>If at any point, you want to change a picture or video, or delete one. Just double click on the image or in the border of the video.<br /><br /></p>

				<h2>step 3: Saving</h2>
				<p>
					If you want to save an expo, just press the "Save expo" button in the top bar. Make sure you remeber of write down the url shown at the bottom and the mail adress and password you
					provided so you can edit the expo another time.
				</p>
				<p>
					Every expo has it's own URL with it's own password and mail adress. Don't lose it because there isn't any password reset or recovery method right now.
					<br />
						<br />
							<br />
				</p>
				<h2>Showing expo's</h2>
				<p>
					After you've got a nice collection of expo's going, it's time to show everything!<br />
					goto show.php with parameter wall, to get the right wall and expo for your start expo.
					SO it would be something like <a href="show.php?wall=2&expo=1">show.php?wall=2&expo=1</a>.
				</p>
				<p>
					If you want to fade in fade out your expo's you can use the up and down arrows. That way you can nicely transistion between expo's. You can switch between the expo's on the playlist with the left and right arrows.
					The playlist can be found in the table playlist (sorry no interface yet). You can also hide the mouse cursor by pressing M.
					<br /><br />
				</p>
				<p>
<br /><br />
					<a href="expo.php" class="btn btn-primary btn-large" style="width:100%;">To the expo builder! &raquo;</a>
				</p>
			</div>

			<!-- Le javascript
			================================================== -->
			<!-- Placed at the end of the document so the pages load faster -->
			<script src="js/jquery.js"></script>
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
			<script type="text/javascript">
				$(document).ready(function() {
					$('#myModal').modal({
						show : false
					});

				})
			</script>
	</body>
</html>
