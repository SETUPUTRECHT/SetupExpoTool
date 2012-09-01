$(function() {

		jQuery.extend({
   postJSON: function( url, data, callback) {
      return jQuery.post(url, data, callback, "json");
   }
});

		var youtubePattern = /youtube.com/;
		var youtubeVideoPattern = /v\=[a-zA-Z0-9_\-]+(?=&|$)/;
		var vimeoPattern = /vimeo.com/;
		var vimeoVideoPattern = /[0-9]+(?=&|$)/;
		var imgPattern = /(.gif|.jpg|.png|.jpeg|.JPG)$/;	
		var youtubeEmbedPattern = /youtube.com\/embed/;
		var vimeoEmbedPattern = /player.vimeo.com\/video/;
		//Setting up buttons in Modals
		$("#submitExpo").bind("click", function(event) {
				event.preventDefault();
				saveExpo();
		});
		
		$("#saveExpo").bind("click", function(event) {
				event.preventDefault();
				saveExpo();
		});
		
		$("#expoDelete").bind("click", function(event) {
				event.preventDefault();
				deleteExpo();
		});
		
		$("#deletePiece").bind("click", function(event) {
				event.preventDefault();
				deletePiece();
		});
		
		$("#submitPassword").bind("click", function(event) {
				event.preventDefault();
				passwordCheck();
		});
		
		$("#changePiece").on("click",function(event){
			event.preventDefault();
			editPiece();
			});
		
		function saveExpo(){
			
				//check wachtwoord
				if($("#password").val() != $("#password2").val()){
					$("#expo-props .modal-body").prepend('<div class="alert alert-block fade in" id="passwordAlert">  <a class="close" data-dismiss="alert">×</a>  Password didn\'t match.</div>');
				}
				
				else{
				var data = new Object;
				data.id = expo.id;
				data.name =  escape($("#name").val());
				data.curator =  escape($("#nameCurator").val());
				data.curator_email =  escape($("#emailCurator").val());
				data.password = MD5($("#password").val());
				data.description =  escape($("#description").val());
				//TODO: should prepare system on multiple locations
				data.location_id =  0;
				data.canvas =  escape($(".canvas").clone().wrap('<div>').parent().html());
				data.pieces = gatherPieces();
			
				
				$.postJSON("php/ajax.php", {
					f : "saveExpo",
					s : data,
					format : "json"
				}, function(data) {

					if(data != null){
					$.each(data, function(i,item){
						expo.id = item;
					});
					}
						
					origin = window.location.origin
					if(origin == undefined){
						origin = "http://www.setup.nl"
					}
					
					$(".infobar").html("To edit the expo at a later time, go to " + origin+window.location.pathname+"?expo="+expo.id);
					$(".infobar").append('<div class="alert alert-success fade in"><a class="close" data-dismiss="alert">×</a> Saved succesfully.</div>');					
					$('.modal.in').modal('hide');
					$('#expo-props').modal({show:false,backdrop:true});
				})
		}
		}


	function deleteExpo(){
			
			data = new Object()
			data.id= expo.id;
			data.hash = MD5($("#passwordDelete").val());
			
			$.postJSON("php/ajax.php", {
					f : "deleteExpo",
					s : data,
					format : "json"
				}, function(data) {
				window.location.replace(window.location.origin+"/setupwall/");
					});
		}

		function deletePiece(){
			$('.modal.in').modal("hide");		
			activeElement.remove();
			activeElement = "";
		}
		
		function editPiece(){
			var src = encodeURI($("#new-src").val());
				var pieceTitle = escape($("#dialog-new").find("#pieceTitle").val());
				var pieceDesc = escape($("#dialog-new").find("#pieceDesc").val());
				var borderValue = escape($("#imageBorder").val());
				var border = "";
				if(borderValue != "none") {
					border = "border " + borderValue;
				}
		
			//Clear piece
			activeElement.children("img:eq(0),iframe,input").remove();
			//Clear classes
			activeElement.removeClass("image").removeClass("youtube").removeClass("vimeo").removeClass("movie");
			
			activeWall = $(".carousel-inner .active").attr("data-id");
			
			//Check new type and rebuild piece
			if(src.match(imgPattern) !== null) {
					activeElement.addClass("image");
					activeElement.prepend('<img width="100%" height="100%" src="' +  decodeURI(src) + '" /><input type="hidden" id="expo" value="'+ expo.id +'"/><input type="hidden" id="wall" value="'+ activeWall +'"/>					<input type="hidden" id="pieceTitle" value="'+  pieceTitle +'"><input type="hidden" id="pieceDesc" value="'+  pieceDesc +'">');
					activeElement.attr("rel","img");
					$('.modal.in').modal("hide");
					activeElement = "";
				} else if(src.match(youtubePattern) !== null) {
					
					if(src.match(youtubeEmbedPattern)){
						activeElement.addClass("youtube");
						activeElement.addClass("movie");
						activeElement.attr("rel","youtube");
						activeElement.prepend('<iframe src="' + decodeURI(src) + '" frameborder="0" width="100%" height="100%" allowfullscreen></iframe><input type="hidden" id="expo" value="'+ expo.id +'"/><input type="hidden" id="wall" value="'+ activeWall +'"/>				<input type="hidden" id="pieceTitle" value="'+ pieceTitle +'"><input type="hidden" id="pieceDesc" value="'+  pieceDesc +'">');
						$('.modal.in').modal("hide");
						activeElement = "";
					}
					else{
					var video = src.match(youtubeVideoPattern);
					if(video.length !== null) {
						activeElement.addClass("youtube");
						activeElement.addClass("movie");
						activeElement.attr("rel","youtube");
						activeElement.prepend('<iframe src="http://www.youtube.com/embed/' + video[0].substring(2) + '?html5=1&autoplay=1&autohide=1" frameborder="0" width="100%" height="100%" allowfullscreen></iframe><input type="hidden" id="expo" value="'+ expo.id +'"/><input type="hidden" id="wall" value="'+ activeWall +'"/>				<input type="hidden" id="pieceTitle" value="'+ pieceTitle +'"><input type="hidden" id="pieceDesc" value="'+ pieceDesc +'">');
						$('.modal.in').modal("hide");
						activeElement = "";
					}
					}
				} else if(src.match(vimeoPattern) !== null) {
					if(src.match(vimeoEmbedPattern)){
						activeElement.addClass("vimeo");
						activeElement.addClass("movie");
						activeElement.attr("rel","vimeo");
						activeElement.prepend('<iframe src="' + decodeURI(src) + '" width="100%" height="100%" frameborder="0"></iframe><input type="hidden" id="expo" value="'+ expo.id +'"/><input type="hidden" id="wall" value="'+ activeWall +'"/>					<input type="hidden" id="pieceTitle" value="'+ pieceTitle +'"><input type="hidden" id="pieceDesc" value="'+ pieceDesc +'">');
						$('.modal.in').modal("hide");
						activeElement = "";
					}
					else{
					var video = src.match(vimeoVideoPattern);
					if(video.length !== null) {
						var video = src.match(vimeoVideoPattern);
						activeElement.addClass("vimeo");
						activeElement.addClass("movie");
						activeElement.attr("rel","vimeo");
						activeElement.prepend('<iframe src="http://player.vimeo.com/video/' + video[0] + '?autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0" width="100%" height="100%" frameborder="0"></iframe><input type="hidden" id="expo" value="'+ expo.id +'"/><input type="hidden" id="wall" value="'+ activeWall +'"/>					<input type="hidden" id="pieceTitle" value="'+ pieceTitle +'"><input type="hidden" id="pieceDesc" value="'+ pieceDesc +'">');
						$('.modal.in').modal("hide");
						activeElement = "";
					}
					}
				} else {
					$("#dialog-new .modal-body").prepend('<div class="alert alert-block fade in" id="elementError"><a class="close" data-dismiss="alert">×</a> De url klopt niet helemaal zie ook de tips.</div>');

				}
		}
		
	$("#submitPiece").bind("click", function(event) {
				//TODO: error check
				var src = $("#new-src").val();
				var pieceTitle = escape($("#dialog-new").find("#pieceTitle").val());
				var pieceDesc = escape($("#dialog-new").find("#pieceDesc").val());
				var borderValue = $("#imageBorder").val();
				var border = "";
				if(borderValue != "none") {
					border = "border " + borderValue;
				}
				
				activeWall = $(".carousel-inner .active").attr("data-id");
				
				if(src.match(imgPattern) !== null) {

					$(".canvas[data-id='"+activeWall+"']").append('<div class="piece image ' + border + '" id="high" width="150px" height="150px" style="position:absolute; left:0px;top:0px;"><img width="100%" height="100%" src="' + src + '" /><input type="hidden" id="expo" value="'+ expo.id +'"/><input type="hidden" id="wall" value="'+ activeWall +'"/>					<input type="hidden" id="pieceTitle" value="'+ pieceTitle +'"><input type="hidden" id="pieceDesc" value="'+ pieceDesc +'"></div>');
					$(".piece").draggable();
					$(".piece").resizable();
					$('.modal.in').modal("hide");
				} else if(src.match(youtubePattern) !== null) {
					if(src.match(youtubeEmbedPattern)){
						$(".canvas[data-id='"+activeWall+"']").append('<div rel="youtube" class="piece movie youtube ' + border + '" rel="youtube" width="150px" height="150px" style="position:absolute;left:0px;top:0px;"><iframe src="<iframe src="' + src + '" frameborder="0" width="100%" height="100%" allowfullscreen></iframe>" frameborder="0" width="100%" height="100%" allowfullscreen></iframe><input type="hidden" id="expo" value="'+ expo.id +'"/><input type="hidden" id="wall" value="'+ activeWall +'"/>				<input type="hidden" id="pieceTitle" value="'+ pieceTitle +'"><input type="hidden" id="pieceDesc" value="'+ pieceDesc +'"></div>');
						$(".piece").draggable();
						$(".piece").resizable();
						$('.modal.in').modal("hide");
						activeElement.prepend('<iframe src="' + src + '" frameborder="0" width="100%" height="100%" allowfullscreen></iframe><input type="hidden" id="expo" value="'+ expo.id +'"/><input type="hidden" id="wall" value="'+ activeWall +'"/>				<input type="hidden" id="pieceTitle" value="'+ pieceTitle +'"><input type="hidden" id="pieceDesc" value="'+ pieceDesc +'">');
					}else{
					var video = src.match(youtubeVideoPattern);
					if(video.length !== null) {
						//playlist parameter needed for AS3 loop bug in Youtube player
						$(".canvas[data-id='"+activeWall+"']").append('<div rel="youtube" class="piece movie youtube ' + border + '" rel="youtube" width="150px" height="150px" style="position:absolute;left:0px;top:0px;"><iframe src="http://www.youtube.com/embed/' + video[0].substring(2) + '?html5=1&autoplay=1&autohide=1&wmode=transparent&loop=1&playlist='+ video[0].substring(2)+'" frameborder="0" width="100%" height="100%" allowfullscreen></iframe><input type="hidden" id="expo" value="'+ expo.id +'"/><input type="hidden" id="wall" value="'+ activeWall +'"/>				<input type="hidden" id="pieceTitle" value="'+ pieceTitle +'"><input type="hidden" id="pieceDesc" value="'+ pieceDesc +'"></div>');
						$(".piece").draggable();
						$(".piece").resizable();
						$('.modal.in').modal("hide");
					}}
				} else if(src.match(vimeoPattern) !== null) {
					if(src.match(vimeoEmbedPattern)){
						$(".canvas[rel='"+activeWall+"']").append('<div rel="vimeo" class="piece movie vimeo ' + border + '" rel="vimeo" width="150px" height="150px" style="position:absolute;left:0px;top:0px;"><iframe src="' + decodeURI(src) + '" width="100%" height="100%" frameborder="0"></iframe><input type="hidden" id="expo" value="'+ expo.id +'"/><input type="hidden" id="wall" value="'+ activeWall +'"/>					<input type="hidden" id="pieceTitle" value="'+ pieceTitle +'"><input type="hidden" id="pieceDesc" value="'+ pieceDesc +'"></div>');
						
						$(this).dialog("close");
						$(".piece").draggable();
						$(".piece").resizable();
						$('.modal.in').modal("hide");
					}
					else{
					var video = src.match(vimeoVideoPattern);
					if(video.length !== null) {
						var video = src.match(vimeoVideoPattern);
						$(".canvas[data-id='"+activeWall+"']").append('<div rel="vimeo" class="piece movie vimeo ' + border + '" rel="vimeo" width="150px" height="150px" style="position:absolute;left:0px;top:0px;"><iframe src="http://player.vimeo.com/video/' + video[0] + '?autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;loop=1" width="100%" height="100%" frameborder="0"></iframe><input type="hidden" id="expo" value="'+ expo.id +'"/><input type="hidden" id="wall" value="'+ activeWall +'"/>					<input type="hidden" id="pieceTitle" value="'+ pieceTitle +'"><input type="hidden" id="pieceDesc" value="'+ pieceDesc +'"></div>');
						$(this).dialog("close");
						$(".piece").draggable();
						$(".piece").resizable();
						$('.modal.in').modal("hide");
					}}
				} else {
					$("#dialog-new .modal-body").prepend('<div class="alert alert-block fade in" id="elementError"><a class="close" data-dismiss="alert">×</a> De url klopt niet helemaal zie ook de tips.</div>');
				}
			});

	

	function gatherPieces(){
		 
		 pieces = new Array();
		 
		 $.each($(".canvas").children(),function(index,value){
		 	piece = new Object();
		 	
		 	valueObject = $(value);
		 	
		 	//Check x en y positie, breedte en hoogte, normaliseer deze tussen 0 en 1
            var position = valueObject.position();
            piece.position_x = parseInt(valueObject.css("left")) / valueObject.parent().width();
            piece.position_y = parseInt(valueObject.css("top")) / valueObject.parent().innerHeight();
		 	
		 	//check of het een image is of iFrame
		 	if(valueObject.hasClass('youtube') || valueObject.hasClass('vimeo') || valueObject.hasClass('movie')){
		 		piece.type = valueObject.attr("rel");	
		 	//Pak URL
		 		piece.url = valueObject.find("iframe").attr("src");
		 		//console.log("video ")+ piece.url;
		 	piece.position_x = (parseInt(valueObject.css("left"))+parseInt(valueObject.css("padding"))) / valueObject.parent().width();
            piece.position_y = (parseInt(valueObject.css("top"))+parseInt(valueObject.css("padding"))) / valueObject.parent().innerHeight();
		 	} 
		 	else if (valueObject.hasClass('image')){
		 		piece.type = "image";
		 	//Pak URL
		 		piece.url = valueObject.find("img").attr("src");
		 	}
		 	//pak de html van het kind erbij
		 	if(valueObject.hasClass("border")){
		 		piece.list = "1";	
		 	}
		 	
		 	//Check of lijst
		 	piece.list = "1";	
		 	
		 	
			
		 	
		 	piece.width = valueObject.width() / valueObject.parent().width();
		 	piece.heigth = valueObject.height() / valueObject.parent().innerHeight();
		 	
		 	//Hoe gaan we hier achter komen?
		 	piece.expo_id = expo.id;
		 	piece.wall = valueObject.find("#wall").val();
		 	
		 	//hidden form fields bevatten titel en description
		 	piece.title = valueObject.find("#pieceTitle").val();
		 	piece.description = valueObject.find("#pieceDesc").val();
		 	
		 	piece.url= encodeURI(piece.url);
		 	piece.title = escape(piece.title);
		 	piece.description = escape(piece.description);
		 	pieces.push(piece);
		 });
		
		return pieces;
	}
	
	function buildExpo(data){
		expo.id = data.id;
		origin = window.location.origin
					if(origin == undefined){
						origin = "http://www.setup.nl"
					}
		$(".infobar").html("To edit this expo at a later time, go to " + origin+window.location.pathname+"?expo="+expo.id);
		$("#nameCurator").val(expo.curator = data.curator);
		$("#emailCurator").val(expo.curator_email = data.curator_email);
		$("#description").val(expo.description = data.description);
		$("#name").val(expo.name = data.name);
		$("#password").val($("#passwordCheck").val());
		$("#password2").val($("#passwordCheck").val());
		//TODO:populate form
		
		$.each(data.sources,function(index,value){
			
			pos_x = Math.round(parseFloat(value.position_x)*$(".canvas[data-id='"+value.wall+"']").width());
			pos_y = Math.round(parseFloat(value.position_y)*$(".canvas[data-id='"+value.wall+"']").height()); 
			width = Math.round(parseFloat(value.width)*$(".canvas[data-id='"+value.wall+"']").width());
			height = Math.round(parseFloat(value.heigth)*$(".canvas[data-id='"+value.wall+"']").height());
			
			value.url = decodeURI(value.url);
			//Sometimes the type doesn't get saved right, luckily we can still guess the type from the url trough regex
			src = value.url;
			
			if(value.type == "image" || src.match(imgPattern) !== null){
				$(".canvas[data-id='"+value.wall+"']").append('<div class="piece image" id="high"  style="left:'+pos_x+'px;top:'+pos_y+'px;width:'+width+'px; height:'+height+'px; position:absolute;"><img height="100%" width="100%" src="' + value.url + '" /><input type="hidden" id="expo" value="'+ value.expo_id +'"/><input type="hidden" id="wall" value="'+ value.wall +'"/><input type="hidden" id="pieceTitle" value="'+ value.title +'"><input type="hidden" id="pieceDesc" value="'+ value.description +'"></div>');
			}
			else if(value.type == "youtube" || value.type == "vimeo" || src.match(youtubePattern) !== null || src.match(vimeoPattern) !== null){
				$(".canvas[data-id='"+value.wall+"']").append('<div class="piece movie '+value.type+'" style="left:'+pos_x+'px;top:'+pos_y+'px;width:'+width+'px; height:'+height+'px; position:absolute;"><iframe src="' + value.url + '" frameborder="0" width="100%" height="100%" allowfullscreen></iframe><input type="hidden" id="expo" value="'+ value.expo_id +'"/><input type="hidden" id="wall" value="'+ value.wall +'"/>				<input type="hidden" id="pieceTitle" value="'+ value.title +'"><input type="hidden" id="pieceDesc" value="'+ value.description +'"></div>');
			}
				$(".piece").draggable();
				$(".piece").resizable();
		})
	}
	
	function passwordCheck(){
		var data= new Object();
		data.id = expo.id;
		data.hash = MD5($("#passwordCheck").val());
		data.email = $("#emailCheck").val();
		
		$.postJSON("php/ajax.php", {
					f : "passwordCheck",
					s : data,
					format : "json"
				}, function(data) {
					if(data.message !== undefined){
						$("#dialog-password .modal-body").prepend('<div class="alert alert-block fade in" id="passwordError"><a class="close" data-dismiss="alert">×</a> the combination of password and user name is incorrect, or expo doesn\'t exsist.</div>');							
					} else{
						buildExpo(data);
						$('.modal.in').modal('hide');}
				})
	}
})