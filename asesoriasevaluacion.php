<?php
include('../app/config/config.php');
session_start();



if (isset($_SESSION['u_usuario'])) {
  //echo "existe sesión";
  //echo "bienvenido usuario";
  $correo_sesion = $_SESSION['u_usuario'];
  $query_sesion = $pdo->prepare("SELECT * FROM tb_usuarios WHERE correo = '$correo_sesion' AND estado = '1' ");
  $query_sesion->execute();
  $sesion_usuarios = $query_sesion->fetchAll(PDO::FETCH_ASSOC);
  foreach ($sesion_usuarios as $sesion_usuario) {
    $id_sesion = $sesion_usuario['id'];
    $id_nombres = $sesion_usuario['nombres'];
    $id_ap_paterno = $sesion_usuario['ap_paterno'];
    $id_ap_materno = $sesion_usuario['ap_materno'];
    $id_sexo = $sesion_usuario['sexo'];
    $id_numero_control = $sesion_usuario['numero_control'];
    $id_carrera = $sesion_usuario['carrera'];
    $id_correo = $sesion_usuario['correo'];
    $id_estado_civil = $sesion_usuario['estado_civil'];
    $id_telefono = $sesion_usuario['telefono'];
    $id_ciudad = $sesion_usuario['ciudad'];
    $id_colonia = $sesion_usuario['colonia'];
    $id_calle = $sesion_usuario['calle'];
    $id_codigo_postal = $sesion_usuario['codigo_postal'];
    $id_curp = $sesion_usuario['curp'];
    $id_fecha_nacimiento = $sesion_usuario['fecha_nacimiento'];
    $id_nivel_escolar = $sesion_usuario['nivel_escolar'];
    $id_reticula = $sesion_usuario['reticula'];
    $id_entidad = $sesion_usuario['entidad'];
    $id_foto_perfil = $sesion_usuario['foto_perfil'];
  }





?>

  <?php
  $sqlito =
    ("SELECT * FROM tb_claseasesoria INNER JOIN tb_tutorias ON tb_tutorias.id = tb_claseasesoria.id_alumnoo WHERE id_asesor = $id_sesion ");





  $resultado = mysqli_query($conexion, $sqlito);


  ?>



  <!DOCTYPE html>
  <html>

  <head>
    <?php include('../layout/head.php'); ?>
    <title>Guia de actividades Complementarias</title>
    <link rel="stylesheet" href="../css/StyleNew.css">
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include('../layout/menumaestro.php'); ?>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Alumnos asesorias

          </h1>

        </section>

        <!-- Main content -->
        <section class="content">
          <div class="panel panel-primary">
            <div class="panel-heading">Guia de Actividades Complementarias</div>
            <div class="panel-body">
              <table class="table table-bordered table-hover table-condensed">


                <th>TEMA</th>
                <th>ASIGNATURA</th>
                <th>ALUMNO</th>
                <th>HORARIO DE ASESORIA</th>
                <th>DIAS ASESORIA</th>
                <th>Estado</th>

                <?php
                while ($filas = mysqli_fetch_assoc($resultado)) {
                ?>
                  <tr>
                    <td><?php echo $filas['tema'] ?></td>
                    <td><?php echo $filas['materia'] ?></td>
                    <td><?php echo $filas['nombres'] ?> <?php echo $filas['ap_paterno'] ?> <?php echo $filas['ap_materno'] ?></td>
                    <td><?php echo $filas['horario'] ?></td>
                    <td><?php if ($filas['lunes'] == 'si'){
                                                        echo "Lunes";
                                                    }
                                                    ?>
                                                    <?php if ($filas['martes'] == 'si'){
                                                        echo "Martes";
                                                    }
                                                    ?>
                                                    <?php if ($filas['miercoles'] == 'si'){
                                                        echo "Miercoles";
                                                    }
                                                    ?>
                                                    <?php if ($filas['jueves'] == 'si'){
                                                        echo "Jueves";
                                                    }
                                                    ?>
                                                    <?php if ($filas['viernes'] == 'si'){
                                                        echo "Viernes";
                                                    }
                                                    ?>


                    </td>
                  

                    <td>
                      <?php
                      if ($filas['observacion_finalizada'] == null) {
                        echo '<span class="rounded-pill badge badgedefault bg-red px-3">Asesoria no finalizada</span>';
                      } else {
                       echo '<span class="rounded-pill badge badgedefault bg-green px-3">Asesoria finalizada</span>';
                      }
                      ?>

                    </td>



                    <td>

                      <?php if ($filas['observacion'] == null) { ?>

                        <button type="button" class="btn btn-success rounded-pill" data-toggle="modal" data-target="#exampleModal<?php echo $filas['id_asesoria']; ?> ">Evaluar</button>
                      <?php } else { ?>
                        <button type="button" class="btn btn-success rounded-pill" data-toggle="modal" disabled data-target="#exampleModal<?php echo $filas['id_asesoria']; ?> ">Evaluar</button>

                      <?php } ?>

                    </td>




                    <td>

                      <?php if ($filas['observacion'] == true) { ?>



                        <?php if ($filas['observacion_finalizada'] == null) { ?>

                          <button type="button" class="btn btn-success rounded-pill" data-toggle="modal" data-target="#exampleModal2<?php echo $filas['id_asesoria']; ?> ">Finalizar asesoria</button>
                        <?php } else {


                        ?>
                          <button type="button" class="btn btn-success rounded-pill" data-toggle="modal" disabled data-target="#exampleModal<?php echo $filas['id_asesoria']; ?> ">Finalizar asesoria</button>

                        <?php } ?>
                      <?php } ?>


                    </td>


                  </tr>








              <!-- Button trigger modal -->


              <!-- Modal -->
              <div class="modal fade" id="exampleModal<?php echo $filas['id_asesoria']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Retroalimentacion alumno asesoria</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <form action="asesoria_evaluacion.php" method="post" class="actualizar_incidencia">
                      <input type="hidden" name="id" value="<?php echo $filas['id_asesoria']; ?>">
                      <div class="modal-body">

                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label for="motivo">Retroalimentacion</label>
                              <div class="">
                                <textarea name="obs" id="" class="form-control" placeholder="Motivo de incidencia" required>
                            </textarea>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group" class="col-sm2 control-label">
                          <label for="status">Seleccionar Status de incidencia</label>
                          <select name="status_incidencia" id="status_incidencia" class="form-control">
                            <option value="">Elegir una Opcion</option>
                            <option value="1" <?= (isset($incidencia) && $incidencia == 1) ? 'selected' : '' ?>>Iniciada</option>
                            <option value="2" <?= (isset($incidencia) && $incidencia == 2) ? 'selected' : '' ?>>Proceso</option>
                            <option value="3" <?= (isset($incidencia) && $incidencia == 3) ? 'selected' : '' ?>>Pausada</option>



                          </select>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success">Save changes</button>
                        </div>
                      </div>
                  </div>
                </div>

                </form>

              </div>


              <div class="modal fade" id="exampleModal2<?php echo $filas['id_asesoria']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Finalizar asesoria</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <form action="asesoria_finalizada.php" method="post" class="finalizar_asesoria">
                      <input type="hidden" name="id" value="<?php echo $filas['id_asesoria']; ?>">
                      <div class="modal-body">

                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label for="motivo">Retroalimentacion final</label>
                              <div class="">
                                <textarea name="obs_final" id="" class="form-control" placeholder="Motivo de incidencia" required>
                            </textarea>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group" class="col-sm2 control-label">
                          <label for="status">Seleccionar Status de incidencia</label>
                          <select name="status_incidencia_final" id="status_incidencia" class="form-control">
                            <option value="">Elegir una Opcion</option>
                            <option value="4" <?= (isset($incidencia) && $incidencia == 1) ? 'selected' : '' ?>>Finalizada</option>




                          </select>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success">Save changes</button>
                        </div>
                      </div>
                  </div>
                </div>

                </form>

              </div>






              <!-- /.content -->
            <?php

                }


            ?>
            
            </div>
       
          </div>
          <!-- /.content-wrapper -->
        


          <script>
            $('.actualizar_incidencia').submit(function(e) {
              e.preventDefault();
              Swal.fire({
                title: '¿DESEAS GUARDAR LOS CAMBIOS?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, DESEO GUARDAR'
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire({
                    title: 'CAMBIOS GUARDADOS CORRECTAMENTE',
                    icon: 'success',
                    showConfirmButton: false,
                  })
                  setTimeout(() => {
                    this.submit();
                  }, "1000")

                }

              })

            });



            $('.finalizar_asesoria').submit(function(e) {
              e.preventDefault();
              Swal.fire({
                title: '¿DESEAS GUARDAR LOS CAMBIOS?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, DESEO GUARDAR'
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire({
                    title: 'CAMBIOS GUARDADOS CORRECTAMENTE',
                    icon: 'success',
                    showConfirmButton: false,
                  })
                  setTimeout(() => {
                    this.submit();
                  }, "1000")

                }

              })

            });
          </script>

          <?php include('../layout/footer_links.php'); ?>

  </body>



  </html>
<?php
} else {
  echo "no existe sesión";
  header('Location:' . $URL . '/login');
} ?>
