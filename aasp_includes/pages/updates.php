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
<div class="box_right_title">Actualizaciones</div>
<script type="text/javascript">
function getLatestVersions() {
	$(".hidden_version").fadeIn("fast");
}
</script>
<table width="100%">
       <tr>
            <td>Versi&oacute;n Actual: r_01</td><td class="hidden_version">Versión Disponible: r_02</td>
       </tr>
       <tr>
            <td>Versi&oacute;n de la BD Actual: r_01</td><td class="hidden_version">Versión de la BD Disponible: r_02</td>
       </tr>
       <tr>
           <td><input type="submit" value="Comprobar versiones más recientes" onclick="getLatestVersions()"/></td>
           <td class="hidden_version"><input type="submit" value="Actualizar" onclick="alert('Trololol! Esta opcion no esta implementada aun! :D')"/></td>
       </tr>
</table>