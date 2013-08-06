
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
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="javascript/main.js"></script>


<?php
####SHOP CARTS####
if($_GET['p']=='donateshop') 
{ ?>
<script type="text/javascript">
		$(document).ready(function() {
			loadMiniCart("donateCart");
		});
</script>
<?php }

if($_GET['p']=='voteshop') 
{ ?>
	<script type="text/javascript">
            $(document).ready(function() {
                loadMiniCart("voteCart");
            });
    </script>
<?php } 

if($GLOBALS['enableSlideShow']==true && $_GET['p'] == 'home')
{
?>
	<script type="text/javascript" src="javascript/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    	$(window).load(function() {
    		$('#slider').nivoSlider({
    			effect: 'fade',
    		});
		});
	</script>
<?php 
}
if($GLOBALS['core_expansion']>2) 
	echo '<script type="text/javascript" src="http://static.wowhead.com/widgets/power.js"></script>';
else
	echo '<script type="text/javascript" src="http://cdn.openwow.com/api/tooltip.js"></script>';

####CURSOR TRACKER####
if($_GET['p']=='donateshop' || $_GET['p'] == 'voteshop') 
{ ?>
	<script type="text/javascript">
	$(document).ready(function() {
		$(document).mousemove(function(e){
		   mouseY = e.pageY;
      });
	});
	</script>
<?php }

####FACEBOOK####
if($GLOBALS['social']['enableFacebookModule']==TRUE) 
{  ?>
	<script type="text/javascript">
		$(document).ready(function() {
				var box_width_one = $(".box_one").width();
				$("#fb").attr('width', box_width_one);
		});
	</script>
<?php 
}

####SERVER STATUS######
if($GLOBALS['serverStatus']['enable']==true) 
{
	?>
	<script type="text/javascript">
        $(document).ready(function() {
            $.post("includes/scripts/misc.php", { serverStatus: true },
               function(data) {
                   $("#server_status").html(data);
                   $(".srv_status_po").hover(function() {
                        $(".srv_status_text").fadeIn("fast");
                         }, function() {
                        $(".srv_status_text").fadeOut("fast");
                        });
          });
        });
    </script>
<?php 
}

plugins::load('javascript');
	
?>

