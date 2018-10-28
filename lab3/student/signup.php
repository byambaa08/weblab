<?php
	include "header.php";
	echo "</div></head>";
	

?>

	<div id="form">
	<?php
		if(isset($_GET['error'])){
			if($_GET['error']==1)
				echo "<font color='#e60000'><center>Нууц үг заавал 6 ба түүнээс дээш оронтой, дор хаяж нэг том үсэг, нэг жижиг үсэг агуулсан байх ёстой!</center></font>";	
			else if($_GET['error']==2)
				echo "<font color='#e60000'><center>Таны оруулсан хоёр нууц үг таарсангүй</center></font>";	
			else if($_GET['error']==3)
				echo "<font color='#e60000'><center>Системд бүртгэлгүй байна. Сургалтын албатай холбоо барьна уу</center></font>";	
		}
	?>
<form action="process.php" method="POST">
			<input type="hidden" name="signup" value="signup">
			<p>
  				<div class="input-group-prepend">
					<?php
						echo '<input type="text" name="id" placeholder="Хэрэглэгчийн ID" class="form-control" aria-describedby="basic-addon1" required>';
					?>
				</div>
			</p>
			<p>
  				<div class="input-group-prepend">
					<?php
						echo '<input type="password"name="password" placeholder="Бүртгэлийн нууц үг"  class="form-control" aria-describedby="basic-addon1" required>';
					?>
				</div>
			</p>
			<p>
  				<div class="input-group-prepend">
					<?php
						echo '<input type="password" name="re_password" placeholder="Нууц үгээ давтах"  class="form-control" aria-describedby="basic-addon1" required>';
					?>
				</div>
			</p>
			<p>
  				<div class="input-group-prepend">
					<?php
					echo'<select name="type" class="form-control" aria-describedby="basic-addon1" required>
							<option value="student" selected>Оюутан</option>
							<option value="staff">Ажилтан</option>
						</select>';
					
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