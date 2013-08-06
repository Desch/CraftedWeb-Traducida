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
<?php $page = new page; ?>
<div class="box_right_title"><?php echo $page->titleLink(); ?> &raquo; Administrar Items</div>
<table width="100%">
        <tr valign="top">
             <td style="text-align: left; width: 300px;"><h3>Modificar Item</h3>
             <p/>Entry<br/>
             <input type="text" style="width: 200px;" id="modsingle_entry"/><br/>
             Precio<br/>
             <input type="text" style="width: 200px;" id="modsingle_price"/><br/>
             Tienda<br/>
             <select style="width: 205px;" id="modsingle_shop">
                     <option value="vote">Tienda de Votaciones</option>
                     <option value="donate">Tienda de Donaciones</option>
             </select><br/>
             <input type="submit" value="Actualizar" onclick="modSingleItem()"/>
             <input type="submit" value="Eliminar" onclick="delSingleItem()"/>
             </td>
             <td style="text-align: left; width: 300px;"><h3>Modificar Multiples Items</h3>
             <p/>
            Niveles entre<br/>
             <select style="width: 140px;" id="modmulti_il_from">
                      <?php for ($i = 1; $i <= $GLOBALS['maxItemLevel']; $i++) {
						echo "<option>".$i."</option>";
					} ?>
             </select>
             &
             <select style="width: 140px;" id="modmulti_il_to">
                      <?php for ($i = $GLOBALS['maxItemLevel']; $i >= 1; $i--) {
						echo "<option>".$i."</option>";
					} ?>
             </select><br/>
             Precio<br/>
             <input type="text" style="width: 200px;" id="modmulti_price"/><br/>
             Calidad<br/>
             <select style="width: 205px;" id="modmulti_quality">
                     <option value="all">Todos</option>
                     <option value="0">Pobre</option>
                     <option value="1">Comun</option>
                     <option value="2">Poco Frecuente</option>
                     <option value="3">Raro</option>
                     <option value="4">Epico</option>
                     <option value="5">Legendario</option>
             </select><br/>
             Tipo<br/>
             <select id="modmulti_type" style="width: 205px;">
                               <option value="all">Todos</option>
                                <option value="0">Consumibles</option>
                                <option value="1">Contenedores</option>
                                <option value="2">Armas</option>
                                <option value="3">Gemas</option>
                                <option value="4">Armaduras</option>
                                <option value="15">Varios</option>
                                <option value="16">Glifos</option>
                                <option value="15-5">Monturas</option>
                                <option value="15-2">Mascotas</option>
            </select>	
             <br/>
             Tienda<br/>
             <select style="width: 205px;" id="modmulti_shop">
                     <option value="vote">Tienda de Votaciones</option>
                     <option value="donate">Tienda de Donaciones</option>
             </select><br/>
             <input type="submit" value="Actualizar" onclick="modMultiItem()"/>
             <input type="submit" value="Eliminar" onclick="delMultiItem()"/>
             </td>
        </tr>
</table>