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

<p id="steps"><b>Introducción</b> &raquo; Información MySQL &raquo; Configurar &raquo; Base de Datos &raquo; <b>Información del Reino</b> &raquo; Finalizar<p>
<hr/>
<table cellpadding="10" cellspacing="5">
	<tr>
    	<td>ID Reino:</td>
    	<td><input type="text" placeholder="Default: 1" id="addrealm_id"></td>
        
        <td>Nombre Reino:</td>
        <td><input type="text" placeholder="Default: Sample Realm" id="addrealm_name"></td>
        
        <td>Host MySQL:</td>
        <td><input type="text" placeholder="Default: 127.0.0.1" id="addrealm_m_host"></td>
     </tr>
     <tr>   
        <td>Descripci&oacute;n (No es necesaria):</td>
        <td><input type="text" placeholder="Default: Blizzlike 1x" id="addrealm_desc"></td>
        
        <td>Host:</td>
        <td><input type="text" placeholder="Default: 127.0.0.1" id="addrealm_host"></td>
        
        <td>Usuario MySQL:</td>
        <td><input type="text" placeholder="Default: root" id="addrealm_m_user"></td>
     </tr>
     <tr>   
        <td>Puerto:</td>
        <td><input type="text" placeholder="Default: 8085" id="addrealm_port"></td> 
        
        <td>BD Characters:</td>
        <td><input type="text" placeholder="Default: characters" id="addrealm_chardb"></td>
        
        <td>Contraseña MySQL:</td>
        <td><input type="text" placeholder="Default: ascent" id="addrealm_m_pass"></td>
     </tr>
     <tr>    
        <td>Usuario Cuenta Autorizada:</td>
        <td><input type="text" placeholder="Default: admin" id="addrealm_a_user"></td> 
        
        <td>Contraseña Cuenta Autorizada:</td>
        <td><input type="text" placeholder="Default: adminpass" id="addrealm_a_pass"></td>        
    </tr>
    <tr>
    	<td>Consola Remota:</td>
        <td>
        	<select id="addrealm_sendtype">
            	<option value="ra">RA</option>
                <option value="soap">SOAP</option>
            </select>
        </td>
        
        <td>Puerto RA (Ignorar si ha elegido SOAP):</td>
        <td><input type="text" placeholder="Default: 3443" id="addrealm_raport"></td>
        
        <td>Puerto SOAP (Ignorar si ha elegido RA):</td>
        <td><input type="text" placeholder="Default: 7878" id="addrealm_soapport"></td>
        
    </tr>
    <tr>
    	<td></td>
        <td><input type="submit" value="Finalizar" onClick="step5()"></td>
    </tr>
</table>