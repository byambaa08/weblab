<!DOCTYPE html>
<html>
<head>
	<title>Систем</title>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="lab7.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" ></script>
	<link rel="stylesheet" href="css/bootstrap.css" >
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/bootstrap-grid.css" >
	<link rel="stylesheet" href="css/bootstrap-grid.min.css" >
	<link rel="stylesheet" href="css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="style.css">
<?php
	$db_hostname = 'localhost';  
 	$db_username = 'root';  
 	$db_password = '';
	$db_database = "student";
  	$db_server = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
	
	function getStudentData(){
		$db_hostname = 'localhost';  
	 	$db_username = 'root';  
	 	$db_password = '';
		$db_database = "student";
	  	$db_server = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
		$qry = "Select * from students";
		$result = mysqli_query($db_server, $qry);
		$fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);		
		return json_encode($fetched);
		}
	function getStudentProgram(){
		$db_hostname = 'localhost';  
	 	$db_username = 'root';  
 		$db_password = '';
		$db_database = "student";
  		$db_server = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
		$qry = "Select * from programs;";
		$result = mysqli_query($db_server, $qry);
		$fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);		
		return json_encode($fetched);
		}
	function getStudentClass(){
		$db_hostname = 'localhost';  
	 	$db_username = 'root';  
	 	$db_password = '';
		$db_database = "student";
	  	$db_server = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
		$qry = "Select * from classes;";
		$result = mysqli_query($db_server, $qry);
		$fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);		
		return json_encode($fetched);
		}
	function getStudentLesson(){
		$db_hostname = 'localhost';  
	 	$db_username = 'root';  
	 	$db_password = '';
		$db_database = "student";
	  	$db_server = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
		$qry = "Select * from lessons;";
		$result = mysqli_query($db_server, $qry);
		$fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);		
		return json_encode($fetched);
		}


	?>

