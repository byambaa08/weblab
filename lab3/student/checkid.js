function checkAvailability() {
   var username_tocheck = $("#student_id").val(); 
   $.ajax({
           url: "checkav.php", 
           data: { check_username :  username_tocheck },
           method: "GET",  
           dataType: "html", 
           success:function(data){
                 $("#user-availability-status").html(data);
           },
           error:function ( jqXHR, textStatus ){
               console.log(username_tocheck);
                }
   });
}