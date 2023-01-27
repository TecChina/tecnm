<?php

if(!isset($_GET["id"])) exit();//preguntando si el metodo get tiene un valor, si no tiene uno sale del porceso
$id = $_GET["id"];

include('ciclo.php');

$sql = ("SELECT nombreActividad FROM extraescolar WHERE idCiclo = $idCiclo AND id = $id");
$query = $bdd->prepare($sql);
$query->execute();
$extraescolar = $query->fetch(PDO::FETCH_LAZY);

$nombre_actividad = $extraescolar['nombreActividad'];

$sqlCliente   = ("SELECT tb_usuarios.id, tb_usuarios.nombres,tb_usuarios.ap_paterno,tb_usuarios.ap_materno,tb_usuarios.carrera,tb_usuarios.numero_control,tb_usuarios.telefono,extragrupo.observacion,extragrupo.desempeyo,extragrupo.acreditacion,extragrupo.idActividad FROM extragrupo INNER JOIN tb_usuarios ON extragrupo.matricula = tb_usuarios.numero_control WHERE extragrupo.idActividad = $id");
$queryCliente = mysqli_query($conexion, $sqlCliente);
$cantidad     = mysqli_num_rows($queryCliente);

?>
