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
 

class cache {
	
	public static function buildCache($filename,$content) 
	{
		if ($GLOBALS['useCache']==TRUE) 
		{
			if(!$fh = fopen('cache/'.$filename.'.cache.php', 'w+'))
			{
				buildError('<b>Error Cache.</b> No se pudo cargar el fichero (cache/'.$filename.'.cache.php)');
			}
			fwrite($fh,$content);
			fclose($fh); 
			unset($content,$filename);
		} 
		else 
			self::deleteCache($filename);
	}
	
	public static function loadCache($filename) 
	{
		if ($GLOBALS['useCache']==TRUE)
		 {
			if (file_exists('cache/'.$filename.'.cache.php')) 
				include('cache/'.$filename.'.cache.php');
			else 
				buildError('<b>Error Cache.</b> No se pudo cargar el fichero (cache/'.$filename.'.cache.php)');
		} 
		else 
			self::deleteCache($filename);
	}
	
	public static function deleteCache($filename) 
	{
		if (file_exists('cache/'.$filename.'.cache.php')) 
		{
			$del = unlink('cache/'.$filename.'.cache.php');
			if(!$del) 
				buildError('<b>Error Cache.</b> Intento eliminar el archivo inexistente de cache (cache/'.$filename.'.cache.php)');
		} 
	}
	
	
	public static function exists($filename) 
	{
		if (file_exists('cache/'.$filename.'.cache.php')) 
			return TRUE;
		else
			return FALSE;
	}

}

?>