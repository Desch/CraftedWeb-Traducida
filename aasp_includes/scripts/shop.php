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
if($_POST['action']=='addsingle') 
{
	$entry = (int)$_POST['entry'];
	$price = (int)$_POST['price'];
	$shop = mysql_real_escape_string($_POST['shop']);
	
	if(empty($entry) || empty($price) || empty($shop))
		die("Introduzca todos los campos.");

	$server->selectDB('worlddb');
	$get = mysql_query("SELECT name,displayid,ItemLevel,quality,AllowableRace,AllowableClass,class,subclass,Flags
	FROM item_template WHERE entry='".$entry."'")or die('Error al obtener los datos de la base de datos. Mensaje de error: '.mysql_error());
	$row = mysql_fetch_assoc($get);
	
	$server->selectDB('webdb');
	
	if($row['AllowableRace']=="-1")
		$faction = 0;
	elseif($row['AllowableRace']==690)
		$faction = 1;
	elseif($row['AllowableRace']==1101)
		$faction = 2;
	else
		$faction = $row['AllowableRace'];

	mysql_query("INSERT INTO shopitems (entry,name,in_shop,displayid,type,itemlevel,quality,price,class,faction,subtype,flags) VALUES (
	'".$entry."','".mysql_real_escape_string($row['name'])."','".$shop."','".$row['displayid']."','".$row['class']."','".$row['ItemLevel']."'
	,'".$row['quality']."','".$price."','".$row['AllowableClass']."','".$faction."','".$row['subclass']."','".$row['Flags']."'
	)")or die('Error mientras se añadian los artículos a la base de datos. Mensaje de error: '.mysql_error());
	
	$server->logThis("Added ".$row['name']." to the ".$shop." shop");
	
	echo 'artículo añadido con exito';
}
###############################
if($_POST['action']=='addmulti') 
{
	$il_from = (int)$_POST['il_from'];
	$il_to = (int)$_POST['il_to'];
	$price = (int)$_POST['price'];
	$quality = mysql_real_escape_string($_POST['quality']);
	$shop = mysql_real_escape_string($_POST['shop']);
	$type = mysql_real_escape_string($_POST['type']);
	
	if(empty($il_from) || empty($il_to) || empty($price) || empty($shop))
		die("Introduzca todos los campos.");
		
	$advanced = "";
	if($type!="all") 
	{
		if($type=="15-5" || $type=="15-5")  
		{
			//Mount or pet
			$type = explode('-',$type);
			
			$advanced.= "AND class='".$type[0]."' AND subclass='".$type[1]."'";
		} 
		else	
			$advanced.= "AND class='".$type."'";
	} 	

	if($quality!="all")
		$advanced .= " AND quality='".$quality."'";
	        
	$server->selectDB('worlddb');
	$get = mysql_query("SELECT entry,name,displayid,ItemLevel,quality,class,AllowableRace,AllowableClass,subclass,Flags
	 FROM item_template WHERE itemlevel>='".$il_from."'
	AND itemlevel<='".$il_to."' ".$advanced) or die('Error al obtener los datos de la base de datos. Mensaje de error: '.mysql_error());
	
	$server->selectDB('webdb');
	
	$c = 0;
	while($row = mysql_fetch_assoc($get)) 
	{
		$faction = 0;
		
		if($row['AllowableRace']==690) 
			$faction = 1;
		elseif($row['AllowableRace']==1101)
			$faction = 2;
		else
			$faction = $row['AllowableRace'];
	
	mysql_query("INSERT INTO shopitems (entry,name,in_shop,displayid,type,itemlevel,quality,price,class,faction,subtype,flags) VALUES (
	'".$row['entry']."','".mysql_real_escape_string($row['name'])."','".$shop."','".$row['displayid']."','".$row['class']."','".$row['ItemLevel']."'
	,'".$row['quality']."','".$price."','".$row['AllowableClass']."','".$faction."','".$row['subclass']."','".$row['Flags']."'
	)")or die('Error mientras se añadian los artículos a la base de datos. Mensaje de error: '.mysql_error());
	
	$c++;
	}
	
	$server->logThis("Añadidos varios elementos a la ".$shop." tienda");
	echo 'Se han añadido correctamente '.$c.' artículos';
}
###############################
if($_POST['action']=='clear') 
{
	$shop = (int)$_POST['shop'];
	
	if($shop==1)
		$shop = "vote";
	elseif($shop==2)
		$shop = "donate";
	
	mysql_query("DELETE FROM shopitems WHERE in_shop='".$shop."'");
	mysql_query("TRUNCATE shopitems");
	return;
}
###############################
if($_POST['action']=='modsingle') 
{
	$entry = (int)$_POST['entry'];
	$price = (int)$_POST['price'];
	$shop = mysql_real_escape_string($_POST['shop']);
	
	if(empty($entry) || empty($price) || empty($shop))
		die("Introduzca todos los campos.");
	
	mysql_query("UPDATE shopitems SET price='".$price."' WHERE entry='".$entry."' AND in_shop='".$shop."'");
	echo 'Artículo actualizado correctamente.';
}
###############################
if($_POST['action']=='delsingle') 
{
	$entry = (int)$_POST['entry'];
	$shop = mysql_real_escape_string($_POST['shop']);
	
	if(empty($entry) || empty($shop))
		die("Introduzca todos los campos.");
	
	mysql_query("DELETE FROM shopitems WHERE entry='".$entry."' AND in_shop='".$shop."'");
	echo 'Artículo eliminado correctamente';
}
###############################
if($_POST['action']=='modmulti') 
{
	$il_from = (int)$_POST['il_from'];
	$il_to = (int)$_POST['il_to'];
	$price = (int)$_POST['price'];
	$quality = mysql_real_escape_string($_POST['quality']);
	$shop = mysql_real_escape_string($_POST['shop']);
	$type = mysql_real_escape_string($_POST['type']);
	
	if(empty($il_from) || empty($il_to) || empty($price) || empty($shop))
		die("Introduzca todos los campos.");
		
	$advanced = "";
	if($type!="all") 
	{
		if($type=="15-5" || $type=="15-5")  
		{
			//Mount or pet
			$type = explode('-',$type);
			
			$advanced.= "AND type='".$type[0]."' AND subtype='".$type[1]."'";
		} 
		else	
			$advanced.= "AND type='".$type."'";
	} 	

	if($quality!="all")
		$advanced .= "AND quality='".$quality."'";
		
	$count = mysql_query("COUNT(*) FROM shopitems WHERE itemlevel >='".$il_from."' AND itemlevel <='".$il_to."' ".$advanced);
		
	mysql_query("UPDATE shopitems SET price='".$price."' WHERE itemlevel >='".$il_from."' AND itemlevel <='".$il_to."' ".$advanced);	
	echo 'Modificacion correcta de '.$count.' articulos!';	
}
###############################
if($_POST['action']=='delmulti') 
{
	$il_from = (int)$_POST['il_from'];
	$il_to = (int)$_POST['il_to'];
	$quality = mysql_real_escape_string($_POST['quality']);
	$shop = mysql_real_escape_string($_POST['shop']);
	$type = mysql_real_escape_string($_POST['type']);
	
	if(empty($il_from) || empty($il_to) || empty($shop))
		die("Introduzca todos los campos.");
		
	$advanced = "";
	if($type!="all") 
	{
		if($type=="15-5" || $type=="15-5")  
		{
			//Mount or pet
			$type = explode('-',$type);
			
			$advanced.= "AND type='".$type[0]."' AND subtype='".$type[1]."'";
		} 
		else	
			$advanced.= "AND type='".$type."'";
	} 	

	if($quality!="all")
		$advanced .= "AND quality='".$quality."'";
	
	$count = mysql_query("COUNT(*) FROM shopitems WHERE itemlevel >='".$il_from."' AND itemlevel <='".$il_to."' ".$advanced);
		
	mysql_query("DELETE FROM shopitems WHERE itemlevel >='".$il_from."' AND itemlevel <='".$il_to."' ".$advanced);
	echo 'Eliminados correctamente '.$count.' articulos!';	
}
###############################
?>