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
	
	$filename = $_GET['plugin']; 
	include('../plugins/'.$filename.'/info.php');			
?>
<div class="box_right_title"><a href="?p=interface&s=plugins">Plugins</a> &raquo; <?php echo $title; ?></div>
<b><?php echo $title; ?></b><br/>
<?php echo $desc; ?>
<hr/>
Autor: <?php echo $author; ?> - <?php echo $created; ?>
<p/>
<b>Archivos:</b><br/>
<?php
$bad = array('.','..');
//Classes
$folder = scandir('../plugins/'.$filename.'/classes/');
foreach($folder as $file)
{
	if(!in_array($file,$bad))
	{
		echo $file.' (Class)<br/>';
	}
}
//Modules
$folder = scandir('../plugins/'.$filename.'/modules/');
foreach($folder as $file)
{
	if(!in_array($file,$bad))
	{
		echo $file.' (Module)<br/>';
	}
}

//Pages
$folder = scandir('../plugins/'.$filename.'/pages/');
foreach($folder as $file)
{
	if(!in_array($file,$bad))
	{
		echo $file.' (Page)<br/>';
	}
}

//Styles
$folder = scandir('../plugins/'.$filename.'/styles/');
foreach($folder as $file)
{
	if(!in_array($file,$bad))
	{
		echo $file.' (Stylesheet)<br/>';
	}
}

//Javascript
$folder = scandir('../plugins/'.$filename.'/javascript/');
foreach($folder as $file)
{
	if(!in_array($file,$bad))
	{
		echo $file.' (Javascript)<br/>';
	}
}

$server->selectDB('webdb');
$chk = mysql_query("SELECT COUNT(*) FROM disabled_plugins WHERE foldername='".mysql_real_escape_string($filename)."'");
if(mysql_result($chk,0)>0)
	echo '<input type="submit" value="Enable Plugin" onclick="enablePlugin(\''.$filename.'\')">';
else
	echo '<input type="submit" value="Disable Plugin" onclick="disablePlugin(\''.$filename.'\')">';
?>