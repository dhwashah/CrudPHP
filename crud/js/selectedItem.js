$(document).ready(function(){
	var tabla = $("#tabla").text();

	//activar item
	$("ul li").each(function(){ 
		if(tabla == $(this).text())
			$(this).addClass("active")
	});

});