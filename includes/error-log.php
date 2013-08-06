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
define('INIT_SITE', TRUE);
require('configuration.php'); 

if($GLOBALS['useDebug']==false)
	exit();
?>

<h2>Error log</h2>

<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=clear" title="Clear the entire log">Clear log</a>
<hr/>

<?php
if (isset($_GET['action']) && $_GET['action']=='clear') 
{
	$errFile = '../error.log';
	$fh = fopen($errFile, 'w') or die("No se puede abrir el archivo");
	$stringData = "";
	fwrite($fh, $stringData);
	fclose($fh);
  ?>
  	<meta http-equiv="Refresh" content="0; url=<?php echo $_SERVER['PHP_SELF']; ?>">
  <?php
}
if(!$file = file_get_contents('../error.log')) {
  echo 'El script no pudo obtener ningun contenido del archivo error.log.';
}

echo str_replace('*','<br/>',$file);

?>