<?php

include('../app/config/config.php');

if (isset($_POST['buscar'])) {
  $matricula_buscar = $_POST['buscar_matricula'];
  $datos = array();
  //$datos['existe'] = "0";
  /*$nombre = array();
  $obs = array();
  $desemp = array();
  $valor = array();
  $ruta = array();
  $credito = array();
  $title = array();
*/
  $alumno_input = array();

  $alumno = mysqli_query($conexion, "SELECT nombres, ap_paterno, ap_materno, numero_control, carrera FROM tb_usuarios where numero_control = '$matricula_buscar'");
  while ($alumnos_array = mysqli_fetch_array($alumno)) {
    $datos[] = $alumnos_array;
  }

  $resultados = mysqli_query($conexion, " SELECT * FROM creditos_tutorias INNER JOIN
  evidencia_tutorias ON 
 creditos_tutorias.id = evidencia_tutorias.id 
 INNER JOIN events_tutorias ON events_tutorias.id_evento = evidencia_tutorias.id_evento
  WHERE evidencia_tutorias.numero_control = $matricula_buscar 
 AND creditos_tutorias.matricula = $matricula_buscar");



 




  
  while ($consulta = mysqli_fetch_array($resultados)) {
    /*$nombre[] = $consulta['nombre'];
    $obs[] = $consulta['observacion'];
    $desemp[] = $consulta['desmp'];
    $valor[] = $consulta['valor'];
    $ruta[] = $consulta['ruta_doc'];
    $credito[] = $consulta['credito'];
    $title[] = $consulta['title'];*/
    $datos[] = $consulta;
  }

  $datos = json_encode($datos);
  echo $datos;
  /*$datos['existe'] = "1";
  $datos['nombre'] = $nombre;
  $datos['obs'] = $obs;
  $datos['desemp'] = $desemp;
  $datos['valor'] = $valor;
  $datos['ruta'] = $ruta;
  $datos['credito'] = $credito;
  $datos['title'] = $title;*/
}




mysqli_close($conexion);