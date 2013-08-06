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
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
</head>

<div class='box_two_title'>Login</div>
Para ver esta pagina debe entrar en el sitio. <hr/>
<?php
if(isset($_POST['x_login']))
	account::logIn($_POST['x_username'],$_POST['x_password'],$_POST['x_redirect'],$_POST['x_remember']);
?>
<form action="?p=login" method="post">
<table>
       <tr>
           <td>Usuario:</td>
           <td><input type="text" name="x_username"></td>
       </tr>
       <tr>
           <td>Contraseña:</td>
           <td><input type="password" name="x_password"></td>
       </tr>
       <tr>
           <td></td>
           <td><input type="checkbox" name="x_remember"> Recordarme</td>
       </tr>
       <tr>
           <td><input type="hidden" value="<?php echo $_GET['r']; ?>" name="x_redirect"></td>
           <td><input type="submit" value="Entrar" name="x_login"></td>
       </tr>
</table>
</form>