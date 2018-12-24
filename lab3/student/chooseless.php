<?php
	$db_hostname = 'localhost';  
 	$db_username = 'root';  
 	$db_password = '';
	$db_database = "student";
  	$db_server = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
	
  	if(isset($_POST['lesson'])){
		$qry="";
		$return ="";
		if($_POST['button']=="Цуцлах"){
			$qry = "DELETE FROM classes where lesson_id='".$_POST['lesson']."' and student_id='".$_POST['student']."';";
			$return ="choose";
		}
		else if($_POST['button']=="Сонгох"){
			$qry = "INSERT INTO classes(lesson_id, student_id) values ('".$_POST['lesson']."','".$_POST['student']."');";
			$return ="cancel";
		}
		$result = mysqli_query($db_server, $qry);
		print_r($return);
		
	}

?>