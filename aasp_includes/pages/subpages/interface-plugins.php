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
<?php $page = new page;
	  $server = new server; ?>
<div class="box_right_title">Plugins</div>
<table>
	<tr>
    	<th>Nombre</th>
        <th>Descripci&oacute;n</th>
        <th>Autor</th>
        <th>Creado</th>
        <th>Estado</th>
    </tr>
<?php
	$bad = array('.','..','index.html');
	
	$folder = scandir('../plugins/');
	foreach($folder as $folderName)
	{
		if(!in_array($folderName,$bad))
		{
			if(file_exists('../plugins/'.$folderName.'/info.php'))
			{
				include('../plugins/'.$folderName.'/info.php');
				?> <tr class="center" onclick="window.location='?p=interface&s=viewplugin&plugin=<?php echo $folderName; ?>'"> <?php
					echo '<td><a href="?p=interface&s=viewplugin&plugin='.$folderName.'">'.$title.'</a></td>';
					echo '<td>'.substr($desc,0,40).'</td>';
					echo '<td>'.$author.'</td>';
					echo '<td>'.$created.'</td>';
					$server->selectDB('webdb');
					$chk = mysql_query("SELECT COUNT(*) FROM disabled_plugins WHERE foldername='".mysql_real_escape_string($folderName)."'");
					if(mysql_result($chk,0)>0)
						echo '<td>Activado</td>';
					else
						echo '<td>Desactivado</td>';
				echo '</tr>';
			}
		}
	}
	
	if($count==0)
	{
		$_SESSION['loaded_plugins'] = NULL;
	}
	else
	{
		$_SESSION['loaded_plugins'] = $loaded_plugins;
	}
?>
</table>