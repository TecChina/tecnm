<?php
include('../app/config/config.php');

$id = $_POST['id'];

session_start();
if (isset($_SESSION['u_usuario'])) {
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

  //$sentenciaSQL = $pdo->prepare("SELECT * FROM suscritos where id_evento = $id");
  //$sentenciaSQL->execute();
  //$datos_alumno = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>

  <!DOCTYPE html>
  <html>

  <head>
    <?php include('../layout/head.php'); ?>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../app/templeates/AdminLTE-2.3.11/bootstrap/css/bootstrap.css">

    <title>Guia de actividades Complementarias</title>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include('../layout/menumaestro.php'); ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            SISTEMA DE CREDITOS COMPLENTARIOS
            <small>Guia de Actividades Complementarias</small>
          </h1>
          <br>
          <form action="Docx_suscribirse.php" method="POST" target="_blank" class="pdf">
            <div class="container">
              <input type="text" value=<?php echo $id ?> style="display: none;" name="id_evento">
              <div id="content">
                <button id="descargar" class="btn btn-primary" type="submit"><i class="fa fa-download"></i> Descargar PDF</button>
              </div>
            </div>
          </form>
        </section>

        <br>


        <!--CRUD-->


        <div class="container">
          <div class="panel panel-primary">
            <div class="panel-heading">Alumnos suscritos</div>

            <table class="table table-bordered table-hover table-condensed">
              <thead>
                <tr class="info">
                  <th scope="col">Alumnos</th>
                  <th scope="col">Matrícula</th>
                  <th scope="col">Inicio del evento</th>
                  <th scope="col">Fin del evento</th>
                </tr>
              </thead>

              <tbody id='table_body'>
                <!--registros de la bd-->
                <?php

                $sql = "SELECT * FROM suscritos where id_evento = $id";

                $row = mysqli_query($conexion, $sql);


                while ($result = mysqli_fetch_assoc($row)) {
                ?>
                  <tr>
                    <td id="name_alumn"><?php echo $result['nombre_alumno'] ?></td>
                    <td id="matri_alumn"><?php echo $result['matricula_alumn'] ?></td>
                    <td id="inicio_alumn"><?php echo $result['inicio'] ?></td>
                    <td id="fin_alumn"><?php echo $result['fin'] ?></td>




          </div>



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
  $('.pdf').submit(function(e) {
    e.preventDefault();
    let trs = document.querySelectorAll('#body_table tr');
    let name = document.getElementById('name_alumn')
    let matri = document.getElementById('matri_alumn')
    let inicio = document.getElementById('inicio_alumn')
    let fin = document.getElementById('fin_alumn')
    let btn = document.getElementById('descargar');
    if (name == null && matri == null && inicio == null && fin == null) {
      Swal.fire({
        title: '¿No hay alumnos registrados?',
        icon: 'question',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
      })
    } else {
      this.submit();
    }
    /*
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

        })*/

  });
</script>
