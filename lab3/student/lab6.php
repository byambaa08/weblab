<?php
	include "header1.php";
?>
</head>
<script>
	function lesson(id) {
		if(check(id)){
			var chosed_ls = [];
			for( var i = 0 ; i < classes.length; i++){
				if(classes[i].student_id == id){
					chosed_ls.push(classes[i].lesson_id);
				}
			}
			var name = "";
			for(var i = 0; i < result.length;i++){
				if(result[i].id == id)
					name = result[i].f_name;
			}
			var table = "<table>";
			table = table.concat("<tr><th>Хичээлүүд</th>");
			table = table.concat("<th>Оюутан: "+name+"</th></tr>");
			var indexes;
			for( var i = 0 ; i < lessons.length; i++){
				table = table.concat("<tr>");
				table = table.concat("<td>" +lessons[i].name+ "</td>");
				table = table.concat("<td>");
				table = table.concat("<input id ='lesson_id' type='hidden' name='lesson' value="+lessons[i].id+" />");
				table = table.concat("<input id ='student_id' type='hidden' name='student_id' value="+id+" />");
				if(chosed_ls.includes(lessons[i].id))
					table = table.concat("<input id='"+id+lessons[i].id+"' type='submit'  onclick='chooselessonajax(id)' name='cancel' class='btn btn-outline-danger' value='Цуцлах'/>");
				else
					table = table.concat("<input id='"+id+lessons[i].id+"' type='submit' onclick = 'chooselessonajax(id)' name='submit' class='btn btn-outline-success' value='Сонгох'/>");
				table = table.concat("</td>");
				table = table.concat("</tr>");
			}
			table = table.concat("</table>");
			document.getElementById("lessontd").innerHTML = table;
			}
		}
</script>
<body>
	<table class="table  table-dark" >
		<td>
			<table>
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
							function get_lesson_name(id){
								for(var i=0;i<lessons.length ;i++){
									if(lessons[i].id==id)
										return lessons[i].name;
								}
							}

							

							
							for (var i = 0; i < result.length; i++) {

								document.write("<tr id="+result[i].id+" onclick='lesson(this.id)'>");

									document.write("<td>"+(i+1)+"</td>");
									document.write("<td>"+result[i].l_name+"</td>");
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
				</tbody>
			</table>
		</td>
			<td id="lessontd">
				<script>
					var hhe = "<?php if (isset($_POST['student_id'])) echo $_POST['student_id']; else echo ''?>";
						if(hhe)
							lesson(hhe);
				</script>
			</td>
	</table>
</body>
</html>
