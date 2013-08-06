<?php
#   ___           __ _           _ __    __     _     
#  / __\ __ __ _ / _| |_ ___  __| / / /\ \ \___| |__  
# / / | '__/ _` | |_| __/ _ \/ _` \ \/  \/ / _ \ '_ \ 
#/ /__| | | (_| |  _| ||  __/ (_| |\  /\  /  __/ |_) |
#\____/_|  \__,_|_|  \__\___|\__,_| \/  \/ \___|_.__/ 
#
#		-[ Created by ©Nomsoft
#		  `-[ Original core by Anthony (Aka. CraftedDev)
#
#				-CraftedWeb Generation II-                  
#			 __                           __ _   							   
#		  /\ \ \___  _ __ ___  ___  ___  / _| |_ 							   
#		 /  \/ / _ \| '_ ` _ \/ __|/ _ \| |_| __|							   
#		/ /\  / (_) | | | | | \__ \ (_) |  _| |_ 							   
#		\_\ \/ \___/|_| |_| |_|___/\___/|_|  \__|	- www.Nomsoftware.com -	   
#                  The policy of Nomsoftware states: Releasing our software   
#                  or any other files are protected. You cannot re-release    
#                  anywhere unless you were given permission.                 
#                  © Nomsoftware 'Nomsoft' 2011-2012. All rights reserved.    
 
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
</head>

<div class='box_two_title'>Carrito de la Compra</div>
<?php
echo '<span class="currency">Vote Points: '.account::loadVP($_SESSION['cw_user']).'<br/>
'.$GLOBALS['donation']['coins_name'].': '.account::loadDP($_SESSION['cw_user']).'
</span>';

if(isset($_GET['return']) && $_GET['return']=="true")
	echo "<span class='accept'>The item(s) was sent to the selected character!</span>";
elseif(isset($_GET['return']) && $_GET['return']!="true")
	echo "<span class='alert'>".$_GET['return']."</span>";

account::isNotLoggedIn();
connect::selectDB('webdb');

$counter = 0;
$totalDP = 0;
$totalVP = 0;

if(isset($_SESSION['donateCart']) && !empty($_SESSION['donateCart'])) 
{
	$counter = 1;
	
	echo '<h3>Donation Shop</h3>';
	
	$sql = "SELECT * FROM shopitems WHERE entry IN(";
	foreach($_SESSION['donateCart'] as $entry => $value) {
		if($_SESSION['donateCart'][$entry]['quantity']!=0) {
		  $sql .= $entry. ',';
		  
		  connect::selectDB($GLOBALS['connection']['worlddb']);
		  $result = mysql_query("SELECT maxcount FROM item_template WHERE entry='".$entry."' AND maxcount>0");
		  if(mysql_result($result,0)!=0)
			  $_SESSION['donateCart'][$entry]['quantity']=1;
		  
		   connect::selectDB($GLOBALS['connection']['webdb']);
		}
	  }
	  
	  $sql = substr($sql,0,-1) . ") AND in_shop='donate' ORDER BY `itemlevel` ASC";

      $query = mysql_query($sql);
?>
<table width="100%" >
<tr id="cartHead">
  <th>Nombre</th>
  <th>Cantidad</th>
  <th>Precio</th>
  <th>Acciones</th></tr>
<?php
while($row = mysql_fetch_array($query)) 
{
	?><tr align="center">
        <td><a href="http://<?php echo $GLOBALS['tooltip_href']; ?>item=<?php echo $row['entry']; ?>"><?php echo $row['name']; ?></a></td> <td>
        <input type="text" value="<?php echo $_SESSION['donateCart'][$row['entry']]['quantity']; ?>" style="width: 30px;"
        onFocus="$(this).next('.quantitySave').fadeIn()" id="donateCartQuantity-<?php echo $row['entry']; ?>" />
        <div class="quantitySave" style="display:none;">
        <a href="#" onclick="saveItemQuantityInCart('donateCart',<?php echo $row['entry']; ?>)">Guardar</a>
        </div>
        </td>
        <td><?php echo $_SESSION['donateCart'][$row['entry']]['quantity'] * $row['price']; ?> 
		<?php echo $GLOBALS['donation']['coins_name']; ?></td>
        <td><a href="#" onclick="removeItemFromCart('donateCart',<?php echo $row['entry']; ?>)">Eliminar</a></td>
    </tr>
    <?php
	$totalDP = $totalDP + ( $_SESSION['donateCart'][$row['entry']]['quantity'] * $row['price'] );
}
?>
</table>
<?php 
} 
if(isset($_SESSION['voteCart']) && !empty($_SESSION['voteCart'])) 
{
	$counter = 1;

	 echo '<h3>Vote Shop</h3>';
	$sql = "SELECT * FROM shopitems WHERE entry IN(";
	foreach($_SESSION['voteCart'] as $entry => $value) {
		if($_SESSION['voteCart'][$entry]['quantity']!=0) {
		  $sql .= $entry. ',';
		  connect::selectDB($GLOBALS['connection']['worlddb']);
		  $result = mysql_query("SELECT maxcount FROM item_template WHERE entry='".$entry."' AND maxcount>0");
		  if(mysql_result($result,0)!=0)
			  $_SESSION['voteCart'][$entry]['quantity']=1;

		   connect::selectDB($GLOBALS['connection']['webdb']);
		}
	  }
	  
	  $sql = substr($sql,0,-1) . ") AND in_shop='vote' ORDER BY `itemlevel` ASC";

$query = mysql_query($sql);
?>
<table width="100%" >
<tr id="cartHead">
  <th>Nombre</th>
  <th>Cantidad</th><th>Precio</th><th>Acciones</th></tr>
<?php
while($row = mysql_fetch_array($query)) {
	?><tr align="center">
        <td><a href="http://<?php echo $GLOBALS['tooltip_href']; ?>item=<?php echo $row['entry']; ?>"><?php echo $row['name']; ?></a></td> <td>
        <input type="text" value="<?php echo $_SESSION['voteCart'][$row['entry']]['quantity']; ?>" style="width: 30px;"
        onFocus="$(this).next('.quantitySave').fadeIn()" id="voteCartQuantity-<?php echo $row['entry']; ?>" />
        <div class="quantitySave" style="display:none;">
        <a href="#" onclick="saveItemQuantityInCart('voteCart',<?php echo $row['entry']; ?>)">Guardar</a>
        </div>
        </td>
        <td><?php echo $_SESSION['voteCart'][$row['entry']]['quantity'] * $row['price']; ?> Putos de Votaciones</td>
        <td><a href="#" onclick="removeItemFromCart('voteCart',<?php echo $row['entry']; ?>)">Eliminar</a></td>
    </tr>
    <?php
	$totalVP = $totalVP + ( $_SESSION['voteCart'][$row['entry']]['quantity'] * $row['price'] );
}
?>
</table>
<?php
}
?>
<br/>
Coste Total: <?php echo $totalVP; ?> Puntos de Votaciones, <?php echo $totalDP.' '.$GLOBALS['donation']['coins_name']; ?>
<hr/>

<?php
if(isset($_SESSION['donateCart']) && !empty($_SESSION['donateCart']) || isset($_SESSION['voteCart']) 
&& !empty($_SESSION['voteCart'])) 
{	?>
	<input type='submit' value='Limpiar Carro' onclick='clearCart()'>
     <div style='position: absolute; right: 15px; bottom: 5px;'>
     <table>
     <tr><td>
	 <select id="checkout_values">
     <?php
	     account::getCharactersForShop($_SESSION['cw_user']);
	 ?>
     </select>
     </td><td><input type='submit' value='Checkout'  onclick='checkout()'></td>
     </tr>
     </table>
     </div>
     
	<?php
}

if($counter==0)
	echo "<span class='attention'>Tu carro esta vacio!</span>";

?>