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
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/bootstrap.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="css/bootstrap-grid.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="css/bootstrap-grid.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="css/bootstrap-reboot.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">

	<div class="jumbotron">
		    <?php
		if(isset($_SESSION['passed'])){
			echo '<a style="align:left;" class="btn btn-danger top-right" href="index.php?logout" role="button">Гарах</a>';
		}
    ?>
    	<h1>Оюутны мэдээллийн систем</h1>    
    	<?php
	    	if(isset($_SESSION['access_lvl']) && $_SESSION['access_lvl']>1){
				menus(decrypt($_SESSION['passed']));
			}
		?>