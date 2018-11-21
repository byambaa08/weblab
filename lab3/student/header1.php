<?php
	function phpFunction(){
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
	?>
