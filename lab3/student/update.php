<?php
	include "header.php";
	echo "</div></head>";
	if(!isset($_GET['id']) || !isset($_SESSION['passed']) || $_SESSION['passed'] !== $_GET['id'] ){
		if($_GET['id']!=md5(decrypt($_SESSION['passed']))){
			header("Location: index.php?error=2");
			die();
		}
	}
	$qry = "SELECT * FROM students WHERE id='".decrypt($_GET['student_id'])."';";
    $result = mysqli_query($db_server, $qry);
	$fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>

	<div id="form">
<form action="process.php" method="POST">
			<p>
				<input type="hidden" name="edited" value="edited">;
				<?php echo '<input type="hidden" name="student_id" value='.decrypt($_GET['student_id']).'>'; ?>
				<?php echo '<input type="hidden" name="id" value='.decrypt($_GET['id']).'>'; ?>
  				<div class="input-group-prepend">
					<?php
						echo '<input type="text" id="user" name="lname" placeholder="Овог" value='.$fetched[0]["l_name"].' class="form-control" aria-describedby="basic-addon1" required>';
					?>
				</div>
			</p>
			<p>
  				<div class="input-group-prepend">
					<?php
						echo '<input type="text" id="user" name="fname" placeholder="Нэр" value='.$fetched[0]["f_name"]. ' class="form-control" aria-describedby="basic-addon1" required>';
					?>
				</div>
			</p>
			<p>
  				<div class="input-group-prepend">
					<?php
					if($fetched[0]["gender"]=='f'){
						echo'<select name="gender" class="form-control" aria-describedby="basic-addon1" required>
							  <option value="f" selected>Эм</option>
							  <option value="m">Эр</option>
						  	</select>';
					}
					else{
						echo'<select name="gender" class="form-control" aria-describedby="basic-addon1" required>
							  <option value="f" >Эм</option>
							  <option value="m" selected>Эр</option>
						  	</select>';
					  	}
					?>
				</div>
			</p>
			<p>
  				<div class="input-group-prepend">
					<?php
						echo '<input type="date" id="user" name="dob" value='.$fetched[0]["dob"].' class="form-control" aria-describedby="basic-addon1" required>';
					?>
				</div>
			</p>
			<p>
				<input type="submit" id="btn" value="Засах" class="form-control">
			</p>
			
		</form>
	</div>

	</div>

</body>
</html>