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

<?php
$consulta1 = "SELECT * FROM formato_constancia2 ORDER BY id DESC LIMIT 1";
$res = mysqli_query($conexion, $consulta1)  ?>
<?php foreach ($res as $opcion) : ?>
  <div style="opacity: 70%; width: 100%;">
    <img style="width: 100%; margin-top:-10px; margin-bottom: -20px;" src="data:imagen/png;base64,<?php echo base64_encode($opcion['encabezado']) ?>">
    <!-- <img src="tecnm/images/avatar.jpg"> -->
  <?php endforeach ?>
  </div>
  <div style="width:100%; text-align:right">
  <p style="width:100%; text-align:right">
  
  DIRECCIÓN <br>
  Subdirección de Planeación y Vinculación<br>
  Departamento de Actividades Extraescolares<br>
      Oficio No. _________<br>
  ASUNTO: CONSTANCIA DE CREDITOS EXTRAESCOLARES<br>
  
    </p>
</div>
  
 
  <p style="text-align: center;">CONSTANCIA DE CUMPLIMIENTO DE ACTIVIDAD COMPLEMENTARIA
  </p>
  

  <?php foreach ($datos_alumno as $opciones) : ?>
    <!-- $html->image(src="../images/link.svg") -->
    <!-- <img src="../images/link.svg"> -->
    
    <b>C.<?php echo $opciones['jefe'] ?></b>
    <p style="line-height: 22px;">
    JEFE (A) DE DEPTO. DE SERVICIOS ESCOLARES DEL I. T. CHINÁ
PRESENTE


      <br>
      PRESENTE.
    </p>
    <p style="text-align: justify; line-height: 22px;">
El que suscribe <b><?php echo $opciones['suscribe'] ?></b>, 
por este medio se permite hacer de su conocimiento que el estudiante <b><?php echo $opciones['alumno'] ?></b> con numero de control 
<b><?php echo $opciones['matricula'] ?></b> de la carrera  <b><?php echo $opciones['carrera'] ?></b>
ha cumplido  con su actividad complementaria con el nivel de desempeño <b><?php echo $opciones['desempe'] ?></b>
y un valor numérico de <b><?php echo $opciones['valor'] ?></b> durante el periodo escolar  <b><?php echo $opciones['ciclo'] ?></b> con un valor circular de <b><?php echo $opciones['valorcurri'] ?></b> creditos. Sin más por el momento agradezco su atención y me despido enviándole un cordial saludo.

  </p>
    <p style="text-align:left;">
    Se extiende la presente en la
    fecha <?php echo $opciones['fecha'] ?>
</p>

<p style="text-align:center;">
              <b>A T E N T A M E N T E</b>
</p>
<p style="text-align:center;">
<b>Excelencia en Educación Tecnológica®</b>
</p>
<p style="text-align:center; ">
<b>Aprender Produciendo</b>
</p>
</p>
<br>


<div>
                <div style="margin:0 auto 0;">
                  <b>_____________________________________ <span style="color: white;">-------------</span> _____________________________________</b>
                  <p><b>Jefe (a) de depto. de act. extraescolares </b>   <span style="color: white;">------------------</span> <b>Subdirector(a) de planeacion y vinculacion
                  </p>
                </div>
                <br>

                <p style="font-size: 14px;">C.p minutario</p>
              
                

              </div>
    <br>
   
    
    <!-- imagen de pie de pagina -->
    <?php foreach ($res as $opcion) : ?>
      <div style="opacity: 70%;">
        <img style="width: 100%; margin-top: -36px;" src="data:imagen/png;base64,<?php echo base64_encode($opcion['pie_pagina']) ?>">

      </div>
    <?php endforeach ?>

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
