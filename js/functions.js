$(function(){

	// Lista de Unidades
	$.post( 'unidad.php' ).done( function(respuesta)
	{
		$( '#unidad' ).html( respuesta );
	});

	// lista de Paises	
	$('#unidad').change(function()
	{
		var la_unidad = $(this).val();
		
		// Lista de analistas
		$.post( 'analista.php', { unidad: la_unidad} ).done( function( respuesta )
		{
			$( '#nombre' ).html( respuesta );
		});
	});
	
	// Lista de Ciudades
	$( '#nombre' ).change( function()
	{
		var nombre = $(this).children('option:selected').html();
		//alert( 'Lista de Analistas de ' + nombre );
	url:"datos.php",
	});
	
})
