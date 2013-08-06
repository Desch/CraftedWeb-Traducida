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
	 
	 $page->validatePageAccess('Users');
	 
     if($page->validateSubPage() == TRUE) {
		 $page->outputSubPage();
	 } else {
		 $server->selectDB('logondb');
		 $usersTotal = mysql_query("SELECT COUNT(*) FROM account");
		 $usersToday = mysql_query("SELECT COUNT(*) FROM account WHERE joindate LIKE '%".date("Y-m-d")."%'");
		 $usersMonth = mysql_query("SELECT COUNT(*) FROM account WHERE joindate LIKE '%".date("Y-m")."%'");
		 $usersOnline = mysql_query("SELECT COUNT(*) FROM account WHERE online=1");
		 $usersActive = mysql_query("SELECT COUNT(*) FROM account WHERE last_login LIKE '%".date("Y-m")."%'");
		 $usersActiveToday = mysql_query("SELECT COUNT(*) FROM account WHERE last_login LIKE '%".date("Y-m-d")."%'");	 
?>
<div class="box_right_title">Informaci&oacute;n General de Usuarios</div>
<table style="width: 100%;">
<tr>
<td><span class='blue_text'>Usuarios Totales</span></td><td><?php echo round(mysql_result($usersTotal,0)); ?></td>
<td><span class='blue_text'>Nuevos Usuarios de Hoy</span></td><td><?php echo round(mysql_result($usersToday,0)); ?></td>
</tr>
<tr>
    <td><span class='blue_text'>Nuevos Usuarios este Mes</span></td><td><?php echo round(mysql_result($usersMonth,0)); ?></td>
    <td><span class='blue_text'>Usuarios Online</span></td><td><?php echo round(mysql_result($usersOnline,0)); ?></td>
</tr>
<tr>
    <td><span class='blue_text'>Usuarios Activos (este mes)</span></td><td><?php echo round(mysql_result($usersActive,0)); ?></td>
    <td><span class='blue_text'>Usuarios Conectados Hoy</span></td><td><?php echo round(mysql_result($usersActiveToday,0)); ?></td>
</tr>
</table>
<hr/>
<a href="?p=users&s=manage" class="content_hider">Administrar Usuarios</a>
<?php } ?>