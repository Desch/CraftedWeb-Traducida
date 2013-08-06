<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
</head>
<?php
#   ___           __ _           _ __    __     _     
#  / __\ __ __ _ / _| |_ ___  __| / / /\ \ \___| |__  
# / / | '__/ _` | |_| __/ _ \/ _` \ \/  \/ / _ \ '_ \ 
#/ /__| | | (_| |  _| ||  __/ (_| |\  /\  /  __/ |_) |
#\____/_|  \__,_|_|  \__\___|\__,_| \/  \/ \___|_.__/ 
#
#		-[ Created by ©Nomsoft
#		  `-[ Original core by Anthony (Aka. CraftedDev)
#
#				-CraftedWeb Generation II-                  
#			 __                           __ _   							   
#		  /\ \ \___  _ __ ___  ___  ___  / _| |_ 							   
#		 /  \/ / _ \| '_ ` _ \/ __|/ _ \| |_| __|							   
#		/ /\  / (_) | | | | | \__ \ (_) |  _| |_ 							   
#		\_\ \/ \___/|_| |_| |_|___/\___/|_|  \__|	- www.Nomsoftware.com -	   
#                  The policy of Nomsoftware states: Releasing our software   
#                  or any other files are protected. You cannot re-release    
#                  anywhere unless you were given permission.                 
#                  © Nomsoftware 'Nomsoft' 2011-2012. All rights reserved.    
 
    session_start();
    header('Content-type: image/jpeg');
	
	$font_size = 20;
	
	$img_width = 100;
	$img_height = 40;
	
	$image = imagecreate($img_width,$img_height);
	imagecolorallocate($image, 255, 255, 255);
	
	$text_color = imagecolorallocate($image, 0, 0, 0);
	
	for($x=1; $x<=30; $x++) 
	{
		$x1 = rand(1,100);
		$y1 = rand(1,100);
		$x2 = rand(1,100);
		$y2 = rand(1,100);
		
		imageline($image, $x1, $y1, $x2, $x2, $text_color);
	}
	
	imagettftext($image, $font_size, 0, 15, 30, $text_color, 'arial.ttf', $_SESSION['captcha_numero']);
	imagejpeg($image);

?>