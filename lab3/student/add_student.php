<?php
	include "header.php";
	echo "</div></head>";
	if(!isset($_GET['id']) || !isset($_SESSION['passed']) || $_SESSION['passed'] !== $_GET['id'] ){
		if($_SESSION['access_lvl']<3 || $_GET['id']!=md5(decrypt($_SESSION['passed']))){
			header("Location: index.php?error=2");
			die();
		}
	}

?>

	<div id="form">
		<?php
			if(isset($_GET['error']) && $_GET['error']==1)
				echo "<p><font color='#e60000'><center>Оюутны ID давхцаж байна!</center></font></p>";
			if(isset($_GET['error']) && $_GET['error']==2)
				echo "<p><font color='#e60000'><center>Оюутны ID дээд талдаа 12 оронтой байна!</center></font></p>";?>
<form action="process.php" method="POST">
			<p>
				<input type="hidden" name="add_student" value="add_student">
				<?php echo '<input type="hidden" name="id" value='.$_GET['id'].'>'; ?>
  				<p><div class="input-group-prepend">
					<input type="text" id="student_id" name="student_id" placeholder="Оюутны ID" class="form-control" aria-describedby="basic-addon1" required>
				</div></p>
  				<div class="input-group-prepend">
					<input type="text" id="user" name="lname" placeholder="Овог" class="form-control" aria-describedby="basic-addon1" required>
				</div>
			</p>
			<p>
  				<div class="input-group-prepend">
					<input type="text" id="user" name="fname" placeholder="Нэр" class="form-control" aria-describedby="basic-addon1" required>
				</div>
			</p>
			<p>
  				<div class="input-group-prepend">
					<select name="gender" class="form-control" aria-describedby="basic-addon1" required>
						<option value="m" >Эр</option>
						<option value="f" >Эм</option>
					</select>
				</div>
			</p>
			<p class = 'text-success'>Төрсөн өдөр</font></p>
			<p>
  				<div class="input-group-prepend">
					<input type="date" id="user" name="dob" class="form-control" aria-describedby="basic-addon1" required>
				</div>
			</p>
			<p>
				<input type="submit" id="btn" value="Нэмэх" class="form-control">
			</p>
			
		</form>
	</div>

	</div>

</body>
</html>