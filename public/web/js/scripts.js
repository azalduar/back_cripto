$(document).ready(function(){
  	$(".contenedor-caja-evento .cruz, .cruz-grande").mouseenter(function(){
  		var id= $(this).data('id');		
  		//console.log();
  		$("#prin"+id).hide("slow");
  		$("#hover"+id).show("slow");
  	});

  	 	
  	$(".contenedor-caja-evento .caja-3.hover").mouseleave(function(){
		var data = $(this).data('hover');
		//console.log(data);
		$("#hover"+data).hide("slow");	
		$("#prin"+data).show("slow");  			

	});

	/*$(".inicio-sesion").click(function(){
		$(".formulario").slideDown("slow");
		$("body, header").css("background-color","rgba(0, 0, 0, .6)");
		$(".navbar-toggle").addClass("collapsed");
		$(".navbar-collapse.collapse").removeClass("in");
		
	});

	$(".cerrar-form").click(function(){
		$(".formulario").slideUp("slow");
		$("body, header").css("background-color","unset");
	});*/

});

 	