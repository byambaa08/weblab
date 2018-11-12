<?php
	include "header.php";
	if(!isset($_GET['id']) || !isset($_SESSION['passed']) || md5(decrypt($_SESSION['passed'])) !== $_GET['id']  || $_SESSION['access_lvl']<=1){
		header("Location: index.php?error=2");
		die();
	}
	else{
		$id = decrypt($_SESSION['passed']);

		echo "</div></head>";
		$qry = "Select * from staffs";
		$result = mysqli_query($db_server, $qry);
		$fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);	
        if($_SESSION['access_lvl']>3)
			echo '<a style="align:left;" class="btn btn-success top-right" href="add_staff.php?id='.md5($id).'" role="button">Ажилтан үүсгэх</a>';
		echo ' <table class="table table-hover table-dark" >
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Овог</th>
				      <th scope="col">Нэр</th>
				      <th scope="col">Хүйс</th>
				      <th scope="col">Албан тушаал</th>
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
		    if($value['occupation']){
				echo $value['occupation'];
		    }
		    else echo "Одоогоор тодорхогүй";
		    echo '</td>';

		   //  echo '<td>';
		    	// echo '<form action="process.php" method="POST">';
					// echo '<input type="hidden" name="id" value='.$id.' >';
					// echo '<input type="hidden" name="student_id" value='.$value["id"].'>';
					// echo '<input type="hidden" name="edit" value="edit">';
		   //  		echo '<input type="submit" id="btn btn-outline-primary" value="Засах" class="btn btn-outline-primary">';
		   //  	echo '</form>';
		   // 	echo '</td>';
		    // echo '<td>';
		    	// echo '<form action="process.php" method="POST">';
					// echo '<input type="hidden" name="id" value='.$id.' >';
					// echo '<input type="hidden" name="student_id" value='.$value["id"].'>';
					// echo '<input type="hidden" name="delete" value="delete">';
		    		?>
		    		<!-- <input type="submit" id="btn btn-outline-danger" value="Устгах" class="btn btn-outline-danger"  onclick="return confirm('Устгахдаа итгэлтэй байна уу?')" /> -->

		    		<?php  

		   		// echo '</form>';
		    // echo '</td>';
		    // echo '</tr>';

		}
	}
?>