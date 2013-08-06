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
	$server->selectDB('webdb');
	$page = new page;
	
	$page->validatePageAccess('Pages');
	
    if($page->validateSubPage() == TRUE) {
		$page->outputSubPage();
	} else {
 ?>

<div class="box_right_title">Páginas</div>

<?php if(!isset($_GET['action'])) { ?>

<table class="center">
<tr>
		<th>Nombre</th><th>Nombre Archivo</th><th>Acciones</th>
</tr>
<?php
	$result = mysql_query("SELECT * FROM custom_pages ORDER BY id ASC");
	while($row = mysql_fetch_assoc($result)) { 
     $check = mysql_query("SELECT COUNT(filename) FROM disabled_pages WHERE filename='".$row['filename']."'");
	 if(mysql_result($check,0)==0) {
		 $disabled = false;
	 } else {
		 $disabled = true;
	 }
    ?>
	<tr <?php if($disabled==true) { echo "style='color: #999;'"; }?>>
         <td width="50"><?php echo $row['name']; ?></td>
         <td width="100"><?php echo $row['filename']; ?>(Database)</td>
         <td><select id="action-<?php echo $row['filename']; ?>"><?php if($disabled==true) {  ?>
             <option value="1">Activar</option>
		 <?php } else { ?>
			 <option value="2">Desactivar</option>
		 <?php } ?>
         <option value="3">Editar</option>
         <option value="4">Eliminar</option>
         </select> &nbsp;<input type="submit" value="Save" onclick="savePage('<?php echo $row['filename']; ?>')"></td>
    </tr>
<?php }

foreach ($GLOBALS['core_pages'] as $k => $v) { 
$filename = substr($v, 0, -4);
unset ($check);
$check = mysql_query("SELECT COUNT(filename) FROM disabled_pages WHERE filename='".$filename."'");
	 if(mysql_result($check,0)==0) {
		 $disabled = false;
	 } else {
		 $disabled = true;
	 }
?>

    <tr <?php if($disabled==true) { echo "style='color: #999;'"; }?>>
        <td><?php echo $k; ?></td>
        <td><?php echo $v; ?></td>
        <td><select id="action-<?php echo $filename; ?>">
             <?php if($disabled==true) { ?>
             <option value="1">Activar</option>
		 <?php } else { ?>
			 <option value="2">Desactivar</option>
		 <?php } ?>
        </select> &nbsp;<input type="submit" value="Save" onclick="savePage('<?php echo $filename; ?>')"></td>
    </tr>
<?php } ?>

</table>

<?php } elseif($_GET['action']=='new') {
	 
 ?>


<?php } elseif($_GET['action']=='edit') {
	
	if(isset($_POST['editpage'])) {
		
		$name = mysql_real_escape_string($_POST['editpage_name']);
		$filename = trim(strtolower(mysql_real_escape_string($_POST['editpage_filename'])));
		$content = mysql_real_escape_string(htmlentities($_POST['editpage_content']));
		
	if(empty($name) || empty($filename) || empty($content)) {
		echo "<h3>Por favor introduzca  <u>todos</u> los datos.</h3>";
	} else {
		mysql_query("UPDATE custom_pages SET name='".$name."',filename='".$filename."',
		content='".$content."' WHERE filename='".mysql_real_escape_string($_GET['filename'])."'");

		echo "<h3>La pagina ha sido actualizada correctamente.</h3> 
		<a href='".$GLOBALS['website_domain']."?p=".$filename."' target='_blank'>View Page</a>";
	}
	}
	
$result = mysql_query("SELECT * FROM custom_pages WHERE filename='".mysql_real_escape_string($_GET['filename'])."'"); 
$row = mysql_fetch_assoc($result);
?>
	   
     <h4>Edici&oacute;n <?php echo $_GET['filename']; ?>.php</h4>
    <form action="?p=pages&action=edit&filename=<?php echo $_GET['filename']; ?>" method="post">
	Nombre<br/>
    <input type="text" name="editpage_name" value="<?php echo $row['name']; ?>"><br/>
    Nombre Archivo<br/>
    <input type="text" name="editpage_filename" value="<?php echo $row['filename']; ?>"><br/>
    Contenido<br/>
    <textarea cols="77" rows="14" id="wysiwyg" name="editpage_content"><?php echo $row['content']; ?></textarea>    
    <br/>
    <input type="submit" value="Guardar" name="editpage">
    
<?php } } ?>