<?php
include('../app/config/config.php');
session_start();

if (isset($_SESSION['u_usuario']) && $_SESSION['u_privilegio']  == 1 ) {
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
  //control de inactividad
  $ahora = date("Y-n-j H:i:s");
  $fechaGuardada = $_SESSION["ultimoAcceso"];
  $tiempo_transcurrido = (strtotime($ahora) - strtotime($fechaGuardada));

  if ($tiempo_transcurrido >= 600) {
    //si pasaron 10 minutos o más
    session_destroy(); // destruyo la sesión
    header('location:../index.php'); //envío al usuario a la pag. de autenticación
    //sino, actualizo la fecha de la sesión
  } else {
    $_SESSION["ultimoAcceso"] = $ahora;
  }

  include('php/extra/AgregarActividad.php');

?>

<!DOCTYPE html>

<html>

    <head>
    <?php include('../layout/head.php'); ?>
    <title>Guia de actividades Complementarias</title>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php include('../layout/menumaestro.php'); ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- cierre sesion por inactividad -->
                <?php if ($_SESSION["ultimoAcceso"] >= 600) {
                echo ("<meta http-equiv='refresh' content='600'>");
                } ?>
                <section class="content-header">
                    <h1>
                        Gestión de alumnos
                        <small>Agregar alumnos en actividades</small>
                    </h1>

                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Actividades Extraescolares</div>
                            <div class="panel-body">

                                <?php
                                echo "<table class='table table-light'>";
                                echo "<thead class='thead-light'>";
                                echo "<tr>";
                                echo "<th>#</th>";
                                echo "<th>Actividad</th>";
                                echo "<th>Accion</th>";
                                echo "<th>Alumno</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                    foreach ($extraescolar as $extra) {
                                        if ($extra['idUsuario'] == $id_sesion) {
                                            
                                            echo "<tr>";
                                            echo "<td></td>";
                                            echo "<td>".$extra['nombreActividad']."</td>";
                                            echo "<td><a class='btn btn-primary btn-lg' href='actividadesEncargado.php?id=".$extra['id'] ."'>Ingresar Alumnos</a></td>";
                                            echo "<td><a class='btn btn-primary btn-lg' href='alumnosListado.php?id=".$extra['id']."'>Actividad del alumno</a></td>";
                                            echo "</tr>";
                                            
                                        } else if($extra['idUsuario'] == ""){
                                            echo "<tr>";
                                            echo "<td>No tienes cargos;</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    echo "</tbody>";
                                            echo "</table>";
                                ?>
                            </div>
                        </div>
                        <!-- /.content -->
                    </div>
                    <!-- /.content-wrapper -->
                    <?php include('../layout/footer.php'); ?>
                    <?php include('../layout/footer_links.php'); ?>
                </section>
            </div>
        </div>
    </body>

</html>

<?php
} else {
  echo "no existe sesión";
  header('Location:' . $URL . '/login');
}?>
