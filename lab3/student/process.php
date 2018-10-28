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
		
		$qry = "SELECT password, access_lvl FROM users where student_id='".$username."';";
    	$result = mysqli_query($db_server, $qry);
	    $fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);
	    $is_student = 1;
	    if(empty($fetched)){
			$qry = "SELECT password, access_lvl FROM users where staff_id='".$username."';";
	    	$result = mysqli_query($db_server, $qry);
		    $fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);
	    	$is_student = 0;

	    }

	    if(empty($fetched) || $fetched[0]['password']!==md5($password)){
	  		header("Location: index.php?error=1&id=".$_POST['user']);
			die();
	    }
	    else{
	    	$_SESSION['passed'] = encrypt($username);
	    	$_SESSION['access_lvl'] = $fetched[0]['access_lvl'];
	    	if($is_student == 1);
		    	header("Location: welcome.php?id=".encrypt($username));
		}
	}
// оюутны мэдээлэл засах хэсэг
	if( isset($_POST['edit']) ){
		$edit_student = $_POST['student_id'];
		if(decrypt($_SESSION['passed']) === $_POST['id']){
	  		header("Location: update.php?id=".encrypt($_POST['id'])."&student_id=".encrypt($_POST['student_id']));
		}
		else{
	  		header("Location: index.php?error=2");
		}
	}
// оюутны мэдээлэл устгах хэсэг
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
// зассны дараа ажиллах хэсэг
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
// хөтөлбөр сонгох
	if( isset($_POST['program']) ){
		print_r($_POST);
		$qry = "UPDATE students 
				SET program_id = '".$_POST['program_id']."'
				 where id='".$_POST['id']."';";
				 echo $qry;
    	$result = mysqli_query($db_server, $qry);
    	echo "<script type='text/javascript'>alert('Амжилттай сонголоо.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";
	}
//бүртгэх
	if (isset($_POST['signup'])){
		print_r($_POST);
		if(!checkPassword($_POST['password'])){
			header("Location: signup.php?error=1");
	  	}
		else if(!$_POST['password'] == $_POST['re_password']){
			header("Location: signup.php?error=2");
		}
		$qry = '';
		$insert_qry = " ";
		if ( $_POST['type']=='student'){
			$qry = "SELECT id from students where id='".$_POST['id']."';";
			$insert_qry = "INSERT INTO users(student_id, access_lvl ,password) VALUES ('".$_POST['id']."' , 0, '".md5($_POST['password'])."');";

		}
		else if( $_POST['type']=='staff'){
			$qry = "SELECT id from staffs where id='".$_POST['id']."';";
			$insert_qry = "INSERT INTO users(student_id, access_lvl ,password) VALUES ('".$_POST['id']."' , 1, '".md5($_POST['password'])."');";

		}
	    $result = mysqli_query($db_server, $qry);
		$fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);
		if(empty($fetched)){
			header("Location: signup.php?error=3");
		}
		else {			                        	
		    $result = mysqli_query($db_server, $insert_qry);
			header("Location: index.php?success=1");


		}
	}
?>