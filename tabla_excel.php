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
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/plugins/dataTables/datatables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

</head>
<body>
<?php
$tipo=$_SESSION['tipo_usuario'];
    if($tipo==1){
?>
<div class="container">
        <header class="row">
            <div class="center"  id="titulo">   
               <!-- <H1>HEADER</H1> -->
            </div>
		</header>
        <p>
 			<section class="contenedor-main row">
              <div class="col-sm-2"> <!-- Inicio Menú -->
              <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Menú </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                         <a class="dropdown-item" href="./tabla_admon.php">PÁGINA PRINCIPAL</a>
                         <a class="dropdown-item" href="./form_nuevo.php"> REGISTRO NUEVO </a>
                         <a class="dropdown-item" href="./tabla_excel.php">BUSCAR Y EXPORTAR A:</a>

             </div>
             </div>           
         
            </div> <!-- FIN Menú-->
            
			 
            <main class="col-md-8">
            <table class="table table-striped" id="cabecera">
					<td><a><strong><?php echo $_SESSION['nombre']; ?></strong></a> </td>
	  		</table>
              </main>
                 

            <div class="col-sm-2">
			 <table class="table">
					<td width="350" align="right"><a href="desconectar.php" class="btn btn-info"> Cerrar Sesion </a></td>
   			 </table>	
            <!-- Lado derecho -->
             </div>  
             </section> 

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
                                                <th>No.</th>
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

                                            $i = 1;
                                            $_pagi_sql = "SELECT * FROM tbl_docs,tbl_asignados, tbl_usuarios, cat_areas, cat_conceptos, tbl_resolucion
                                            WHERE tbl_asignados.idfolio=tbl_docs.Idfolio
                                            and tbl_asignados.cvesp=tbl_usuarios.id_usuario
                                            and tbl_resolucion.docref=tbl_docs.Idfolio
                                            and tbl_asignados.idconcepto=cat_conceptos.Id
                                            and tbl_asignados.cvesp=tbl_resolucion.sprecibe
                                            and tbl_usuarios.idarea=cat_areas.Id
                                            and tbl_docs . fechaact >= '2019-01-01'
                                            order by tbl_docs . idfolio asc";

                                            //and fecha >='2019-01-01'
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
                                                   
                                                    ?>
                                            <tr>
                                          
                                            <td>  <?php echo $idfolio=$row['idfolio']; ?></td>
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
                                                   <!-- <strong>Finalizado</strong>-->
                                                        <form name="resolucion" method="post" action="./resolucion2.php">
                                                        <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                                                        <input type="submit" name="resolucion" class=" btn-danger" value="Finalizado">

                                                    </form>

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
                dom: '<"html7buttons"B>lTfgitp',
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
 
}elseif($tipo==2){

    header("Location:tabla_super.php");

  }elseif($tipo==3){

    header("Location:tabla_usu.php");

      }elseif($tipo==4){

        header("Location:tabla_oficialia.php");

  }else{
      header("Location:index.php");

  }

?> 

</body>

</html> 