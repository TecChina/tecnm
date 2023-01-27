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

$sentenciaSQL = $pdo->prepare("SELECT * FROM constanciasextra2 WHERE matricula = '$id_numero_control'");
$sentenciaSQL->execute();
$datos_alumno = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
<h2>

  <p style="text-align: center;">CONSTANCIA DE CUMPLIMIENTO DE ACTIVIDAD COMPLEMENTARIA.
  </p>
</h2>
<br>

<?php foreach ($datos_alumno as $opciones) : ?>
C. <?php echo $opciones['jefe'] ?>
<br>

Jefe(a) del Departamento de Servicios Escolares o su equivalente en los Institutos Tecnológicos Descentralizados

<br>
PRESENTE.
<br>
<br>
<br>
<p style="text-align: justify;">
    El que se suscribe <?php echo $opciones['suscribe'] ?>, por
    este medio se permite hacer de su conocimiento que el estudiante <?php echo $opciones['alumno'] ?>
    con numero de control <?php echo $opciones['matricula'] ?>
    de la carrera de <?php echo $opciones['carrera'] ?>
    ha cumplido su actividad complementaria con el nivel de desempeño <?php echo $opciones['desempe'] ?>
    y un valor numérico de <?php echo $opciones['valor'] ?>
    durante el periodo escolar <?php echo $opciones['ciclo'] ?>
    con un valor curricular de <?php echo $opciones['valorcurri'] ?>
    créditos.
  </p>
<br>
<br>
<br>
<p style="text-align: right;">
    Se extiende la presente en la
    fecha <?php echo $opciones['fecha'] ?>
  </p>
<br>
<br>
<br>
<br>
<p style="text-align: center;">
  ATENTAMENTE
</p>
<?php endforeach ?>

</div>

</body>

</html>
//<?php
//require_once 'dompdf/autoload.inc.php';

//use Dompdf\Dompdf;

//$dompdf = new DOMPDF();
//$dompdf->load_html(ob_get_clean());
//$dompdf->render();
//$pdf = $dompdf->output();
//$filename = "constancia.pdf";
//file_put_contents($filename, $pdf);
//$dompdf->stream($filename);
//?>

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
