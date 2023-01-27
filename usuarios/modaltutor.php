<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    $tutor_sql = "SELECT * FROM `tb_usuarios` WHERE cargo = 1;";
    $resultado_tutor = mysqli_query($conexion, $tutor_sql);
    ?>
</head>

<body>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#example<?php echo $filas['id']; ?>">
        Asignar tutor
    </button></td>





    <div class="modal fade" id="example<?php echo $filas['id']; ?>" tabindex="-1" aria-labelledby="example" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="example">Asignar tutor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>


                <form method="post" action="actualizar_tutor.php" class="asignar_tutor">
                    <input type="hidden" name="id" value="<?php echo $filas['id']; ?>">
                    <div class="modal-body">
                        
                        <div class="col">
                            <div class="form-group" class="col-sm2 control-label">


                            <div class="row">
                                <div class="col">
                                    <label for="" class="form-group">CARRERA:</label>
                                <?php echo $filas['carrera'] ?>
                                </div>

                                <div class="col">
                                <label for="" class="form-group">SEMESTRE:</label>
                                <?php echo $filas['semestre'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                <label for="" class="form-group">PERIODO:</label>
                                    <?php echo $filas['periodo'] ?>
                                </div>
                                <div class="col">
                                <label for="" class="form-group">DIAS TUTORIA:</label>
                                <?php echo $filas['dias_tutoria']?>
                                </div>
                            </div>

                                <label for="prioridad">Seleccionar tutor</label>
                                <select name="tutor" id="" class="form-control" required>
                                    <option value="">Seleccionar una opcion</option>
                                    <?php
                                    while ($resultado_query = mysqli_fetch_assoc($resultado_tutor)) {
                                    ?>

                                        <option value="<?php echo $resultado_query['id'] ?>">
                                            <?php echo $resultado_query['nombres'] ?>
                                            <?php echo $resultado_query['ap_paterno'] ?>
                                            <?php echo $resultado_query['ap_materno'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" value="Actualizar">Guardar</button>
                    </div>




                </form>


                </td>


            </div>




        </div>
    </div>
    </div>
    </div>

    <div>

</body>

</html>