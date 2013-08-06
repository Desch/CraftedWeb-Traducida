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

$page->validatePageAccess('Tools->Tickets');

?>
<div class="box_right_title">Tickets</div>
<?php if(!isset($_GET['guid'])) { ?>
<table class="center">
        <tr>
            <td><input type="checkbox" id="tickets_offline">Ver Tickets fuera de linea</td>
            <td>
            <select id="tickets_realm">
           		 <?php
				 $server->selectDB('webdb');
				 
				$result = mysql_query("SELECT char_db,name,description FROM realms");
				if(mysql_num_rows($result)==0) 
				{
					echo '<option value="NULL">No se han encontrado Reinos.</option>';
				}
				else 
				{
					echo '<option value="NULL">--Selecionar Reino--</option>';
					while($row = mysql_fetch_assoc($result)) 
					{
						echo '<option value="'.$row['char_db'].'">'.$row['name'].' - <i>'.$row['description'].'</i></option>';
					}
				}
				 ?>
            </select>
            </td>
            <td>
            <input type="submit" value="Load" onclick="loadTickets()">
            </td>
        </tr>
</table>
<hr/>
<span id="tickets">
	   <?php 
	    if(isset($_SESSION['lastTicketRealm']))
		   {
			   ##############################
				if($GLOBALS['core_expansion']==3)
					$guidString = 'playerGuid';
				else
					$guidString = 'guid';	
				
				if($GLOBALS['core_expansion']==3)
					$closedString = 'closed';
				else
					$closedString = 'closedBy';
					
				if($GLOBALS['core_expansion']==3)
				
					$ticketString = 'guid';
				else
					$ticketString = 'ticketId';
				############################
						
			  $offline = $_SESSION['lastTicketRealmOffline'];
			  $realm = mysql_real_escape_string($_SESSION['lastTicketRealm']);
			  

				if($realm == "NULL")
				   die("<pre>Por favor, seleccionar Reino.</pre>");
				
				mysql_select_db($realm);	
				
				$result = mysql_query("SELECT ".$ticketString.",name,message,createtime,".$guidString.",".$closedString." FROM gm_tickets ORDER BY ticketId DESC");
				if(mysql_num_rows($result)==0)
				   die("<pre>No se han encontrado Tickets!</pre>");
				   
				echo '
				<table class="center">
				   <tr>
					   <th>ID</th>
					   <th>Nombre</th>
					   <th>Mensaje</th>
					   <th>Creado</th>
					   <th>Estado Ticket</th>
					   <th>Estado Jugador</th>
					   <th>Herramientas Rapidas</th>
				   </tr>
				';
				
				while($row = mysql_fetch_assoc($result)) 
				{
					$get = mysql_query("SELECT COUNT(online) FROM characters WHERE guid='".$row[$guidString]."' AND online='1'");
					if(mysql_result($get,0)==0 && $offline == "on") {
					echo '<tr>';
						echo '<td><a href="?p=tools&s=tickets&guid='.$row[$ticketString].'&db='.$realm.'">'.$row[$ticketString].'</td>';
						echo '<td><a href="?p=tools&s=tickets&guid='.$row[$ticketString].'&db='.$realm.'">'.$row['name'].'</td>';
						echo '<td><a href="?p=tools&s=tickets&guid='.$row[$ticketString].'&db='.$realm.'">'.substr($row['message'],0,15).'...</td>';
						echo '<td><a href="?p=tools&s=tickets&guid='.$row[$ticketString].'&db='.$realm.'">'.date('Y-m-d H:i:s',$row['createtime']).'</a></td>';
						
						if($row[$closedString]==1) 
							echo '<td><font color="red">Resuelto</font></td>';
						else
							echo '<td><font color="green">Pendiente</font></td>';		
						
						$get = mysql_query("SELECT COUNT(online) FROM characters WHERE guid='".$row[$guidString]."' AND online='1'");
						if(mysql_result($get,0)>0)
						   echo '<td><font color="green">Online</font></td>';
						else
						   echo '<td><font color="red">Offline</font></td>';
						   
						?> <td><a href="#" onclick="deleteTicket('<?php echo $row[$ticketString]; ?>','<?php echo $realm; ?>')">Borrar</a>
								&nbsp;
								<?php if($row[$closedString]==1) 
								{ ?>
									<a href="#" onclick="openTicket('<?php echo $row[$ticketString]; ?>','<?php echo $realm; ?>')">Abrir</a>
								<?php }
								else 
								{
								?>
							   <a href="#" onclick="closeTicket('<?php echo $row[$ticketString]; ?>','<?php echo $realm; ?>')">Cerrar</a>
							   <?php
								}
								?>
								</td><?php
							echo '<tr>';
							}
            }
            echo '</table>'; 
		   }
		   else
			echo '<pre>Por favor, seleccionar Reino.</pre>';
	   ?>
</span>
<?php } 
elseif(isset($_GET['guid'])) 
{
	if($GLOBALS['core_expansion']==3)
		$guidString = 'playerGuid';
	else
		$guidString = 'guid';	
	
	if($GLOBALS['core_expansion']==3)
		$closedString = 'closed';
	else
		$closedString = 'closedBy';		
		
	if($GLOBALS['core_expansion']==3)
		$ticketString = 'guid';
	else
		$ticketString = 'ticketId';		
	
	mysql_select_db($_GET['db']);
	$result = mysql_query("SELECT name,message,createtime,".$guidString.",".$closedString." FROM gm_tickets WHERE ".$ticketString."='".(int)$_GET['guid']."'");
	$row = mysql_fetch_assoc($result);
	?>
    <table style="width: 100%;" class="center">
        <tr>
            <td>
            	<span class='blue_text'>Enviado por:</span>
            </td>	
            <td>
				<?php echo $row['name']; ?>
            </td>
                
            <td>
            	<span class='blue_text'>Creado:</span>
            </td>
            <td>
				<?php echo date("Y-m-d H:i:s",$row['createtime']); ?>
            </td>
               
            <td>
            	<span class='blue_text'>Estado del Ticket:</span>
            </td>
            <td>
				<?php
                if($row[$closedString]==1) 
                    echo '<font color="red">Resuelto</font>';
                else
                    echo '<font color="green">Pendiente</font>';
                ?>
            </td>
            
            <td>
            	<span class='blue_text'>Estado Jugador:</span>
            </td>
            <td>
            	<?php
				$get = mysql_query("SELECT COUNT(online) FROM characters WHERE guid='".$row[$guidString]."' AND online='1'");
				if(mysql_result($get,0)>0)
				   	echo '<font color="green">Online</font>';
				else
				   echo '<font color="red">Offline</font>';
			   ?>
            </td>
                
        </tr>
    </table>
    <hr/>
    <?php
	echo nl2br($row['message']);
	?>
    <hr/>
    <pre>
        <a href="?p=tools&s=tickets">&laquo; Volver atr&aacute;s</a>
        &nbsp; &nbsp; &nbsp;
        <a href="#" onclick="deleteTicket('<?php echo $_GET['guid']; ?>','<?php echo $_GET['db']; ?>')">Eliminar Ticket</a>
        &nbsp; &nbsp; &nbsp;
        <?php if($row[$closedString]==1) 
			{ ?>
				<a href="#" onclick="openTicket('<?php echo $_GET['guid']; ?>','<?php echo $_GET['db']; ?>')">Abrir Ticket</a>
			<?php }
			else 
			{
			?>
		  		<a href="#" onclick="closeTicket('<?php echo $_GET['guid']; ?>','<?php echo $_GET['db']; ?>')">Cerrar Ticket</a>
		   <?php
			}
		   ?>
    </pre>
    <?php
}

?>
