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

?>

  <!DOCTYPE html>
  <html>

  <head>
    <?php include('../layout/head.php'); ?>
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
        <section class="content-header">
          <h1>FORMATO DE LAS CONSTANCIAS</h1>
          <br> <br>

          <div class="container" style="padding: 60px 90px 60px 40px; background: white;">
            <form action="formato_constancia_ctrl.php" method="POST" enctype="multipart/form-data" class="formato">
              <label for="encabezado">Ingresa el encabezado de la constancia</label>
              <input type="file" name="encabezado" required id="encabezado">
              <br><br> <br>

              <p style="text-align:rigth;">
  
  DIRECCIÓN
  Subdirección de Planeación y Vinculación
  Departamento de Actividades Extraescolares
      Oficio No. ___ (1) ___
  ASUNTO: CONSTANCIA DE CREDITOS EXTRAESCOLARES
  
    </p>

              <b></b>
              <p style="line-height: 22px;">
              JEFE (A) DE DEPTO. DE SERVICIOS ESCOLARES DEL I. T. CHINÁ
PRESENTE


                <br>
                PRESENTE.
              </p>
              <p style="text-align: justify; line-height: 22px;">
                El que se suscribe <b>Persona que suscribe</b>, por
                este medio se permite hacer de su conocimiento que el estudiante <b>Nombre del alumno</b>
                con numero de control <b>Matricula del alumno</b>
                de la carrera de <b>Carrera del alumno</b>
                ha cumplido su actividad complementaria con el nivel de desempeño <b>Desempeño del alumno</b>
                y un valor numérico de <b>Valor numerico del desempeño</b>
                durante el periodo escolar <b>Ciclo escolar</b>
                con un valor curricular de <b>Valor curricular</b>
                créditos.
              </p>
              <p style="text-align: right;">
                Se extiende la presente en la
                fecha <b>Fecha</b>
              </p>
              <p>
                <b>A T E N T A M E N T E
Excelencia en Educación Tecnológica®
Aprender Produciendo
</b>
              </p>
              <br>
              <br>
              <br>
              <br>
              <div>
                <div style="margin:0 auto 0;">
                  <b>_____________________________________ <span style="color: white;">-------------</span> _____________________________________</b>
                  <p><b>JEFE(A) DE DEPTO. DE ACT. EXTRAESCOLARES<br> RESPONSABLE </b> <span style="color: white;">------------------------------------------------</span> SUBDIRECTOR(A) DE PLANEACIÓN Y VINCULACIÓN
                  </p>
                </div>
                <br>

                
                <br>
                <br>
                <br>

              </div>
              <label for="pie">Ingresa el pie de pagina de la constancia</label>
              <input type="file" name="pie" required id="pie">
              <br><br>
              <input type="submit" class="btn btn-success" value="Guardar">
            </form>
          </div>
          <br>
          <br>

          <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


  </body>

  </html>

  </div>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('../layout/footer.php'); ?>
  <?php include('../layout/footer_links.php'); ?>




  </body>



  </html>
<?php
} else {
  echo "no existe sesión";
  header('Location:' . $URL . '/login');
} ?>

<script>
  const encabezado = document.getElementById('encabezado');
  const pie = document.getElementById('pie');

  $('.formato').submit(function(e) {
    e.preventDefault();
    if (encabezado.files[0].size > 1097152 || pie.files[0].size > 1097152) {
      Swal.fire({
        title: 'UNA DE LAS IMAGENES SUPERA EL PESO MAXIMO (1MB), INTENTA SUBIR OTRA',
        icon: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
      }).then((result) => {
        if (result.isConfirmed) {
          e.preventDefault();
        }

      })
    } else {
      Swal.fire({
        title: '¿DESEAS GUARDAR LAS IMAGENES?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: 'ENCABEZADO Y PIE DE PAGINA GUARDADOS',
            icon: 'success',
            showConfirmButton: false,
          })
          setTimeout(() => {
            this.submit();
          }, "1000")
        }

      })
    }
  });
</script>
