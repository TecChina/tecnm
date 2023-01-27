<?php

include('../app/config/config.php');

//$encabezado = $_POST['encabezado'];
//$pie = $_POST['pie'];

$type_encabezado = $_FILES['encabezado']['type'];
$name_encabezado = $_FILES['encabezado']['name'];
$tamano_encabezado = $_FILES['encabezado']['size'];
$type_pie = $_FILES['pie']['type'];
$name_pie = $_FILES['pie']['name'];
$tamano_pie = $_FILES['pie']['size'];

$encabezadoSubida = fopen($_FILES['encabezado']['tmp_name'], 'r');
$pieSubida = fopen($_FILES['pie']['tmp_name'], 'r');

$encabezadoBinario = fread($encabezadoSubida, $tamano_encabezado);
$pieBinario = fread($pieSubida, $tamano_pie);

$encabezadoBinario = mysqli_escape_string($conexion, $encabezadoBinario);
$pieBinario = mysqli_escape_string($conexion, $pieBinario); 

if ($tamano_encabezado > 1097152 || $tamano_pie > 1097152) {
  header('Location: formato_constancia2.php');
} else {
  //sentencia sql
  $sql = "INSERT INTO formato_cons2 (encabezado, nombre_encabezado,
                                pie_pagina, nombre_pie) 
                                VALUES 
                                ('" . $encabezadoBinario . "',
                                       '" . $name_encabezado . "', '" . $pieBinario . "',
                                       '" . $name_pie . "')";


  //ejecutamos sql

  $ejecutar = mysqli_query($conexion, $sql);
  //verificamos la ejecucion
  if (!$ejecutar) {
    echo 'Error al registrarse';
  } else {
    header('Location: formato_constancia2.php');
  }
}

mysqli_close($conexion);
