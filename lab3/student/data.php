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
            password  	VARCHAR(255) not null, 
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
		$access_qry = "
			CREATE TABLE accesses (
			student_id   		VARCHAR(12) NOT NULL
		);";

		if (mysqli_query($db_server, $program_qry)) {
			if (mysqli_query($db_server, $student_qry)) {
			    if (mysqli_query($db_server, $lesson_qry)) {
			    	if (mysqli_query($db_server, $class_qry)) {
						if (mysqli_query($db_server, $access_qry)) {
							if (mysqli_query($db_server, "ALTER TABLE accesses ADD FOREIGN KEY (student_id) REFERENCES students(id);")) {
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
				                        $insert_qry = array("INSERT INTO students(id,f_name,l_name,gender,dob,password) VALUES ('15b1seas0318', 
				                        	'Byambajargal', 
				                        	'Suuri', 
				                        	'm', 
				                        	'1998-01-17',
				                        	'".md5('ta98011719')."');",
				                        	"INSERT INTO students(id,f_name,l_name,gender,dob,password) VALUES ('15b1seas0333', 
				                        	'Munkhbat', 
				                        	'Olzod', 
				                        	'm', 
				                        	'1998-01-01',
				                        	'".md5('ta98011719')."');",
				                        	"INSERT INTO students(id,f_name,l_name,gender,dob,password) VALUES ('15b1seas0472', 
				                        	'Sanjaasuren', 
				                        	'Lhavgasuren', 
				                        	'm', 
				                        	'1998-03-17',
				                        	'".md5('ta98011719')."');",
				                        	"INSERT INTO students(id,f_name,l_name,gender,dob,password) VALUES ('15b1seas0666', 
				                        	'Erdenebaatar', 
				                        	'Tulga', 
				                        	'm', 
				                     	   	'1997-02-20',
				                        	'".md5('ta98011719')."');",
				                        	
				                        	"INSERT INTO students(id,f_name,l_name,gender,dob,password) VALUES ('15b1seas1145', 
				                        	'Azjargal', 
				                        	'enkh', 
				                        	'm', 
				                        	'1996-09-23',
				                        	'".md5('ta98011719')."');");
			                       		foreach ($insert_qry as $value) {
			                        		mysqli_query($db_server, $value);
			                        	}

			                        	$qry = "INSERT INTO accesses(student_id) VALUES ('15b1seas0318');";
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
?>