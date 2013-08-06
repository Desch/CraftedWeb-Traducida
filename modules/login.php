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
  if (!isset($_SESSION['cw_user'])) 
	  { 
		  if (isset($_POST['login'])) 
			account::logIn($_POST['login_username'],$_POST['login_password'],$_SERVER['REQUEST_URI'],$_POST['login_remember']);
?>
     <div class="box_one">
	 <div class="box_one_title">Gestión Cuenta</div> 
         <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
         <fieldset style="border: none; margin: 0; padding: 0;">
             <input type="text" placeholder="Username..." name="login_username" class="login_input" /><br/>
             <input type="password" placeholder="Password..." name="login_password" class="login_input" style="margin-top: -1px;" /><br/>
             <input type="submit" value="Log In" name="login" style="margin-top: 4px;" /> 
             <input type="checkbox" name="login_remember" checked="checked"/> Recordarme
         </fieldset>    
         </form> 
     <br/>
     <table width="100%">
            <tr>
                <td><a href="?p=register">Crear Cuenta</a></td>
                <td align="right"><a href="?p=forgotpw">Has olvidado tu Contraseña?</a></td>
            </tr>
     </table>
     </div>
<?php } ?>
