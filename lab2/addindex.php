<?php
include('index.php');
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$date=$_POST['date'];
$sisi=$_POST['sisi'];
$gender=$_POST['gender'];
$program=$_POST['program'];
mysql_query($conn, "INSERT into student(firstname, lastname, sisi, gender, birthdate,program) values('".$firstname"','".$lastname"','".$sisi"','".$gender"','".$date"','".$program"')");
header('location:index.php');
?>