<?php
 	$db_hostname = 'localhost';  
 	$db_username = 'root';  
 	$db_password = '';
	$db_database = "student";
  	$db_server = mysqli_connect($db_hostname, $db_username, $db_password,$db_database);
	if (!$db_server) {
		echo "Cannot connect: " . $conn->error;
	}
	else{
		$student_qry = "
			CREATE TABLE students (
			id   		VARCHAR(12) NOT NULL, 
			f_name     	VARCHAR(15) NOT NULL, 
			l_name     	VARCHAR(15) NOT NULL, 
			gender   	CHAR NOT NULL,
			dob 		DATE not null, 
            program_id  VARCHAR(12),    
			CONSTRAINT students_PK
			       PRIMARY KEY (id)    
		);";
		$program_qry = "
			CREATE TABLE programs (
			id   			VARCHAR(12) NOT NULL, 
			name     		VARCHAR(40) NOT NULL, 
			approved_date  	VARCHAR(15) NOT NULL,
			CONSTRAINT programs_PK
			       PRIMARY KEY (id)
		);";
		$lesson_qry = "
			CREATE TABLE lessons (
			id   			VARCHAR(12) NOT NULL, 
			name     		VARCHAR(40) NOT NULL, 
			credit  		INT(1) NOT NULL,
			CONSTRAINT lessons_PK
			       PRIMARY KEY (id)
		);";
		$class_qry = "
			CREATE TABLE classes (
			student_id   		VARCHAR(12) NOT NULL, 
			lesson_id     		VARCHAR(12) NOT NULL 
		);";
		$users_qry = "
			CREATE TABLE users (
			student_id   		VARCHAR(12) ,
			staff_id	   		VARCHAR(12) ,
			access_lvl			INT(1),
			password   			VARCHAR(255) NOT NULL
		);";
		$staff_qry = "
			CREATE TABLE staffs (
			id   		VARCHAR(12) NOT NULL, 
			f_name     	VARCHAR(15) NOT NULL, 
			l_name     	VARCHAR(15) NOT NULL, 
			gender   	CHAR NOT NULL,
			dob 		DATE not null, 
			start_date 	DATE not null,
			occupation	VARCHAR(20),
			CONSTRAINT staffs_PK
			       PRIMARY KEY (id)    
		);";
		mysqli_query($db_server, $staff_qry);
		if (mysqli_query($db_server, $program_qry)) {
			if (mysqli_query($db_server, $student_qry)) {
			    if (mysqli_query($db_server, $lesson_qry)) {
			    	if (mysqli_query($db_server, $class_qry)) {
						if (mysqli_query($db_server, $users_qry)) {
							if (mysqli_query($db_server, "ALTER TABLE users ADD FOREIGN KEY (student_id) REFERENCES students(id);")) {
							if (mysqli_query($db_server, "ALTER TABLE users ADD FOREIGN KEY (staff_id) REFERENCES staffs(id);")) {
								if (mysqli_query($db_server,"ALTER TABLE classes ADD FOREIGN KEY (lesson_id) REFERENCES lesson(id);")) {
									if (mysqli_query($db_server,"ALTER TABLE classes ADD FOREIGN KEY (student_id) REFERENCES students(id);")) {
										$insert_qry = array("INSERT INTO lessons(id,name,credit) VALUES (
			                        		'CSII200', 
				                        	'Basics of algorithm', 
				                        	'3');",
											"INSERT INTO lessons(id,name,credit) VALUES (
			                        		'CSII202', 
				                        	'Basics of internet technology', 
				                        	'3');",
											"INSERT INTO lessons(id,name,credit) VALUES (
			                        		'CSII201', 
				                        	'C language of programming', 
				                        	'3');",
											"INSERT INTO lessons(id,name,credit) VALUES (
			                        		'ICSI211', 
				                        	'Platform technology', 
				                        	'3');",
											"INSERT INTO lessons(id,name,credit) VALUES (
			                        		'ICSI311', 
				                        	'Database system', 
				                        	'3');",
											"INSERT INTO lessons(id,name,credit) VALUES (
			                        		'ICSI314', 
				                        	'System integration', 
				                        	'3');",
											"INSERT INTO lessons(id,name,credit) VALUES (
			                        		'ICSI208', 
				                        	'Basics of network', 
				                        	'3');");

			                       		foreach ($insert_qry as $value) {
			                        		mysqli_query($db_server, $value);
			                        	}

			                        	$insert_qry = array("INSERT INTO programs(id,name,approved_date) VALUES (
			                        		'D061303', 
				                        	'Information Technology', 
				                        	'2012-01-17');",
			                        		"INSERT INTO programs(id,name,approved_date) VALUES (
			                        		'D061302', 
				                        	'Software programming', 
				                        	'2012-02-17');");
			                       		foreach ($insert_qry as $value) {
			                        		mysqli_query($db_server, $value);
			                        	}
				                        $insert_qry = array("INSERT INTO students(id,f_name,l_name,gender,dob) VALUES ('15b1seas0318', 
				                        	'Byambajargal', 
				                        	'Suuri', 
				                        	'm', 
				                        	'1998-01-17');",
				                        	"INSERT INTO students(id,f_name,l_name,gender,dob) VALUES ('15b1seas0333', 
				                        	'Munkhbat', 
				                        	'Olzod', 
				                        	'm', 
				                        	'1998-01-01');",
				                        	"INSERT INTO students(id,f_name,l_name,gender,dob) VALUES ('15b1seas0472', 
				                        	'Sanjaasuren', 
				                        	'Lhavgasuren', 
				                        	'm', 
				                        	'1998-03-17');",
				                        	"INSERT INTO students(id,f_name,l_name,gender,dob) VALUES ('15b1seas0666', 
				                        	'Erdenebaatar', 
				                        	'Tulga', 
				                        	'm', 
				                     	   	'1997-02-20');",
				                        	
				                        	"INSERT INTO students(id,f_name,l_name,gender,dob) VALUES ('15b1seas1145', 
				                        	'Azjargal', 
				                        	'enkh', 
				                        	'm', 
				                        	'1996-09-23');");
			                       		foreach ($insert_qry as $value) {
			                        		mysqli_query($db_server, $value);
			                        	}

			                        	$qry = "INSERT INTO users(student_id, access_lvl ,password) VALUES ('15b1seas0318' , 9, '".md5('admin')."');";
			                        	mysqli_query($db_server, $qry);

			                        	$qry = "INSERT INTO users(student_id, access_lvl ,password) VALUES ('15b1seas0472' , 0, '".md5('admin')."');";
			                        	mysqli_query($db_server, $qry);
									}
								}
	                    	}
	                    }
	                    }

					}
                } 
            } 

        } 
	}
?>