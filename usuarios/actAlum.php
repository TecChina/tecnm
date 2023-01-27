<?php
include('../app/config/config.php');
session_start();



if (isset($_SESSION['u_usuario']) && $_SESSION['u_privilegio']  == 2 ) {
  //echo "existe sesión";
  //echo "bienvenido usuario";
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
    $privilegio = $sesion_usuario['cargo'];
  }


?>



<!DOCTYPE html>
<html>
<head>
  <?php include ('../layout/head.php'); ?>
  <title>Listado de Alumnos Activos</title>
  <script>
    function confirmacion(){
        var respuesta = confirm("¿Deseas eliminar esta informacion?");
        if (respuesta==true){
            return true;
        }else{
        return false;
    }
    } 
  </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include ('../layout/menuuser.php'); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SISTEMA DE ACTIVIDADES
        <small>Listado de actividades extraescolares</small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="panel panel-primary">
                    <div class="panel-heading">CATEGORIAS</div>
                    <br>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Actividad</th>
      <th scope="col">Lugar</th>
      <th scope="col">Horario</th>
      <th scope="col">Encargado</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $busqueda = mysqli_query($conexion, "SELECT * FROM extraescolar inner join extragrupo on extraescolar.id=extragrupo.idActividad WHERE extragrupo.matricula = $id_numero_control ");
    $numero = mysqli_num_rows($busqueda);
   ?> 
   <h5 class= "card-titl">Resultados (<?php echo $numero?>)</h5>
   <?php while ($resultado= mysqli_fetch_assoc($busqueda)){
    ?>
    <tr>
      <th scope="row"><?php echo $resultado["nombreActividad"];?></th>
      <td><?php echo $resultado["lugarActividad"];?></td>
      <td><?php echo $resultado["horaHacer"];?></td>
      <td><?php echo $resultado["encargadoActividad"]?></td>
    </tr>
    <?php } ?>
    
  </tbody>
</table>
        
</section>
        
      </div>
      <?php include('../layout/footer.php'); ?>
    </div>
    <?php include('../layout/footer_links.php'); ?>
  </body>

  </html>
<?php
} else {
  echo "no existe sesión";
  header('Location:' . $URL . '/login');
}
