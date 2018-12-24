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

			if(isset($_GET['error']) && $_GET['error']==3)
				echo "<p><font color='#e60000'>Та систем админтай холбогдоно уу!</font></p>";	
			if(isset($_GET['success']) && $_GET['success']==1)
				echo "<p ><center class = 'text-success'>Амжилттай бүртгэж авлаа. Та нэвтрэх боломжтой болсон.</center</p>";	
		?>
		<form action="process.php" method="POST">
			<p>
  				<div class="input-group-prepend">
					<?php
						if(isset($_GET['id'])){
							echo '<input type="text" id="user" name="user" value='.$_GET['id'].' placeholder="Хэрэглэгчийн ID" class="form-control" aria-describedby="basic-addon1" required>';
						}
						else if(isset($_COOKIE['username'])){
							echo '<input type="text" id="user" name="user" value='.$_COOKIE['username'].' placeholder="Хэрэглэгчийн ID" class="form-control" aria-describedby="basic-addon1" required>';
						}	
						else {
							echo '<input type="text" id="user" name="user" placeholder="Хэрэглэгчийн ID" class="form-control" aria-describedby="basic-addon1" required>';
						}
							
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
				if(isset($_GET['error']) && $_GET['error']==4){
					echo "<p><font color='#e60000'>Зурган код дээрх текстийг буруу оруулсан байна!</font></p>";
				}
			?>
			<p>
				<div id="imgdiv">
							<img id="img" src="captcha.php">
				</div>
				
			</p>
			<p>
				<table>
					<td>
						<input id="captcha1" name="captcha" type="text" class="form-control" required>
					</td>
					<td>
						<img id="reload" src="reload.png" style="width:40px;height:40px;">
						
					</td>
				</table>
				
			</p>
			<p>
			<input type="submit" id="btn" value="Нэвтрэх" class="form-control">
			</p>
			<p>
                <a href="signup.php" class="btn btn-primary form-control">Бүртгүүлэх</a>
            </p>
			
		</form>
		
	</div>

</body>
</html>