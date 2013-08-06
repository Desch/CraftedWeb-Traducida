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
<?php $page = new page; $server = new server; $account = new account; $character = new character; ?>
<div class="box_right_title"><?php echo $page->titleLink(); ?> &raquo; Administrar Personajes</div>
Personaje seleccionado:  <?php echo $account->getCharName($_GET['guid'],$_GET['rid']); ?>
<?php
$server->connectToRealmDB($_GET['rid']);

$usersTotal = mysql_query("SELECT name,race,account,class,level,money,leveltime,totaltime,online,latency,gender FROM characters WHERE guid='".$_GET['guid']."'");
$row = mysql_fetch_assoc($usersTotal);
?>
<hr/>
<table style="width: 100%;">
<tr>
    <td>Nombre Character</td>
    <td><input type="text" value="<?php echo $row['name']; ?>" class="noremove" id="editchar_name"/></td>
</tr>
<tr>
    <td>Cuenta</td>
    <td><input type="text" value="<?php echo $account->getAccName($row['account']); ?>" class="noremove" id="editchar_accname"/>
    <a href="?p=users&s=manage&user=<?php echo strtolower($account->getAccName($row['account'])); ?>">Ver</a></td>
</tr>
<tr>
    <td>Raza</td>
    <td>
    	<select id="editchar_race">
        	<option <?php if($row['race']==1) echo 'selected'; ?> value="1">Humano</option>
            <option <?php if($row['race']==3) echo 'selected'; ?> value="3">Enano</option>
            <option <?php if($row['race']==4) echo 'selected'; ?> value="4">Elfo de la Noche</option>
            <option <?php if($row['race']==7) echo 'selected'; ?> value="7">Gnome</option>
            <option <?php if($row['race']==11) echo 'selected'; ?> value="11">Dranei</option>
             <?php if($GLOBALS['core_expansion']>=3) ?>
            	<option <?php if($row['race']==22) echo 'selected'; ?> value="22">Ferocanis</option>
            <option <?php if($row['race']==2) echo 'selected'; ?> value="2">Orco</option>
            <option <?php if($row['race']==6) echo 'selected'; ?> value="6">Tauren</option>
            <option <?php if($row['race']==8) echo 'selected'; ?> value="8">Troll</option>
            <option <?php if($row['race']==5) echo 'selected'; ?> value="5">No Muerto</option>
			<option <?php if($row['race']==10) echo 'selected'; ?> value="10">Elfo de Sangre</option>
            <?php if($GLOBALS['core_expansion']>=3) ?>
            	<option <?php if($row['race']==9) echo 'selected'; ?> value="9">Goblin</option>
            <?php if($GLOBALS['core_expansion']>=4) ?>
            	<option <?php if($row['race']==NULL) echo 'selected'; ?> value="NULL">Pandaren</option>    
        </select>
    </td>
</tr>
<tr>   
    <td>Class</td>
    <td>
    	<select id="editchar_class">
        	<option <?php if($row['class']==1) echo 'selected'; ?> value="1">Guerrero</option>
            <option <?php if($row['class']==2) echo 'selected'; ?> value="2">Paladin</option>
            <option <?php if($row['class']==11) echo 'selected'; ?> value="11">Druida</option>
            <option <?php if($row['class']==3) echo 'selected'; ?> value="3">Cazador</option>
            <option <?php if($row['class']==5) echo 'selected'; ?> value="5">Sacerdote</option>
             <?php if($GLOBALS['core_expansion']>=2) ?>
            	<option <?php if($row['class']==6) echo 'selected'; ?> value="6">Caballero de la Muerte</option>
            <option <?php if($row['class']==9) echo 'selected'; ?> value="9">Brujo</option>
            <option <?php if($row['class']==7) echo 'selected'; ?> value="7">Chaman</option>
            <option <?php if($row['class']==4) echo 'selected'; ?> value="4">Picaro</option>
            <option <?php if($row['class']==8) echo 'selected'; ?> value="8">Mago</option>
            <?php if($GLOBALS['core_expansion']>=4) ?>
            	<option <?php if($row['class']==12) echo 'selected'; ?> value="12">Monk</option>
        </select>
    </td>
</tr>
<tr>   
    <td>Gender</td>
    <td>
    	<select id="editchar_gender">
        	<option <?php if($row['gender']==0) echo 'selected'; ?> value="0">Hombre</option>
            <option <?php if($row['gender']==1) echo 'selected'; ?> value="1">Mujer</option>
        </select>
    </td>
</tr>
<tr>
    <td>Nivel</td>
    <td><input type="text" value="<?php echo $row['level']; ?>" class="noremove" id="editchar_level"/></td>
</tr>
<tr>    
    <td>Dinero (Oro)</td>
    <td><input type="text" value="<?php echo floor($row['money'] / 10000); ?>" class="noremove" id="editchar_money"/></td>
</tr>
<tr>
    <td>Tiempo de Nivelación</td>
    <td><input type="text" value="<?php echo $row['leveltime']; ?>" disabled="disabled"/></td>
</tr>
<tr>    
    <td>Tiempo Total</td>
    <td><input type="text" value="<?php echo $row['totaltime']; ?>" disabled="disabled"/></td>
</tr>
<tr>
    <td>Estado</td>
    <td>
	<?php if ($row['online']==0)
				  echo '<input type="text" value="Offline" disabled="disabled"/>';
			  else
			  	  echo '<input type="text" value="Online" disabled="disabled"/>'; 
	?>              
    </td>
</tr>
<tr>    
    <td>Latencia</td>
    <td><input type="text" value="<?php echo $row['latency']; ?>" disabled="disabled"/></td>
</tr>
<tr>
	<td></td>
    <td><input type="submit" value="Guardar" onclick="editChar('<?php echo $_GET['guid']; ?>','<?php echo $_GET['rid']; ?>')"/> 
    	<i>* Nota</i>: No puedes editar todos los datos si el personaje esta en linea.</td>
</tr>
</table>
<hr/>