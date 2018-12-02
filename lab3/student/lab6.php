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
		    </tr>
		</thead>
		<tbody>
			<tr>
				<script>
					var checked = [];
					var classes = JSON.parse('<?php echo getStudentClass(); ?>');
					var lessons = JSON.parse('<?php echo getStudentLesson(); ?>');
					var result = JSON.parse('<?php echo getStudentData(); ?>');

					function check(id){
						if(!checked.includes(id)){
							checked.push(id);
							return true;
						}
						else{
							checked.splice(checked.indexOf(id), 1 );
							return false;
						}
					}

					function lesson(id) {
						if(check(id)){
							if ( document.getElementById(id).children[4].innerHTML != "Хөтөлбөр сонгоогүй"){
								var chosed_ls = [];
								var not_chosed_ls = [];
								for( var i = 0 ; i < classes.length; i++){
									if(classes[i].student_id == id){
										chosed_ls.push(classes[i].lesson_id);
									}
								}
								for( var i = 0 ; i < lessons.length; i++){
									if(!chosed_ls.includes(lessons[i].id)){
										not_chosed_ls.push(lessons[i].id);
									}
								}
								var table = "<table><tr>";
								table = table.concat("<td>Сонгоогүй</td>");
								for( var i = 0 ; i < chosed_ls.length; i++){
									table = table.concat("<td>" +chosed_ls[i]+ "</td>");
								}
								table = table.concat("</tr>");
								table = table.concat("<tr>");
								table = table.concat("<td>Сонгоогүй</td>");
								for( var i = 0 ; i < not_chosed_ls.length; i++){
									table = table.concat("<td>" +not_chosed_ls[i]+ "</td>");
								}

								table = table.concat("</tr>");
								table = table.concat("</table>");
								document.getElementById(id+1).innerHTML = table;
								}
							else{
								document.getElementById(id+1).innerHTML = "<button class='btn btn-outline-primary' type='button'>Хөтөлбөр Сонгох</button>";
							}
						}
					}

					
					for (var i = 0; i < result.length; i++) {

						document.write("<tr id="+result[i].id+" onclick='lesson(this.id)'>");

							document.write("<td>"+(i+1)+"</td>");
							document.write("<td>"+result[i].id+"</td>");
							document.write("<td>"+result[i].f_name+"</td>");
							if(result[i].gender =='m')
								document.write("<td>эр</td>");
							else 
								document.write("<td>эм</td>");
							if(result[i].program_id == null)
								document.write("<td>Хөтөлбөр сонгоогүй</td>");
							else {
								var programName = JSON.parse('<?php echo getStudentProgram(); ?>');
								document.write("<td>");
								for (var j = 0; j < programName.length; j++) {
									if (programName[j].id == result[i].program_id)
										document.write(programName[0].name);
								}
								document.write("</td>");
							}

							document.write("<td id = " + result[i].id +1+"></td>");
					}
				</script>
			</tr>
</body>
</html>
