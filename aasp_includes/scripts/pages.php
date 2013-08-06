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
if($_POST['action']=='toggle')
 {
	if($_POST['value']==1) {
		//Enable
		mysql_query("DELETE FROM disabled_pages WHERE filename='".mysql_real_escape_string($_POST['filename'])."'");
	} 
	elseif($_POST['value']==2) 
	{
		//Disable
		mysql_query("INSERT IGNORE disabled_pages values('".mysql_real_escape_string($_POST['filename'])."')");
	}
}
###############################
if($_POST['action']=='delete') 
{
	mysql_query("DELETE FROM custom_pages WHERE filename='".mysql_real_escape_string($_POST['filename'])."'");
	return;
}
###############################
if($_POST['action']=='saveVoteLink') 
{
	$id = (int)$_POST['id'];
	$title = mysql_real_escape_string($_POST['title']);
	$points = (int)$_POST['points'];
	$image = mysql_real_escape_string($_POST['image']);
	$url = mysql_real_escape_string($_POST['url']);
	
	if(!empty($id))
	{
		mysql_query("UPDATE votingsites SET title='".$title."',points='".$points."',image='".$image."',url='".$url."'
		WHERE id='".$id."'");
	}
}
###############################
if($_POST['action']=='removeVoteLink') 
{
	$id = (int)$_POST['id'];
	
	mysql_query("DELETE FROM votingsites WHERE id='".$id."'");
}
###############################
if($_POST['action']=='addVoteLink') 
{
	$title = mysql_real_escape_string($_POST['title']);
	$points = (int)$_POST['points'];
	$image = mysql_real_escape_string($_POST['image']);
	$url = mysql_real_escape_string($_POST['url']);
	
	if(!empty($title) && !empty($points) && !empty($image) && !empty($url))
	  mysql_query("INSERT INTO votingsites VALUES('','".$title."','".$points."','".$image."','".$url."')");
}
###############################
if($_POST['action']=='saveServicePrice') 
{
	$service = mysql_real_escape_string($_POST['service']);
	$price = (int)$_POST['price'];
	$currency = mysql_real_escape_string($_POST['currency']);
	$enabled = mysql_real_escape_string($_POST['enabled']);
	
	mysql_query("UPDATE service_prices SET price='".$price."',currency='".$currency."',enabled='".$enabled."' 
	WHERE service='".$service."'");
}
###############################
?>