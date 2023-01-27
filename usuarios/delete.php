<?php
include('../app/config/config.php');

$id = $_GET['id'];

$sql = "DELETE FROM guia WHERE id='$id'";
$row = mysqli_query($conexion, $sql);

if ($row) {
  Header("Location: guia.php");
} else {
  echo 'ERROR AL eliminar';
}

mysqli_close($conexion);
