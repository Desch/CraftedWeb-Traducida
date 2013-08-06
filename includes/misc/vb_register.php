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
 

function qpc_post($varname){
	return trim(stripslashes((get_magic_quotes_gpc()) ? $_POST[$varname] : addslashes($_POST[$varname])));
}

define('THIS_SCRIPT', 'vb_register.php');
$root_path = '../..'.$GLOBALS['forum']['forum_path'];


require_once($root_path.'global.php');
require_once($root_path.'/includes/class_dm.php');
require_once($root_path.'/includes/class_dm_user.php');

$userdm = new vB_DataManager_User($vbulletin, ERRTYPE_ARRAY);

$userdm->set('username', qpc_post('username'));
$userdm->set('email', qpc_post('email'));
$userdm->set('password', qpc_post('password'));
$userdm->set('usergroupid',qpc_post('usergroupid'));
$userdm->set('ipaddress', qpc_post('ipaddress'));
$userdm->set('referrerid', qpc_post('referrername'));
$userdm->set('timezoneoffset', qpc_post('timezoneoffset'));
$userdm->set_bitfield('options', 'adminemail', intval(qpc_post('adminemail')));
$userdm->set_bitfield('options', 'showemail', intval(qpc_post('showemail')));
$firstname=qpc_post('firstname');
$lastname=qpc_post('lastname');
$dst_setting = intval(qpc_post('dst'));

switch ($dst_setting)
{
	case 0:
	case 1:
		$userdm->set_bitfield('options', 'dstonoff', $dst_setting);
	break;
	case 2:
		$userdm->set_bitfield('options', 'dstauto', 1);
	break;
}

#If there are errors (eMail not set, eMail banned, Username taken, etc.) you can check for errors using
if (count($userdm->errors)) 
{
	for($i=0; $ierrors; $i++) 
	{
		print "ERROR{$i}:{$userdm->errors[$i]}n";
	}
} 
else 
{
	# If everything is OK
	$newuserid = $userdm->save();
	echo "1";
}

?>