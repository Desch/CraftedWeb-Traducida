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
<?php $page = new page; $server = new server;?>
<div class="box_right_title">Administrar Reinos</div>
<table class="center">
<tr><th>ID</th><th>Nombre</th><th>Host</th><th>Puerto</th><th>Character BD</th><th>Acciones</th></tr>
<?php
    $server->selectDB('webdb');
	$result = mysql_query("SELECT * FROM realms ORDER BY id DESC");
	while($row = mysql_fetch_assoc($result)) { ?>
		  <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['host']; ?></td>
              <td><?php echo $row['port']; ?></td>
              <td><?php echo $row['char_db']; ?></td>
              <td><a href="#" onclick="edit_realm(<?php echo $row['id']; ?>,'<?php echo $row['name']; ?>','<?php echo $row['host']; ?>',
              '<?php echo $row['port']; ?>','<?php echo $row['char_db']; ?>')">Editar</a> &nbsp; 
              <a href="#" onclick="delete_realm(<?php echo $row['id']; ?>,'<?php echo $row['name']; ?>')">Borrar</a><br/>
              <a href="#" onclick="edit_console(<?php echo $row['id']; ?>,'<?php echo $row['sendType']; ?>','<?php echo $row['rank_user']; ?>',
			  '<?php echo $row['rank_pass']; ?>')">Modificar Configuracion de Consola</a>
              </td>
          </tr>
	<?php }
?>
</table>