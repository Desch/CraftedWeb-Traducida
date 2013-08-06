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
<?php $page = new page; $server = new server; $account = new account; ?>
<div class="box_right_title"><?php echo $page->titleLink(); ?> &raquo; Administrar Usuarios</div>

<?php
if(isset($_GET['char']))  {
	echo 'Resultados de la busqueda <b>'.$_GET['char'].'</b><pre>';
	$result = mysql_query("SELECT name, id FROM realms");
	while($row = mysql_fetch_assoc($result)) 
	{
		$server->connectToRealmDB($row['id']);
		$get = mysql_query("SELECT account,name FROM characters WHERE name='".mysql_real_escape_string($_GET['char'])."' OR guid='".(int)$_GET['char']."'");
		$rows = mysql_fetch_assoc($get);
			echo '<a href="?p=users&s=manage&user='.$rows['account'].'">'.$rows['name'].' - '.$row['name'].'</a><br/>';
	}
	echo '</pre><hr/>';
}

if(isset($_GET['user']))  {
	
	$server->selectDB('logondb');
	$value = mysql_real_escape_string($_GET['user']);
	$result = mysql_query("SELECT * FROM account WHERE username='".$value."' OR id='".$value."'");
	if(mysql_num_rows($result)==0) {
		echo "<span class='red_text'>No se han encontrado resultados!</span>";
	} else {
		$row = mysql_fetch_assoc($result);?>
		<table width="100%">
			<tr>
			<td><span class='blue_text'>Nombre de Cuenta</span></td><td> <?php echo ucfirst(strtolower($row['username']));?> (<?php echo $row['last_ip']; ?>)</td>
			<td><span class='blue_text'>Miembro Desde</span></td><td><?php echo $row['joindate']; ?></td>
			</tr>
			<tr>
				<td><span class='blue_text'>Email</span></td><td><?php echo $row['email'];?></td>
				<td><span class='blue_text'>Puntos de Votación</span></td><td><?php  echo $account->getVP($row['id']); ?></td>
			</tr>
			<tr>
				<td><span class='blue_text'>Estado de Cuenta</span></td><td><?php echo $account->getBan($row['id']); ?></td>
				<td><span class='blue_text'><?php echo $GLOBALS['donation']['coins_name']; ?></span></td><td><?php echo $account->getDP($row['id']); ?></td>
			</tr>
			<tr><td><a href='?p=users&s=manage&getlogs=<?php echo $row['id']; ?>'>Busqueda de Pagos y Registros Tienda </a><br />
            <a href='?p=users&s=manage&getslogs=<?php echo $row['id']; ?>'>Registro de Servicios</a></td>
			<td></td>
			<td><a href='?p=users&s=manage&editaccount=<?php echo $row['id']; ?>'>Editar Información de Cuenta</a></tr>
			</table>
            <hr/>
            <b>Characters</b><br/>
            <table>
            <tr>
            	<th>Guid</th>
                <th>Nombre</th>
                <th>Nivel</th>
                <th>Clase</th>
                <th>Raza</th>
                <th>Reino</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <?php
			 $server->selectDB('webdb');
			 $result = mysql_query("SELECT name,id FROM realms");
			 while($row = mysql_fetch_assoc($result))
			 {
				$acct_id = $account->getAccID($_GET['user']);
				$server->connectToRealmDB($row['id']);
				$result = mysql_query("SELECT name,guid,level,class,race,gender,online FROM characters WHERE account='".(int)$_GET['user']."'
				OR account='".$acct_id."'");
				 
				while($rows = mysql_fetch_assoc($result))
				{
					?>
                    <tr class="center">
                    	<td><?php echo $rows['guid']; ?></td>
                        <td><?php echo $rows['name']; ?></td>
                        <td><?php echo $rows['level']; ?></td>
                        <td><img src="../styles/global/images/icons/class/<?php echo $rows['class']; ?>.gif" /></td>
                        <td><img src="../styles/global/images/icons/race/<?php echo $rows['race'].'-'.$rows['gender']; ?>.gif" /></td>
                        <td><?php echo $row['name']; ?></td>
                        <td>
                        <?php
						if($rows['online']==1)
							echo '<font color="#009900">Online</font>';
						else
							echo '<font color="#990000">Offline</font>';	
						?>
                        </td>
                        <td><a href="#" onclick="characterListActions('<?php echo $rows['guid']; ?>','<?php echo $row['id']; ?>')">Lista de acciones</a></td>
                    </tr>
                    <?php 
				}
			 }
			 ?>
             </table>
            <hr/>
		<?php
	}
 }
elseif(isset($_GET['getlogs'])) {
	?>
	Cuenta seleccionada: <a href='?p=users&s=manage&user=<?php echo $_GET['getlogs']; ?>'><?php echo $account->getAccName($_GET['getlogs']); ?></a><p />
	
	<h4 class='payments' onclick='loadPaymentsLog(<?php echo (int)$_GET['getlogs']; ?>)'>Registro de pagos</h4>
	<div class='hidden_content' id='payments'></div>
	<hr/>
	<h4 class='payments' onclick='loadDshopLog(<?php echo (int)$_GET['getlogs']; ?>)'>Registros tienda Donaciones</h4>
	<div class='hidden_content' id='dshop'></div>
	<hr/>
	<h4 class='payments' onclick='loadVshopLog(<?php echo (int)$_GET['getlogs']; ?>)'>Registro tienda Votaciones</h4>
	<div class='hidden_content' id='vshop'></div>
	<?php
}
elseif(isset($_GET['editaccount'])) {
   ?>Cuenta seleccionada: <a href='?p=users&s=manage&user=<?php echo $_GET['editaccount']; ?>'><?php echo $account->getAccName($_GET['editaccount']); ?></a><p />
   <table width="100%">
	<input type="hidden" id="account_id" value="<?php echo $_GET['editaccount']; ?>" />
		   <tr><td>Email</td> <td><input type="text" id="edit_email" class='noremove' 
		   value="<?php echo $account->getEmail($_GET['editaccount']); ?>"/> </tr> 
		   <tr><td>Cambiar Password</td><td><input type="text" id="edit_password" class='noremove'/></td></tr>
		   <tr><td>Puntos Votaciones</td> <td><input type="text" id="edit_vp" value="<?php echo $account->getVP($_GET['editaccount']); ?>" class='noremove'/> </tr>
		   <tr><td><?php echo $GLOBALS['donation']['coins_name']; ?></td> 
									<td><input type="text" id="edit_dp" value="<?php echo $account->getDP($_GET['editaccount']); ?>" class='noremove'/></td></tr>
		   <tr><td></td><td><input type="submit" value="Guardar" onclick="save_account_data()"/></td></tr>
   </table>
   <hr/>
<?php } 
 elseif(isset($_GET['getslogs'])) {
	?>
	Cuenta seleccionada: <a href='?p=users&s=manage&user=<?php echo $_GET['getslogs']; ?>'><?php echo $account->getAccName($_GET['getslogs']); ?></a><p />
	<table>
    	<tr>
        	<th>Servicio</th>
            <th>Descripción</th>
            <th>Reino</th>
            <th>Día</th>
        </tr>
        <?php
		$server->selectDB('webdb');
		$result = mysql_query("SELECT * FROM user_log WHERE account='".(int)$_GET['getslogs']."'");
		if(mysql_num_rows($result)==0)
			echo 'No se han encontrado registros para esta cuenta!';
		else
		{
			while($row = mysql_fetch_assoc($result))
			{
				echo '<tr class="center">';
					echo '<td>'.$row['service'].'</td>';
					echo '<td>'.$row['desc'].'</td>';
					echo '<td>'.$server->getRealmName($row['realmid']).'</td>';
					echo '<td>'.date('Y-m-d H:i',$row['timestamp']).'</td>';
				echo '</tr>';
			}
		}
		?>
    </table>
    <hr/>
<?php
}
?>
<table width="100%">
  			<tr>
            	<td>Usuario or ID: </td>	
                <form action="" method="get">
                <input type="hidden" name="p" value="users">
                <input type="hidden" name="s" value="manage">
                <td><input type="text" name="user"></td><td><input type="submit" value="Go"></td>
            </tr></form>
            
            <tr>
                <td>Nombre Character or GUID: </td>	
                <form action="" method="get">
                <input type="hidden" name="p" value="users">
                <input type="hidden" name="s" value="manage">
                <td><input type="text" name="char"></td><td><input type="submit" value="Go"></td>
           </tr></form>
</table>