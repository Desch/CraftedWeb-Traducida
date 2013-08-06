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
 
require('includes/misc/headers.php'); //Load sessions, erorr reporting & ob.

if(file_exists('install/index.php'))
	header("Location: install/index.php");

define('INIT_SITE', TRUE);

require('includes/configuration.php'); //Load configuration file

if(isset($GLOBALS['not_installed']) && $GLOBALS['not_installed']==true)
{
	if(file_exists('install/index.php'))
		header("Location: install/index.php");
	else
		exit('<b>Error</b>. Parece que su sitio no esta aun instalado, pero no se encuentra el instalador!');	
}

if($GLOBALS['maintainance']==TRUE && !in_array($_SERVER['REMOTE_ADDR'],$GLOBALS['maintainance_allowIPs']))
{ 
  die("<center><h3>Website en Mantenimiento</h3>
      ".$GLOBALS['website_title']." se encuentra actualmente en importantes trabajos de mantenimiento, volvera a estar disponible tan pronto como sea posible.
      <br/><br/>Sinceramente
  </center>");
}


require('includes/misc/connect.php'); //Load connection class
$connect = new connect;

$connect->connectToDB();

require('includes/misc/func_lib.php'); 
require('includes/misc/compress.php'); 

require('includes/classes/account.php'); 
require('includes/classes/server.php'); 
require('includes/classes/website.php'); 
require('includes/classes/shop.php'); 
require('includes/classes/character.php'); 
require('includes/classes/cache.php'); 
require('includes/classes/plugins.php'); 

/******* LOAD PLUGINS ***********/
plugins::globalInit();

plugins::init('classes');
plugins::init('javascript');
plugins::init('modules');
plugins::init('styles');
plugins::init('pages');

//Load configs.
if($GLOBALS['enablePlugins']==true)
{
	if($_SESSION['loaded_plugins']!=NULL)
	{
		foreach($_SESSION['loaded_plugins'] as $folderName)
		{
			if(file_exists('plugins/'.$folderName.'/config.php'))
				include_once('plugins/'.$folderName.'/config.php');
		}
	}
}

$account = new account;
$account->getRemember(); //Remember thingy.

//This is to prevent the error "Undefined index: p"
if (!isset($_GET['p'])) 
	$_GET['p'] = 'home';
	
###VOTING SYSTEM####
if(isset($_SESSION['votingUrlID']) && $_SESSION['votingUrlID']!=0 && $GLOBALS['vote']['type']=='confirm')
{
    if(website::checkIfVoted((int)$_SESSION['votingUrlID'],$GLOBALS['connection']['webdb'])==TRUE) 
		die("?p=vote");
	
	$acct_id = account::getAccountID($_SESSION['cw_user']);
	
	$next_vote = time() + $GLOBALS['vote']['timer'];
	
	connect::selectDB('webdb');
	
	mysql_query("INSERT INTO votelog VALUES('','".(int)$_SESSION['votingUrlID']."',
	'".$acct_id."','".time()."','".$next_vote."','".$_SERVER['REMOTE_ADDR']."')");
     
	$getSiteData = mysql_query("SELECT points,url FROM votingsites WHERE id='".(int)$_SESSION['votingUrlID']."'");
	$row = mysql_fetch_assoc($getSiteData);
	
	if(mysql_num_rows($getSiteData)==0)
	{
		header('Location: index.php');
		unset($_SESSION['votingUrlID']);
	}
	
	//Update the points table.
	$add = $row['points'] * $GLOBALS['vote']['multiplier'];
	mysql_query("UPDATE account_data SET vp=vp + ".$add." WHERE id=".$acct_id);
	
	unset($_SESSION['votingUrlID']);
	
	header("Location: ?p=vote");
}

###SESSION SECURITY###
if(!isset($_SESSION['last_ip']) && isset($_SESSION['cw_user'])) 
	$_SESSION['last_ip'] = $_SERVER['REMOTE_ADDR'];
	
elseif(isset($_SESSION['last_ip']) && isset($_SESSION['cw_user'])) 
{
	if($_SESSION['last_ip']!=$_SERVER['REMOTE_ADDR'])
		header("Location: ?p=logout");
	else
		$_SESSION['last_ip']=$_SERVER['REMOTE_ADDR'];
}
?>

