<?php
	include "header.php";
	if(!isset($_GET['id']) || !isset($_SESSION['passed']) || md5(decrypt($_SESSION['passed'])) !== $_GET['id']  || $_SESSION['access_lvl']<=1){
		header("Location: index.php?error=2");
		die();
	}
	else{
		$id = decrypt($_SESSION['passed']);

		echo "</div></head>";
		$qry = "Select * from users";
		$result = mysqli_query($db_server, $qry);
		$fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);	
        if($_SESSION['access_lvl']>3)
			echo '<a style="align:left;" class="btn btn-success top-right" href="add_student.php?id='.md5($id).'" role="button">Оюутан үүсгэх</a>';
		echo ' <table class="table table-hover table-dark" >
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Оюутны ID</th>
				      <th scope="col">Ажилтны ID</th>
				      <th scope="col" colspan=2 class="text-center">Үйлдэл</th>
				    </tr>
				  </thead>
				  <tbody>';
		foreach ($fetched as $key => $value) {
			echo '<tr>';
			echo '<th scope="row">'.($key+1).'</th>';
			echo '<td>'.$value["student_id"].'</td>';
			echo '<td>'.$value["staff_id"].'</td>';
			$change_id = "";
			$is_student = 0;
            if (empty($value["staff_id"])){
            	$change_id = $value["student_id"];
			    $is_student = 1;
            }
            else{
            	$change_id = $value["staff_id"];
            }
		    echo '<td>';
		    	echo '<form action="process.php" method="POST">';
					echo '<input type="hidden" name="id" value='.$id.' >';
					echo '<input type="hidden" name="cancel" value="cancel">';
					echo '<input type="hidden" name="is_student" value='.$is_student.'>';
					echo '<input type="hidden" name="change_id" value='.$change_id.'>';
					if ($value['access'] == 1 ){
		    		    echo '<input type="submit" id="btn btn-outline-primary" value="Хүчингүй болгох" class="btn btn-outline-primary">';
					}
		    		else{
		    		    echo '<input type="submit" id="btn btn-outline-primary" value="Хүчинтэй болгох" class="btn btn-outline-primary">';
		    		}
		    	echo '</form>';
		   	echo '</td>';
		    echo '<td>';
		    	echo '<form action="process.php" method="POST">';
					echo '<input type="hidden" name="id" value='.$id.' >';
					echo '<input type="hidden" name="delete_user" value="delete">';
					echo '<input type="hidden" name="is_student" value='.$is_student.'>';
					echo '<input type="hidden" name="change_id" value='.$change_id.'>';
		    		?>
		    		<input type="submit" id="btn btn-outline-danger" value="Устгах" class="btn btn-outline-danger"  onclick="return confirm('Устгахдаа итгэлтэй байна уу?')" />

		    		<?php  

		   		echo '</form>';
		    echo '</td>';
		    echo '</tr>';

		}
	}
?>