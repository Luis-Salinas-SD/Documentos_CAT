<!DOCTYPE html>
<?php

session_start();
if (@!$_SESSION['cvesp']) {
    header("Location:index.php");
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/titulo.css"/>
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/estilo_index.css">
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/plugins/dataTables/datatables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

</head>
<body>
<?php
$tipo=$_SESSION['tipo_usuario'];
    if($tipo==3){
?> 

        <header>
            
		</header>
        <p>
        <table width="980" class="ubica1">
					<td width="479" align="left" ><a>  Bienvenido <strong><?php echo $_SESSION['nombre']; ?></strong></a> </td>

					<td width="105" align="right"><a class="external" href="./Manuales/analista.pdf">
                     <input id="ayuda" type="image" src="./img/help.png" alt ="Ayuda" title="Ayuda">
                     </a>
					 </td>
					 
	  				<td width="105" align="right"><a href="desconectar.php"> Cerrar Sesion </a></td>
   				 </table>
   				
                    <div class="container">	
  		 <div class="header row">
  			<div class="navegacion col">
 				
  				<nav class="navbar navbar-default" role="navigation">
  				
  				<ul id="button">
		
					 
                  <li><a href="tabla_usu.php">REGRESAR A TABLA</a></li>
                  <li><a href="historial_usuario.php">HISTORIAL</a></li>
							 
					</ul>
			</nav>
			</div>
			</div>

            <div class="row">
            <div class="col-lg-12">   

            <div class="center" style="text-align: center;"> 
                     <h2>
                          
                            BUSQUEDA Y EXPORTACION A:
                        
                    </h2>
            </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                            <tr>

                                                <th>FECHA</th>
                                                <th>DOCUMENTO</th>
                                                <th>EMITIDO</th>
                                                <th>DESCRIPCIÓN</th>
                                                <th>TURNADO</th>
                                                <th>ESTATUS</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $i = 1;
                                            require('./bd/conndb1.php');
                                            $conexion = getConn();

                                            $idarea=$_SESSION['id_usuario'];
                                          
                                            $_pagi_sql = "SELECT * FROM tbl_docs,tbl_asignados, tbl_usuarios, 
                                                        cat_areas, cat_conceptos, tbl_resolucion
                                                        WHERE tbl_asignados.idfolio=tbl_docs.Idfolio
                                                        and tbl_asignados.cvesp=tbl_usuarios.id_usuario
                                                        and tbl_resolucion.docref=tbl_docs.Idfolio
                                                        and tbl_asignados.idconcepto=cat_conceptos.Id
                                                        and tbl_asignados.cvesp=tbl_resolucion.sprecibe
                                                        and tbl_usuarios.idarea=cat_areas.Id
                                                        and tbl_usuarios.id_usuario=$idarea
                                                        and tbl_docs . fechaact >= '2019-01-01'
                                                        order by tbl_docs . idfolio asc";
                                           
                                            $_pagi_result = $conexion->query($_pagi_sql);
                                            $numfilas = $_pagi_result->rowCount();
                                            if ($numfilas == 0) {
                                                echo '<script>alert(" NO CUENTA CON REGISTROS EN ESTA SECCION ")</script>';
                                                ?>

                                            <?php

                                        } else {

                                            while ($i <= 1) {
                                                while ($row = $_pagi_result->fetch(PDO::FETCH_ASSOC)) {
                                                    $turnado_nombre = $row['nombre'];
                                                    $turnado_area = $row['area'];
                                                    $turnado = $turnado_nombre . '<br>' . $turnado_area;
                                                    $idfolio=$row['idfolio'];
                                                    ?>
                                            <tr>
                                                <td class="center">
                                                    <?php echo $row['fecha_doc']; ?>
                                                </td>
                                                <td class="center">
                                                    <?php echo $row['docreferencia']; ?>
                                                </td>
                                                <td class="center">
                                                    <?php echo $row['remitente']; ?>
                                                </td>
                                                <td class="center">
                                                    <?php echo $row['descripcion']; ?>
                                                </td>
                                                <td class="center">
                                                    <?php echo $turnado; ?>
                                                </td>
                                                <?php
                                                if ($row['estatus'] == 1) {

                                                    ?>


                                                <td class="center">
                                                    <div class="alert alert-success">
                                                        <strong>En proceso</strong>
                                                    </div>
                                                </td>
                                                <?php

                                            } else {

                                                ?>
                                                <td class="center">
                                                    <div class="alert alert-danger">
                                                    
                                                    <a href="resolucion4.php?idfolio=<?php echo $idfolio; ?>"> 
                                                    
                                                       <strong>Finalizado</strong> </a>
                                                    </div>
                                                </td>

                                                <?php

                                            }

                                            ?>

                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    }
                                }
                                ?>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html6buttons"B>lTfgitp',
                buttons: [{
                        extend: 'excel',
                        title: 'DATOS DE TABLA'
                    },
                    {
                        extend: 'print',
                        customize: function(win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]

            });

        });
    </script>
<?php
  }elseif($tipo==1){

    header("Location:tabla_admon.php");

  }elseif($tipo==2){

    header("Location:tabla_super.php");

      }elseif($tipo==4){

        header("Location:tabla_oficialia.php");

  }else{
      header("Location:index.php");

  }

?> 
</body>

</html> 