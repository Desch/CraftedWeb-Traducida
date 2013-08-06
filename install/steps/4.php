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

<p id="steps"><b>Introducción</b> &raquo; Información MySQL &raquo; Configurar &raquo; <b>Base de Datos</b> &raquo; Información del Reino &raquo; Finalizar<p>
<hr/>
<p>Despues de escanear la carpeta de actualizaciones, se encontraron las siguientes actualizaciones de la Base de Datos:<ul>
    	<?php
			$files = scandir('sql/updates/');
			foreach($files as $value) {
				if(substr($value,-3,3)=='sql')
				{
					echo '<a href="#">'.$value.'</a><br/>';	
					$found = true;
				}
			}
		?>
    </ul>
    <?php
	if(!isset($found))
				echo '<code>No updates was found in your /updates folder. <a href="?st=5">Click here to continue</a></code>';
	?>
    <i>* Sugerencia: Al hacer Click en ellos podr&aacute;s obtener informaci&oacute;n adicionales.</i>
</p>
<p>
Haga click abajo para aplicar todas estas actualizaciones. Si no quieres introducir estas actualizaciones, haga click <a href="?st=5">aquí</a>. Se pueden instalar en cualquier momento de forma manual mediante la importaci&oacute;n a la base de datos con el sofware de gesti&oacute;n MySQL de su elecci&oacute;n. (HeidiSQL, SQLyog, Navicat, etc...)
</p>
<p>
	<br/>
	<input type="submit" value="Aplicar Actualizaciones" onclick="step4()">
</p>