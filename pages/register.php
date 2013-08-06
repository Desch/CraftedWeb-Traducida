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
<div class='box_two_title'>Register</div>
It's free, join us today! <hr/>
<?php 
account::isLoggedIn();
if (isset($_POST['register'])) {
	account::register($_POST['username'],$_POST['email'],$_POST['password'],$_POST['password_repeat'],$_POST['referer'],$_POST['captcha']);
} 
?>
<input type="hidden" value="<?php echo $_GET['id']; ?>" id="referer" />
<table width="80%">
        <tr>
             <td align="right">Username:</td> 
             <td><input type="text" id="username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" onkeyup="checkUsername()"/>
             <br/><span id="username_check" style="display:none;"></span></td>
        </tr>
        <tr>
             <td align="right">Email:</td> 
             <td><input type="text"  id="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"/></td>
        </tr>
         <tr>
             <td align="right">Password:</td> 
             <td><input type="password"  id="password" /></td>
        </tr>
        <tr>
             <td align="right">Repeat password:</td> 
             <td><input type="password"  id="password_repeat" /></td>
        </tr>
        <?php
		if($GLOBALS['registration']['captcha']==TRUE) { 
			$_SESSION['captcha_numero']= rand(0000,9999);
		?>
			<tr>
                <td align="right"></td>
                <td><img src="includes/misc/captcha.php" /></td>
            </tr>
            <tr> 
                <td align="right">Captcha:</td>
                <td><input type="text" id="captcha" /></td>
            </tr>
		<?php }
		?>
        <tr>
        	<td></td>
            <td><hr/></td>
        </tr>
        
        <tr>
            <td></td>
            <td>
          		<input type="submit" value="Register" onclick="register(<?php if($GLOBALS['registration']['captcha']==TRUE)  echo 1;  else  echo 0; ?>)" 
                id="register"/> 
            <?php 
			include("documents/termsofservice.php"); 
			if($tos_enable == true)
			{
			?>
            <br/>By registering, you accept our <a href="#" onclick="viewTos()">Terms of Service</a>
            <?php } ?>
        </tr>
 </table>
 <script type="text/javascript">
 	document.onkeydown = function(event) 
	{
		var key_press = String.fromCharCode(event.keyCode);
		var key_code = event.keyCode;
		if(key_code == 13)
			{
				register(<?php if($GLOBALS['registration']['captcha']==TRUE)  echo 1;  else  echo 0; ?>)
			}
	}
 </script>
 
