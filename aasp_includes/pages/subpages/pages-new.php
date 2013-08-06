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
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
</head>
<?php $page = new page;
if(isset($_POST['newpage'])) {
	
	$name = mysql_real_escape_string($_POST['newpage_name']);
	$filename = trim(strtolower(mysql_real_escape_string($_POST['newpage_filename'])));
	$content = mysql_real_escape_string(htmlentities($_POST['newpage_content']));
	
	if(empty($name) || empty($filename) || empty($content)) {
		echo "<h3>Por favor introduzca <u>todos</u> los campos.</h3>";
	} else {
		mysql_query("INSERT INTO custom_pages VALUES ('','".$name."','".$filename."','".$content."',
		'".date("Y-m-d H:i:s")."')");

		echo "<h3>La pagina se ha creado correctamente.</h3> 
		<a href='".$GLOBALS['website_domain']."?p=".$filename."' target='_blank'>Ver Pagina</a><br/><br/>";
	}
} ?>
<div class="box_right_title"><?php echo $page->titleLink(); ?> &raquo; Nueva Página</div>
<form action="?p=pages&s=new" method="post">
Nombre<br/>
<input type="text" name="newpage_name"><br/>
Nombre de Archivo <i>(Esto es ?p=NOMBRE_DE_ARCHIVO,  por ejemplo, ?p=conectar el nombre del archivo es 'conectar')<br/>
<input type="text" name="newpage_filename"><br/>
Contenido<br/>
<textarea cols="77" rows="14" id="wysiwyg" name="newpage_content">
<?php if(isset($_POST['newpage_content'])) { echo $_POST['newpage_content']; } ?></textarea>    <br/>
<input type="submit" value="Create" name="newpage">