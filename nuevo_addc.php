<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    ASIGNAR
</button>
<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body 
                <script language="JavaScript" type="text/javascript" src="./js/ajax.js"></script>-->
            <div class="modal-body">
            <script src="js/jquery-3.3.1.min.js"></script> 
                <script language="JavaScript" type="text/javascript" src="./js/ajax1.js"></script>


                <script language="javascript">
                    $(document).ready(function(){
                    $("#area").on('change', function () {
                    $("#area option:selected").each(function () {
                        elegido=$(this).val();
                        $.post("./usuarios.php", { elegido: elegido }, function(data){
                            $("#usuarios").html(data);
                        });			
                                    });
                            });
                            });
                </script>
                <?php $idfolio=$_POST['idfolio']; 
                include("bd/conexion.php"); 
                ?>

                <main class="container">

                    <div class="row">

                        <div class="col-sm-4">

                            <div class="card card-body">

                                <form name="nuevo_empleado" action="" onsubmit="enviarDatosEmpleado(); return false">

                                    <input type="text" id="folio" value="<?php echo $idfolio; ?>" name="folio">

                                    <fieldset class="fieldset1">
                                        <legend class="legend1 estilo4">
                                            Asignar a:</legend>
                                        <p for="usuarios"> Área </p>
                                        <?php 
                                        $sql = "SELECT * FROM cat_areas";
                                        $resultado = $dbh->query($sql); ?>

                                        <select name="area" id="area" class="form-control" tabindex="8">
                                            <option name="areas" value="0"> Elige una opción</option>
                                            <?php
                                            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                                $area = $row['area'];
                                                ?>
                                            <option name="areas" value="<?php echo $row['Id']; ?>">
                                                <?php echo trim($area); ?>
                                            </option>
                                            <?php 
                                        } ?>
                                        </select>

                                        <p for="usuarios">Servidor Público </p>

                                        <?php
                                        $sql1 = "SELECT * FROM tbl_usuarios, cat_areas where cat_areas.Id=1 and cat_areas.Id=tbl_usuarios.idarea  ";
                                        $resultado = $dbh->query($sql1); ?>
                                        <select name="usuarios" id="usuarios" class="form-control" tabindex="9">
                                            <option value="0"> Elige una opción</option>
                                            <?php
                                            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <option value="<?php echo $row['cvesp']; ?>">
                                                <?php echo $row['nombre']; ?>
                                            </option>
                                            <?php 
                                        } ?>
                                        </select>

                                        <p>Concepto</p>
                                        <?php
                                        $sql2 = "SELECT * FROM cat_conceptos";
                                        $resultado2 = $dbh->query($sql2); ?>
                                        <select name="concepto" class="form-control" tabindex="10">
                                            <option value="0"> Elige un Concepto</option>
                                            <?php
                                            while ($row2 = $resultado2->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <option value="<?php echo $row2['Id']; ?>">
                                                <?php echo $row2['tarea']; ?>
                                            </option>
                                            <?php 
                                        }
                                        ?>
                                        </select>
                                        <p>
                                    </fieldset>
                                    <input type="submit" class="btn btn-success btn-block" value="Asignar Tarea" />

                                </form>
                            </div> <!-- cierre del class="card card-body" -->
                        </div>
                        <!--cierre de col-sm-4-->
                        <div id="resultado">
                            <?php include('tabla_old.php');  ?>
                        </div>
                    </div>
                </main>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>

