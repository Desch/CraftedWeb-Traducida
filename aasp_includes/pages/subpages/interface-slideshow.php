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
<?php $page = new page; $server = new server; ?>
<div class="box_right_title"><?php echo $page->titleLink(); ?> &raquo; Slideshow</div>
<?php 
if($GLOBALS['enableSlideShow']==true) 
$status = 'Enabled';
else
$status = 'Disabled';

$server->selectDB('webdb');
$count = mysql_query("SELECT COUNT(*) FROM slider_images");
?>
La slideshow esta <b><?php echo $status; ?></b>. Tienes <b><?php echo round(mysql_result($count,0)); ?></b> imagenes en la slideshow.
<hr/>
<?php 
if(isset($_POST['addSlideImage']))
{
	$page = new page;
	$page->addSlideImage($_FILES['slideImage_upload'],$_POST['slideImage_path'],$_POST['slideImage_url']);
}
?>
<a href="#addimage" onclick="addSlideImage()" class="content_hider">Añadir Imagen</a>
<div class="hidden_content" id="addSlideImage">
<form action="" method="post" enctype="multipart/form-data">
Subir una imagen:<br/>
<input type="file" name="slideImage_upload"><br/>
o introducir la URL de la imagen (Esto anular&aacute; la imagen subida)<br/>
<input type="text" name="slideImage_path"><br/>
Donde debe redirigir la imagen? (Dejar en blanco si no tiene)<br/>
<input type="text" name="slideImage_url"><br/>
<input type="submit" value="Añadir" name="addSlideImage">
</form>
</div>
<br/>&nbsp;<br/>
<?php 
$server->selectDB('webdb');
$result = mysql_query("SELECT * FROM slider_images ORDER BY position ASC");
if(mysql_num_rows($result)==0) 
{
	echo "No tienes ninguna imagen en la slideshow!";
}
else 
{
	echo '<table>';
	$c = 1;
	while($row = mysql_fetch_assoc($result))
	{
		echo '<tr class="center">';
		echo '<td><h2>&nbsp; '.$c.' &nbsp;</h2><br/>
		<a href="#remove" onclick="removeSlideImage('.$row['position'].')">Eliminar</a></td>';
		echo '<td><img src="../'.$row['path'].'" alt="'.$c.'" class="slide_image" maxheight="200"/></td>';
		echo '</tr>';
		$c++;
	}
	  echo '</table>';
}
?>

