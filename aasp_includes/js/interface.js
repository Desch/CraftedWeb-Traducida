$("input[type='text']").not(document.getElementsByClassName('noremove')).focus(function() {
	this.value="";
});
$("input[type='password']").focus(function() {
	this.value="";
});

document.onkeydown = function(event) 
{
	var key_press = String.fromCharCode(event.keyCode);
	var key_code = event.keyCode;
	if(key_code == 27)
		{
			hideLoader();
		}
}


function showLoader() {
	centerLoader();
	$("#overlay").fadeIn("fast");
	$("#loading").fadeIn("slow");
}

function hideLoader() {
	$("#overlay").fadeOut("fast");
	$("#loading").fadeOut("fast");
	$("#loading").html("Cargando...");
}

function centerLoader() {

    var scrolledX = document.body.scrollLeft || document.documentElement.scrollLeft || self.pageXOffset;
    var scrolledY = document.body.scrollTop || document.documentElement.scrollTop || self.pageYOffset;
	

    var screenWidth = document.body.clientWidth || document.documentElement.clientWidth || self.innerWidth;
    var screenHeight = document.body.clientHeight || document.documentElement.clientHeight || self.innerHeight;

    var left = scrolledX + (screenWidth - $("#loading").width())/2;
    var top = scrolledY + (screenHeight - $("#loading").height())/4;
    //centering
    $("#loading").css({
        "position": "absolute",
        "top": top,
        "left": left
    });
	
	
	$("#overlay").click(function(){
         $("#loading").fadeOut();
		 $("#overlay").fadeOut();	
	});
}

function getPage(pagename) {
	$(".box_right").html("<img src='images/ajax-loader.gif'>'");
	$(".box_right").load("pages/" + pagename + ".php");
}

function loader(id) {
	$(id).html("<img src='styles/default/images/ajax-loader.gif'>'");
}
function templateInstallGuide() {
	showLoader();
	$("#loading").html("<h3>Instalar Templates</h3>\
	<h4>Paso 1</h4>Lo primero es descargar o crear una plantilla para CraftedWeb. Si tienes experiencia en HTML/CSS, deberias ser capaz de crear una plantilla sin mucha dificultad, utilizando \
	la plantilla predeterminada como nucleo o ejemplo. Si no sabes como crearla, deberias conseguir otras platillas de otra manera.\
	<h4>Paso 2</h4>A continuacion, coger la carpeta de de la plantilla que deseas instalar. El nombre de la carpeta no importa, pero debe ser una carpeta normal, sin ZIP ni RAR.\
	Sube la carpeta en /styles/ que se encuentra en la carpeta raiz donde instalastes CraftedWeb.\
	<h4>Paso 3</h4>Inicia sesion en el panel de Administracion, entra en Diseños > Plantillas, y a continuacion 'Instalar una nueva Plantilla'. En la primera entrada escribir el nombre de la carpeta que contiene nuestra plantilla, y en la segunda, poner el nombre de la plantilla para poder reconocerla.\
	<h4>Paso 4</h4>Volver al panel de Administracion, en Diseños > Plantillas, abajo en 'Elegir Plantilla' selecionar la plantilla que queremos instalar y haga click en Guardar.\
	<h4>Buen Trabajo!</h4>La nueva Plantilla ya debe estar instalada y activa en su nuevo sitio. Siempre puede desactivarlar en cualquier momento y activarla cuando lo desee.\  <br/>\
	<i>Para los Desarrolladores:</i> Una ves la plantilla este instalada, ya no debes volver a instalarla, puedes editar sobre la marcha cuando sea necesario..<br/>\
	<input type='submit' value='Listo!' onclick='hideLoader()'>");
}

function setTemplate() {
	var id = document.getElementById("choose_template").value;
	
	showLoader();
	$("#loading").html("Guardando...");
	$.post("../aasp_includes/scripts/layout.php", { action: "setTemplate", id: id },
       function(data) {
			window.location='?p=interface'
   });
   
}

function installTemplate() {
	
	var path = document.getElementById("installtemplate_path").value;
	var name = document.getElementById("installtemplate_name").value;
	
	showLoader();
	$("#loading").html("Guardando...");
	$.post("../aasp_includes/scripts/layout.php", { action: "installTemplate", path: path,name: name },
       function(data) {
			window.location='?p=interface'
   });
	
}

function uninstallTemplate() {
	
	var id = document.getElementById("uninstall_template_id").value;
	
	showLoader();
	$("#loading").html("Guardando...");
	$.post("../aasp_includes/scripts/layout.php", { action: "uninstallTemplate", id:id },
       function(data) {
			window.location='?p=interface'
   });
	
}

function editMenu(id) {
	
	showLoader();
	$.post("../aasp_includes/scripts/layout.php", { action: "getMenuEditForm", id:id },
       function(data) {
			$("#loading").html(data);
   });
	
}

function saveMenuLink(pos) {
	
	var title = document.getElementById("editlink_title").value;
	var url = document.getElementById("editlink_url").value;
	var shownWhen = document.getElementById("editlink_shownWhen").value;
	
	showLoader();
	$("#loading").html("Guardando...");
	$.post("../aasp_includes/scripts/layout.php", { action: "saveMenu", title: title, url: url, shownWhen: shownWhen, id: pos },
       function(data) {
			 if(data==true) {
			window.location='?p=interface&s=menu'
		   } else {
			 $("#loading").html(data);  
		   }
   });
   
}

function deleteLink(id) {
	
	showLoader();
	$("#loading").html("Estas seguro de eliminar este enlace?<br/><br/>\
	<input type='submit' value='Si' onclick='deleteLinkNow( " + id + " )'> <input type='submit' value='No' onclick='hideLoader()'>");
	
}

function deleteLinkNow(id) {
	
	showLoader();
	$("#loading").html("Guardando...");
	$.post("../aasp_includes/scripts/layout.php", { action: "deleteLink", id: id },
       function(data) {
			 if(data==true) {
			window.location='?p=interface&s=menu'
		   } else {
			 $("#loading").html(data);  
		   }
   });
   
}

function addLink() {
	
	showLoader();
	$("#loading").html("<h3>Añadir Enlace</h3>\
	Titulo<br/><input type='text' id='addlink_title'><br/>\
	Url<br/><input type='text' id='addlink_url'><br/>\
	Ver Cuando<br/><select id='addlink_shownWhen'>\
	<option value='always'>Always</option><option value='logged'>Conectado</option>\
	<option value='notlogged'>No Conectado</option>\
	</select><br/>\
	<input type='submit' value='Add' onclick='addLinkNow()'>");
	
}

function addLinkNow() {
	
	var title = document.getElementById("addlink_title").value;
	var url = document.getElementById("addlink_url").value;
	var shownWhen = document.getElementById("addlink_shownWhen").value;
	
	$("#loading").html("Añadiendo...");
	
	$.post("../aasp_includes/scripts/layout.php", { action: "addLink", title: title, url: url, shownWhen: shownWhen },
       function(data) {
		   if(data==true) {
			   window.location='?p=interface&s=menu'
		   } else {
			    $("#loading").html(data);  
		   }
   });
	
}

$("#menu_left ul li").not("#menu_head").click(function() {
	if($(this).next().is(":hidden")) {
			 $(this).next().slideDown("slow");
		} else {
          $(this).next().slideUp("slow");
		}
});

function savePage(filename) {

	var action = document.getElementById("action-" + filename).value;

	if(action==2 || action==1) {
		$.post("../aasp_includes/scripts/pages.php", { action: "toggle", value: action, filename: filename },
       function(data) {
			 window.location='?p=pages';
       });
	}
	
	if(action==3) {
		
		window.location='?p=pages&action=edit&filename=' + filename;
		
	}
	
	if(action==4) {
		showLoader();
		$("#loading").html('Estas seguro de eliminar esta pagina?<br/>\
		<input type="submit" value="Si" onclick="deletePage(\'' + filename +  '\')"> \
		<input type="submit" value="No" onclick="hideLoader()">');
	}
	
}

function deletePage(filename) {
	$.post("../aasp_includes/scripts/pages.php", { action: "delete", filename: filename },
       function(data) {
			 window.location='?p=pages';
       });
}

function removeSlideImage(id) {
	showLoader();
	$("#loading").html('Estas seguro de eliminar esta imagen?<br/>\
	<input type="submit" value="Si" onclick="removeSlideImageNow('+ id +')"> \
	<input type="submit" value="No" onclick="hideLoader()">');
}

function removeSlideImageNow(id) {
	$.post("../aasp_includes/scripts/layout.php", { action: "deleteImage", id: id },
       function(data) {
			 window.location='?p=interface&s=slideshow';
       });
}

function addSlideImage() {
	$("#addSlideImage").fadeIn(500);
}

function editVoteLink(id,title,points,image,url) {
	showLoader();
	$("#loading").html('Titulo<br/><input type="text" value="'+title+'" id="editVoteLink_title"><br/>\
	Puntos<br/><input type="text" value="'+points+'" id="editVoteLink_points"><br/>\
	Url Imagen <br/><input type="text" value="'+image+'" id="editVoteLink_image"><br/>\
	Url<br/><input type="text" value="'+url+'" id="editVoteLink_url"><br/>\
	<input type="submit" value="Save" onclick="saveVoteLink('+id+')"> <input type="submit" value="Close" onclick="hideLoader()">');
}

function saveVoteLink(id) {
	var title = document.getElementById("editVoteLink_title").value;
	var points = document.getElementById("editVoteLink_points").value;
	var image = document.getElementById("editVoteLink_image").value;
	var url = document.getElementById("editVoteLink_url").value;
	
	$.post("../aasp_includes/scripts/pages.php", { action: "saveVoteLink", id: id, title:title, points:points, image:image, url:url },
       function(data) {
			 window.location='?p=services&s=voting';
       });
}

function removeVoteLink(id) {
	showLoader();
	$("#loading").html('Estas seguro de eliminar este sitio de votacion?<br/>\
	<input type="submit" value="Si" onclick="removeVoteLinkNow('+ id +')"> \
	<input type="submit" value="No" onclick="hideLoader()">');
}

function removeVoteLinkNow(id) {
	$.post("../aasp_includes/scripts/pages.php", { action: "removeVoteLink", id: id },
       function(data) {
			 window.location='?p=services&s=voting';
       });
}

function addVoteLink() {
	showLoader();
	$("#loading").html('Titulo<br/><input type="text" id="addVoteLink_title"><br/>\
	Puntos<br/><input type="text" id="addVoteLink_points"><br/>\
	Url Imagen<br/><input type="text" id="addVoteLink_image"><br/>\
	Url<br/><input type="text" id="addVoteLink_url"><br/>\
	<input type="submit" value="Add" onclick="addVoteLinkNow()"> <input type="submit" value="Close" onclick="hideLoader()">');
}

function addVoteLinkNow() {
	var title = document.getElementById("addVoteLink_title").value;
	var points = document.getElementById("addVoteLink_points").value;
	var image = document.getElementById("addVoteLink_image").value;
	var url = document.getElementById("addVoteLink_url").value;
	
	   $.post("../aasp_includes/scripts/pages.php", { action: "addVoteLink", title:title, points:points, image:image, url:url },
       function(data) {
			 window.location='?p=services&s=voting';
       });
}

function saveServicePrice(service) {
	var price = document.getElementById(service + "_price").value;
	var currency = document.getElementById(service + "_currency").value;
	var enabled = document.getElementById(service + "_enabled").value;
	
	
	$.post("../aasp_includes/scripts/pages.php", { action: "saveServicePrice", service:service, price: price, currency: currency, enabled: enabled },
       function(data) {
			 window.location='?p=services&s=charservice';
       });
}

function disablePlugin(foldername) {
	
	$.post("../aasp_includes/scripts/layout.php", { action: "disablePlugin", foldername: foldername},
       function(data) {
			 window.location='?p=interface&s=viewplugin&plugin=' + foldername;
       });
}

function enablePlugin(foldername) {
	
	$.post("../aasp_includes/scripts/layout.php", { action: "enablePlugin", foldername: foldername},
       function(data) {
			 window.location='?p=interface&s=viewplugin&plugin=' + foldername;
       });
}