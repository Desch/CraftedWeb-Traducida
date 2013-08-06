<?php
/* ___           __ _           _ __    __     _     
  / __\ __ __ _ / _| |_ ___  __| / / /\ \ \___| |__  
 / / | '__/ _` | |_| __/ _ \/ _` \ \/  \/ / _ \ '_ \ 
/ /__| | | (_| |  _| ||  __/ (_| |\  /\  /  __/ |_) |
\____/_|  \__,_|_|  \__\___|\__,_| \/  \/ \___|_.__/ 

		-[ Created by �Nomsoft
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
                  � Nomsoftware 'Nomsoft' 2011-2012. All rights reserved.  */
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Instalacion CraftedWeb</title>

	<style type="text/css">

	::selection{ background-color: #06C; color: #fff; }
	::moz-selection{ background-color: #06C; color: #fff; }
	::webkit-selection{ background-color: #06C; color: #fff; }

	body { background-color: #efefef; margin: 40px; font: 13px/20px normal Helvetica, Arial, sans-serif; color: #4F5155;}

	a {color: #003399;background-color: transparent;font-weight: normal;}

	h1 {color: #0e86cb;background-color: transparent;border-bottom: 1px solid #D0D0D0;font-size: 19px;font-weight: normal;margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;}

	code {font-family: Consolas, Monaco, Courier New, Courier, monospace;font-size: 12px;background-color: #f9f9f9;border: 1px solid #D0D0D0;
		color: #002166;display: block;margin: 14px 0 14px 0;padding: 12px 10px 12px 10px;}

	#content{margin: 0 15px 0 15px;}
	
	#main_box{width: 950px; margin: 50px;border: 1px solid #D0D0D0;-webkit-box-shadow: 0 0 8px #D0D0D0; -webkit-box-align:center; -moz-box-align:center;}
	
	hr { border-top: 1px solid #D0D0D0; border-bottom: none; border-left: none; border-right: none; }
	
	#steps { font-size: 11px; }
	
	input[type="submit"] { height: 32px; border:none; background-color: #f9f9f9;
		padding-bottom: 5px; padding-left: 18px;  padding-right: 18px; cursor:pointer; -moz-border-radius: 1px; border-radius: 1px;        
		padding-top: 2px; top: -4px; border: 1px solid #ccc;
		font-family: 'Calibri', 'newCalibri', 'Arial'; color:#0e86cb;  }
	input[type="submit"]:hover { background-color:#fff; }
	</style>
</head>
<body>
 <center>
<div id="main_box">
	<h1>Instalación CraftedWeb</h1>

	<div id="content">
    	<p id="steps"><b>Introducción</b> &raquo; Información MySQL &raquo; Configurar &raquo; Base de Datos&raquo; Información del Reino &raquo; Finalizar<p>
        <hr/>
        <p>Bienvenido a CraftedWeb!</p><BR>
		 <p>Para instalar, siga las instrucciones que aparecen en pantalla e introduzca los datos correctos.      </p>
	  <p>Antes de continuar, debe saber que son necesarios los datos de acceso MySQL de su servidor.
	  <p>Traducción Completa por Desch.<p>
	  <p>Antes de nada debes poner  CHMOD 777  estos archivos <i>'includes/configuration.php'</i> E <i>'install/sql/CraftedWeb_Base.sql'</i></p>
		 <p>Cuanto este listo, puede comenzar!</p>
        <p><input type="submit" value="Empezar Instalación" onclick="window.location='install.php?st=1'"></p>
	</div>
</div>
</center>
</body>
</html>