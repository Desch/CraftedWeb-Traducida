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
<?php account::isNotLoggedIn(); 
if (isset($_POST['save'])) {
	account::changeEmail($_POST['email'],$_POST['current_pass']);
}
?>
<div class='box_two_title'>Change Email</div>
<form action="?p=settings" method="post">
<table width="70%">
       <tr>
           <td>Email adress:</td> 
           <td><input type="text" name="email" value="<?php echo account::getEmail($_SESSION['cw_user']); ?>"></td>
       </tr>
       <tr>
           <td></td> 
           <td><hr/></td>
       </tr>
       <tr>
           <td>Enter your current password:</td> 
           <td><input type="password" name="current_pass"></td>
       </tr>
       
       <tr>
           <td></td> 
           <td><input type="submit" value="Save" name="save"></td>
       </tr>
</table>
</form>