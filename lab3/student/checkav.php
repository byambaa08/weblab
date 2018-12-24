<?php


if(isset($_GET['check_username'])){
		$db_hostname = 'localhost';  
 	$db_username = 'root';  
 	$db_password = '';
	$db_database = "student";
  	$db_server = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
		$username=mysqli_real_escape_string($db_server, $_GET['check_username']);
		if(empty($username)){
			echo " ";
		}
		$query="SELECT * FROM users WHERE student_id='".$username."'";
		$result=  mysqli_query($db_server,$query);
	 	$rowCount=  mysqli_num_rows($result);
	 	if($rowCount>0){   
	 		echo "<span class='status-not-available'><font color='#e60000'> Not Available.</span>";
		} 
		else {
			echo "<span class='text-success'> Username Available.</span>";
		}
	}
?>