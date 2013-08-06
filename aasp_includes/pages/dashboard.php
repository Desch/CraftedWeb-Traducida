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
<div class="box_right_title">Dashboard</div>
<table style="width: 605px;">
<tr>
<td><span class='blue_text'>Conexiones Activas</span></td><td><?php echo $server->getActiveConnections(); ?></td>
<td><span class='blue_text'>Cuentas Activas(Este mes)</span></td><td><?php echo $server->getActiveAccounts(); ?></td>
</tr>
<tr>
     <td><span class='blue_text'>Cuentas que han entrado hoy</span></td><td><?php echo $server->getAccountsLoggedToday(); ?></td> 
    <td><span class='blue_text'>Cuentas creadas hoy</span></td><td><?php echo $server->getAccountsCreatedToday(); ?></td>
</tr>
</table>
</div>

<?php
$server->checkForNotifications();
?>

<div class="box_right">
        <div class="box_right_title">Registro de Panel de Administraci&oacute;n</div>
        <?php
                    $server->selectDB('webdb');
                    $result = mysql_query("SELECT * FROM admin_log ORDER BY id DESC LIMIT 10");
                    if(mysql_num_rows($result)==0) {
                        echo "El registro de administración se encuentra vacio!";
                    } else { ?>
        <table class="center">
               <tr>
                 <th>D&iacute;a</th><th>Usuario</th><th>Accion</th></tr>
                    <?php
                    while($row = mysql_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo date("Y-m-d H:i:s",$row['timestamp']); ?></td>
                            <td><?php echo $account->getAccName($row['account']); ?></td>
                            <td><?php echo $row['action']; ?></td>
                        </tr>
                    <?php }
               ?>
        </table><br/>
        <a href="?p=logs&s=admin" title="Get more logs">Registros Antiguos...</a>
        <?php } ?>
</div>