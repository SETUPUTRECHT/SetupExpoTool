<?php

require_once('settings.php');
require_once('db_mysql.php');

function checkExpo($data,$echo = true){
	$id= $data['location'];
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$settings = $db->query("
        SELECT *
        FROM active
        WHERE location_id = $id
        ", true) or $db->raise_error(); 
	
	if($echo){
	echo json_encode($settings);
	} else{
	return $settings;
	}
}

function loadLocation($data,$echo = true){
	$id= $data['id'];
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$settings = $db->query("
        SELECT *
        FROM location
        WHERE id = $id
        ", true) or $db->raise_error(); 
	
	if($echo){
	echo json_encode($settings);
	} else{
	return $settings;
	}
}

function loadLocationByName($data){
		$name= $data['name'];
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$settings = $db->query("
        SELECT *
        FROM location
        WHERE name = $name
        ", true) or $db->raise_error(); 
	echo json_encode($settings);
}


function loadPlaylists($data){
		$id= $data['location'];
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$settings = $db->query("
        SELECT *
        FROM playlist
        WHERE location_id = $id
        ", true) or $db->raise_error(); 
	echo json_encode($settings);
}

function loadExpo($data, $echo=true){
		$id= $data['id'];
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$settings = $db->query("
        SELECT *
        FROM expos
        WHERE id = $id
        ", true);// or $db->raise_error(); 
	
	if($echo){
	echo json_encode($settings);
	}else{
		return $settings;
	}
}

function loadExpoByLocation($data,$echo = true){
	$id= $data['location_id'];
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);				 
	$items = $db->query("SELECT * FROM expos WHERE location_id = $id") or $db->raise_error(); // Leaving 'raise_error()' blank will create an error message with the SQL
	$data = array();

	while ($row  = $db->fetch_array($items)){	
		$data[] = $row;
	};
	if($echo){
	echo json_encode($data);
	} else{
	return $data;
	}
}


function saveLocation($data){
	$location_name = $data['location_name'];
	$location_curator=$data['location_curator'];
	$location_curator_email = $data['location_curator_email'];
	$password = $data['password'];
	$width = $data['width']; 		
	$height = $data['height'];	
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$db->query("
        INSERT INTO location (location_name, location_curator, location_curator_email, password, width, height)
        VALUES ('$location_name', '$location_curator', '$location_curator_email', '$password', $width, $height)
") or $db->raise_error('Failed adding new location'); // Will use the message we give it + the SQL
echo $db->insert_id();
}


function saveExpo($data){
	if(isset($data['id'])){
		updateExpo($data);	
	}else{
	$name = $data['name'];
	$curator=$data['curator'];
	$curator_email = $data['curator_email'];
	$password = $data['password'];
	$description = $data['description']; 		
	$location_id = $data['location_id'];
	$canvas = htmlentities($data['canvas']);	
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$db->query("
        INSERT INTO expos (name, curator, curator_email, password, description, location_id, canvas)
        VALUES ('$name', '$curator', '$curator_email', '$password', '$description', $location_id, '$canvas')
");// or $db->raise_error('Failed adding new location'); // Will use the message we give it + the SQL
$id['id']=$db->insert_id();

	saveSources($data);
	echo json_encode($id,true);
	}
}

function updateExpo($data){
	$id = $data['id'];	
	$name = $data['name'];
	$curator=$data['curator'];
	$curator_email = $data['curator_email'];
	$password = $data['password'];
	$description = $data['description']; 		
	$location_id = $data['location_id'];
	$canvas = htmlentities($data['canvas']);
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);	
	$db->query("
        UPDATE expos SET `name`='$name', `curator`='$curator', `curator_email`='$curator_email', `password`='$password', `description`='$description', `location_id`='$location_id', `canvas`='$canvas' WHERE `id`=$id
        ") or $db->raise_error('Failed adding new location'); // Will use the message we give it + the SQL
		
	clearSources($data);
	saveSources($data);
	
}

function updateActive($data){
	$id = $data['id'];	
	$location = $data['location'];
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);	
	$db->query("
        UPDATE active SET `active`='$id' WHERE `location_id`=$location
        ") or $db->raise_error('Failed adding new location'); // Will use the message we give it + the SQL
	}


function deleteExpo($data){
	$id = $data["id"];
	$hash = $data["hash"];
	$expo = loadExpo($data,false);
	
	if($hash == $expo["password"]){
	clearSources($data);
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$settings = $db->query("DELETE FROM `expos` WHERE id=$id", true);// or $db->raise_error(); 
	$succes = "succes!";
	echo json_encode($succes);
	} else{
		$error = "wrong password given or expo doesn't exsist";
		echo json_encode($error,true);
	}
}


function clearSources($data){
	$id= $data['id'];
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$settings = $db->query("DELETE FROM sources WHERE expo_id=".$id, true);// or $db->raise_error();
	//echo "gtg"; 
}

function saveSources($data){
	
	if(isset($data['pieces'])){
	$statement = "VALUES";
	
	foreach($data['pieces'] as $source){
		if(!isset($source['type'])){
			$source['type']="unknown";
		}
		
		$statement .= "(".
        $source['expo_id'].",".
        $source['wall'].", ".
        "'".$source['title']."', ".
		"'".$source['type']."', ".
        "'".$source['url']."', ".
        "'".$source['description']."', ".
        $source['position_x'].", ".
        $source['position_y'].", ".
		$source['width'].", ".
        $source['heigth'].", ".
        $source['list']."),";
	}
	
	$statement = substr($statement,0,-1);
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$settings = $db->query("INSERT INTO sources(expo_id, wall, title, type, url, description, position_x, position_y, width, heigth, list) $statement", true);// or $db->raise_error();
	}
}

function loadSources($data,$echo = true){
	$id = $data["id"];	
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$items = $db->query("
        SELECT * 
        FROM sources 
        WHERE expo_id = $id 
       ") or $db->raise_error(); // Leaving 'raise_error()' blank will create an error message with the SQL

	$sources = array();
	while ($row  = $db->fetch_array($items)){
		$sources[] = $row;
	};
	return $sources;
}

function loadSourcesBooklet($data){
	$id = $data["id"];	
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$items = $db->query("
        SELECT * 
        FROM sources 
        WHERE expo_id = $id 
       ") or $db->raise_error(); // Leaving 'raise_error()' blank will create an error message with the SQL

	$sources = array();
	while ($row  = $db->fetch_array($items)){
		$sources[] = $row;
	};
	echo json_encode($sources,true);
}

function passwordCheck($data){
	$email = $data["email"];
	$hash = $data["hash"];
	$expo = loadExpo($data, false);
	if($hash == $expo["password"] && $email == $expo["curator_email"]){
		$expo['sources'] = loadSources($data,false);
		$expo['password'] = "ssshhh it's secret";	
		echo json_encode($expo,true);
	} else{
		$error["message"] = "Not the right username and password.";
		echo json_encode($error,true);
	}
}


function loadWallSources($data,$echo = true){
	$id = $data["id"];
	$wall = $data["wall"];	
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$items = $db->query("
        SELECT * 
        FROM sources 
        WHERE expo_id = $id AND wall = $wall
       ") or $db->raise_error(); // Leaving 'raise_error()' blank will create an error message with the SQL

	$sources = array();
	while ($row  = $db->fetch_array($items)){
		$sources[] = $row;
	};
	if($echo){
	echo json_encode($sources);
	}else{
		return $sources;
	}

}

function loadWalls($data, $echo = true){
	$location_id;
	
	if(isset($data['location_id'])){
		$location_id = $data['location_id'];
	}else if(!isset($data['location_id'])&&isset($data['id'])){
		$id = $data["id"];
	
	$settings = loadExpo($data,false); 
	$location_id = $settings['location_id'];
	} else{
		$location_id = 0;
	}
	
	
	
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$wall = $db->query("
        SELECT *
        FROM wall
        WHERE location_id = $location_id
        "); //or $db->raise_error();
	
	$walls = array();
	//$wall[]=$data;
	//$walls[]=$location_id;
	while ($row  = $db->fetch_array($wall)){
		$walls[] = $row;
	};
	if($echo){
	echo json_encode($walls);
	}else{
		return $walls;
	}
}


//Stuff for remote.php

function remoteAction($data){
	$expoId = $data['expoId'];
	$wallNumber = $data['wall'];
	$locationId = $data['location'];
	$hide = $data['hide']; 
	$playlistOn = $data['playlistOn'];
	$playlistNumber = $data['playlistNumber'];
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$wall = $db->query("INSERT INTO
  remote
SET
  location_id = '$locationId',
  wall_number = '$wallNumber',
  active = '$expoId',
  hide = '$hide',
  playlist_on = '$playlistOn',
  playlist_id = '$playlistNumber'
  
ON DUPLICATE KEY UPDATE
  active = '$expoId',
  hide = '$hide',
  playlist_on = '$playlistOn',
  playlist_id = '$playlistNumber'"); //or $db->raise_error();
  

}

function getPlaylist($data, $echo = true){
			
	$location_id = $data['location_id'];
	$wall = $data['wall'];
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$items = $db->query("
        SELECT * 
        FROM playlist_walls 
        WHERE location_id = $location_id AND wall = $wall
       "); //or $db->raise_error(); // Leaving 'raise_error()' blank will create an error message with the SQL

	$playlists = array();
	while ($row  = $db->fetch_array($items)){
		$playlists[] = $row;
	};
	if($echo){
	echo json_encode($playlists);
	}else{
		return $playlists;
	}
}
function updatePlaylist($data){
	
	$locationId = $data['location_id'];
	$wallNumber = $data['wall'];
	$name = $data['playlistName'];
	$expos = $data['expolist'];
	$timer = $data['timer'];
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$wall = $db->query("INSERT INTO
  playlist_walls
	
	SET
  location_id = '$locationId',
  wall = '$wallNumber',
  playlist_name = '$name',
  expos= '$expos',
  timer = '$timer'
  
ON DUPLICATE KEY UPDATE
  playlist_name = '$name',
  expos='$expos',
  timer = '$timer'"); //or $db->raise_error();
 
 	getPlaylist($data);
 
}

function checkUpdate($data, $echo = true){
			
	$location_id = $data['location_id'];
	$wall = $data['wall'];
	$db = new db_mysql(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$items = $db->query("
        SELECT * 
        FROM remote 
        WHERE location_id = $location_id AND wall_number = $wall
       "); //or $db->raise_error(); // Leaving 'raise_error()' blank will create an error message with the SQL

	$playlists = array();
	while ($row  = $db->fetch_array($items)){
		$playlists[] = $row;
	};
	if($echo){
	echo json_encode($playlists);
	}else{
		return $playlists;
	}
}

function vimeoThumb($data){
	$imgid = $data["id"];
	$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
	echo json_encode($hash[0]['thumbnail_medium']); 
}

?>