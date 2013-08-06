<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
</head>
<?php
/* ___           __ _           _ __    __     _     
  / __\ __ __ _ / _| |_ ___  __| / / /\ \ \___| |__  
 / / | '__/ _` | |_| __/ _ \/ _` \ \/  \/ / _ \ '_ \ 
/ /__| | | (_| |  _| ||  __/ (_| |\  /\  /  __/ |_) |
\____/_|  \__,_|_|  \__\___|\__,_| \/  \/ \___|_.__/ 

		-[ Created by ©Nomsoft
		  `-[ Original core by Anthony (Aka. CraftedDev)

				-CraftedWeb Generation II-                  
			 __                           __ _   							   
		  /\ \ \___  _ __ ___  ___  ___  / _| |_ 							   
		 /  \/ / _ \| '_ ` _ \/ __|/ _ \| |_| __|							   
		/ /\  / (_) | | | | | \__ \ (_) |  _| |_ 							   
		\_\ \/ \___/|_| |_| |_|___/\___/|_|  \__|	- www.Nomsoftware.com -	   
                  The policy of Nomsoftware states: Releasing our software   
                  or any other files are protected. You cannot re-release    
                  anywhere unless you were given permission.                 
                  © Nomsoftware 'Nomsoft' 2011-2012. All rights reserved.  */
 
define('INIT_SITE', TRUE);
include('../../includes/misc/headers.php');
include('../../includes/configuration.php');;
mysql_connect($GLOBALS['connection']['host'],$GLOBALS['connection']['user'],$GLOBALS['connection']['password']);

###############################
if(isset($_POST['login'])) 
{
	 $username = mysql_real_escape_string(strtoupper(trim($_POST['username']))); 
	 $password = mysql_real_escape_string(strtoupper(trim($_POST['password'])));
	 if(empty($username) || empty($password))
		 die("Por favor, introduzca ambos campos.");
	 
		 $password = sha1("".$username.":".$password."");
		 mysql_select_db($GLOBALS['connection']['logondb']);
		 
		 $result = mysql_query("SELECT COUNT(id) FROM account WHERE username='".$username."' AND 
		 sha_pass_hash = '".$password."'");
		 if(mysql_result($result,0)==0)
			 die("Combinación de Usuario/Contraseña invalida.");
		 
		 $getId = mysql_query("SELECT id FROM account WHERE username='".$username."'");
		 $row = mysql_fetch_assoc($getId);
		 $uid = $row['id'];
		 $result = mysql_query("SELECT gmlevel FROM account_access WHERE id='".$uid."' 
		 AND gmlevel >= '".$GLOBALS[$_POST['panel'].'Panel_minlvl']."'");
		
		 if(mysql_num_rows($result)==0)
			 die("La cuenta especificada no tiene permiso para iniciar sesión!");
			 
		 $rank = mysql_fetch_assoc($result);	 
		 
		 $_SESSION['cw_'.$_POST['panel']]=ucfirst(strtolower($username));
		 $_SESSION['cw_'.$_POST['panel'].'_id']=$uid;
		 $_SESSION['cw_'.$_POST['panel'].'_level']=$rank['gmlevel'];
		 
		 if(empty($_SESSION['cw_'.$_POST['panel']]) || empty($_SESSION['cw_'.$_POST['panel'].'_id'])
		 || empty($_SESSION['cw_'.$_POST['panel'].'_level']))
		 	die('Los scripts han encontrado un error (una o más sesiones se establecieron NULL)');
		 
		 sleep(1);
		 die(TRUE);
  }
###############################  
?>