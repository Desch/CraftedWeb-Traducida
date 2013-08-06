<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
</head>
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
 
##############
##  Account functions goes here
##############

class account {
	
	###############################
	####### Log in method
	###############################
	public static function logIn($username,$password,$last_page,$remember) 
	{
		if (!isset($username) || !isset($password) || $username=="Usuario..." || $password=="Password...") 
			echo '<span class="red_text">Por favor, introduzca ambos cambos.</span>'; 
		else 
		{
			$username = mysql_real_escape_string(trim(strtoupper($username)));
			$password = mysql_real_escape_string(trim(strtoupper($password)));
			
			connect::selectDB('logondb');
			$checkForAccount = mysql_query("SELECT COUNT(id) FROM account WHERE username='".$username."'");
			if (mysql_result($checkForAccount,0)==0) 
				echo '<span class="red_text">Usuario Invalido.</span>';	
			else 
			{
				if($remember!=835727313) 
					$password = sha1("".$username.":".$password.""); 
					
				$result = mysql_query("SELECT id FROM account WHERE username='".$username."' AND sha_pass_hash='".$password."'");
				if (mysql_num_rows($result)==0) 
					echo '<span class="red_text">Contraseña Erronea.</span>';
				else 
				{
					if($remember=='on') 
						setcookie("cw_rememberMe", $username.' * '.$password, time()+30758400);
						//Set "remember me" cookie. Expires in 1 year.
						 
					$id = mysql_fetch_assoc($result); 
					$id = $id['id'];
					
					self::GMLogin($username);
					$_SESSION['cw_user']=ucfirst(strtolower($username));
					$_SESSION['cw_user_id']=$id;
					
					connect::selectDB('webdb');
					$count = mysql_query("SELECT COUNT(*) FROM account_data WHERE id='".$id."'");
					if(mysql_result($count,0)==0)
						mysql_query("INSERT INTO account_data VALUES('".$id."','0','0')");
					
					if(!empty($last_page))
					   header("Location: ".$last_page);
					else
					   header("Location: index.php"); 
				}
			}
			
		}
		
	}
	
	public static function loadUserData() 
	{
		//Unused function
		$user_info = array();
		
		connect::selectDB('logondb');
		$account_info = mysql_query("SELECT id, username, email, joindate, locked, last_ip, expansion FROM account 
		WHERE username='".$_SESSION['cw_user']."'");
		while($row = mysql_fetch_array($account_info)) 
		{
			$user_info[] = $row;
		}
		
	    return $user_info;
	}
	
	###############################
	####### Log out method
	###############################
	public static function logOut($last_page) 
	{
		session_destroy();
		setcookie('cw_rememberMe', '', time()-30758400);
		if (empty($last_page)) 
		{
			header('Location: ?p=home"');
			exit();
		}
		header('Location: '.$last_page);
		exit();
	}
	
	
	###############################
	####### Registration method
	###############################
	public function register($username,$email,$password,$repeat_password,$captcha,$raf) 
	{
		$errors = array();
		
		if (empty($username))  
			$errors[] = 'Introduzca un Usuario.';
			
		if (empty($email)) 
			$errors[] = 'Introduzca un Email valido.';
			
		if (empty($password)) 
			$errors[] = 'Introduzca la Contraseña.';
			
		if (empty($repeat_password)) 
			$errors[] = 'Repita la Contraseña.';
			
		if($username==$password) 
			$errors[] = 'Su Contraseña no puede ser igual al Usuario!';
			
		else 
		{
			session_start();
			if($GLOBALS['registration']['captcha']==TRUE) 
			{ 
				if($captcha!=$_SESSION['captcha_numero']) 
					$errors[] = 'El captcha es incorrecto!';
			}
			
			if (strlen($username)>$GLOBALS['registration']['userMaxLength'] || strlen($username)<$GLOBALS['registration']['userMinLength']) 
				$errors[] = 'El nombre de usuario debe estar entre '.$GLOBALS['registration']['userMinLength'].' y  '.$GLOBALS['registration']['userMaxLength'].' letras.';
				
			if (strlen($password)>$GLOBALS['registration']['passMaxLength'] || strlen($password)<$GLOBALS['registration']['passMinLength']) 
				$errors[] = 'La contraseña debe estar entre '.$GLOBALS['registration']['passMinLength'].' y '.$GLOBALS['registration']['passMaxLength'].' letras.';
				
			if ($GLOBALS['registration']['validateEmail']==true) 
			{
			    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
				       $errors[] = 'Introduzca un email valido.';
			}
			
		}
		$username_clean = mysql_real_escape_string(trim($username));
		$password_clean = mysql_real_escape_string(trim($password));
		$username = mysql_real_escape_string(trim(strtoupper(strip_tags($username))));
		$email = mysql_real_escape_string(trim(strip_tags($email)));
		$password = mysql_real_escape_string(trim(strtoupper(strip_tags($password))));
		$repeat_password = trim(strtoupper($repeat_password));
		$raf = (int)$raf;
		
		
		connect::selectDB('logondb');
		//Check for existing user
		$result = mysql_query("SELECT COUNT(id) FROM account WHERE username='".$username."'");
		if (mysql_result($result,0)>0) 
			$errors[] = 'Ese Usuario ya existe!';
		
		if ($password != $repeat_password) 
			$errors[] = 'Las contraseñas no coinciden!';
		
		if (!empty($errors)) 
		{
			//errors found.
			echo "<p><h4>Han ocurrido los siguientes errores:</h4>";
				foreach($errors as $error) 
				{
					echo  "<strong>*", $error ,"</strong><br/>";
				}
			echo "</p>";
			exit();
		} 
		else 
		{
			$password = sha1("".$username.":".$password."");
			mysql_query("INSERT INTO account (username,email,sha_pass_hash,joindate,expansion,recruiter) 
			VALUES('".$username."','".$email."','".$password."','".date("Y-m-d H:i:s")."','".$GLOBALS['core_expansion']."','".$raf."') "); 
			
			$getID = mysql_query("SELECT id FROM account WHERE username='".$username."'");
			$row = mysql_fetch_assoc($getID);
			
			connect::selectDB('webdb');
			mysql_query("INSERT INTO account_data VALUES('".$row['id']."','','')"); 
			
			$result = mysql_query("SELECT id FROM account WHERE username='".$username_clean."'");	 
			$id = mysql_fetch_assoc($result); 
			$id = $id['id'];
					
			self::GMLogin($username_clean);
			$_SESSION['cw_user']=ucfirst(strtolower($username_clean));
			$_SESSION['cw_user_id']=$id;
			
			account::forumRegister($username_clean,$password_clean,$email);
		}

	}
	
	
	public static function forumRegister($username,$password,$email) 
	{
	 date_default_timezone_set($GLOBALS['timezone']);
	 
     global $phpbb_root_path, $phpEx, $user, $db, $config, $cache, $template;
	 if($GLOBALS['forum']['type']=='phpbb' && $GLOBALS['forum']['autoAccountCreate']==TRUE) 
	 {
		     ////////PHPBB INTEGRATION//////////////
			define('IN_PHPBB', true);
			define('ROOT_PATH', '../..'.$GLOBALS['forum']['forum_path']);

			$phpEx = "php";
			$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : ROOT_PATH;
			
			if(file_exists($phpbb_root_path . 'common.' . $phpEx) && file_exists($phpbb_root_path . 'includes/functions_user.' . $phpEx)) 
			{
			include($phpbb_root_path.'common.'.$phpEx);
			
			include($phpbb_root_path.'includes/functions_user.'.$phpEx);
			
			$arrTime = getdate();
			$unixTime = strtotime($arrTime['year']."-".$arrTime['mon'].'-'.$arrTime['mday']." ".$arrTime['hours'].":".
								  $arrTime['minutes'].":".$arrTime['seconds']);

			$user_row = array(
				'username'              => $username,
				'user_password'         => phpbb_hash($password),
				'user_email'            => $email,
				'group_id'              => (int) 2,
				'user_timezone'         => (float) 0,
				'user_dst'              => "0",
				'user_lang'             => "en",
				'user_type'             => 0,
				'user_actkey'           => "",
				'user_ip'               => $_SERVER['REMOTE_HOST'],
				'user_regdate'          => $unixTime,
				'user_inactive_reason'  => 0,
				'user_inactive_time'    => 0
			);

			// All the information has been compiled, add the user
			// tables affected: users table, profile_fields_data table, groups table, and config table.
			$user_id = user_add($user_row);
			}
	  	}
	}
	
	###############################
	####### Check if a user is logged in method.
	###############################
	public static function isLoggedIn() 
	{
		if (isset($_SESSION['cw_user'])) 
			header("Location: ?p=account");
	}
	
	
	###############################
	####### Check if a user is NOT logged in method.
	###############################
	public static function isNotLoggedIn() 
	{
		if (!isset($_SESSION['cw_user'])) 
			header("Location: ?p=login&r=".$_SERVER['REQUEST_URI']);
	}
	
	public static function isNotGmLoggedIn() 
	{
		if (!isset($_SESSION['cw_gmlevel']))
			header("Location: ?p=home");
	}
	
	
	###############################
	####### Return ban status method.
	###############################
	public static function checkBanStatus($user) 
	{
		connect::selectDB('logondb');
		$acct_id = self::getAccountID($user);
		
		$result = mysql_query("SELECT bandate,unbandate,banreason FROM account_banned WHERE id='".$acct_id."' AND active=1");
		if (mysql_num_rows($result)>0) 
		{
			$row = mysql_fetch_assoc($result);
			if($row['bandate'] > $row['unbandate']) 
				$duration = 'Infinite';
			else 
			{
				$duration = $row['unbandate'] - $row['bandate'];
				$duration = ($duration / 60)/60;
				$duration = $duration.' hours';  
			}
				echo '<span class="yellow_text">Baneado<br/>
					  Motivo: '.$row['banreason'].'<br/>
					  Expiración: '.$duration.'</span>';
		} 
		else 
			echo '<b class="green_text">Activo</b>';
	}
	
	
	###############################
	####### Return account ID method.
	###############################
	public static function getAccountID($user) 
	{
		$user = mysql_real_escape_string($user);
		connect::selectDB('logondb');
		$result = mysql_query("SELECT id FROM account WHERE username='".$user."'");
		$row = mysql_fetch_assoc($result);
		return $row['id'];
	}
	
	public static function getAccountName($id) 
	{
		$id = (int)$id;
		connect::selectDB('logondb');
		$result = mysql_query("SELECT username FROM account WHERE id='".$id."'");
		$row = mysql_fetch_assoc($result);
		return $row['username'];
	}
	
	
	###############################
	####### "Remember me" method. Loads on page startup.
	###############################
	public function getRemember() 
	{
		if (isset($_COOKIE['cw_rememberMe']) && !isset($_SESSION['cw_user'])) {
			$account_data = explode("*", $_COOKIE['cw_rememberMe']);
			$this->logIn($account_data[0],$account_data[1],$_SERVER['REQUEST_URI'],835727313);
		}	
	}
	
	
	###############################
	####### Return account Vote Points method.
	###############################
	public static function loadVP($account_name) 
	{
		$acct_id = self::getAccountID($account_name);
		connect::selectDB('webdb');
		$result = mysql_query("SELECT vp FROM account_data WHERE id=".$acct_id);
		if (mysql_num_rows($result)==0) 
			return 0;
		else 
		{
			$row = mysql_fetch_assoc($result);
			return $row['vp'];
		}
	}
	
	
	public static function loadDP($account_name) 
	{
	    $acct_id = self::getAccountID($account_name);
		connect::selectDB('webdb');
		$result = mysql_query("SELECT dp FROM account_data WHERE id=".$acct_id);
		if (mysql_num_rows($result)==0) 
			return 0;
		else 
		{
			$row = mysql_fetch_assoc($result);
			return $row['dp'];
		}
	}
	
	
	
	###############################
	####### Return email method.
	###############################
	public static function getEmail($account_name) 
	{
		$account_name = mysql_real_escape_string($account_name);
		connect::selectDB('logondb');
		$result = mysql_query("SELECT email FROM account WHERE username='".$account_name."'");
		$row = mysql_fetch_assoc($result);
		return $row['email'];
	}
	
	
	###############################
	####### Return online status method.
	###############################
	public static function getOnlineStatus($account_name) 
	{
		$account_name = mysql_real_escape_string($account_name);
		connect::selectDB('logondb');
		$result = mysql_query("SELECT COUNT(online) FROM account WHERE username='".$account_name."' AND online=1");
		if (mysql_result($result,0)==0) 
			return '<b class="red_text">Offline</b>';
		else
			return '<b class="green_text">Online</b>';
	}
	
	
	###############################
	####### Return Join date method.
	###############################
	public static function getJoindate($account_name) 
	{
		$account_name = mysql_real_escape_string($account_name);
		connect::selectDB('logondb');
		$result = mysql_query("SELECT joindate FROM account WHERE username='".$account_name."'");
		$row = mysql_fetch_assoc($result);
		return $row['joindate'];
	}
	
	
	###############################
	####### Returns a GM session if the user is a GM with rank 2 and above.
	###############################
	public static function GMLogin($account_name) 
	{
		connect::selectDB('logondb');
		$acct_id = self::getAccountID($account_name);
		
		$result = mysql_query("SELECT gmlevel FROM account_access WHERE gmlevel > 2 AND id=".$acct_id);
		if(mysql_num_rows($result)>0) 
		{
			$row = mysql_fetch_assoc($result);
			$_SESSION['cw_gmlevel']=$row['gmlevel'];
		}
		
	}
	
	public static function getCharactersForShop($account_name) 
	{
		$acct_id = self::getAccountID($account_name);
		connect::selectDB('webdb');
		$getRealms = mysql_query("SELECT id,name FROM realms");
		while($row = mysql_fetch_assoc($getRealms)) 
		{
			connect::connectToRealmDB($row['id']);
			$result = mysql_query("SELECT name,guid FROM characters WHERE account='".$acct_id."'");
			if(mysql_num_rows($result)==0 && !isset($x))
			{
				$x = true;
			     echo '<option value="">No se encontraron Personajes!</option>';
			}
				  
			while($char = mysql_fetch_assoc($result)) 
			{
				echo '<option value="'.$char['guid'].'*'.$row['id'].'">'.$char['name'].' - '.$row['name'].'</option>';
			}
		}
	}
	
	
	public static function changeEmail($email,$current_pass) 
	{

		$errors = array();
		if (empty($current_pass)) 
			$errors[] = 'Por favor, introduzca su contraseña actual.'; 
		else 
		{
			if (empty($email)) 
				$errors[] = 'Por favor, introduzca un email valido.';
			
			connect::selectDB('logondb');
			$id = $_SESSION['cw_user_id'];
			$username = mysql_real_escape_string(trim(strtoupper($_SESSION['cw_user'])));
			$password = mysql_real_escape_string(trim(strtoupper($current_pass)));
			
			$password = sha1("".$username.":".$password."");

			$result = mysql_query("SELECT COUNT(id) FROM account WHERE id='".$id."' AND sha_pass_hash='".$password."'");
			if (mysql_result($result,0)==0) 
				$errors[] = 'La contraseña actual es erronea.';
			
			
			if ($GLOBALS['registration']['validateEmail']==true) 
			{
			    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
				    $errors[] = 'Introduzca un email valido.';
				 else 
					 mysql_query("UPDATE account SET email='".$email."' WHERE id='".$_SESSION['cw_user_id']."'");
			}
			
		}
		if(empty($errors)) 
			echo 'Se ha actualizado correctamente su cuenta.';
		else 
		{
			echo '<div class="news" style="padding: 5px;">
			<h4 class="red_text">Han ocurrido los siguientes errores:</h4>';
				   foreach($errors as $error) 
				   {
					 echo  '<strong class="yellow_text">*', $error ,'</strong><br/>';
				   }
			echo '</div>';
		}
	}
	
	
	
	//Used for the change password page.
	public static function changePass($old,$new,$new_repeat) 
	{
		$_POST['cur_pass']=mysql_real_escape_string(trim($old));
		$_POST['new_pass']=mysql_real_escape_string(trim($new));
		$_POST['new_pass_repeat']=mysql_real_escape_string(trim($new_repeat));
		
		//Check if all field values has been typed into
		if (!isset($_POST['cur_pass']) || !isset($_POST['new_pass']) || !isset($_POST['new_pass_repeat'])) 
			echo '<b class="red_text">Por favor, rellene todos los campos!</b>';
	    else 
		{
			//Check if new passwords match?
			if ($_POST['new_pass'] != $_POST['new_pass_repeat'])
				echo '<b class="red_text">Las nuevas contraseñas no coinciden!</b>';
			else 
			{
			  if (strlen($_POST['new_pass']) < $GLOBALS['registration']['passMinLength'] || 
			      strlen($_POST['new_pass']) > $GLOBALS['registration']['passMaxLength'])
				  echo '<b class="red_text">La contraseña debe tener entre 6 y 32 letras.</b>';
			  else 
			  {
				//Lets check if the old password is correct!
				$username = strtoupper(mysql_real_escape_string($_SESSION['cw_user']));
				connect::selectDB('logondb');
				$getPass = mysql_query("SELECT `sha_pass_hash` FROM `account` WHERE `id`='".$_SESSION['cw_user_id']."'");
				$row = mysql_fetch_assoc($getPass);
				$thePass = $row['sha_pass_hash'];
				
				$pass = mysql_real_escape_string(strtoupper($_POST['cur_pass']));
				$pass_hash = strtoupper(sha1($username.':'.$pass));
				
				$new_pass = mysql_real_escape_string(strtoupper($_POST['new_pass']));
				$new_pass_hash = sha1($username.':'.$new_pass);
				
				if ($thePass != $pass_hash) 
					echo '<b class="red_text">La antigua contraseña no es correcta!</b>';
				else 
				{
					//success, change password
					echo 'Su contraseña se ha cambiado!';
					mysql_query("UPDATE account SET sha_pass_hash='".$new_pass_hash."' WHERE id='".$_SESSION['cw_user_id']."'");
					mysql_query("UPDATE account SET v='0' AND s='0' WHERE username='".$username."'");
				}
			}
		  }
		}
	}
	
	public static function changePassword($account_name,$password) 
	{
			$username = mysql_real_escape_string(strtoupper($account_name));
			$pass = mysql_real_escape_string(strtoupper($password));
			$pass_hash = sha1($username.':'.$pass);
			
			connect::selectDB('logondb');
			mysql_query("UPDATE `account` SET `sha_pass_hash`='$pass_hash' WHERE `id`='".$_SESSION['cw_user_id']."'");
			mysql_query("UPDATE `account` SET `v`='0' AND `s`='0' WHERE id='".$_SESSION['cw_user_id']."'");
			
			account::logThis("Changed password","passwordchange",NULL);
	}
	
	public static function forgotPW($account_name, $account_email) 
	{
		$account_name = mysql_real_escape_string($account_name);
		$account_email = mysql_real_escape_string($account_email);
		
		if (empty($account_name) || empty($account_email)) 
			echo '<b class="red_text">Por favor, introduzca ambos campos.</b>';
		else 
		{
			connect::selectDB('logondb');
			$result = mysql_query("SELECT COUNT('id') FROM account 
								   WHERE username='".$account_name."' AND email='".$account_email."'");
			
			if (mysql_result($result,0)==0) 
				echo '<b class="red_text">El usuario o email no es correcto.</b>';
			else 
			{
				//Success, lets send an email & add the forgotpw thingy.
				$code = RandomString();
				website::sendEmail($account_email,$GLOBALS['default_email'],'Forgot Password',"
				Hola, aquí estamos. <br/><br/>
				Se ha pedido restablecer la contraseña para la cuenta  ".$account_name." <br/>
				Si desea restablecer su contraseña, haga click en el siguiente enlace: <br/>
				<a href='".$GLOBALS['website_domain']."?p=forgotpw&code=".$code."&account=".account::getAccountID($account_name)."'>
				".$GLOBALS['website_domain']."?p=forgotpw&code=".$code."&account=".account::getAccountID($account_name)."</a>
				
				<br/><br/>
				
				Si no lo ha solicitado, simplemente ignore este mensaje.<br/><br/>
				Saludos. La Administración");
				$account_id = self::getAccountID($account_name);
				connect::selectDB('webdb');
				
				mysql_query("DELETE FROM password_reset WHERE account_id='".$account_id."'");
				mysql_query("INSERT INTO password_reset (code,account_id)
				VALUES ('".$code."','".$account_id."')");
				echo "Se ha enviado un enlace para restablecer su contraseña a la direccion de correo especificada. 
					  Si ha tratado de enviar otras solicitudes para restablecer su contraseña antes de esto, no va a funcionar. <br/>";
				}	
			}	
		}
	
		public static function hasVP($account_name,$points) 
		{
			$points = (int)$points;
			$account_id = self::getAccountID($account_name);
			connect::selectDB('webdb');
			$result = mysql_query("SELECT COUNT('id') FROM account_data WHERE vp >= '".$points."' AND id='".$account_id."'");
			
			if (mysql_result($result,0)==0) 
				return FALSE;
			else
				return TRUE;
		}
		
		public static function hasDP($account_name,$points) 
		{
			$points = (int)$points;
			$account_id = self::getAccountID($account_name);
			connect::selectDB('webdb');
			$result = mysql_query("SELECT COUNT('id') FROM account_data WHERE dp >= '".$points."' AND id='".$account_id."'");
			
			if (mysql_result($result,0)==0)
				return FALSE;
			else
				return TRUE;
		}
		
		
		public static function deductVP($account_id,$points) 
		{
			$points = (int)$points;
			$account_id = (int)$account_id;
			connect::selectDB('webdb');
            
			mysql_query("UPDATE account_data SET vp=vp - ".$points." WHERE id='".$account_id."'");
		}
		
		public static function deductDP($account_id,$points) 
		{
			$points = (int)$points;
			$account_id = (int)$account_id;
			connect::selectDB('webdb');
            
			mysql_query("UPDATE account_data SET dp=dp - ".$points." WHERE id='".$account_id."'");
		}
		
		public static function addDP($account_id,$points)
		{
			$account_id = (int)$account_id;
			$points = (int)$points;
			connect::selectDB('webdb');
			
			mysql_query("UPDATE account_data SET dp=dp + ".$points." WHERE id='".$account_id."'");
		}
		
		public static function addVP($account_id,$points)
		{
			$account_id = (int)$account_id;
			$points = (int)$points;
			connect::selectDB('webdb');
			
			mysql_query("UPDATE account_data SET dp=dp + ".$points." WHERE id='".$account_id."'");
		}
		
		public static function getAccountIDFromCharId($char_id,$realm_id) 
		{
			$char_id = (int)$char_id;
			$realm_id = (int)$realm_id;
			connect::selectDB('webdb');
			connect::connectToRealmDB($realm_id);
			
			$result = mysql_query("SELECT account FROM characters WHERE guid='".$char_id."'");
			$row = mysql_fetch_assoc($result);
			return $row['account'];
		}
		
		
		public static function isGM($account_name) 
		{
	         $account_id = self::getAccountID($account_name);
			 $result = mysql_query("SELECT COUNT(id) FROM account_access WHERE id='".$account_id."' AND gmlevel >= 1");
			 if (mysql_result($result,0)>0)
				 return TRUE;
			 else
				 return FALSE;
		}
		
		public static function logThis($desc,$service,$realmid)
		{
			$desc = mysql_real_escape_string($desc);
			$realmid = (int)$realmid;
			$service = mysql_real_escape_string($service);
			$account = (int)$_SESSION['cw_user_id'];
			
			connect::selectDB('webdb');
			mysql_query("INSERT INTO user_log VALUES('','".$account."','".$service."','".time()."','".$_SERVER['REMOTE_ADDR']."','".$realmid."','".$desc."')");
	}
}
?>