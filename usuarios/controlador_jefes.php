<?php






include('../app/config/config.php');

$nombres = strtoupper($_POST['nombre']);
$correo = strtoupper($_POST['correo']);
$departamento = strtoupper($_POST['depa']);

date_default_timezone_set("America/Monterrey");

$fechaHora = date('Y-m-d h:i:s');
$estado = '1';

$nombre_de_foto_perfil = "SisTECNM-" . date('Y-m-d-h-i-s');

//echo $nombres ." - ".$ap_paterno." - ".$ap_materno." - ".$sexo." - ".$numero_control." - ".$carrera." - ".$correo." - ".$estado_civil." - ".$telefono." - ".$ciudad." - ".$colonia." - ".$calle." - ".$codigo_postal." - ".$curp." - ".$fecha_nacimiento." - ".$nivel_escolar." - ".$reticula." - ".$entidad." - ".$contraseña." - ".$user_creacion. " - ".$fechaHora." - ".$estado;

$inserta = "INSERT INTO tb_jefes(nombres, correo, id_departamento) 
VALUES ('$nombres', '$correo', '$departamento')";

$resultado = mysqli_query($conexion, $inserta);
if (!$resultado) {
  if (mysqli_error($conexion) == "Duplicate entry '$correo' for key 'tb_jefes.PRIMARY'") {
    echo '<script language="javascript">alert("El jefe ya existe");window.location.href="lista-jefes.php"</script>';
  } else {
    echo '<script language="javascript">alert("No se pudo guardar. Inténtalo de nuevo.");window.location.href="lista-jefes.php"</script>';
  }
} else {
  header('Location: lista-jefes.php');
}   


mysqli_close($conexion);
