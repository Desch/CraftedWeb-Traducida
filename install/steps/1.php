
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

<center>
    	<p id="steps">Introducción &raquo; <b>Información MySQL</b> &raquo; Configurar &raquo; Base de Datos &raquo; Información del Reino &raquo; Finalizar<p>
		<hr/>
<table cellpadding="10" cellspacing="5">
	<tr>
    	<td>Host MySQL:</td>
        <td><input type="text" placeholder="Default: 127.0.0.1" id="step1_host"></td>
        
        <td>Realmlist:</td>
        <td><input type="text" placeholder="Default: logon.yourserver.com" id="step1_realmlist"></td>
        
        <td>T&iacute;tulo Website:</td>
        <td><input type="text" placeholder="Default: YourServer" id="step1_title"></td>
     </tr>
     <tr>   
        <td>Usuario MySQL:</td>
        <td><input type="text" placeholder="Default: root" id="step1_user"></td> 
        
        <td>BD Auth:</td>
        <td><input type="text" placeholder="Default: auth" id="step1_logondb"></td>
        
        <td>Dominio Website:</td>
        <td><input type="text" placeholder="Default: http://yourserver.com" id="step1_domain"></td>
     </tr>
     <tr>   
        <td>Contrase&ntilde;a MySQL:</td>
        <td><input type="text" placeholder="Default: ascent" id="step1_pass"></td>  
        
        <td>DB World:</td>
        <td><input type="text" placeholder="Default: world" id="step1_worlddb"></td>
        
        <td>Expansi&oacute;n:</td>
        <td>
        	<select id="step1_exp">
            	<option value="0">Vanilla (No expansion)</option>
                <option value="1">The Burning Crusade</option>
                <option value="2" selected>Wrath of the Lich King (TrinityCore)</option>
                <option value="3">Cataclysm (SkyfireEMU)</option>
                <option value="4">Mists of Pandaria</option>
            </select>
        </td>
     </tr>
     <tr>    
        <td>Email PayPal:</td>
        <td><input type="text" placeholder="Default: youremail@gmail.com" id="step1_paypal"></td>  
        
        <td>DB Website:</td>
        <td><input type="text" placeholder="Default: craftedweb" id="step1_webdb"></td>   
        
        <td>Email Administrador:</td>
        <td><input type="text" placeholder="Default: noreply@yourserver.com" id="step1_email"></td>        
    </tr>
    <tr>
    	<td></td>
        <td><input type="submit" value="Continuar" onclick="step1()"></td>
    </tr>
</table></center>