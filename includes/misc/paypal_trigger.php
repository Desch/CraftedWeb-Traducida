<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
</head>
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
 
define('INIT_SITE', TRUE);
require('../configuration.php');
require('connect.php');

$send = 'cmd=_notify-validate';

 foreach ($_POST as $key => $value)
 {
     if(get_magic_quotes_gpc() == 1)
         $value = urlencode(stripslashes($value));
     else
         $value = urlencode($value);
		 
     $send .= "&$key=$value";
 }
 
 $head .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
 $head .= "Content-Type: application/x-www-form-urlencoded\r\n";
 $head .= 'Content-Length: '.strlen($send)."\r\n\r\n";
 $fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
 
 connect::selectDB('webdb');

 if ($fp !== false)
 {
    fwrite($fp, $head.$send);
    $resp = stream_get_contents($fp);
	
    $resp = end(explode("\n", $resp));
	 
	$item_number = mysql_real_escape_string($_POST['item_number']);
	$item_name = mysql_real_escape_string($item_number['0']);
	$mc_gross = mysql_real_escape_string($_POST['mc_gross']);
	$txn_id = mysql_real_escape_string($_POST['txn_id']);
	$payment_date = mysql_real_escape_string($_POST['payment_date']);
	$first_name = mysql_real_escape_string($_POST['first_name']);
	$last_name = mysql_real_escape_string($_POST['last_name']);
	$payment_type = mysql_real_escape_string($_POST['payment_type']);
	$payer_email = mysql_real_escape_string($_POST['payer_email']);
	$address_city = mysql_real_escape_string($_POST['address_city']);
	$address_country = mysql_real_escape_string($_POST['address_country']);
	$custom = mysql_real_escape_string($_POST['custom']);
	$mc_fee = mysql_real_escape_string($_POST['mc_fee']);
	$fecha = date("Y-m-d");
	$payment_status = mysql_real_escape_string($_POST['payment_status']);
	$reciever = mysql_real_escape_string($_POST['receiver_email']);		 
	
if ($resp == 'VERIFIED')
{
	if ($reciever!=$GLOBALS['donation']['paypal_email'])
		exit();
			
	mysql_query("INSERT INTO payments_log(userid,paymentstatus,buyer_email,firstname,lastname,city,country,mc_gross,mc_fee,itemname,paymenttype,
	paymentdate,txnid,pendingreason,reasoncode,datecreation) values ('".$custom."','".$payment_status."','".$payer_email."',
	'".$first_name."','".$last_name."','".$address_city."','".$address_country."','".$mc_gross."',
	'".$mc_fee."','".$item_name."','".$payment_type."','".$payment_date."','".$txn_id."','".$pending_reason."',
	'".$reason_code."','".$fecha."')");
				
	$to = $payer_email;
	$subject = $GLOBALS['donation']['emailResponse'];
	$message = 'Hola '.$first_name.'
	Nos gustaria informarle de que el pago se realizo con exito.
	
	Si necesita ayuda, pude ponerse en contacto con el soporte a traves de los foros.
	------------------------------------------
	Email del Pago: '.$payer_email.'
	Importe del Pago: '.$mc_gross.'
	Nombre Comprador: '.$first_name.' '.$last_name.'
	Dia del pago: '.$payment_date.'
	ID de la Cuenta: '.$custom.'
	------------------------------------------
	Este pago queda guardado en nuestros registros internos.
	
	Muchas Gracias, el Equipo de Administracion.
	';
	$headers = 'Desde: '.$GLOBALS['default_email'].'' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
	
	if ($GLOBALS['donation']['emailResponse']==true) 
	{
		mail($to, $subject, $message, $headers); 
		if ($GLOBALS['donation']['sendResponseCopy']==true)
			mail($GLOBALS['donation']['copyTo'], $subject, $message, $headers); 
	}

	$res = fgets ($fp, 1024);
	if($payment_status=="Completed")
	{
		if($GLOBALS['donation']['donationType']==2)
		{
			mysql_query("INSERT INTO payments_log(userid,paymentstatus,buyer_email,firstname,lastname,mc_gross,paymentdate,datecreation) values ('".$custom."',
			'".$mc_gross."','".$payer_email."','".$first_name."','".$last_name."','".$mc_gross."','".$payment_date."','".$fecha."')");
			
			for ($row = 0; $row < count($GLOBALS['donationList']); $row++)
			{
				$coins = $mc_gross;
				if($coins == $GLOBALS['donationList'][$row][2])
					mysql_query("UPDATE account_data SET dp=dp + ".$GLOBALS['donationList'][$row][1]." WHERE id='".$custom."'");
			}
		}
		elseif($GLOBALS['donation']['donationType']==2)
		{
			$coins = ceil($mc_gross);
			mysql_query("UPDATE account_data SET dp=dp + ".$coins." WHERE id='".$custom."'");
		}
				
 }
}
else if ($resp == 'INVALID')
{
	if($GLOBALS['donation']['donationType']==2)
	{
		 mysql_query("INSERT INTO payments_log(userid,paymentstatus,buyer_email,firstname,
		 lastname,mc_gross,paymentdate,datecreation) values ('".$custom."','".$payment_status." - INVALID FUUUU ".$_POST['mc_gross']."','".$payer_email."',
		 '".$first_name."','".$last_name."','".$mc_gross."','".$payment_date."','".$fecha."')");
	}
	
 mail($GLOBALS['donation']['copyTo'],"Donacion INVALIDA","El pago no es valido, la informacion se muestra a continuacion: <br/>
		  User ID : ".$custom."
		  Email Comprador: ".$payer_email."
		  Importe: ".$mc_gross." USD
		  Dia: ".$payment_date."
		  Nombre: ".$first_name."
		  Apellidos: ".$last_name."
		  ","Desce: ".$GLOBALS['donation']['responseFrom']."");  
		  
		  mail($payer_email,"Hola. Desafortunadamente, el ultimo pago que que hizo no fue valido, pongase en contacto con nosotros para mas informacion. 
		  
		  Saludos.
		  Equipo de Administracion");
	
		 mysql_query("INSERT INTO payments_log(userid,paymentstatus,buyer_email,firstname,lastname,mc_gross,paymentdate,datecreation) values ('".$custom."','".$payment_status." - INVALID','".$payer_email."','".$first_name."','".$last_name."','".$mc_gross."','".$payment_date."','".$fecha."')");
    }
 }

fclose ($fp); 
 
?> 