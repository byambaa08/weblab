<?php
	session_start();
	$captchanumber = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'; // Initializing PHP variable with string
	$captchanumber = substr(str_shuffle($captchanumber), 0, 6); // Getting first 6 word after shuffle.
	$_SESSION["code"] = $captchanumber; // Initializing session variable with above generated sub-string
	$image = imagecreatefromjpeg("bj.jpg"); // Generating CAPTCHA
	$foreground = imagecolorallocate($image, 0, 0, 0); // Font Color
	// echo $foreground;
	imagestring($image, 5, 75, 20, $captchanumber, $foreground);
	header('Content-type: image/png');
	imagepng($image);
?>