<?php ob_start();
include('../app/config/config.php');
session_start();
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

//id del evento
$id_event = $_POST['id_evento'];
?>

<?php
$consulta1 = "SELECT * FROM formato_constancia2 ORDER BY id DESC LIMIT 1";
$res = mysqli_query($conexion, $consulta1)  ?>

<?php foreach ($res as $opcion) : ?>
  <div style="width: 100%;">
    <img style="width: 100%; margin-top:-10px; margin-bottom: -20px;" src="data:imagen/png;base64,<?php echo base64_encode($opcion['encabezado']) ?>">
    <!-- <img src="tecnm/images/avatar.jpg"> -->
  <?php endforeach ?>
  </div>

  <h2 style="text-align: center;">Lista de alumnos suscritos</h2>

  <table class="table table-bordered table-hover table-condensed" style="width: 100%;">
    <thead>
      <tr style="background-color: cadetblue;">
        <th class="col-3">Alumnos</th>
        <th class="col-3">Matrícula</th>
        <th class="col-3">Inicio de la actividad</th>
        <th class="col-3">Fin de la actividad</th>
      </tr>
    </thead>

    <tbody>
      <!--registros de la bd-->
      <?php
      $sql = "SELECT * FROM suscritos where id_evento = $id_event";

      $row = mysqli_query($conexion, $sql);

      while ($result = mysqli_fetch_assoc($row)) {
      ?>
        <tr style="text-align: center; background-color: antiquewhite; ">
          <td class="col-3"><?php echo $result['nombre_alumno'] ?></td>
          <td class="col-3"><?php echo $result['matricula_alumn'] ?></td>
          <td class="col-3"><?php echo $result['inicio'] ?></td>
          <td class="col-3"><?php echo $result['fin'] ?></td>

          </div>
        <?php } ?>
        </tr>
    </tbody>

  </table>
  </div>
  </div>
  </div>
  </table </div>
  </div>
  </section>

  <br>
  <br>
  <br>
  <br>
  <br>
  <!-- imagen de pie de pagina -->
  <!-- imagen de pie de pagina -->
  <?php foreach ($res as $opcion) : ?>
    <div style=" position: absolute; bottom: 0;">
      <img style="width: 100%; margin-top: -36px;" src="data:imagen/png;base64,<?php echo base64_encode($opcion['pie_pagina']) ?>">

    </div>
  <?php endforeach ?>


  </div>

  </body>

  </html>


  <?php
  $html = ob_get_clean();
  require_once './libreria/dompdf/autoload.inc.php';

  use Dompdf\Dompdf;

  $dompdf = new Dompdf;

  $options = $dompdf->getOptions();
  $options->set(array('isRemoteEnabled' => true));

  $dompdf->setOptions($options);

  $dompdf->loadHtml($html);
  $dompdf->setPaper('letter');

  $dompdf->render();
  $dompdf->stream("archivo_.pdf", array("Attachment" => false));

  ?>
