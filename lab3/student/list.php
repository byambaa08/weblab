<?php
	include "header.php";
	if(!isset($_GET['id']) || !isset($_SESSION['passed']) || md5(decrypt($_SESSION['passed'])) !== $_GET['id']  || $_SESSION['access_lvl']<=1){
		header("Location: index.php?error=2");
		die();
	}
	else{
		$id = decrypt($_SESSION['passed']);

		echo'<a class="btn btn-secondary btn-lg" role="button" href="welcome.php?id='.md5($id).'">өөрийн мэдээлэл</a>';
		echo "</div></head>";
		$qry = "Select * from students";
		$result = mysqli_query($db_server, $qry);
		$fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);	

		echo ' <table class="table table-hover table-dark" >
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Овог</th>
				      <th scope="col">Нэр</th>
				      <th scope="col">Хүйс</th>
				      <th scope="col">Хөтөлбөр</th>
				      <th scope="col" colspan=2 class="text-center">Үйлдэл</th>
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

		    echo '<td>';
		    	echo '<form action="process.php" method="POST">';
					echo '<input type="hidden" name="id" value='.$id.' >';
					echo '<input type="hidden" name="student_id" value='.$value["id"].'>';
					echo '<input type="hidden" name="edit" value="edit">';
		    		echo '<input type="submit" id="btn btn-outline-primary" value="Засах" class="btn btn-outline-primary">';
		    	echo '</form>';
		   	echo '</td>';
		    echo '<td>';
		    	echo '<form action="process.php" method="POST">';
					echo '<input type="hidden" name="id" value='.$id.' >';
					echo '<input type="hidden" name="student_id" value='.$value["id"].'>';
					echo '<input type="hidden" name="delete" value="delete">';
		    		?>
		    		<input type="submit" id="btn btn-outline-danger" value="Устгах" class="btn btn-outline-danger"  onclick="return confirm('Устгахдаа итгэлтэй байна уу?')" />

		    		<?php  

		   		echo '</form>';
		    echo '</td>';
		    echo '</tr>';

		}
	}
?>