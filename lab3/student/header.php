 <?php
 
	session_start();
	include "functions.php";
 	$db_hostname = 'localhost';  
 	$db_username = 'root';  
 	$db_password = '';
	$db_database = "student";
  	$db_server = mysqli_connect($db_hostname, $db_username, $db_password);
	if (!$db_server) {
		echo "Cannot connect: " . $conn->error;
		
	}
	else {
		$sql = "CREATE DATABASE ".$db_database;
		if (mysqli_query($db_server, $sql)) {
			include "data.php";
         } 
		$db_server = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Систем</title>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" ></script>
	<script src="captcha.js" ></script>
	<script src="checkid.js" ></script>
	<link rel="stylesheet" href="css/bootstrap.css" >
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/bootstrap-grid.css" >
	<link rel="stylesheet" href="css/bootstrap-grid.min.css" >
	<link rel="stylesheet" href="css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="style.css">

	<div class="jumbotron">
		    <?php
		if(isset($_SESSION['passed'])){
			echo '<a style="align:left;" class="btn btn-danger top-right" href="index.php?logout" role="button">Гарах</a>';
		}
    ?>
    	<h1>Оюутны мэдээллийн систем</h1>    
    	<?php
	    	if(isset($_SESSION['access_lvl'])){
				menus(decrypt($_SESSION['passed']),$_SESSION['access_lvl']);
			}
		?>