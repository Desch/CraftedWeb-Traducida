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
$account = new account;

$per_page = 20;
								   
$pages_query = mysql_query("SELECT COUNT(*) FROM admin_log");
$pages = ceil(mysql_result($pages_query,0) / $per_page );

$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_page;

if(isset($_SESSION['cw_staff']) && !isset($_SESSION['cw_admin']))
{
	if($_SESSION['cw_staff_level'] < $GLOBALS['adminPanel_minlvl'])
		exit('Ey! No deberias estar aquí!');
}
?>

<div class="box_right_title">Admin log</div>
<table class="center">
       <tr><th>Día</th><th>Usuario</th><th>Acción</th><th>IP</th></tr>
       <?php
					        $server->selectDB('webdb');
							$result = mysql_query("SELECT * FROM admin_log ORDER BY id DESC LIMIT ".$start.",".$per_page);
							while($row = mysql_fetch_assoc($result)) { ?>
								<tr>
                                    <td><?php echo date("Y-m-d H:i:s",$row['timestamp']); ?></td>
                                    <td><?php echo $account->getAccName($row['account']); ?></td>
                                    <td><?php echo $row['action']; ?></td>
                                    <td><?php echo $row['ip']; ?></td>
                                </tr>
							<?php }
	   ?>
</table>
<hr/>
                        <?php
						    if($pages>=1 && $page <= $pages) 
							{
								if($page>1)
								{
								   $prev = $page-1;
								   echo '<a href="?p=logs&s=admin&page='.$prev.'" title="Previous">Anterior</a> &nbsp;';
								}
								for($x=1; $x<=$pages; $x++)
								{
									if($page == $x) 
									   echo '<a href="?p=logs&s=admin&page='.$x.'" title="Page '.$x.'"><b>'.$x.'</b></a> ';
									else   
									   echo '<a href="?p=logs&s=admin&page='.$x.'" title="Page '.$x.'">'.$x.'</a> ';
								}
								
								if($page<$x - 1)
								{
								   $next = $page+1;
								   echo '&nbsp; <a href="?p=logs&s=admin&page='.$next.'" title="Next">Siguiente</a> &nbsp; &nbsp;';
								}
							}
						?>
