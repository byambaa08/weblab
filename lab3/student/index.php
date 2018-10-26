<?php

	session_start();
    session_destroy();
	include "header.php";	

    if(isset($_GET['logout']))
         session_destroy();
?>

</div></head>
<body>
	<div id="form">

		<?php
			if(isset($_GET['error']) && $_GET['error']==2)
				echo "<p><font color='#e60000'>Ямар нэгэн юм буруу боллоо!</font></p>";	
		?>
		<form action="process.php" method="POST">
			<p>
  				<div class="input-group-prepend">
					<?php
						if(isset($_GET['id'])){
							echo '<input type="text" id="user" name="user" value='.$_GET['id'].' placeholder="Оюутны ID" class="form-control" aria-describedby="basic-addon1" required>';
						}
						else	
							echo '<input type="text" id="user" name="user" placeholder="Оюутны ID" class="form-control" aria-describedby="basic-addon1" required>';
					?>
				</div>
			</p>
			<p>
  				<div class="input-group-prepend">
					<input type="Password" id="pass" name="pass" placeholder="Нууц үг" class="form-control" required  >
				</div>
			</p>
			<?php
				if(isset($_GET['error']) && $_GET['error']==1){
					echo "<p><font color='#e60000'>Нууц үг эсвэл Оюутны ID буруу байна!</font></p>";
				}
			?>
			<p>
				<input type="submit" id="btn" value="Нэвтрэх" class="form-control">
			</p>
			
		</form>
		
	</div>

</body>
</html>