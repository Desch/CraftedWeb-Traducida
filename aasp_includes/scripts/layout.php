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
if($_POST['action']=="setTemplate") 
{
	mysql_query("UPDATE template SET applied='0' WHERE applied='1'");
	mysql_query("UPDATE template SET applied='1' WHERE id='".(int)$_POST['id']."'");
}
###############################
if($_POST['action']=="installTemplate") 
{
	mysql_query("INSERT INTO template VALUES('','".mysql_real_escape_string(trim($_POST['name']))."','".mysql_real_escape_string(trim($_POST['path']))."','0')");
	$server->logThis("Instalada la plantilla ".$_POST['name']);
}
###############################
if($_POST['action']=="uninstallTemplate") 
{
	mysql_query("DELETE FROM template WHERE id='".(int)$_POST['id']."'");
	mysql_query("UPDATE template SET applied='1' ORDER BY id ASC LIMIT 1");
	
	$server->logThis("Plantilla desinstalada");
}
###############################
if($_POST['action']=="getMenuEditForm") 
{
	$result = mysql_query("SELECT * FROM site_links WHERE position='".(int)$_POST['id']."'");
	$rows = mysql_fetch_assoc($result);
	 ?>
    Titulo<br/>
    <input type="text" id="editlink_title" value="<?php echo $rows['title']; ?>"><br/>
    URL<br/>
    <input type="text" id="editlink_url" value="<?php echo $rows['url']; ?>"><br/>
    Ver Cuando<br/>
    <select id="editlink_shownWhen">
             <option value="always" <?php if($rows['shownWhen']=="always") { echo "selected='selected'"; } ?>>Siempre</option>
             <option value="logged" <?php if($rows['shownWhen']=="logged") { echo "selected='selected'"; } ?>>El usuario este logeado</option>
             <option value="notlogged" <?php if($rows['shownWhen']=="notlogged") { echo "selected='selected'"; } ?>>El usuario no este logeado</option>
    </select><br/>
    <input type="submit" value="Guardar" onclick="saveMenuLink('<?php echo $rows['position']; ?>')">
	
<?php }
###############################
if($_POST['action']=="saveMenu") 
{
	$title = mysql_real_escape_string($_POST['title']);
	$url = mysql_real_escape_string($_POST['url']);
	$shownWhen = mysql_real_escape_string($_POST['shownWhen']);
	$id = (int)$_POST['id'];
	
	if(empty($title) || empty($url) || empty($shownWhen)) {
		die("Introduzca todos los campos.");
	}
	
	mysql_query("UPDATE site_links SET title='".$title."',url='".$url."',shownWhen='".$shownWhen."' WHERE position='".$id."'");
	
	$server->logThis("Se ha modificado el Menu");
	
	echo TRUE;
}
###############################
if($_POST['action']=="deleteLink") 
{
	mysql_query("DELETE FROM site_links WHERE position='".(int)$_POST['id']."'");
	
	$server->logThis("Se ha eliminado un enlace del Menu");
	
	echo TRUE;
}
###############################
if($_POST['action']=="addLink") 
{
	$title = mysql_real_escape_string($_POST['title']);
	$url = mysql_real_escape_string($_POST['url']);
	$shownWhen = mysql_real_escape_string($_POST['shownWhen']);
	
	if(empty($title) || empty($url) || empty($shownWhen)) {
		die("Introduzca todos los campos.");
	}
	
	mysql_query("INSERT INTO site_links VALUES('','".$title."','".$url."','".$shownWhen."')");
	
	$server->logThis("Se ha añadido ".$title." al menu");
	
	echo TRUE;
}
###############################
if($_POST['action']=="deleteImage") 
{
	$id = (int)$_POST['id'];
	mysql_query("DELETE FROM slider_images WHERE position='".$id."'");
	
	$server->logThis("Se ha eliminado una imagen del slideshow");
	
	return;
}
###############################
if($_POST['action']=="disablePlugin") 
{
	$foldername = mysql_real_escape_string($_POST['foldername']);
	
	mysql_query("INSERT INTO disabled_plugins VALUES('".$foldername."')");
	
	include('../../plugins/'.$foldername.'/info.php');
	$server->logThis("Plugin Desactivado ".$title);
}
###############################
if($_POST['action']=="enablePlugin") 
{
	$foldername = mysql_real_escape_string($_POST['foldername']);
	
	mysql_query("DELETE FROM disabled_plugins WHERE foldername='".$foldername."'");
	
	include('../../plugins/'.$foldername.'/info.php');
	$server->logThis("Plugin Activado ".$title);
}
###############################
?>