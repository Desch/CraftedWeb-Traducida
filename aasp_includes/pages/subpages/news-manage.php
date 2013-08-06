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
<?php
$server = new server;
$server->selectDB('webdb');
$result = mysql_query("SELECT * FROM news ORDER BY id DESC");
if(mysql_num_rows($result)==0)
{ 
echo "<span class='blue_text'>No existen aun noticias!</span>"; 
}
else { 
?>
<div class="box_right_title">Noticias &raquo; Administrar</div>
<table width="100%">
<tr>
    <th>ID</th>
    <th>Titulo</th>
    <th>Contenido</th>
    <th>Comentarios</th>
    <th>Acciones</th>
</tr>
<?php
while($row=mysql_fetch_assoc($result)) {
	$comments = mysql_query("SELECT COUNT(id) FROM news_comments WHERE newsid='".$row['id']."'");
	 echo '<tr class="center">
			   <td>'.$row['id'].'</td>
			   <td>'.$row['title'].'</td>
			   <td>'.substr($row['body'],0,25).'...</td>
			   <td>'.mysql_result($comments,0).'</td>
			   <td> <a onclick="editNews('.$row['id'].')" href="#">Editar</a> &nbsp;  
			   <a onclick="deleteNews('.$row['id'].')" href="#">Borrar</a></td>
	 </tr>';
}
?></table><?php
}
 ?>    
