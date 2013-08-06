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
<?php account::isNotLoggedIn(); ?>
<div class='box_two_title'>Donar</div>
Introduzca el valor deseado para donar, y a continuación haga click en el boton.<table align="center">
       <tr>
           <td align="center"><img src="styles/global/images/paypal.png"></td>
       </tr>
       <tr>
           <td>
               <?php
			   if($GLOBALS['donation']['donationType']==1)
			   {
			   ?>
               	<input type="text" onKeyUp="changeAmount(this,'open')" value="Introduzca el valor de la donación..." onclick="this.value=''">
               <?php } 
			   elseif($GLOBALS['donation']['donationType']==2)
			   {
				   echo '<select onchange="changeAmount(this,\'list\')">';
				   for ($row = 0; $row < count($GLOBALS['donationList']); $row++)
					{
							echo "<option value='".$GLOBALS['donationList'][$row][1]."'>".$GLOBALS['donationList'][$row][0]."</option>";
					}
					echo '</select>'; 
			   }
			   ?>
           </td>
      </tr>
      <tr><td>
<center>
<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
          <input id="submit" type="image" src="styles/<?php echo $GLOBALS['template']['path']; ?>/images/donate.png" 
         		 border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
          <input type="hidden" name="notify_url" value="<?php echo $GLOBALS['website_domain']; ?>includes/misc/paypal_trigger.php" />
          <input type="hidden" name="add" value="1" />
          <input type="hidden" name="cmd" value="_xclick" />
          <input type="hidden" name="business" value="<?php echo $GLOBALS['donation']['paypal_email']; ?>" />
          <input type="hidden" id="item_name" name="item_name" value="<?php echo $GLOBALS['donation']['coins_name']; ?>" />
          <input type="hidden" id="item_number" name="item_number" value="" />
          <!-- ATTENTION HACKERS: Don't try changing anything here, it won't work, you won't receive a reward, and we'll keep your money. -->
          <input type="hidden" id="amount" name="amount" value="<?php
          if($GLOBALS['donation']['donationType']==2) 
		     echo $GLOBALS['donationList'][0][2]; 
		  else
		    echo 1;	 
		  ?>" />
          <input type="hidden" name="no_shipping" value="1" />
          <input type="hidden" name="no_note" value="1" />
          <input type="hidden" name="currency_code" value="<?php echo $GLOBALS['donation']['currency']; ?>" />
          <input type="hidden" name="lc" value="US" />
          <input type="hidden" name="bn" value="PP-ShopCartBF" />
          <input type="hidden" name="custom" value="<?php echo account::getAccountID($_SESSION['cw_user']); ?>">
         </form>
         </td>
     </tr>
     <?php 
	 	include("documents/refundpolicy.php"); 
		if($rp_enable == true)
		{
	 	?>
     <tr>
         <td align="center">
         	<br/>Por favor lea nuestra  <a href="#refundpolicy" onclick="viewRefundPolicy()">Política de devoluciones</a> antes de donar.
         <td>
     </tr>
     <?php } ?>
  </table>
</center>