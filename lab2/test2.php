<?php
	$students = array(

	$student[] = array(
		'name' => "Byambajargal",
		'lastname' => "Suuri",
		'sisi' => "15b1seas0318",
		'lesson' => array(array(
			'lessonid' => "ISCI",
			'lessonname' => "WEB",
			'lessoncredit' => 3
		),array(
			'lessonid' => "ISCI2",
			'lessonname' => "WEB2",
			'lessoncredit' => 3
		),array(
			'lessonid' => "ISCI3",
			'lessonname' => "WEB3",
			'lessoncredit' => 3
		),array(
			'lessonid' => "ISCI4",
			'lessonname' => "WEB4",
			'lessoncredit' => 3
		)),
		'Occu' => "IT"
	),
	$student[] = array(
		'name' => "Amarjargal",
		'lastname' => "Enkhbold",
		'sisi' => "14b1seas0881",
		'lesson' => array(array(
			'lessonid' => "ISCI",
			'lessonname' => "WEB",
			'lessoncredit' => 3
		),array(
			'lessonid' => "ISCI2",
			'lessonname' => "WEB2",
			'lessoncredit' => 3
		),array(
			'lessonid' => "ISCI3",
			'lessonname' => "WEB3",
			'lessoncredit' => 3
		),array(
			'lessonid' => "ISCI4",
			'lessonname' => "WEB4",
			'lessoncredit' => 3
		)),
		'Occu' => "IT"
	),

	$student[] = array(
		'name' => "Erdene",
		'lastname' => "Bold",
		'sisi' => "15b1seas1189",
		'lesson' => array(array(
			'lessonid' => "ISCI",
			'lessonname' => "WEB",
			'lessoncredit' => 3
		),array(
			'lessonid' => "ISCI2",
			'lessonname' => "WEB2",
			'lessoncredit' => 3
		),array(
			'lessonid' => "ISCI3",
			'lessonname' => "WEB3",
			'lessoncredit' => 3
		),array(
			'lessonid' => "ISCI4",
			'lessonname' => "WEB4",
			'lessoncredit' => 3
		)),
		'Occu' => "IT"
	),

	$student[] = array(
		'name' => "Dulguun",
		'lastname' => "Lkhagva",
		'sisi' => "14b1seas1181",
		'lesson' => array(array(
			'lessonid' => "ISCI",
			'lessonname' => "WEB",
			'lessoncredit' => 3
		),array(
			'lessonid' => "ISCI2",
			'lessonname' => "WEB2",
			'lessoncredit' => 3
		),array(
			'lessonid' => "ISCI3",
			'lessonname' => "WEB3",
			'lessoncredit' => 3
		),array(
			'lessonid' => "ISCI4",
			'lessonname' => "WEB4",
			'lessoncredit' => 3
		)),
		'Occu' => "IT"
	),

	$student[] = array(
		'name' => "Azjargal",
		'lastname' => "Enkhjargal",
		'sisi' => "14b1seas0882",
		'lesson' => array(
		array(
			'lessonid' => "ISCI",
			'lessonname' => "WEB",
			'lessoncredit' => 3
		),array(
			'lessonid' => "ISCI2",
			'lessonname' => "WEB2",
			'lessoncredit' => 3
		),array(
			'lessonid' => "ISCI3",
			'lessonname' => "WEB3",
			'lessoncredit' => 3
		),array(
			'lessonid' => "ISCI4",
			'lessonname' => "WEB4",
			'lessoncredit' => 3
		)),
		'Occu' => "IT"
	)
);
?>


<?php 

function print_all($husnegt){ 

	function my_sort($a, $b){
		if($a==$b) return 0;
		return($a<$b)? -1:1;
	}
	usort($husnegt, "my_sort");
	echo "<table border='1px'>";
	echo "<tr> ";
	echo 	"<th>Firstname </th>";
	echo 	"<th>Lastname</th>";
	echo 	"<TH>Occupation</TH>";
	echo 	"<th>sisi</th>";
	echo 	"<th colspan='3'>Lesson</th>";
	echo "</tr>";
	for($i = 0; $i < count($husnegt); $i++){
echo "<tr>";
		foreach($husnegt as $key=>$value){
			foreach($value as $row=>$y){
				if(is_array($y)){
					foreach ($y as $k=>$a) {
						foreach ($a as $hd => $h) {
							echo "<td>".$h."</td>" ;
						}
					}
				}
				else{
					echo "<td>".$y."</td>" ;
				}

			}
		}
	"</tr>";
}
echo "	</table>";
}

print_all($students);
?>



<?php
	function search($husnegt, $ner){
		echo "<table border='1px'> ";
		echo "<tr > ";
		for($i=0;$i<count($husnegt);$i++){
			if($ner==$husnegt[$i]['name']){
				echo "<th>". $husnegt[$i]['name']."</th>";
				echo "<th>". $husnegt[$i]['sisi']."</th>";
			}
		}
		echo "</tr> ";
		echo "</table> ";
	}

	$b='Byambajargal';
	search($students, $b);
?>
<?php
	function update($sisi, $class, &$husnegt){
	$lessons =array(
		$lesson[] = array(
			'lessonid' => "MATH01",
			'lessonname' => "MATHEMATICS",
			'lessoncredit' => "3",
		),	
		$lesson[] = array(
			'lessonid' => "MATH02",
			'lessonname' => "MATHEMATICS2",
			'lessoncredit' => "3",
		),	
		$lesson[] = array(
			'lessonid' => "ISCI",
			'lessonname' => "WEB",
			'lessoncredit' => "3",
		),	
	);
	for($i=0;$i<count($husnegt);$i++){
		if($sisi==$husnegt[$i]['sisi']){
			$husnegt[$i]['lessonname']=$lesson[2]['lessonname'];
			$husnegt[$i]['lessonid']=$lesson[2]['lessonid'];
			$husnegt[$i]['lessoncredit']=$lesson[2]['lessoncredit'];
		}
	}
		}
	$sisi1='15b1seas0318';
	$class1='web';
	update($sisi1, $class1, $students );
?>