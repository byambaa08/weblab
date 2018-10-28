<?php
	include "header.php";
	if(!isset($_GET['id']) || !isset($_SESSION['passed']) || $_SESSION['passed'] !== $_GET['id'] ){
		if(!isset($_GET['id']) || $_GET['id']!=md5(decrypt($_SESSION['passed']))){

			if(!isset($_POST['id']) || !isset($_SESSION['passed']) || $_SESSION['passed'] !== $_POST['id'] ){
				if(!isset($_POST['id']) ||  $_POST['id']!=md5(decrypt($_SESSION['passed']))){
					header("Location: index.php?error=2");
					die();
				}
			}
		}
	}
	$id = decrypt($_SESSION['passed']);
	
	if(isset($_POST['lesson'])){
		$qry = "INSERT INTO classes(student_id,lesson_id)  VALUES ('".decrypt($_SESSION['passed'])."','".$_POST['lesson_id']."');";
		$result = mysqli_query($db_server, $qry);
	}
	if(isset($_POST['class'])){
	    $qry = "DELETE from classes where student_id='".decrypt($_SESSION['passed'])."' and lesson_id='".$_POST['lesson_id']."';";
		$result = mysqli_query($db_server, $qry);
		// $result = mysqli_query($db_server, $qry);
	}
	echo'<a class="btn btn-secondary btn-lg" role="button" href="welcome.php?id='.md5($id).'">өөрийн мэдээлэл</a>';
	echo "</div></head>";

	$qry = "SELECT * FROM classes where student_id = '".$id."';";
	$result = mysqli_query($db_server, $qry);
	$classes = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$qry = "SELECT * FROM lessons ;";
	$result = mysqli_query($db_server, $qry);
	$lessons = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$student_lessons = array();
	echo ' <table class="table table-hover table-dark">
				  <thead>
				    <tr>
				      <th scope="col">Сонгосон хичээлүүд</th>
				      <th scope="col">Сонгох боломжтой хичээлүүд</th>
				    </tr>
				  </thead>
				  <tbody>';

		echo '<td>';
		foreach ($classes as $key => $value) {
			        array_push($student_lessons, $value['lesson_id']);
			    	echo '<form action="lesson.php" method="POST">';
						echo '<input type="hidden" name="id" value='.md5($id).' >';
					echo '<input type="hidden" name="lesson_id" value='.$value['lesson_id'].' >';
					$qry = "SELECT name FROM lessons where id='".$value['lesson_id']."'";
				    $result = mysqli_query($db_server, $qry);
				    $cool = mysqli_fetch_all($result, MYSQLI_ASSOC);
			    		echo '<input type="submit" name="class" id="btn btn-outline-primary" value="'.$cool[0]['name'].'" class="btn btn-outline-success">';
			    	echo '</form>';
			    }
			   	echo '</td>';

		   	echo '<td>';

		foreach ($lessons as $key => $value) {
			if(!in_array($value['id'], $student_lessons)){
		    	echo '<form action="lesson.php" method="POST">';
					echo '<input type="hidden" name="id" value='.md5($id).' >';
					echo '<input type="hidden" name="lesson_id" value='.$value['id'].' >';

		    		echo '<input type="submit" name="lesson" id="btn btn-outline-primary" value="'.$value['name'].'" class="btn btn-outline-danger">';
		    	echo '</form>';
		    }
		 }
		   	echo '</td>';
		    echo '</tr>';

		


?>
