	function load(page){
		var parametros = {"action":"ajax"};
		$("#loader").fadeIn('slow');
		$.ajax({
			url:'tabla.php',
			data: parametros,
			 beforeSend: function(objeto){
			$("#loader").html("<img src='loader.gif'>");
			},
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$("#loader").html("");
			}
		})
	}

		$('#dataUpdate').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		  var idreg = button.data('idreg') // Extraer la información de atributos de datos
		  var no_oficio = button.data('no_oficio') // Extraer la información de atributos de datos
		  var estatus = button.data('estatus') // Extraer la información de atributos de datos
		  var avances = button.data('avances') // Extraer la información de atributos de datos
		  var usuario = button.data('usuario')
		  var unidad = button.data('unidad')
		  var unidad1 = button.data('unidad1')
		  var nombre0 = button.data('nombre0')
		  
		  
		  
		  var modal = $(this)
		 // modal.find('.modal-title').text('Modificar analista: '+nombre)
		  modal.find('.modal-body #idreg').val(idreg)
		  modal.find('.modal-body #no_oficio').val(no_oficio)
		  modal.find('.modal-body #estatus').val(estatus)
		  modal.find('.modal-body #avances').val(avances)
		  modal.find('.modal-body #usuario').val(usuario)
		  modal.find('.modal-body #unidad').val(unidad)
		  modal.find('.modal-body #unidad1').val(unidad1)
		  modal.find('.modal-body #nombre0').val(nombre0)
		  
		 
		  $('.alert').hide();//Oculto alert
		})
		
		
	$(document).ready(function(){
		  $.ajax({
			type: 'POST',
			url: 'unidad.php'
		  })
		  .done(function(listas_rep){
			$('#lista_reproduccion').html(listas_rep)
		  })
		  .fail(function(){
			alert('Hubo un errror al cargar las Unidades')
		  })

		  $('#lista_reproduccion').on('change', function(){
			var id = $('#lista_reproduccion').val()
			$.ajax({
			  type: 'POST',
			  url: 'usuario.php',
			  data: {'id': id}
			})
			.done(function(listas_rep){
			  $('#videos').html(listas_rep)
			})
			.fail(function(){
			  alert('Hubo un errror al cargar los Analistas')
			})
		  })

		  $('#enviar').on('click', function(){
			var resultado = 'ASIGNACION:            ' + $('#lista_reproduccion option:selected').text() +
			' ANALISTA:             ' + $('#videos option:selected').text()

			$('#resultado1').html(resultado)
		  })

		})
		
		
		
	$( "#guardarDatos" ).submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "agregar.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#datos_ajax_register").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#datos_ajax_register").html(datos);
					
					load(1);
				  }
			});
		  event.preventDefault();
		});
		
		$( "#Datos" ).submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "agregar.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#datos_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#datos_ajax").html(datos);
					
					load(1);
				  }
			});
		  event.preventDefault();
		});
	
		
