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
     $page = new page;
	 
	 $page->validatePageAccess('Shop');
	 
     if($page->validateSubPage() == TRUE) {
		 $page->outputSubPage();
	 } else {
		 $server->selectDB('webdb');
		 $inShop = mysql_query("SELECT COUNT(*) FROM shopitems");
		 $purchToday = mysql_query("SELECT COUNT(*) FROM shoplog WHERE date LIKE '%".date('Y-m-d')."%'");
		 $getAvg = mysql_query("SELECT AVG(*) AS priceAvg FROM shopitems");
		 $totalPurch = mysql_query("SELECT COUNT(*) FROM shoplog");
		 
		 //Note: The round() function will return 0 if no value is set :)
?>
<div class="box_right_title">Informaci&oacute;n General Tienda</div>
<table style="width: 100%;">
<tr>
<td><span class='blue_text'>Art&iacute;culos en Tienda</span></td><td><?php echo round(mysql_result($inShop,0));?></td>
</tr>
<tr>
    <td><span class='blue_text'>Compras Hoy</span></td><td><?php echo round(mysql_result($purchToday,0)); ?></td>
    <td><span class='blue_text'>Compras Totales</span></td><td><?php echo round(mysql_result($totalPurch,0)); ?></td>
</tr>
<tr>
    <td><span class='blue_text'>Coste medio</span></td><td><?php echo round(mysql_result($getAvg,0)); ?></td>
</tr>
</table>
<hr/>
<a href="?p=shop&s=add" class="content_hider">Añadir Art&iacute;culos</a>
<a href="?p=shop&s=manage" class="content_hider">Administrar Art&iacute;culos</a>
<a href="?p=shop&s=tools" class="content_hider">Herramientas</a>
<?php } ?>
