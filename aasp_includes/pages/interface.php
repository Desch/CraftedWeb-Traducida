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
	
	$page->validatePageAccess('Interface');
	
    if($page->validateSubPage() == TRUE) {
		$page->outputSubPage();
	} else {
?>
<div class="box_right_title">Plantilla</div>          
    
 Aqu&iacute; podr&aacute;s elegir la plantilla que estar&aacute; activa en su sitio web. Adem&aacute;s este es tambi&eacute;n el lugar donde instalar nuevos temas para su sitio web.<br/><br/>
 <h3>Elegir Plantilla</h3>
        <select id="choose_template">
                <?php
                $result = mysql_query("SELECT * FROM template ORDER BY id ASC");
                while($row = mysql_fetch_assoc($result)) {
                    if($row['applied']==1) 
                        echo "<option selected='selected' value='".$row['id']."'>[Active] ";
                    else 
                        echo "<option value='".$row['id']."'>";
                        
                    echo $row['name']."</option>";
                }
                ?>
        </select>
        <input type="submit" value="Guardar" onclick="setTemplate()"/><hr/><p/>
        
        <h3>Instalar una nueva Plantilla</h3>
        <a href="#" onclick="templateInstallGuide()">Como instalar nuevas plantillas</a><br/><br/><br/>
        Direccion de la Plantilla<br/>
        <input type="text" id="installtemplate_path"/><br/>
        Elegir Nombre<br/>
        <input type="text" id="installtemplate_name"/><br/>
        <input type="submit" value="Instalar" onclick="installTemplate()"/>
        <hr/>
        <p/>
        
        <h3>Desinstalar Plantilla</h3>
        <select id="uninstall_template_id">
                <?php
                $result = mysql_query("SELECT * FROM template ORDER BY id ASC");
                while($row = mysql_fetch_assoc($result)) {
                    if($row['applied']==1) 
                        echo "<option selected='selected' value='".$row['id']."'>[Active] ";
                    else 
                        echo "<option value='".$row['id']."'>";
                        
                    echo $row['name']."</option>";
                }
                ?>
        </select>
        <input type="submit" value="Desinstalar" onclick="uninstallTemplate()"/> 
 <?php } ?>