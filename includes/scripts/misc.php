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

if(isset($_POST['element']) &&$_POST['element'] =='vote') 
{
   echo 'Puntos de Votaciones: '.account::loadVP($_POST['account']);
}
#################
elseif(isset($_POST['element']) && $_POST['element']=='donate') 
{
   echo $GLOBALS['donation']['coins_name'].': '.account::loadDP($_POST['account']);
}
#################
if(isset($_POST['action']) && $_POST['action']=='removeComment') 
{
   connect::selectDB('webdb');
   mysql_query("DELETE FROM news_comments WHERE id='".(int)$_POST['id']."'");
}
#################
if(isset($_POST['getTos'])) 
{
   include("../../documents/termsofservice.php");
   echo $tos_message;
}
#################
if(isset($_POST['getRefundPolicy'])) 
{
   include("../../documents/refundpolicy.php");
   echo $rp_message;
}
#################
if(isset($_POST['serverStatus'])) 
{
   echo '<div class="box_one_title">Estado del Reino</div>';
		 $num = 0;
		 foreach ($GLOBALS['realms'] as $k => $v) {
			 if ($num != 0) { echo "<hr/>"; }
			   server::serverStatus($k);
			   $num++;
		   }
		   if ($num == 0) {
			 buildError("<b>No se encontraron Reinos: </b> Por favor, configure su base de datos y agregue el reino(s)!",NULL);  
			 echo "No se encontraron Reinos.";
		   }
		unset($num);
?>
<hr/>
<span id="realmlist">set realmlist <?php echo $GLOBALS['connection']['realmlist']; ?></span>
</div>
<?php   
}
#################
if(isset($_POST['convertDonationList']))
{
	for ($row = 0; $row < count($GLOBALS['donationList']); $row++)
		{
				$value = (int)$_POST['convertDonationList'];
				if($value == $GLOBALS['donationList'][$row][1])
				{
					echo $GLOBALS['donationList'][$row][2];
					exit();
				}
		}
}

?>