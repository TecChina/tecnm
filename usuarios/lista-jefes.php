<?php
include('../app/config/config.php');
session_start();



if (isset($_SESSION['u_usuario']) && $_SESSION['u_privilegio']  == 0 ) {
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
  
  //control de inactividad
  $ahora = date("Y-n-j H:i:s");
  $fechaGuardada = $_SESSION["ultimoAcceso"];
  $tiempo_transcurrido = (strtotime($ahora) - strtotime($fechaGuardada));

  if ($tiempo_transcurrido >= 600) {
    //si pasaron 10 minutos o más
    session_destroy(); // destruyo la sesión
    header('location:../index.php'); //envío al usuario a la pag. de autenticación
    //sino, actualizo la fecha de la sesión
  } else {
    $_SESSION["ultimoAcceso"] = $ahora;
  }
?>



  <!DOCTYPE html>
  <html>

  <head>
    <?php include('../layout/head.php'); ?>
    <title>Listado de Alumnos</title>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include('../layout/menu.php'); ?>

      <!-- cierre sesion por inactividad -->
      <?php if ($_SESSION["ultimoAcceso"] >= 600) {
        echo ("<meta http-equiv='refresh' content='600'>");
      } ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            JEFES
          </h1>

        </section>

        <br>

        <div class="container">
        <a href="create_jefes.php" class="btn btn-primary">Nuevo jefe</a>
        </div>

        <!-- Main content -->
        <section class="content">
          <div class="panel panel-primary">
            <div class="panel-heading">Lista de Jefes</div>
            <div class="panel-body">
              <table class="table table-bordered table-hover table-condensed">
                <center><th>N°</th></center>
                <th>Nombre Completo</th>

                <th>Correo Institucional</th>
                <th>Departamento Asignado</th>
                <th>Acciones</th>

                <?php
                $contador_usuarios = 0;
                $query_usuarios = $pdo->prepare("SELECT tb_jefes.id, tb_jefes.nombres, tb_jefes.correo, departamento.departamento FROM tb_jefes INNER JOIN departamento ON tb_jefes.id_departamento = departamento.id");
                $query_usuarios->execute();
                $usuarios = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);
                foreach ($usuarios as $jef) {
                  $id = $jef['id'];
                  $nombres = $jef['nombres'];
                  $correo = $jef['correo'];
                  $departamento = $jef['departamento'];
                  $contador_usuarios = $contador_usuarios + 1;
                ?>

                  <tr>
                    <td>
                      <center><?php echo $contador_usuarios; ?></center>
                    </td>
                    <td><?php echo $nombres; ?></td>

                    <td>
                      <?php echo $correo; ?>
                    </td>

                    <td>
                      <?php echo $departamento; ?>
                    </td>

                    <td>
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#example<?php echo $jef['id']; ?>">
                        Editar
                      </button>

                      <div class="modal fade" id="example<?php echo $jef['id']; ?>" tabindex="-1" aria-labelledby="example" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="example">Actualización del jefe de departamento</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>

                            </div>


                            <form method="post" action="actualizar_jefes.php">
                              <input type="hidden" name="id" value="<?php echo $jef['id']; ?>">

                              <div class="modal-body" id="">

                                  <div class="form-group">
                                    <label>N°</label>
                                    <?php echo $jef['id']; ?>
                                  </div>

                                  <div>
                                    <label>Nombre Completo</label>
                                    <input type="text" name="nombres" id="" class="form-control" placeholder="nombre completo" <?php echo $nombres; ?>>
                                  </div>

                                  <div>
                                    <label>Correo Institucional</label>
                                    <input type="text" name="correo" id="" class="form-control" placeholder="correo" <?php echo $correo; ?>>
                                  </div>

                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" value="Actualizar" onclick="alerta_guardar(<?php echo $jef['id']; ?>)">Guardar</button>
                                  </div>



                              </div>
                            </form>






                          </div>




                        </div>
                      </div>

                      <a onclick="alerta_eliminar3(<?php echo $jef['id']; ?>)" class="btn btn-danger">Eliminar</a>
                    </td>
                  </tr>
                <?php
                }
                ?>


              </table>
            </div>
          </div>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <?php include('../layout/footer.php'); ?>
      <?php include('../layout/footer_links.php'); ?>


      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="js/sweetalert.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  </body>

  </html>
<?php
} else {
  echo "no existe sesión";
  header('Location:' . $URL . '/login');
}
