<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
</head>
<?php
#   ___           __ _           _ __    __     _     
#  / __\ __ __ _ / _| |_ ___  __| / / /\ \ \___| |__  
# / / | '__/ _` | |_| __/ _ \/ _` \ \/  \/ / _ \ '_ \ 
#/ /__| | | (_| |  _| ||  __/ (_| |\  /\  /  __/ |_) |
#\____/_|  \__,_|_|  \__\___|\__,_| \/  \/ \___|_.__/ 
#
#		-[ Created by ©Nomsoft
#		  `-[ Original core by Anthony (Aka. CraftedDev)
#
#				-CraftedWeb Generation II-                  
#			 __                           __ _   							   
#		  /\ \ \___  _ __ ___  ___  ___  / _| |_ 							   
#		 /  \/ / _ \| '_ ` _ \/ __|/ _ \| |_| __|							   
#		/ /\  / (_) | | | | | \__ \ (_) |  _| |_ 							   
#		\_\ \/ \___/|_| |_| |_|___/\___/|_|  \__|	- www.Nomsoftware.com -	   
#                  The policy of Nomsoftware states: Releasing our software   
#                  or any other files are protected. You cannot re-release    
#                  anywhere unless you were given permission.                 
#                  © Nomsoftware 'Nomsoft' 2011-2012. All rights reserved.    
 

require('../ext_scripts_class_loader.php');

if (isset($_POST['item_entry'])) 
{
	$entry = mysql_real_escape_string($_POST['item_entry']);
	$character_realm = mysql_real_escape_string($_POST['character_realm']);
	$type = mysql_real_escape_string($_POST['send_mode']);
	
	if (empty($entry) || empty($character_realm) || empty($type))
		echo '<b class="red_text">Por favor especifique un personaje.</b>';
	else 
	{
		connect::selectDB('webdb');
		
		$realm = explode("*", $character_realm);
		
		$result = mysql_query("SELECT price FROM shopitems WHERE entry='".$entry."'");
		$row = mysql_fetch_assoc($result);
		$account_id = account::getAccountIDFromCharId($realm[0],$realm[1]);
		$account_name = account::getAccountName($account_id);
		
		if ($type=='vote') 
		{
        	if (account::hasVP($account_name,$row['price'])==FALSE)
				die('<b class="red_text">No tienes suficientes Puntos de Votaciones</b>');
				
	    account::deductVP($account_id,$row['price']);
		
		} 
		elseif ($type=='donate') 
		{
			if (account::hasDP($account_name,$row['price'])==FALSE)
			   die('<b class="red_text">No tienes suficientes '.$GLOBALS['donation']['coins_name'].'</b>');

	        account::deductDP($account_id,$row['price']);
		}
		
	   shop::logItem($type,$entry,$realm[0],$account_id,$realm[1],1);
       $result = mysql_query("SELECT * FROM realms WHERE id='".$realm[1]."'");
	   $row = mysql_fetch_assoc($result);
	   
	  if($row['sendType']=='ra') 
	  {
		 require('../misc/ra.php');
		 require('../classes/character.php');
		  
		 sendRa("send items ".character::getCharname($realm[0])." \"Su artículo solicitado\" \"Gracias por ayudarnos!\" ".$entry." ",
		 $row['rank_user'],$row['rank_pass'],$row['host'],$row['ra_port']); 
	  } 
	  elseif($row['sendType']=='soap') 
	  {
		 require('../misc/soap.php');
		 require('../classes/character.php'); 
		 
		 sendSoap("send items ".character::getCharname($realm[0])." \"Su artículo solicitado\" \"Gracias por ayudarnos!\" ".$entry." ",
		 $row['rank_user'],$row['rank_pass'],$row['host'],$row['soap_port']);
	  }
	}
}

?>