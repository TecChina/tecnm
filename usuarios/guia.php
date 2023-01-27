<?php
include('../app/config/config.php');
session_start();

if (isset($_SESSION['u_usuario']) && $_SESSION['u_privilegio']  == 0) {
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

  //$sentencia = $pdo->query("SELECT * FROM guia;");
  //$actividades = $sentencia->fetchAll(PDO::FETCH_OBJ);
  //print_r($actividades);

  $guia = $pdo->prepare("SELECT * FROM guia");
  $guia->execute();
  $actividades = $guia->fetchAll(PDO::FETCH_ASSOC);

?>

  <!DOCTYPE html>
  <html>

  <head>
    <?php include('../layout/head.php'); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../app/templeates/AdminLTE-2.3.11/bootstrap/css/bootstrap.css">
    <title>Guia de actividades Complementarias</title>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include('../layout/menu.php'); ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- cierre sesion por inactividad -->
        <?php if ($_SESSION["ultimoAcceso"] >= 600) {
          echo ("<meta http-equiv='refresh' content='600'>");
        } ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            SISTEMA DE CREDITOS COMPLENTARIOS
            <small>Guia de Actividades Complementarias</small>
          </h1>
        </section>

        <br>

        <div class="container">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertar">Añadir actividad</button>
        </div>
        <!--MODAL (nueva actividad)-->
        <div class="modal fade" id="insertar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Ingrese actividad complementaria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--formulario-->
                <form action="registrar.php" method="POST" class="nuevo_evento">
                  <div class="form-group">
                    <label for="">Nombre de la actividad</label>
                    <textarea class="form-control mb-3" name="actividad" placeholder="Actividad"></textarea>
                    <label for="">Decripción</label>
                    <textarea class="form-control mb-3" name="descripcion" placeholder="Descripción"></textarea>
                    <div class="row">
                      <div class="col">
                        <label for="">Crédito de actividad</label>
                        <input type="text" class="form-control mb-3" name="credito" placeholder="Crédito por actividad">
                      </div>
                      <div class="col">
                        <label for="">Máximo acomular</label>
                        <input type="text" class="form-control mb-3" name="maximo" placeholder="Máximo por acomular">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>

              </div>

            </div>
          </div>
        </div>
      </div>
      <br>


      <!--CRUD-->


      <div class="container">
        <div class="panel panel-primary">
          <div class="panel-heading">Guia de Actividades Complementarias</div>

          <table class="table table-bordered table-hover table-condensed">
            <thead>
              <tr>
                <th scope="col">Actividad</th>
                <th scope="col">Descripción</th>
                <th scope="col">Crédito por actividad</th>
                <th scope="col">Máximo acomular</th>
              </tr>
            </thead>

            <tbody>
              <!--registros de la bd-->
              <?php
              $sql = "SELECT * FROM guia";

              $row = mysqli_query($conexion, $sql);

              while ($result = mysqli_fetch_assoc($row)) {
              ?>
                <tr>
                  <td><?php echo $result['actividad'] ?></td>
                  <td><?php echo $result['descripcion'] ?></td>
                  <td><?php echo $result['credito'] ?></td>
                  <td><?php echo $result['maximo'] ?></td>
                  <td><button type="button" class="btn btn-success editbtn" data-toggle="modal" data-target="#example<?php echo $result['id']; ?>">Editar</button></td>




        </div>

        <!--MODAL (editar actividad)-->
        <div class="modal fade" id="example<?php echo $result['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Editar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--formulario-->
                <form action="editar.php" method="POST" class="editar_evento">
                  <input type="hidden" name="id_editar" value="<?php echo $result['id']; ?>">

                  <div class="form-group">
                    <label for="">Nombre de la actividad</label>
                    <textarea class="form-control mb-3" name="actividad" id="actividad" placeholder="Actividad"><?php echo $result['actividad'] ?></textarea>

                    <label for="">Decripción</label>
                    <textarea class="form-control mb-3" name="descripcion" id="descripcion" placeholder="Descripción"><?php echo $result['descripcion'] ?></textarea>

                    <div class="row">
                      <div class="col">
                        <label for="">Crédito de actividad</label>
                        <input type="text" class="form-control mb-3" name="credito" id="credito" placeholder="Crédito por actividad" value="<?php echo $result['credito'] ?>">
                      </div>
                      <div class="col">
                        <label for="">Máximo acomular</label>
                        <input type="text" class="form-control mb-3" name="maximo" id="maximo" placeholder="Máximo por acomular" value="  <?php echo $result['maximo'] ?>">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>

              </div>

            </div>
            <td><a class="btn btn-danger" onclick="alerta_eliminar(<?php echo $result['id']; ?>)">Eliminar</a></td>
          <?php
              }
          ?>
          </tr>
          </tbody>

          </table>
          </div>
        </div>
      </div>
      </table </div>
    </div>
    </section>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="./js/sweetalert.js"></script>

  </body>
  <?php include('../layout/footer.php'); ?>
  <?php include('../layout/footer_links.php'); ?>

  </html>
<?php
} else {
  echo "no existe sesión";
  header('Location:' . $URL . '/login');
}
?>
<script>
  //alerta guardar----------------
  $('.nuevo_evento').submit(function(e) {
    e.preventDefault();
    Swal.fire({
      title: '¿DESEAS GUARDAR LOS DATOS?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'SI, DESEO GUARDAR'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'DATOS GUARDADOS CORRECTAMENTE',
          icon: 'success',
          showConfirmButton: false,
        })
        setTimeout(() => {
          this.submit();
        }, "1000")

      }

    })

  });

  //alerta editar----------------
  $('.editar_evento').submit(function(e) {
    e.preventDefault();
    Swal.fire({
      title: '¿DESEAS ACTUALIZAR LA INFORMACIÓN?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ACEPTAR'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'DATOS GUARDADOS CORRECTAMENTE',
          icon: 'success',
          showConfirmButton: false,
        })
        setTimeout(() => {
          this.submit();
        }, "1000")

      }

    })

  });




  function alerta_eliminar(codigo) {
    Swal.fire({
      title: 'ELIMINAR',
      text: "Deseas eliminar la información?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'SI, eliminar'
    }).then((result) => {
      if (result.isConfirmed) {
        parametros = {
          id: codigo
        };
        $.ajax({
          data: parametros,
          url: "delete.php",
          type: "GET",
          beforeSend: function() {},
          success: function() {
            Swal.fire("Informacion eliminada", "success").then((result) => {
              window.location.href = "guia.php"
            });
          }
        });
      }
    })
  }
</script>
