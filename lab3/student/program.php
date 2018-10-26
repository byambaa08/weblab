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
	$qry = "SELECT * FROM students WHERE id='".decrypt($_SESSION['passed'])."';";
    $result = mysqli_query($db_server, $qry);
	$student = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$qry = "SELECT * FROM programs;";
    $result = mysqli_query($db_server, $qry);
	$programs = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>
		<?php echo '<h1 class="display-4 text-center text-success">'.$student[0]['f_name'].' та хөтөлбөрөө сонгоно уу.</h1>';?>
	<div id="form">
<form action="process.php" method="POST">
	<p>
		<?php
				echo '<input type="hidden" name="program" value="program">';
				echo '<input type="hidden" name="id" value='.decrypt($_SESSION['passed']).' >';
				echo'<select name="program_id" class="form-control" aria-describedby="basic-addon1" required>';
				foreach ($programs as $key => $value) {
					echo '<option value="'.$value["id"].'" >'.$value["name"].'</option>';
				}
				
				echo '</select>';
			
		?>
	</p>
	<p>
		<input type="submit" id="btn" value="Хадгалах" class="form-control">
	</p>
			
</form>
	</div>

	</div>

</body>
</html> 