<?php
if(!isset($_GET["id"])) exit();

$id = $_GET["id"];

include('ciclo.php');

$sql = ("SELECT nombreActividad FROM extraescolar WHERE idCiclo = $idCiclo AND id = $id");
$query = $bdd->prepare($sql);
$query->execute();
$extraescolar = $query->fetch(PDO::FETCH_LAZY);

$nombre_actividad = $extraescolar['nombreActividad'];

$sql = ("SELECT matricula FROM extragrupo");
$query = $bdd->prepare($sql);
$query->execute();
$matriculas = $query->fetchAll(PDO::FETCH_ASSOC);
?>