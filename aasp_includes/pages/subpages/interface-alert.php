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
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
</head>
<?php 
	$page = new page; 
	
	if(isset($_POST['update_alert']))
	{
		$alert_enable = $_POST['alert_enable'];
		$alert_message = trim($_POST['alert_message']);
		
		$alert_enable =($alert_enable == 'on') ? 'true' : 'false';
		
		$file_content = '<?php

$alert_enabled = '.$alert_enable.';

$alert_message = "'.$alert_message.'";

?>
';
		
		$fp = fopen('../documents/alert.php', 'w');
		if(fwrite($fp, $file_content))
			$msg = 'El mensaje de alerta se ha actualizado!';
		else
			$msg = '[Error]No se pudo escribir en el archivo!';	
			
		fclose($fp);
	}

	include('../documents/alert.php');
?>
<div class="box_right_title"><?php echo $page->titleLink(); ?> &raquo; Mensaje de Alerta</div>
<form action="?p=interface&s=alert" method="post">
<table>
	<tr>
    	<td>Habilitar el mensaje de alerta</td>
        <td><input name="alert_enable" type="checkbox" <?php if ($alert_enabled==true) echo 'checked'; ?> /></td>
    </tr>
    <tr>
    	<td>Mensaje de alerta</td>
        <td><textarea name="alert_message" cols="60" rows="3"><?php echo $alert_message; ?></textarea>
    </tr>
    <tr>
    	<td></td>
        <td><input type="submit" value="Save" name="update_alert">
        <?php
			if(isset($msg))
				echo $msg;
		?>
        </td>
    </tr>
</table>
</td>