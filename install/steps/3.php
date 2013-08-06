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

<p id="steps">Introducción &raquo; Informacion MySQL &raquo; Configurar &raquo; <b>Base de Datos</b> &raquo; Información del Reino &raquo; ´Finalizar<p>
<hr/>
<p>Ahora es el momento de hacer algo realmente. El script har&aacute; lo siguiente:<ul>
    	<li>Crear la base de datos de la Web si no existe.</li>
        <li>Crear todas las tablas de la base de datos de la Web.</li>
        <li>Insertar los datos por defecto en la base de datos de la Web.</li>
        <li>Escribir en el archivo de configuraci&oacute;n.</li>
    </ul>
Para evitar cualquier error en la base de datos, aseg&uacute;rese de que el Usuario MySQL tenga acceso a los siguientes comandos.
<ul>
    	<li>INSERT</li>
        <li>INSERT IGNORE</li>
        <li>UPDATE</li>
        <li>ALTER</li>
        <li>DELETE</li>
        <li>DROP</li>
        <li>CREATE</li>
    </ul>
Puede eliminar algunos de ellos una vez se haya completado la instalaci&oacute;n, ya que no son necesarios cuando se ejecute el CMS.
<p>
	<br/>
	<input type="submit" value="Empezar la Instalación!" onclick="step3()">
</p>