<?php
	include "header.php";
	// Login шалгах
	if( isset($_POST['user']) ){

		$username = $_POST['user'];
		$password = $_POST['pass'];
		$username = stripcslashes($username);
		$username = filter_var($username, FILTER_SANITIZE_STRING);
		$password = stripcslashes($password);
		$password = filter_var($password, FILTER_SANITIZE_STRING);
		
		$qry = "SELECT password FROM students where id='".$username."';";
    	$result = mysqli_query($db_server, $qry);
	    $fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);

	    if(empty($fetched) || $fetched[0]['password']!==md5($password)){
	  		header("Location: index.php?error=1&id=".$_POST['user']);
			die();
	    }
	    else{
	    	$_SESSION['passed'] = encrypt($username);
	    	header("Location: welcome.php?id=".encrypt($username));
		}
	}

	if( isset($_POST['edit']) ){
		$edit_student = $_POST['student_id'];
		if(decrypt($_SESSION['passed']) === $_POST['id']){
	  		header("Location: update.php?id=".encrypt($_POST['id'])."&student_id=".encrypt($_POST['student_id']));
		}
		else{
	  		header("Location: index.php?error=2");
		}
	}
	if( isset($_POST['delete']) ){    	
		$qry = "SELECT * FROM accesses where student_id='".$_POST['student_id']."';";
    	$result = mysqli_query($db_server, $qry);
    	$fetched = mysqli_fetch_all($result,MYSQLI_ASSOC);
    	if(empty($fetched)){
			$qry = "DELETE FROM students where id='".($_POST['student_id']."';");
	    	$result = mysqli_query($db_server, $qry);
	    	echo "<script type='text/javascript'>alert('Амжилттай устлаа.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";
    	}else 
	    	echo "<script type='text/javascript'>alert('Таньд энэ хэрэглэгчийг устгах эрх алга.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";


	}

	if( isset($_POST['edited']) ){
		print_r($_POST);
		$qry = "UPDATE students 
				SET l_name = '".$_POST['lname']."', 
				f_name ='".$_POST['fname']."', 
				gender = '".$_POST['gender']."', 
				dob='".$_POST['dob']."'
				where id='".$_POST['student_id']."';";
    	$result = mysqli_query($db_server, $qry);
    	echo "<script type='text/javascript'>alert('Амжилттай засагдлаа.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";
	}
	if( isset($_POST['program']) ){
		print_r($_POST);
		$qry = "UPDATE students 
				SET program_id = '".$_POST['program_id']."'
				 where id='".$_POST['id']."';";
				 echo $qry;
    	$result = mysqli_query($db_server, $qry);
    	echo "<script type='text/javascript'>alert('Амжилттай сонголоо.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";
	}

	//
?>