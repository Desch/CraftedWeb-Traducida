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

$server->selectDB('logondb');

###############################
if($_POST['action']=='edit') 
{
	$email = mysql_real_escape_string(trim($_POST['email']));
	$password = mysql_real_escape_string(trim(strtoupper($_POST['password'])));
	$vp = (int)$_POST['vp'];
	$dp = (int)$_POST['dp'];
	$id = (int)$_POST['id'];
	$extended = NULL;
	
	$chk1 = mysql_query("SELECT COUNT FROM account WHERE email='".$email."' AND id='".$od."'");
	if(mysql_query($chk1,0)>0)
		$extended .= "Se ha cambiado el correo electronico a".$email."<br/>"; 
	
	mysql_query("UPDATE account SET email='".$email."' WHERE id='".$id."'");
	$server->selectDB('webdb');
	
	mysql_query("INSERT IGNORE INTO account_data VALUES('".$id."','','','')");
	
		$chk2 = mysql_query("SELECT COUNT FROM account_data WHERE vp='".$vp."' AND id='".$od."'");
		if(mysql_query($chk2,0)>0)
			$extended .= "Se han actualizado los puntos de Votaciones a ".$vp."<br/>"; 
			
		$chk3 = mysql_query("SELECT COUNT FROM account_data WHERE dp='".$dp."' AND id='".$od."'");
		if(mysql_query($chk3,0)>0)
			$extended .= "Se han actualizado los Tokens de Donaciones a ".$dp."<br/>"; 	
	
	
	mysql_query("UPDATE account_data SET vp='".$vp."', dp ='".$dp."' WHERE id='".$id."'");
	
	if(!empty($password)) 
	{
		$username = strtoupper(trim($account->getAccName($id)));
		
		$password = sha1("".$username.":".$password."");
		$server->selectDB('logondb');
		mysql_query("UPDATE account SET sha_pass_hash='".$password."' WHERE id='".$id."'");
		mysql_query("UPDATE account SET v='0',s='0' WHERE id='".$id."'");
		$extended .= "Changed password<br/>";
	}
	
	
	$server->logThis("Modificando la informacion de cuenta de ".ucfirst(strtolower($account->getAccName($id))),$extended);
	echo "Los cambios se guardaron.";
}
###############################
if($_POST['action']=='saveAccA')
{
	$id = (int)$_POST['id'];
	$rank = (int)$_POST['rank'];
	$realm = mysql_real_escape_string($_POST['realm']);
	
	mysql_query("UPDATE account_access SET gmlevel='".$rank."',RealmID='".$realm."' WHERE id='".$id."'");
	$server->logThis("Modificando el aceso de cuenta de ".ucfirst(strtolower($account->getAccName($id))));
}
###############################
if($_POST['action']=='removeAccA')
{
	$id = (int)$_POST['id'];
	
	mysql_query("DELETE FROM account_access WHERE id='".$id."'");
	$server->logThis("Modificando el aceso de cuenta GM de ".ucfirst(strtolower($account->getAccName($id))));
}
###############################
if($_POST['action']=='addAccA')
{
	$user = mysql_real_escape_string($_POST['user']);
	$realm = mysql_real_escape_string($_POST['realm']);
	$rank = (int)$_POST['rank'];
	
	$guid = $account->getAccID($user);
	
	mysql_query("INSERT INTO account_access VALUES('".$guid."','".$rank."','".$realm."')");
	$server->logThis("Añadido acceso GM a la cuenta ".ucfirst(strtolower($account->getAccName($guid))));
}
###############################
if($_POST['action']=='editChar') 
{
	$guid = (int)$_POST['guid'];
	$rid = (int)$_POST['rid'];
	$name = mysql_real_escape_string(trim(ucfirst(strtolower($_POST['name']))));
	$class = (int)$_POST['class'];
	$race = (int)$_POST['race'];
	$gender = (int)$_POST['gender'];
	$money = (int)$_POST['money'];
	$accountname = mysql_real_escape_string($_POST['account']);
	$accountid = $account->getAccID($accountname);	
		
	if(empty($guid) || empty($rid) || empty($name) || empty($class) || empty($race))
		exit('Error');
	
	$server->connectToRealmDB($rid);	
	
	$onl = mysql_query("SELECT COUNT(*) FROM characters WHERE guid='".$guid."' AND online=1");
	if(mysql_result($onl,0)>0)
		exit('El pesonake debe estar online para que los cambios sir!');
	
	mysql_query("UPDATE characters SET name='".$name."',class='".$class."',race='".$race."',gender='".$gender."', money='".$money."', account='".$accountid."'
	WHERE guid='".$guid."'");
	
	echo 'El personaje se salvo!';
	
	$chk = mysql_query("SELECT COUNT(*) FROM characters WHERE name='".$name."'");
	if(mysql_result($chk,0)>1)
		echo '<br/><b>NOTA:</b> Parece que hay mas de un personaje con este nombre, esto podría obligarnos a cambiar el nombre al conectarse.';
	
	$server->logThis("Modificados los datos de personaje para ".$name);
}
###############################
?>