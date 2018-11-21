<!DOCTYPE html>
<html>
<head>
	<?php
	include "header1.php";
?>
</head>
<body>
	<table class="table table-hover table-dark" >
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
		<tbody>
			<script>
				var result = JSON.parse('<?php echo phpFunction(); ?>');
				document.write("<tr>"+result[0].id+"</tr>");
			</script>
</body>
</html>
