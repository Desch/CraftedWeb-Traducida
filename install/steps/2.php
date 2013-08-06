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

<p id="steps">Introducción &raquo; Información MySQL &raquo; <b>Configurar</b> &raquo; Base de Datos &raquo; Información del Reino &raquo; Finalizar<p>
<hr/>
<p>Ahora tenemos que comprobar que se puede escribir en el archivo de &quot;configuración&quot; y que puede leerse el archivo SQL. Antes de comprobar asegúrese de que:<ul>
    	<li>Se ha establecido el  CHMOD a 777 en ambos archivos <i>'includes/configuration.php'</i> E <i>'install/sql/CraftedWeb_Base.sql'</i> (<b>Debes</b> cambiar esto a 644 despu&eacute;s de completar la instalaci&oacute;n!)</li>
        <li>El archivo existe (No estamos creando un nuevo archivo, solo estamos escribiendo en uno en blanco. Si el archivo (includes/configuration.php) no existe, cree uno. Puedes usar el notepad o sofware similar, solo recuerde que debe guardarlo como <i>configuration.php</i>, NO .TXT!</li>
    </ul>
</p>
<p>
	<br/>
	<input type="submit" value="Comprobar los archivos" onclick="step2()">
</p>