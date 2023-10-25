	function load(page){
		var parametros = {"action":"ajax"};
		$("#loader").fadeIn('slow');
		$.ajax({
			url:'tabla.php',
			data: parametros,
			 beforeSend: function(objeto){
			$("#loader").html("<img src='./img/loader.gif'>");
			},
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$("#loader").html("");
			}
		})
	}

		$('#dataUpdate').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		  var no_oficio = button.data('no_oficio') // Extraer la información de atributos de datos
		  var usuario = button.data('usuario')
		  var unidad = button.data('unidad')
		 
		 	  
		  
		  
		  var modal = $(this)
		 // modal.find('.modal-title').text('Modificar analista: '+nombre)
		  modal.find('.modal-body #no_oficio').val(no_oficio)
		  modal.find('.modal-body #usuario').val(usuario)
		  modal.find('.modal-body #unidad').val(unidad)
		 
		  
		  
		 
		  $('.alert').hide();//Oculto alert
		})
		
		
	$(document).ready(function(){
		  $.ajax({
			type: 'POST',
			url: 'unidad.php'
		  })
		  .done(function(listas_rep){
			$('#uni').html(listas_rep)
		  })
		  .fail(function(){
			alert('Hubo un errror al cargar las Unidades')
		  })

		  $('#uni').on('change', function(){
			var id = $('#uni').val()
			$.ajax({
			  type: 'POST',
			  url: 'usuario.php',
			  data: {'id': id}
			})
			.done(function(listas_rep){
			  $('#usuarios').html(listas_rep)
			})
			.fail(function(){
			  alert('Hubo un errror al cargar los Analistas')
			})
		  })
		  
		 
		  $('#enviar').on('click', function(){
			alert('ASIGNACION:            ' + $('#uni option:selected').text() +
			'                                  ANALISTA:             ' + $('#usuarios option:selected').text() )
			
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
	
	
	
	$('#dataRegister').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		  var no_oficio = button.data('no_oficio') // Extraer la información de atributos de datos
		  	  
		  
		  
		  var modal = $(this)
		 // modal.find('.modal-title').text('Modificar analista: '+nombre)
		  modal.find('.modal-body #no_oficio').val(no_oficio)
		    
		  
		 
		  $('.alert').hide();//Oculto alert
		})
		
	$( "#guardarNota" ).submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "agrenota.php",
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
			
		$( "#guardar" ).submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "fase.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#datos1_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#datos1_ajax").html(datos);
					
					load(1);
				  }
			});
		  event.preventDefault();
		});
