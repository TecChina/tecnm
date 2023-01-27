<?php
include('../app/config/config.php');

$id_evento = $_POST['id'];
$responsable = $_POST['responsable'];
$matricula = $_POST['matricula'];
$nombre_alumno = $_POST['nombre_alumno'];
$apPaterno = $_POST['ap_paterno'];
$apMaterno = $_POST['ap_materno'];
$inicio = " ";
$fin = " ";

$nombre_completo = $nombre_alumno . " " . $apPaterno . " " . $apMaterno;

$fecha = mysqli_query($conexion, "SELECT start, end FROM events WHERE id = $id_evento");


while ($consultaFecha = mysqli_fetch_array($fecha)) {
  $inicio = $consultaFecha['start'];
  $fin = $consultaFecha['end'];
}

$eventos = array();

$siExiste = false;

$existe = mysqli_query($conexion, "SELECT id_evento FROM suscritos where matricula_alumn = $matricula");
//$consulta2 = mysqli_fetch_array($actividades);


$iterador = 0;
while ($consultaExiste = mysqli_fetch_array($existe)) {
  $eventos[] = $consultaExiste['id_evento'];

  if ($eventos[$iterador] == $id_evento) {
    $siExiste = true;
  }

  $iterador++;
}


if ($siExiste == false) {
  $sql = "INSERT INTO suscritos(id_evento, id_respons, matricula_alumn, nombre_alumno, inicio, fin) values ('$id_evento','$responsable', '$matricula', '$nombre_completo', '$inicio', '$fin')";

  $query = $bdd->prepare($sql);

  $sth = $query->execute();

  if (!$sth) {
    echo "error al guardar";
  } else {
    header('Location: calendariovista.php');
  }
} else {
  echo '<script language="javascript">confirm("Al parecer ya estas inscrito en esta actividad");window.location.href="calendariovista.php"</script>';
}

// HACER QUE EL BOTON SE DESABILITE CUANDO YA ME SUSCRIBÍ, HACERLO COMO EL DE DESCARGAR PDF EN [Alumnos_Suscritos.php]--------------------------------




mysqli_close($conexion);
