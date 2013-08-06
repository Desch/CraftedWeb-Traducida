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
 

require('../ext_scripts_class_loader.php');

connect::selectDB('logondb');

if (isset($_POST['register'])) 
{
	$username = trim($_POST['username']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$repeat_password = trim($_POST['password_repeat']);
	$captcha = (int)$_POST['captcha'];
	$raf = $_POST['raf'];
	
	account::register($username,$email,$password,$repeat_password,$captcha,$raf);
	echo TRUE;
}

if(isset($_POST['check'])) 
{
	if($_POST['check']=="username") 
	{
		$username = mysql_real_escape_string($_POST['value']);
		
		$result = mysql_query("SELECT COUNT(id) FROM account WHERE username='".$username."'");
		if(mysql_result($result,0)==0)
			echo "<i class='green_text'>Este nombre de usuario esta Disponible</i>";
		else 
			echo "<i class='red_text'>Este nombre de usuario NO esta Disponible</i>";
	}
}
?>