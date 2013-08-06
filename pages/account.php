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
 
?>
<?php 
account::isNotLoggedIn();
?>
<div class='box_two_title'>Mi Cuenta</div>
<table style="width: 100%; margin-top: -15px;">
<tr>
<td><span class='blue_text'>Nombre Cuenta</span></td><td> <?php echo ucfirst(strtolower($_SESSION['cw_user']));?></td>
<td><span class='blue_text'>Registrado</span></td><td><?php echo account::getJoindate($_SESSION['cw_user']); ?></td>
</tr>
<tr>
    <td><span class='blue_text'>Email</span></td><td><?php echo account::getEmail($_SESSION['cw_user']);?></td>
    <td><span class='blue_text'>Puntos de Votaciones</span></td><td><?php echo account::loadVP($_SESSION['cw_user']); ?></td>
</tr>
<tr>
    <td><span class='blue_text'>Estado de Cuenta</span></td><td><?php echo account::checkBanStatus($_SESSION['cw_user']);?></td>
    <td><span class='blue_text'><?php echo $GLOBALS['donation']['coins_name']; ?></span></td><td><?php echo account::loadDP($_SESSION['cw_user']); ?></td>
</tr>
<br/>
</table>
 </div>
<div class='box_two'>      
      <div class='box_two_title'>Servicios</div>
     <div id="account_func_placeholder">
			  <div class='account_func' onclick="acct_services('character')">Servicios de Personajes</div>
			  <div class='account_func' onclick="acct_services('account')">Servicios de Cuenta</div>        
			  <div class='account_func' onclick="acct_services('settings')">Configuración</div>
              
			  <div class='hidden_content' id='character'>
                 <?php if($GLOBALS['service']['unstuck']['status']=='TRUE') { ?>
                     <div class='service' onclick='redirect("?p=unstuck")'>
                     <div class='service_icon'><img src='styles/global/images/icons/character_migration.png'></div>
                     <h3>Desbloqueo</h3>
                     <div class='service_desc'>Desbloquear Personaje.</div>
                     </div>
                 <?php } ?>
                 
                 <?php if($GLOBALS['service']['revive']['status']=='TRUE') { ?>
                     <div class='service' onclick='redirect("?p=revive")'>
                     <div class='service_icon'><img src='styles/global/images/icons/revive.png'></div>
                     <h3>Revivir</h3>
                     <div class='service_desc'>Revivir Personaje.</div> 
                     </div>
                 <?php } ?>
                 
                 <?php if($GLOBALS['service']['teleport']['status']=='TRUE') { ?>
                     <div class='service' onclick='redirect("?p=teleport")'>
                     <div class='service_icon'><img src='styles/global/images/icons/transfer.png'></div>
                     <h3>Teletransporte</h3>
                     <div class='service_desc'>Teletransportar Personaje.</div> 
                     </div>
                 <?php } ?>
                 
                 <?php if($GLOBALS['service']['appearance']['status']=='TRUE') { ?>
                     <div class='service' onclick='redirect("?p=service&s=appearance")'>
                     <div class='service_icon'><img src='styles/global/images/icons/appearance.png'></div>
                     <h3>Cambiar Apariencia</h3>
                     <div class='service_desc'>Personalizar apariencia del personaje (Incluido cambiar nombre opcional).</div> 
                     </div>
                 <?php } ?>
                 
                 <?php if($GLOBALS['service']['race']['status']=='TRUE') { ?>
                     <div class='service' onclick='redirect("?p=service&s=race")'>
                     <div class='service_icon'><img src='styles/global/images/icons/race_change.png'></div>
                     <h3>Cambiar Raza</h3>
                     <div class='service_desc'>Cambiar la raza del personaje (Dentro de la facción actual).</div> 
                     </div>
                 <?php } ?>
                 
                 <?php if($GLOBALS['service']['name']['status']=='TRUE') { ?>
                     <div class='service' onclick='redirect("?p=service&s=name")'>
                     <div class='service_icon'><img src='styles/global/images/icons/name_change.png'></div>
                     <h3>Cambiar Nombre</h3>
                     <div class='service_desc'>Cambiar nombre del personaje.</div> 
                     </div>
                 <?php } ?>
                 
                 <?php if($GLOBALS['service']['faction']['status']=='TRUE') { ?>
                     <div class='service' onclick='redirect("?p=service&s=faction")'>
                     <div class='service_icon'><img src='styles/global/images/icons/factions.png'></div>
                     <h3>Cambiar Facción</h3>
                     <div class='service_desc'>Cambiar la facci&oacute;n del personaje (De Horda a Alianza y de Alianza a Horda)</div> 
                     </div>
                 <?php } ?>
              </div>
              <div class='hidden_content' id='account'>
              
                     <div class='service' onclick='redirect("?p=vote")'>
                     <div class='service_icon'><img src='styles/global/images/icons/character_migration.png'></div>
                     <h3>Votar</h3>
                     <div class='service_desc'>Votar & recibir Recompensas.</div> 
                     </div>
                 
                     <div class='service' onclick='redirect("?p=donate")'>
                     <div class='service_icon'><img src='styles/global/images/icons/visa.png'></div>
                     <h3>Donar</h3>
                     <div class='service_desc'>Donar & recibir Recompensas.</div> 
                     </div>
                 
                     <div class='service' onclick='redirect("?p=voteshop")'>
                     <div class='service_icon'><img src='styles/global/images/icons/raf.png'></div>
                     <h3>Tienda Votaciones</h3>
                     <div class='service_desc'>Reclama tu Recompensa!</div> 
                     </div>
                 
                     <div class='service' onclick='redirect("?p=donateshop")'>
                     <div class='service_icon'><img src='styles/global/images/icons/raf.png'></div>
                     <h3>Tienda Donaciones</h3>
                     <div class='service_desc'>Reclama tu Recompensa!</div> 
                     </div>
              
              </div>
              
              <div class='hidden_content' id='settings'>
              
                     <div class='service' onclick='redirect("?p=changepass")'>
                     <div class='service_icon'><img src='styles/global/images/icons/arena.png'></div>
                     <h3>Cambiar Contraseña</h3>
                     <div class='service_desc'>Cambiar la contraseña de tu cuenta.</div>
                     </div>
                 
                     <div class='service' onclick='redirect("?p=settings")'>
                     <div class='service_icon'><img src='styles/global/images/icons/ptr.png'></div>
                     <h3>Cambiar Email</h3>
                     <div class='service_desc'>Cambiar la cuenta de Email asociada a tu cuenta.</div> 
                     </div>
              
              </div>
      </div>