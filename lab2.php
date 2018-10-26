<!DOCTYPE html>
<html>
<head>
	<title>hehe</title>
</head>
<body>
	<?php 
		echo '<table border="1">'; # table таг дотор хүрээ өгч байна
		for($i=0; $i<5; $i++){#мөрийн дагуу 0-с 4 хүртэл давтаж байна
		 	echo '<tr>'; # мөрийг хэвлэж байна
    		for($j=0; $j<5; $j++){#баганын дагуу давтаж байна
   			echo "<th> ", $j+1, "</th>"; # баганын дагуу хэвлэж байна
    		}
    		echo '</tr>'; #мөрийг хааж байна
		}
		echo '</table>';#table таг хааж байна/ хүснэгт

	?>
</body>
</html>