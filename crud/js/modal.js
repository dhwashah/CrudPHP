$(document).ready(function(){
	$("a[name='eliminar']").click(function(e){
		var valor = e.target.attributes['value']['value'];
		$("#btnEliminar").attr('value', valor);
	});
});