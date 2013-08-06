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
<script type="text/javascript" src="../aasp_includes/js/interface.js"></script>
<script type="text/javascript" src="../aasp_includes/js/account.js"></script>
<script type="text/javascript" src="../aasp_includes/js/server.js"></script>
<script type="text/javascript" src="../aasp_includes/js/news.js"></script>
<script type="text/javascript" src="../aasp_includes/js/logs.js"></script>
<script type="text/javascript" src="../aasp_includes/js/shop.js"></script>
<?php if($GLOBALS['core_expansion']>2) 
{
	//Core is over WOTLK. Use WoWHead.
	echo '<script type="text/javascript" src="http://static.wowhead.com/widgets/power.js"></script>';
}
else
{
	echo '<script type="text/javascript" src="http://cdn.openwow.com/api/tooltip.js"></script>';
}
?>
<script type="text/javascript" src="../aasp_includes/js/wysiwyg.js"></script>
<script type="text/javascript" src="../aasp_includes/js/wysiwyg/wysiwyg.image.js"></script>
<script type="text/javascript" src="../aasp_includes/js/wysiwyg/wysiwyg.link.js"></script>
<script type="text/javascript" src="../aasp_includes/js/wysiwyg/wysiwyg.table.js"></script>

<script type="text/javascript">
$(function() {
        $('#wysiwyg').wysiwyg();
    });
</script>