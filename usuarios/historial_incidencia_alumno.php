<?php
include('../app/config/config.php');
session_start();



if (isset($_SESSION['u_usuario'])) {
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <?php include('../layout/head.php'); ?>
    
    <title>Inicio</title>
    
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    
    <?php 
  $sql= "SELECT * FROM tb_tutorias where id = '{$_GET['id']}'";
  $resultado = mysqli_query($conexion,$sql);
  ?>
    
      <?php include('../layout/menu.php'); ?>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
         Informacion del alumno
           
          </h1>
        </section>

<br>

<section class="content">
  
<div class="panel panel-primary">
  <div class="panel-heading">Informacion del alumno</div>
  <div class="panel-body">
    <table class="table table-bordered table-hover table-condensed">
    <th>Nombres</th>
    <th>Apellido paterno</th>
    <th>Apellido materno</th>
    <th>Numero control</th>
    <th>Carrera</th>
    <th>Semestre</th>

    <?php
      while($filas = mysqli_fetch_assoc($resultado)){
?>
     <tr>
       <td><?php echo $filas['nombres']?></td>
       <td><?php echo $filas['ap_paterno']?></td>
       <td><?php echo $filas['ap_materno']?></td>
       <td><?php echo $filas['id']?></td>
       <td><?php echo $filas['carrera']?></td>
       <td><?php echo $filas['semestre']?></td>
     </tr>


    <?php
    }
    ?>

    </table>
  </div>
</div>


<div class="panel panel-primary">
   
        
   <div class="panel-heading">Historial de seguimiento totural del alumno</div>
   <div class="panel-body">
   <table class="table table-bordered table-hover table-condensed">
  
   <th>Numero de control</th>
   <th>Motivo</th>
   <th>Categoria</th>
   <th>Fecha y hora de seguimiento tutotal</th>
   
                                             
  <?php 

  
  $sql="SELECT * FROM `tb_incidencia` WHERE id_alumno = '{$_GET['id']}' ";
  $resultado = mysqli_query($conexion,$sql);
  ?>
                            <?php
      while($filas = mysqli_fetch_assoc($resultado)){
?>
      
      <tr>
      
      <td><?php echo $filas['id_alumno']?></td>
      <td><?php echo $filas['motivo']?></td>
      <td><?php echo $filas['categoria']?></td>
      <td><?php echo $filas['timestamp']?></td>
      </tr>
      <?php
    }
    ?>    
    
    </table>
</div>
</section>
</div>

    
      <!-- /.content-wrapper -->
      <?php include ('../layout/footer.php'); ?>
      <?php include ('../layout/footer_links.php'); ?>
  

  </body>
  </html>
<?php
} else {
  echo "no existe sesión";
  header('Location:' . $URL . '/login');
}
