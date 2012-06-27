<?php
require_once('mainfunctions.php');

$function = $_POST['f'];
$data = $_POST['s'];

call_user_func($function, $data);