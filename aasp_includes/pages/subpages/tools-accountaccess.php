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
$server = new server;
$account = new account;
$page = new page;

$page->validatePageAccess('Tools->Account Access');

?>
<div class="box_right_title">Aceso de Cuentas</div>
Todas las cuentas GM se listan a continuacion.
<br/>&nbsp;
<table>
	<tr>
    	<th>ID</th>
        <th>Usuario</th>
        <th>Rank</th>
        <th>Reino</th>
        <th>Estado</th>
        <th>Ultima Conexi&oacute;n</th>
        <th>Acciones</th>
    </tr>
    <?php
	$server->selectDB('logondb');
	$result = mysql_query("SELECT * FROM account_access");
	if(mysql_num_rows($result)==0) 
	 	echo "<b>No se han encontrado cuentas GM!</b>";	
	else
	{
		while($row = mysql_fetch_assoc($result)) 
		{
			?>
            <tr style="text-align:center;">
            	<td><?php echo $row['id']; ?></td>
                <td><?php echo $account->getAccName($row['id']); ?></td>
                <td><?php echo $row['gmlevel']; ?></td>
                <td>
                <?php 
					if($row['RealmID']=='-1')
						echo 'Todos';
					else
					{
						$getRealm = mysql_query("SELECT name FROM realmlist WHERE id='".$row['RealmID']."'");
						if(mysql_num_rows($getRealm)==0)
							echo 'Desconocido';
						$rows = mysql_fetch_assoc($getRealm);
						echo $rows['name'];
					}
				?>
                </td>
                <td>
                <?php
					$getData = mysql_query("SELECT last_login,online FROM account WHERE id='".$row['id']."'");
					$rows = mysql_fetch_assoc($getData);
					if($rows['online']==0)
					 	echo '<font color="red">Offline</font>';
					else
						echo '<font color="green">Online</font>';	
				?>
                </td>
                <td>
                <?php
				 	echo $rows['last_login'];
				?>
                </td>
                <td>
                	<a href="#" onclick="editAccA(<?php echo $row['id']; ?>,<?php echo $row['gmlevel']; ?>,<?php echo $row['RealmID']; ?>)">Editar</a>
              		&nbsp;
                    <a href="#" onclick="removeAccA(<?php echo $row['id']; ?>)">Eliminar</a>
                </td>
            </tr>
            <?php
		}
		
	}
	?>
</table>
<hr/>
<a href="#" class="content_hider" onclick="addAccA()">Añadir Cuenta</a>