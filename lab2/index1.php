<?php
	$lesson = array(array(
			'lessonid' => "ISCI1",
			'lessonname' => "WEB",
			'lessoncredit' => 3),
	 	array(
			'lessonid' => "ISCI2",
			'lessonname' => "Data",
			'lessoncredit' => 3),
	 	array(
			'lessonid' => "ISCI3",
			'lessonname' => "Structure",
			'lessoncredit' => 3),
	  	array(
			'lessonid' => "ISCI4",
			'lessonname' => "C language",
			'lessoncredit' => 3));
	$students = array(array(
		'lastname' => "Suuri",
		'name' => "Byambajargal",
		'sisi' => "15b1seas0318",
		'Occu' => "IT",
		'lesson' => array("ISCI1","ISCI2","ISCI4")), 
	array(
		'lastname' => "Enkhbold",
		'name' => "Amarjargal",
		'sisi' => "14b1seas0881",
		'Occu' => "IT",
		'lesson' => array("ISCI3","ISCI2","ISCI4")),
	array(
		'lastname' => "Bold",
		'name' => "Erdene",
		'sisi' => "15b1seas1189",
		'Occu' => "IT",
		'lesson' => array("ISCI2","ISCI3","ISCI4")),
	array(
		'lastname' => "Lkhagva",
		'name' => "Dulguun",
		'sisi' => "14b1seas1181",
		'Occu' => "IT",
		'lesson' => array("ISCI1","ISCI3","ISCI4")),
	array(
		'lastname' => "Enkhjargal",
		'name' => "Azjargal",
		'sisi' => "14b1seas0882",
		'Occu' => "IT",
		'lesson' => array("ISCI1","ISCI3","ISCI4")));

	if(isset($_POST['lessons'])){
		$tmp = 0;
	    for($i = 0; $i < count($students); $i++){
			if($students[$i]['sisi']==$_POST['sisi']){
				$students[$i]['lesson']=$_POST['lessons'];
				$tmp=1;
			}
		}
		if($tmp==0){
			echo "Sisi not found. ";
		}
	}



function print_all($husnegt,$lesson){ 

	
	echo "<form action='index1.php' method='post'>
		<button type='submit' name='Firstname' value='Firstname'>Firstname</button>
		<button type='submit' name='Lastname' value='Lastname'>Lastname</button>
		</form>";
	function my_sort_first($a, $b){
		return strcmp($a["name"], $b["name"]);
	}
	function my_sort_last($a, $b){
		return strcmp($a["lastname"], $b["lastname"]);
	}
	if(isset($_POST['Firstname']))
		usort($husnegt, "my_sort_first");
	if(isset($_POST['Lastname']))
		usort($husnegt, "my_sort_last");
	


	//usort($husnegt, "my_sort_first");

	echo "<table border='1px'>";
	echo "<tr> ";
		echo "<th rowspan='2'>Firstname </th>";
		echo "<th rowspan='2'>Lastname</th>";
		echo "<th rowspan='2'>Occupation</TH>";
		echo "<th rowspan='2'>sisi</th>";
		echo "<th colspan='4'>Lesson</th>";
	echo "</tr>";
	echo "<tr>";
		echo "<th>Name</th><th>ID</th><th>credit</th>";
	echo "</tr>";

	for($i = 0; $i < count($husnegt); $i++){

		echo "<tr>";
		echo "<th rowspan='4'>". $husnegt[$i]['name']."</th>";
		echo "<th rowspan='4'>". $husnegt[$i]['lastname']."</th>";
		echo "<th rowspan='4'>". $husnegt[$i]['Occu']."</th>";
		echo "<th rowspan='4'>". $husnegt[$i]['sisi']."</th>";
		foreach ($husnegt[$i]['lesson'] as $key => $value) {
			for($j=0;$j<count($lesson);$j++){
				if($lesson[$j]['lessonid']==$value)
					echo "<tr><th>". $lesson[$j]['lessonname']."</th><th>".$lesson[$j]['lessonid']."</th><th>". $lesson[$j]['lessoncredit']."</th></tr>";

			}	
		}
	}

	echo "	</table>";
			
}


print_all($students,$lesson);

	
	function search($husnegt, $ner){
		echo "<table border='1px'> ";
		echo "<tr > ";
		for($i=0;$i<count($husnegt);$i++){
			if(strpos(strtolower($husnegt[$i]['name']),strtolower($ner))!==false){
				echo "<tr><th>". $husnegt[$i]['name']."</th>";
				echo "<th>". $husnegt[$i]['sisi']."</th></tr>";
			}
		}
		echo "</tr> ";
		echo "</table> ";
	}

	echo "<form action='index1.php' method='post'>";
	echo "Search Name: <input type='text' name='name'><br>";
	echo "<input type='submit'><br>";
	echo "</form>";
	if(isset($_POST['name'])){
		search($students, $_POST["name"]);
	}

	echo "<form action='index1.php' method='post'>";
	echo "Update Sisi: <input type='text' name='sisi'><br>";
	echo "Lesson ID: ";
	echo'<select name="lessons">';
	foreach ($lesson as $key=>$value) {
		echo '<option value='.$value["lessonname"].'>'.$value['lessonname'].'</option>';
	}
	echo '</select>';
	echo "<br><input type='submit'><br>";
	echo "</form>";
?>