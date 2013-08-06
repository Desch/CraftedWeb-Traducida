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
 	$server->selectDB('webdb'); 
 	$page = new page;
	
	$page->validatePageAccess('Realms');
	
    if($page->validateSubPage() == TRUE) {
		$page->outputSubPage();
	} else {
?>
<div class='box_right_title'>Nuevo Reino</div>
<?php if(isset($_POST['add_realm'])) {
	$server->addRealm($_POST['realm_id'],$_POST['realm_name'],$_POST['realm_desc'],$_POST['realm_host'],$_POST['realm_port']
			,$_POST['realm_chardb'],$_POST['realm_sendtype'],$_POST['realm_rank_username'],
			$_POST['realm_rank_password'],$_POST['realm_ra_port'],$_POST['realm_soap_port'],$_POST['realm_a_host']
			,$_POST['realm_a_user'],$_POST['realm_a_pass']);	
}?>

                        <form action="?p=realms" method="post" style="line-height: 15px;">
                        <b>Informaci&oacute;n General del Reino</b>
                        <hr/>
                        ID Reino: <br/>
                        <input type="text" name="realm_id" placeholder="Default: 1"/> <br/>
                        <i class='blue_text'>Esta ID debe ser la misma que has especidicado en la tabla 'realmlist' en Auth. 
                        					 De lo contrario, el tiempo online 'uptime' no funcionar&aacute; correctamente.</i><br/>
                        Nombre Reino: <br/>
                        <input type="text" name="realm_name" placeholder="Default: Reino de Ejemplo"/> <br/>
                        (Opcional) Descripci&oacute;n Reino: <br/>
                        <input type="text" name="realm_desc" placeholder="Default: Blizzlike 3x"/> <br/>
                        Puerto Reino: <br/>
                        <input type="text" name="realm_port" placeholder="Default: 8085"/> <br/>
                        Host: (IP o DNS) <br/>
                        <input type="text" name="realm_host" placeholder="Default: 127.0.0.1"/> <br/>
                        
                        <br/>
                        <b>Información de Consola Remota</b> <i>(Tienda de Votaci&oacute;n & Donaci&oacute;n)</i>
                        <hr/>
                        Consola Remota <i>(Siempre se puede cambiar mas adelante</i>: <br/>
                        <select name="realm_sendtype">
                                 <option value="ra">RA</option>
                                 <option value="soap">SOAP</option>
                        </select><br/>
                        <i class='blue_text'>Especifique una cuenta GM de nivel 3 (Se usa para la Consola Remota)<br/>
                        Consejo: No utilice su cuenta de Admin, utilice una cuenta de nivel 3.</i><br/>
                        Nombre de Usuario: <br/>
                        <input type="text" name="realm_rank_username" placeholder="Default: desch"/> <br/>
                        Password: <br/>
                        <input type="password" name="realm_rank_password" placeholder="Default: ascent"/> <br/>
                        Puerto RA: <i>(Ignorar si ha elegido SOAP)</i> <br/>
                        <input type="text" name="realm_ra_port" placeholder="Default: 3443"/> <br/>
                        Puerto SOAP: <i>(Ignorar si ha elegido  RA)</i> <br/>
                        <input type="text" name="realm_soap_port" placeholder="Default: 7878"/> <br/>
                        <br/>
                        <b>Informacion MySQL</b> <i>(Si queda en blanco, los datos se copiaran del archivo de configuraci&oacute;n)</i>
                        <hr/>
                        MySQL Host: <br/>
                        <input type="text" name="realm_m_host" placeholder="Default: 127.0.0.1"/><br/>
                        MySQL Usuario: <br/>
                        <input type="text" name="realm_m_user" placeholder="Default: root"/><br/>
                        MySQL Password: <br/>
                        <input type="text" name="realm_m_pass" placeholder="Default: ascent"/><br/>
                        Base de Datos Characters: <br/>
                        <input type="text" name="realm_chardb" placeholder="Default: characters"/> <br/>
                        <hr/>
                        <input type="submit" value="Añadir" name="add_realm" />                     
                        </form>
<?php } ?>
