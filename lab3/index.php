<?php
	include "login.php";
	

    $result = mysqli_query($db_server,"SELECT * FROM book");
    $fetched = mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo "<table border='1'>";
    	echo "<tr>";
    foreach ($fetched as $key => $value) {
    	
    			echo "<td>";
    				echo $value['title'];
    		    echo "</td>";
    	
    }
        echo "</tr>";
    	echo "</table>";
?>