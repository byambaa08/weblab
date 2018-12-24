function chooselessonajax(id) {
   var student_id = $("#student_id").val(); 
   var lesson_id = (id.replace(student_id,'')+""); 
   var button = $("#"+student_id+lesson_id).val();
   $.ajax({
           url: "chooseless.php", 
           data: { student :  student_id,
                   lesson : lesson_id,
                   button : button
                 },
           method: "POST",  
           dataType: "html", 
           success:function(data){
              if(data =="cancel"){
                 $("#"+student_id+lesson_id).attr("class", "btn btn-outline-danger");
                 $("#"+student_id+lesson_id).attr("value", "Цуцлах");
              }
              else if(data=="choose"){
                $("#"+student_id+lesson_id).attr("class", "btn btn-outline-success");
                 $("#"+student_id+lesson_id).attr("value", "Сонгох");
              }
           },
           error:function ( jqXHR, textStatus ){

               console.log(lesson_id);
               console.log(jqXHR);
           }
   });
}