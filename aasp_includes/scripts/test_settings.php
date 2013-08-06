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
include('../../includes/configuration.php');

###############################
if(isset($_POST['test'])) 
{
	$errors = array();
	
	/* Test Connection */
	if(!mysql_connect($GLOBALS['connection']['host'],$GLOBALS['connection']['user'],
	$GLOBALS['connection']['password'])) 
		$errors[] = "Error conexión MySQL. Revise sus ajustes/configuración.";
	else 
	{
		if(!mysql_select_db($GLOBALS['connection']['webdb']))
			$errors[] = "Error Base de Datos. No se puede conectar con la base de datos de la web.";
		
		if(!mysql_select_db($GLOBALS['connection']['logondb']))
			$errors[] = "Error Base de Datos. No se puede conectar con la base de datos de auth.";
		
		if(!mysql_select_db($GLOBALS['connection']['worlddb']))
			$errors[] = "Error Base de Datos. No se puede conectar con la base de datos de world.";
	}
	
	if (!empty($errors)) 
	{
			foreach($errors as $error) 
			{
				echo  "<strong>*", $error ,"</strong><br/>";
			}
			
		} 
		else
			echo "No han ocurrido errores. Ajustes correctos.";
}
###############################
?>