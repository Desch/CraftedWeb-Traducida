<?php
#   ___           __ _           _ __    __     _     
#  / __\ __ __ _ / _| |_ ___  __| / / /\ \ \___| |__  
# / / | '__/ _` | |_| __/ _ \/ _` \ \/  \/ / _ \ '_ \ 
#/ /__| | | (_| |  _| ||  __/ (_| |\  /\  /  __/ |_) |
#\____/_|  \__,_|_|  \__\___|\__,_| \/  \/ \___|_.__/ 
#
#		-[ Created by �Nomsoft
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
#                  � Nomsoftware 'Nomsoft' 2011-2012. All rights reserved.    



    require('includes/loader.php'); //Load all php scripts
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
</head>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $GLOBALS['website_title']; ?> Panel de Staff</title>
<link rel="stylesheet" href="../aasp_includes/styles/default/style.css" />
<link rel="stylesheet" href="../aasp_includes/styles/wysiwyg.css" />
<script type="text/javascript" src="../javascript/jquery.js"></script>
</head>

<body>
<div id="overlay"></div>
<div id="loading"><img src="../aasp_includes/styles/default/images/ajax-loader.gif" /></div>
<div id="leftcontent">
        <div id="menu_left">
        	<ul>
        			  <li id="menu_head">Menu</li>
                      
                      <li>Dashboard</li>
                      <ul class="hidden" <?php activeMenu('dashboard'); ?>>
                          <a href="?p=dashboard">Dashboard</a>
                      </ul>
                      <?php
                      if($GLOBALS['staffPanel_permissions']['Pages']==true)
                      {
                      ?>     
                      <li>Paginas</li>
                           <ul class="hidden" <?php activeMenu('pages'); ?>>
                               <a href="?p=pages">Todas las Paginas</a>
                               <a href="?p=pages&s=new">Añadir pagina</a>
                           </ul>
                      <?php
                      }
                      if($GLOBALS['staffPanel_permissions']['News']==true)
                      {
                      ?>
                      <li>Noticias</li>
                           <ul class="hidden" <?php activeMenu('news'); ?>>
                               <a href="?p=news">Enviar Noticias</a>
                               <a href="?p=news&s=manage">Administrar Noticias</a>
                           </ul>
                      <?php
                      }
                      if($GLOBALS['staffPanel_permissions']['Shop']==true)
                      {
                      ?>          
                      <li>Tienda</li>
                            <ul class="hidden" <?php activeMenu('shop'); ?>>
                               <a href="?p=shop">Resumen</a>
                               <a href="?p=shop&s=add">Añadir Articulos</a>
                               <a href="?p=shop&s=manage">Gestionar Articulos</a>
                               <a href="?p=shop&s=tools">Herramientas</a>
                           </ul> 
                      <?php
                      }
                      if($GLOBALS['staffPanel_permissions']['Donations']==true)
                      {
                      ?>     
                      <li>Donaciones</li>
                           <ul class="hidden" <?php activeMenu('donations'); ?>>
                               <a href="?p=donations">Resumen</a>
                               <a href="?p=donations&s=browse">Navegador</a>
                           </ul> 
                      <?php
                      }
                      if($GLOBALS['staffPanel_permissions']['Logs']==true)
                      {
                      ?>     
                      <li>Registros</li>
                            <ul class="hidden" <?php activeMenu('logs'); ?>>
                               <a href="?p=logs&s=voteshop">Votaciones</a>
                               <a href="?p=logs&s=donateshop">Donaciones</a>
                           </ul> 
                      <?php
                      }
                      if($GLOBALS['staffPanel_permissions']['Interface']==true)
                      {
                      ?>     
                      <li>Interfaz</li>
                            <ul class="hidden" <?php activeMenu('interface'); ?>>
                               <a href="?p=interface">Plantillas</a>
                               <a href="?p=interface&s=menu">Menu</a>
                               <a href="?p=interface&s=slideshow">Slideshow</a>
                               <a href="?p=interface&s=plugins">Plugins</a>
                           </ul> 
                      <?php
                      }
                      if($GLOBALS['staffPanel_permissions']['Users']==true)
                      {
                      ?>     
                      <li>Usuarios</li>
                            <ul class="hidden" <?php activeMenu('users'); ?>>
                               <a href="?p=users">Resumen</a>
                               <a href="?p=users&s=manage">Administrar Usuarios</a>
                           </ul> 
                      <?php
                      }
                      if($GLOBALS['staffPanel_permissions']['Realms']==true)
                      {
                      ?>     
                      <li>Reinos</li>
                            <ul class="hidden" <?php activeMenu('realms'); ?>>
                               <a href="?p=realms">Nuevo Reino</a>
                               <a href="?p=realms&s=manage">Administrar Reino(s)</a>
                           </ul> 
                      <?php
                      }
                      if($GLOBALS['staffPanel_permissions']['Services']==true)
                      {
                      ?>     
                      <li>Servicios</li>
                            <ul class="hidden" <?php activeMenu('services'); ?>>
                               <a href="?p=services&s=voting">Enlaces Votaciones</a>
                               <a href="?p=services&s=charservice">Servicios Personajes</a>
                           </ul> 
                      <?php
                      }
                      if($GLOBALS['staffPanel_permissions']['Tools->Tickets']==true || 
                      $GLOBALS['staffPanel_permissions']['Tools->Account Access']==true)
                      {
                      ?>    
                      <li>Herramientas</li>
                            <ul class="hidden" <?php activeMenu('tools'); ?>>
                               <?php if($GLOBALS['staffPanel_permissions']['Tools->Tickets']==true) {?>
                               <a href="?p=tools&s=tickets">Tickets</a>
                               <?php } ?>
                               <?php if($GLOBALS['staffPanel_permissions']['Tools->Account Access']==true) { ?>
                               <a href="?p=tools&s=accountaccess">Acesso Cuentas</a>
                               <?php } ?>
                           </ul>  
                     <?php
                      }
                      ?>
                  </ul>
         </div>
</div>

<div id="header">
<div id="header_text">
  <?php if(isset($_SESSION['cw_staff'])) { ?> Bienvenido  
     <b><?php echo $_SESSION['cw_staff']; ?> </b> 
     <a href="?p=logout"><i>(Salir)</i></a> &nbsp; | &nbsp;
     <a href="<?php echo $GLOBALS['website_domain']; ?>" title="View your site">View your site</a>
     <?php } else {
         echo "Please log in.";
     }?>
 </div>
</div>
      
      
<div id="wrapper">
<div id="middlecontent">
<?php if(!isset($_SESSION['cw_staff'])) { ?>  
<br/>
<center>
<h2>Por favor acceda</h2>
  <input type="text" placeholder="Username" id="login_username" style="border: 1px solid #ccc;"/><br/> 
  <input type="password" placeholder="Password" id="login_password" style="border: 1px solid #ccc;"/><br/>
  <input type="submit" value="Entrar" onclick="login('staff')"/> <br/>
  <div id="login_status"></div>
</center>
 <?php 
 } 
 else 
 { 
 ?>
    <div class="box_right">
    <?php
		if(!isset($_GET['p']))
                 $page = "dashboard";
		 else 
		 { 
			 $page = $_GET['p']; }		   
			 $pages = scandir('../aasp_includes/pages');
			 unset($pages[0],$pages[1]);
			 
			 if (!file_exists('../aasp_includes/pages/'.$page.'.php'))
				 include('../aasp_includes/pages/404.php');
			 elseif(in_array($page.'.php',$pages))
				 include('../aasp_includes/pages/'.$page.'.php');
			 else
				 include('../aasp_includes/pages/404.php');              
		  }
    ?>
     </div>
</div>
    <?php if(isset($_SESSION['cw_staff']))  { ?>
    <div id="rightcontent">
		 <?php if($GLOBALS['forum']['type']=='phpbb' && $GLOBALS['forum']['autoAccountCreate']==TRUE && $page=='dashboard') { ?>
         <div class="box_right">
         <div class="box_right_title">Actividad Recientes en Foros</div>
            <table>
                <tr>
                    <th>Cuenta</th>
                    <th>Mensaje</th>
                    <th>Tema</th>
                </tr>
			<?php
            $server->selectDB($GLOBALS['forum']['forum_db']);
            $result = mysql_query("SELECT poster_id,post_text,post_time,topic_id FROM phpbb_posts ORDER BY post_id DESC LIMIT 10");
            while($row = mysql_fetch_assoc($result)) 
			{
                $string = $row['post_text']; 
                //Lets get the username			
                $getUser = mysql_query("SELECT username FROM phpbb_users WHERE user_id='".$row['poster_id']."'"); 
				$user = mysql_fetch_assoc($getUser);
                //Get topic
                $getTopic = mysql_query("SELECT topic_title FROM phpbb_topics WHERE topic_id='".$row['topic_id']."'"); 
				$topic = mysql_fetch_assoc($getTopic);
            ?>
                <tr>
                    <td><a href="http://heroic-wow.net/forum/memberlist.php?mode=viewprofile&u=<?php echo $row['poster_id']; ?>" title="View profile" 
                    target="_blank"><?php echo $user['username']; ?></a></td>
                    <td><?php echo limit_characters(stripBBcode($string));?></td>
                    <td><a href="http://heroic-wow.net/forum/viewtopic.php?t=<?php echo $row['topic_id']?>" title="View this topic" target="_blank">
                    	Ver tema</a></td>
                </tr>
            <?php } ?>
        </table>
         </div> 
             <?php } ?>
     <div class="box_right">
            <div class="box_right_title">Estado del Servidor</div>
            <table>
               <tr valign="top">
                   <td>
                        Jugadores Online: <br/>
                        Conexiones Activas: <br/>
                        Nuevas cuentas Hoy: <br/>
                   </td>
                   <td>
                   <b>
                       <?php echo $server->players_online;?><br/>
                       <?php echo $server->active_connections;?><br/>
                       <?php echo $server->accounts_today;?><br/>
                   </b>
                   </td>
               </tr>
            </table>
     </div>    
                         
    <div class="box_right">
    <div class="box_right_title">Configuracion Website</div>
    <table>
           <tr valign="top">
               <td>
                MySQL Host: <br/>
                MySQL User: <br/>
                MySQL Password: <br/>
               </td>
               <td>
               <b>
               <?php echo $GLOBALS['connection']['host'];?><br/>
               <?php echo $GLOBALS['connection']['user']; ?><br/>
               <?php echo substr($GLOBALS['connection']['password'],0,4); ?>****<br/>
               </b>
               </td>
               <td>
               Base de Datos Auth: <br/>
               Base de Datos Website: <br />
               Base de Datos World: <br/>
               Revision Base de Datos: 
               </td>
               <td>
               <b>
               <?php echo $GLOBALS['connection']['logondb']; ?><br/>
               <?php echo $GLOBALS['connection']['webdb']; ?><br/>
               <?php echo $GLOBALS['connection']['worlddb']; ?><br/>
               <?php 
                     $server->selectDB('webdb');
                     $get = mysql_query("SELECT version FROM db_version");
                     $row = mysql_fetch_assoc($get);
                     echo $row['version']; ?>
               </b>
               </td>
           </tr>
    </table>
</div>          
</div>         
  <?php } ?>
</div>               
</div> 
	<?php include('../aasp_includes/javascript_loader.php'); 
	if(!isset($_SESSION['cw_admin']))
	{
	?>
    <script type="text/javascript">
 	document.onkeydown = function(event) 
	{
		var key_press = String.fromCharCode(event.keyCode);
		var key_code = event.keyCode;
		if(key_code == 13)
			{
				login('staff')
			}
	}
 </script>
    <?php } ?>
</body>
</html>