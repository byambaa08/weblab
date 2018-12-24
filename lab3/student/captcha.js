$(document).ready(function() {
//change CAPTCHA on each click or on refreshing page
	$("#reload").click(function() {

		$("img#img").remove();
		var id = Math.random();
		$('<img id="img" src="captcha.php?id='+id+'"/>').appendTo("#imgdiv");
		id ='';
	});

	//validation function
	$('#button').click(function() {
		var name = $("#username1").val();
		var email = $("#email1").val();
		var captcha = $("#captcha1").val();

		if (name == '' || email == '' || captcha == '')
		{
			alert("Fill All Fields");
		}
	});
});