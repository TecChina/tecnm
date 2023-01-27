
<?php
include('../app/config/config.php');
// obtenemos el valor y el resultado
$resultado = 0;
$valor = '';
$idRegistros = $_REQUEST['id'];
$control = $_REQUEST['control'];
$actividad = $_REQUEST['actividad'];
$habilidad = $_REQUEST['habilidad'];
$tiempo = $_POST['tiempo'];
$equipo = $_POST['equipo'];
$liderazgo = $_POST['liderazgo'];
$organiza = $_POST['organiza'];
$interpreta = $_POST['interpreta'];
$realiza = $_POST['realiza'];
$iniciativa = $_POST['iniciativa'];

$resultado = ($tiempo + $equipo + $liderazgo + $organiza + $interpreta + $realiza + $iniciativa) / 7;
if ($resultado <= 4) {
  $valor = 'Excelente';
  $calificacion = 1;
}
if ($resultado <= 3) {
  $valor = 'Notable';
  $calificacion = 1;
}
if ($resultado <= 2) {
  $valor = 'Bueno';
  $calificacion = 1;
}
if ($resultado <= 1) {
  $valor = 'Suficiente';
  $calificacion = 2;
}
if ($resultado <= 0) {
  $valor = 'Insuficiente';
  $calificacion = 2;
};

$update = ("UPDATE extragrupo 
	SET 
	observacion  ='" .$habilidad. "',
	valor  ='" .$resultado. "',
  acreditacion  ='" .$calificacion. "',
	desempeyo  ='" .$valor. "'
	

WHERE matricula='" .$control. "' AND idActividad='".$actividad."'
");
$result_update = mysqli_query($conexion, $update);


header('Location: alumnosListado.php?id='.$actividad);

?>
