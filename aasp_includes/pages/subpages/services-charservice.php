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
$server = new server;
$account = new account;
?>
	 
<div class="box_right_title">Servicios de Personajes</div>
<table class="center">
<tr><th>Servicio</th><th>Precio</th><th>Moneda</th><th>Estado</th></tr>
<?php
$result = mysql_query("SELECT * FROM service_prices");
while($row = mysql_fetch_assoc($result)) { ?>
	<tr>
        <td><?php echo $row['service']; ?></td>
        <td><input type="text" value="<?php echo $row['price']; ?>" style="width: 50px;" id="<?php echo $row['service']; ?>_price" class="noremove"/></td>
        <td><select style="width: 200px;" id="<?php echo $row['service']; ?>_currency">
             <option value="vp" <?php if ($row['currency']=='vp') echo 'selected'; ?>>Puntos de Votación</option>
             <option value="dp" <?php if ($row['currency']=='dp') echo 'selected'; ?>><?php echo $GLOBALS['donation']['coins_name']; ?></option>
        </select></td>
        <td><select style="width: 150px;" id="<?php echo $row['service']; ?>_enabled">
             <option value="true" <?php if ($row['enabled']=='TRUE') echo 'selected'; ?>>Activado</option>
             <option value="false" <?php if ($row['enabled']=='FALSE') echo 'selected'; ?>>Desactivado</option>
        </select></td>
        <td><input type="submit" value="Save" onclick="saveServicePrice('<?php echo $row['service']; ?>')"/>
    </tr>
<?php }
?>
</table>