<?php
include('../app/config/config.php');



$id = $_POST['id_editar'];

$actividad = $_POST['actividad'];
$descripcion = $_POST['descripcion'];
$credito = $_POST['credito'];
$maximo = $_POST['maximo'];

$sql = "UPDATE guia SET actividad = '$actividad' ,descripcion = '$descripcion',
credito = '$credito' , maximo ='$maximo' WHERE id = $id";





echo $sql;

$query = $bdd->prepare($sql);
if ($query == false) {
  print_r($bdd->errorInfo());
  die('Erreur prepare');
}
$sth = $query->execute();
if ($sth == false) {
  print_r($query->errorInfo());
  die('Erreur execute');
}
header('Location: guia.php');


mysqli_close($conexion);
