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
 
class Page
{
  var $page;
  var $values = array();

  function Page($template) 
  {
    if (file_exists($template))
      $this->page = join("", file($template));
  }

  function parse($file) 
  {
		ob_start();
		include($file);
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
  }

  function replace_tags($tags = array()) 
  {
      if (sizeof($tags) > 0)
      foreach ($tags as $tag => $data) 
	  {
			$data = (file_exists($data)) ? $this->parse($data) : $data;
			$this->page = preg_replace("({" . $tag . "})", $data,
						  $this->page);
	  }
  }
  
  function setVar($key,$array) 
  {
	  $this->values[$key] = $array;
  }

  function output() 
  {
        echo $this->page;
  }
  
  function loadCustoms() 
  { 
    if($GLOBALS['enablePlugins']==true)
	{
		if(isset($_SESSION['loaded_plugins_modules']))
		{
			foreach($_SESSION['loaded_plugins_modules'] as $filename)
			{
				$name = basename(substr($filename,0,-4));
				
				$this->replace_tags(array($name => $filename));
			}
		}
	}
 }
}
?>