<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
</head>
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
 
define('INIT_SITE', TRUE);
include('../../includes/misc/headers.php');
include('../../includes/configuration.php');
include('../functions.php');
$server = new server;
$account = new account;

$server->selectDB('webdb');

###############################
if($_POST['action']=="payments") 
{
		$result = mysql_query("SELECT paymentstatus,mc_gross,datecreation FROM payments_log WHERE userid='".(int)$_POST['id']."'");
		if(mysql_num_rows($result)==0)
			echo "<b color='red'>No se han encontrado pagos para esta cuenta.</b>";
		else 
		{
		?> <table width="100%">
               <tr>
                   <th>Cantidad</th>
                   <th>Estado del Pago</th>
                   <th>Dia</th>
               </tr>
           <?php
		while($row = mysql_fetch_assoc($result)) 
		{ ?>
			<tr>
                 <td><?php echo $row['mc_gross'];?>$</td>
                 <td><?php echo $row['paymentstatus']; ?></td>
                 <td><?php echo $row['datecreation']; ?></td>   
            </tr>
		<?php }
		echo '</table>';
		}
	}
###############################	
elseif($_POST['action']=='dshop') 
{
		$result = mysql_query("SELECT entry,char_id,date,amount,realm_id FROM shoplog WHERE account='".(int)$_POST['id']."' AND shop='donate'");
		if(mysql_num_rows($result)==0)
			echo "<b color='red'>No se han encontrado registros para esta cuenta.</b>";
		else 
		{
		?> <table width="100%">
               <tr>
                   <th>Item</th>
                   <th>Character</th>
                   <th>Dia</th>
                   <th>Importe</th>
               </tr>
           <?php
		while($row = mysql_fetch_assoc($result)) { ?>
			<tr>
                 <td><a href="http://<?php echo $GLOBALS['tooltip_href']; ?>item=<?php echo $row['entry']; ?>" title="" target="_blank">
				 	 <?php echo $server->getItemName($row['entry']);?></a></td>
                 <td><?php echo $account->getCharName($row['char_id'],$row['realm_id']); ?></td>
                 <td><?php echo $row['date']; ?></td>   
                 <td>x<?php echo $row['amount']; ?></td>
            </tr>
		<?php }
		echo '</table>';
		}
	}
###############################	
elseif($_POST['action']=='vshop') 
{
		$result = mysql_query("SELECT entry,char_id,realm_id,date,amount FROM shoplog WHERE account='".(int)$_POST['id']."' AND shop='vote'");
		if(mysql_num_rows($result)==0)
			echo "<b color='red'>No se han encontrado registros para esta cuenta.</b>";
		else 
		{
		?> <table width="100%">
               <tr>
              	 <th>Item</th>
                 <th>Character</th>
                 <th>Dia</th>
                 <th>Importe</th>
               </tr>
           <?php
		while($row = mysql_fetch_assoc($result)) { ?>
			<tr>
                 <td><a href="http://<?php echo $GLOBALS['tooltip_href']; ?>item=<?php echo $row['entry']; ?>" title="" target="_blank">
				 	 <?php echo $server->getItemName($row['entry']);?></a></td>
                 <td><?php echo $account->getCharName($row['char_id'],$row['realm_id']); ?></td>
                 <td><?php echo $row['date']; ?></td>
                 <td>x<?php echo $row['amount']; ?></td>   
            </tr>
		<?php }
		echo '</table>';
		}
	}	
###############################	
elseif($_POST['action']=="search") 
{
	$input = mysql_real_escape_string($_POST['input']);
	$shop = mysql_real_escape_string($_POST['shop']);
	?>
    <table width="100%">
    <tr>
        <th>Usuario</th>
        <th>Character</th>
        <th>Reino</th>
        <th>Item</th>
        <th>Dia</th>
        <th>Importe</th>
    </tr>
	
	<?php 
	//Search via character name...
	$loopRealms = mysql_query("SELECT id FROM realms");
	while($row = mysql_fetch_assoc($loopRealms)) 
	{
		   $server->connectToRealmDB($row['id']);
		   $result = mysql_query("SELECT guid FROM characters WHERE name LIKE '%".$input."%'");
		   if(mysql_num_rows($result)>0) {
		   $row = mysql_fetch_assoc($result);
		   $server->selectDB('webdb');
		   $result = mysql_query("SELECT * FROM shoplog WHERE shop='".$shop."' AND char_id='".$row['guid']."'"); 
           
            while($row = mysql_fetch_assoc($result)) { ?>
		<tr class="center">
            <td><?php echo $account->getAccName($row['account']); ?></td>
            <td><?php echo $account->getCharName($row['char_id'],$row['realm_id']); ?></td>
            <td><?php echo $server->getRealmName($row['realm_id']); ?></td>
            <td><a href="http://<?php echo $GLOBALS['tooltip_href']; ?>item=<?php echo $row['entry']; ?>" title="" target="_blank">
			<?php echo $server->getItemName($row['entry']); ?></a></td>
            <td><?php echo $row['date']; ?></td>
            <td>x<?php echo $row['amount']; ?></td>   
        </tr>	
		<?php } } }?>
        
        
        <?php 
	        //Search via account name
	       $server->selectDB('logondb');
		   $result = mysql_query("SELECT id FROM account WHERE username LIKE '%".$input."%'");
		   if(mysql_num_rows($result)>0) {
		   $row = mysql_fetch_assoc($result);
		   $server->selectDB('webdb');
		   $result = mysql_query("SELECT * FROM shoplog WHERE shop='".$shop."' AND account='".$row['id']."'"); 
           
            while($row = mysql_fetch_assoc($result)) { ?>
		<tr class="center">
            <td><?php echo $account->getAccName($row['account']); ?></td>
            <td><?php echo $account->getCharName($row['char_id'],$row['realm_id']); ?></td>
            <td><?php echo $server->getRealmName($row['realm_id']); ?></td>
            <td><a href="http://<?php echo $GLOBALS['tooltip_href']; ?>item=<?php echo $row['entry']; ?>" title="" target="_blank">
			<?php echo $server->getItemName($row['entry']); ?></a></td>
            <td><?php echo $row['date']; ?></td>
            <td>x<?php echo $row['amount']; ?></td>   
        </tr>	
		<?php } } ?>
        
        
        <?php 
	        //Search via item name
	       $server->selectDB('worlddb');
		   $result = mysql_query("SELECT entry FROM item_template WHERE name LIKE '%".$input."%'");
		   if(mysql_num_rows($result)>0) {
		   $row = mysql_fetch_assoc($result);
		   $server->selectDB('webdb');
		   $result = mysql_query("SELECT * FROM shoplog WHERE shop='".$shop."' AND entry='".$row['entry']."'"); 
           
            while($row = mysql_fetch_assoc($result)) { ?>
		<tr class="center">
            <td><?php echo $account->getAccName($row['account']); ?></td>
            <td><?php echo $account->getCharName($row['char_id'],$row['realm_id']); ?></td>
            <td><?php echo $server->getRealmName($row['realm_id']); ?></td>
            <td><a href="http://<?php echo $GLOBALS['tooltip_href']; ?>item=<?php echo $row['entry']; ?>" title="" target="_blank">
			<?php echo $server->getItemName($row['entry']); ?></a></td>
            <td><?php echo $row['date']; ?></td>
            <td>x<?php echo $row['amount']; ?></td>   
        </tr>	
		<?php } } ?>
        
        <?php 
	        //Search via date
			$server->selectDB('webdb');
		    $result = mysql_query("SELECT * FROM shoplog WHERE shop='".$shop."' AND date LIKE '%".$input."%'"); 
           
            while($row = mysql_fetch_assoc($result)) { ?>
		<tr class="center">
            <td><?php echo $account->getAccName($row['account']); ?></td>
            <td><?php echo $account->getCharName($row['char_id'],$row['realm_id']); ?></td>
            <td><?php echo $server->getRealmName($row['realm_id']); ?></td>
            <td><a href="http://<?php echo $GLOBALS['tooltip_href']; ?>item=<?php echo $row['entry']; ?>" title="" target="_blank">
			<?php echo $server->getItemName($row['entry']); ?></a></td>
            <td><?php echo $row['date']; ?></td>
            <td>x<?php echo $row['amount']; ?></td>   
        </tr>	
        
        
		<?php } 
		if($input=="Buscando...") 
		{
			 //View last 10 logs
			$server->selectDB('webdb');
		   $result = mysql_query("SELECT * FROM shoplog WHERE shop='".$shop."' ORDER BY id DESC LIMIT 10"); 
           
            while($row = mysql_fetch_assoc($result)) { ?>
		<tr class="center">
            <td><?php echo $account->getAccName($row['account']); ?></td>
            <td><?php echo $account->getCharName($row['char_id'],$row['realm_id']); ?></td>
            <td><?php echo $server->getRealmName($row['realm_id']); ?></td>
            <td><a href="http://<?php echo $GLOBALS['tooltip_href']; ?>item=<?php echo $row['entry']; ?>" title="" target="_blank">
			<?php echo $server->getItemName($row['entry']); ?></a></td>
            <td><?php echo $row['date']; ?></td>
            <td>x<?php echo $row['amount']; ?></td>   
        </tr>	
			<?php } }
		 ?>
        
</table>
    <?php
}
###############################

?>