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
	$id_right = substr($id, 0, $_SESSION['length']);
	setcookie('username',$id_right, time() + (86400 * 30));


	echo "</div></head>";

	$qry = "select * from students where id = '".$id."'";
	$result = mysqli_query($db_server, $qry);
	$fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);
	echo ' <table class="table table-hover table-dark">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Овог</th>
				      <th scope="col">Нэр</th>
				      <th scope="col">Хүйс</th>
				      <th scope="col">Хөтөлбөр</th>
				      <th scope="col" colspan=3 class="text-center">Үйлдэл</th>
				    </tr>
				  </thead>
				  <tbody>';
		foreach ($fetched as $key => $value) {
			echo '<tr>';
			echo '<th scope="row">'.($key+1).'</th>';
			echo '<td>'.$value["l_name"].'</td>';
		    echo '  <td>'.$value["f_name"].'</td>';
		    if($value["gender"]==='m')
		    	echo '<td>Эр</td>';
		    else
		    	echo '<td>Эм</td>';
		    echo '<td>';
		    if($value['program_id']){
		    	$program_qry = "Select name from programs where id='".$value['program_id']."';";
				$res = mysqli_query($db_server, $program_qry);
				$program_name = mysqli_fetch_all($res, MYSQLI_ASSOC);
				echo $program_name[0]['name'];
		    }
		    else echo "Хөтөлбөр сонгоогүй";
		    echo '</td>';
		    if($value['program_id']){
			   echo '<td>';
			    	echo '<form action="lesson.php" method="GET">';
						echo '<input type="hidden" name="id" value='.md5($id).' >';
			    		echo '<input type="submit" id="btn btn-outline-primary" value="Хичээл сонгох" class="btn btn-outline-primary">';
			    	echo '</form>';
			   	echo '</td>';
			   }else{
			   	echo '<td>';
			    	echo '<form action="program.php" method="GET">';
						echo '<input type="hidden" name="id" value='.md5($id).' >';
			    		echo '<input type="submit" id="btn btn-outline-primary" value="Хөтөлбөр сонгох" class="btn btn-outline-primary">';
			    	echo '</form>';
			   	echo '</td>';}
		   	echo '<td>';
		    	echo '<form action="password.php" method="GET">';
					echo '<input type="hidden" name="id" value='.md5($id).' >';
		    		echo '<input type="submit" id="btn btn-outline-primary" value="Нууц үг солих" class="btn btn-outline-primary">';
		    	echo '</form>';
		   	echo '</td>';
		    echo '</tr>';

		}


?>
