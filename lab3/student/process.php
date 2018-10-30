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
		
		$qry = "SELECT * FROM users where student_id='".$username."';";
    	$result = mysqli_query($db_server, $qry);
	    $fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);
	    $is_student = 1;
	    if(empty($fetched)){
			$qry = "SELECT * FROM users where staff_id='".$username."';";
	    	$result = mysqli_query($db_server, $qry);
		    $fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);
	    	$is_student = 0;

	    }

	    if(empty($fetched) || $fetched[0]['password']!==md5($password)){
	  		header("Location: index.php?error=1&id=".$_POST['user']);
			die();
	    }
	    else{
	    	if($fetched[0]['access'] == 0){
		  		header("Location: index.php?error=3&id=".$_POST['user']);
				die();
	    	}
	    	$_SESSION['passed'] = encrypt($username);
	    	$_SESSION['length'] = strlen($username);
	    	$_SESSION['access_lvl'] = $fetched[0]['access_lvl'];
	    	// if($is_student == 0);
		    	header("Location: welcome.php?id=".encrypt($username));
		}
	}
// оюутны мэдээлэл засахын өмнө шалгаж баина
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
		$qry = "SELECT access_lvl FROM users where student_id='".$_POST['student_id']."';";
    	$result = mysqli_query($db_server, $qry);
    	$fetched = mysqli_fetch_all($result,MYSQLI_ASSOC);
    	if($fetched[0]['access_lvl'] < $_SESSION['access_lvl']){
			$qry = "DELETE FROM students where id='".($_POST['student_id']."';");
	    	$result = mysqli_query($db_server, $qry);
	    	echo "<script type='text/javascript'>alert('Амжилттай устлаа.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";
    	}else 
	    	echo "<script type='text/javascript'>alert('Таньд энэ хэрэглэгчийг устгах эрх алга.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";


	}
// зассны дараа ажиллах хэсэг
	if( isset($_POST['edited']) ){
		$lname = $_POST['lname'];
		$fname = $_POST['fname'];

		$lname = stripcslashes($lname);
		$lname = filter_var($lname, FILTER_SANITIZE_STRING);

		$fname = stripcslashes($fname);
		$fname = filter_var($fname, FILTER_SANITIZE_STRING);
		$qry = "UPDATE students 
				SET l_name = '".$lname."', 
				f_name ='".$fname."', 
				gender = '".$_POST['gender']."', 
				dob='".$_POST['dob']."'
				where id='".$_POST['student_id']."';";
    	$result = mysqli_query($db_server, $qry);
    	echo "<script type='text/javascript'>alert('Амжилттай засагдлаа.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";
	}
// хөтөлбөр сонгох
	if( isset($_POST['program']) ){
		$qry = "UPDATE students 
				SET program_id = '".$_POST['program_id']."'
				 where id='".$_POST['id']."';";
				 echo $qry;
    	$result = mysqli_query($db_server, $qry);
    	echo "<script type='text/javascript'>alert('Амжилттай сонголоо.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";
	}
//бүртгэх
	if (isset($_POST['signup'])){

		$password = $_POST['password'];
		$re_password = $_POST['re_password'];
		$id = $_POST['id'];


		$password = stripcslashes($password);
		$password = filter_var($password, FILTER_SANITIZE_STRING);

		$re_password = stripcslashes($re_password);
		$re_password = filter_var($re_password, FILTER_SANITIZE_STRING);

		$id = stripcslashes($id);
		$id = filter_var($id, FILTER_SANITIZE_STRING);

		if(!checkPassword($password)){
			header("Location: signup.php?error=1");
	  	}
		else if(!$password == $re_password){
			header("Location: signup.php?error=2");
		}
		$qry = '';
		$insert_qry = " ";

		if ( $_POST['type']=='student'){
			$qry = "SELECT id from students where id='".$_POST['id']."';";
			$insert_qry = "INSERT INTO users(student_id, access_lvl ,password, access) VALUES ('".$_POST['id']."' , 0, '".md5($_POST['password'])."', 1);";

		}
		else if( $_POST['type']=='staff'){
			$qry = "SELECT id from staffs where id='".$_POST['id']."';";
			$insert_qry = "INSERT INTO users(staff_id, access_lvl ,password, access) VALUES ('".$_POST['id']."' , 1, '".md5($_POST['password']).", 1);";

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
//оюутан нэмэх
    if( isset($_POST['add_student']) ){
    	if(md5(decrypt($_SESSION['passed'])) != $_POST['id'] || $_SESSION['access_lvl'] < 3)
			header("Location: index.php?error=2");
	    print_r($_POST);
		$student_id = $_POST['student_id'];
		$student_id = stripcslashes($student_id);
		$student_id = filter_var($student_id, FILTER_SANITIZE_STRING);
		$result = mysqli_query($db_server, "SELECT * FROM students where id='".$student_id."';");
    	$fetched = mysqli_fetch_all($result,MYSQLI_ASSOC);
	    if(!empty($fetched)){
            header("Location: add_student.php?id=".$_POST['id']."&error=1");
	    }
	    $result = mysqli_query($db_server, "SELECT * FROM staffs where id='".$student_id."';");
    	$fetched = mysqli_fetch_all($result,MYSQLI_ASSOC);
	    if(!empty($fetched)){
            header("Location: add_student.php?id=".$_POST['id']."&error=1");
	    }

		if(strlen($staff_id)>12)
            header("Location: add_student.php?id=".$_POST['id']."&error=2");
		$lname = $_POST['lname'];
		$lname = stripcslashes($lname);
		$lname = filter_var($lname, FILTER_SANITIZE_STRING);

		$fname = $_POST['fname'];
		$fname = stripcslashes($fname);
		$fname = filter_var($fname, FILTER_SANITIZE_STRING);

        $qry = "INSERT INTO students(id,f_name,l_name,gender,dob) VALUES ('".$student_id."', 
				'".$fname."', 
				'".$lname."', 
				'".$_POST['gender']."', 
				'".$_POST['dob']."');";
    	$result = mysqli_query($db_server, $qry);
    	echo "<script type='text/javascript'>alert('Амжилттай бүртгэгдлээ.'); location='welcome.php?id=".$_POST['id']."';</script>";
    }
//ажилтан нэмэх
    if( isset($_POST['add_staff']) ){
    	if(md5(decrypt($_SESSION['passed'])) != $_POST['id'] || $_SESSION['access_lvl'] < 3)
			header("Location: index.php?error=2");
	    print_r($_POST);
		$staff_id = $_POST['staff_id'];
		$staff_id = stripcslashes($staff_id);
		$staff_id = filter_var($staff_id, FILTER_SANITIZE_STRING);
		$result = mysqli_query($db_server, "SELECT * FROM students where id='".$staff_id."';");
    	$fetched = mysqli_fetch_all($result,MYSQLI_ASSOC);
	    if(!empty($fetched)){
            header("Location: add_staff.php?id=".$_POST['id']."&error=1");
	    }
	    $result = mysqli_query($db_server, "SELECT * FROM staffs where id='".$staff_id."';");
    	$fetched = mysqli_fetch_all($result,MYSQLI_ASSOC);
	    if(!empty($fetched)){
            header("Location: add_staff.php?id=".$_POST['id']."&error=1");
	    }

		$lname = $_POST['lname'];
		$lname = stripcslashes($lname);
		$lname = filter_var($lname, FILTER_SANITIZE_STRING);
		if(strlen($staff_id)>12)
            header("Location: add_staff.php?id=".$_POST['id']."&error=2");
		$fname = $_POST['fname'];
		$fname = stripcslashes($fname);
		$fname = filter_var($fname, FILTER_SANITIZE_STRING);

		$occu = $_POST['occu'];
		$occu = stripcslashes($occu);
		$occu = filter_var($occu, FILTER_SANITIZE_STRING);

        $qry = "INSERT INTO staffs(id, f_name, l_name, gender, dob, start_date, occupation) VALUES ('".$staff_id."', 
				'".$fname."', 
				'".$lname."', 
				'".$_POST['gender']."', 
				'".$_POST['dob']."', 
				'".$_POST['start_date']."', 
				'".$occu."');";
    	$result = mysqli_query($db_server, $qry);
    	echo "<script type='text/javascript'>alert('Амжилттай бүртгэгдлээ.'); location='welcome.php?id=".$_POST['id']."';</script>";
    }
//хэрэглэгч хүчингүи болгох
    if( isset($_POST['cancel']) ){
    	if(decrypt($_SESSION['passed']) != $_POST['id'] || $_SESSION['access_lvl'] < 3)
			header("Location: index.php?error=2");
		if ($_POST['is_student']==1){

			$qry = "SELECT * from users where student_id='".$_POST['change_id']."';";
		    $result = mysqli_query($db_server, $qry);
    	    $fetched = mysqli_fetch_all($result,MYSQLI_ASSOC);
    	    if($fetched[0]['access']==0){
			    $qry = "UPDATE users 
				    SET access = 1 where student_id='".$_POST['change_id']."';"; 
		        $result = mysqli_query($db_server, $qry);
		        echo "<script type='text/javascript'>alert('Амжилттай эрх нээлээ.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";
    	    }
    	    else{
    	    	if($fetched[0]['access_lvl'] > $_SESSION['access_lvl'])
    	    	    echo "<script type='text/javascript'>alert('Эрх хүрэхгүй байна.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";
    	        else{
			    $qry = "UPDATE users 
				    SET access = 0 where student_id='".$_POST['change_id']."';";
		        $result = mysqli_query($db_server, $qry);
		        echo "<script type='text/javascript'>alert('Амжилттай эрх хаалаа.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";
    	        }
    	    }
		}
		else{
            $qry = "SELECT * from users where staff_id='".$_POST['change_id']."';";
		    $result = mysqli_query($db_server, $qry);
    	    $fetched = mysqli_fetch_all($result,MYSQLI_ASSOC);
    	    if($fetched[0]['access']==0){
			    $qry = "UPDATE users 
				    SET access = 1 where staff_id='".$_POST['change_id']."';"; 
		        $result = mysqli_query($db_server, $qry);
		        echo "<script type='text/javascript'>alert('Амжилттай эрх нээлээ.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";
            }

    	    else{
    	    	if($fetched[0]['access_lvl'] > $_SESSION['access_lvl'])
    	        	echo "<script type='text/javascript'>alert('Эрх хүрэхгүй байна.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";
        	    else{
    		    	$qry = "UPDATE users 
				    SET access = 0 where staff_id='".$_POST['change_id']."';";
		            $result = mysqli_query($db_server, $qry);
		            echo "<script type='text/javascript'>alert('Амжилттай эрх хаалаа.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";
                }
            }
        }
    } 
//хэрэглэгч устгах
    if( isset($_POST['delete_user']) ){
    	if(md5(decrypt($_SESSION['passed'])) != $_POST['id'] || $_SESSION['access_lvl'] < 3)
			// header("Location: index.php?error=2");
	    print_r($_POST);
		if ($_POST['is_student']==1){
			$qry = "SELECT * from users where student_id='".$_POST['change_id']."';";
		    $result = mysqli_query($db_server, $qry);
    	    $fetched = mysqli_fetch_all($result,MYSQLI_ASSOC);
    	    if($fetched[0]['access_lvl'] > $_SESSION['access_lvl'])
    	    	echo "<script type='text/javascript'>alert('Эрх хүрэхгүй байна.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";
    	    else{
			    $qry = "delete from users where student_id='".$_POST['change_id']."';";
		        $result = mysqli_query($db_server, $qry);
		        echo "<script type='text/javascript'>alert('Амжилттай устгалаа.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";
	     	}
	    }
	    else{
            $qry = "SELECT * from users where staff_id='".$_POST['change_id']."';";
		    $result = mysqli_query($db_server, $qry);
    	    $fetched = mysqli_fetch_all($result,MYSQLI_ASSOC);
    	    if($fetched[0]['access_lvl'] > $_SESSION['access_lvl'])
    	    	echo "<script type='text/javascript'>alert('Эрх хүрэхгүй байна.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";
    	    else{
    	    	$qry = "delete from users where student_id='".$_POST['change_id']."';";
		        $result = mysqli_query($db_server, $qry);
		        echo "<script type='text/javascript'>alert('Амжилттай устгалаа.'); location='welcome.php?id=".md5($_POST['id'])."';</script>";
	     	}
        }

    } 
?>