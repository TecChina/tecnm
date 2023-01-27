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
  }





?>

  <?php
  $sqlito =
    ("SELECT * FROM tb_claseasesoria INNER JOIN tb_tutorias ON tb_tutorias.id = tb_claseasesoria.id_alumnoo INNER JOIN tb_usuarios ON tb_usuarios.id = tb_claseasesoria.id_asesor WHERE id_alumnoo = $id_numero_control ");





  $resultado = mysqli_query($conexion, $sqlito);


  ?>



  <!DOCTYPE html>
  <html>

  <head>
    <?php include('../layout/head.php'); ?>
    <title>Guia de actividades Complementarias</title>
    <link rel="stylesheet" href="../css/StyleNew.css">
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include('../layout/menumaestro.php'); ?>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Alumnos asesorias

          </h1>

        </section>

        <!-- Main content -->
        <section class="content">
          <div class="panel panel-primary">
            <div class="panel-heading">Guia de Actividades Complementarias</div>
            <div class="panel-body">
              <table class="table table-bordered table-hover table-condensed">


                <th>TEMA</th>
                <th>ASIGNATURA</th>

                <th>HORARIO DE ASESORIA</th>
                <th>DIAS ASESORIA</th>
                <th>PROFESOR</th>
                <th>STATUS</th>
                <th>RETROALIMENTACION FINAL</th>



                <?php
                while ($filas = mysqli_fetch_assoc($resultado)) {
                ?>
                  <tr>
                    <td><?php echo $filas['tema'] ?></td>
                    <td><?php echo $filas['materia'] ?></td>

                    <td><?php echo $filas['horario'] ?></td>

                    <td>
                      <?php if ($filas['lunes'] == 'si') {
                        echo "Lunes";
                      }
                      ?>
                      <?php if ($filas['martes'] == 'si') {
                        echo "Martes";
                      }
                      ?>
                      <?php if ($filas['miercoles'] == 'si') {
                        echo "Miercoles";
                      }
                      ?>
                      <?php if ($filas['jueves'] == 'si') {
                        echo "Jueves";
                      }
                      ?>
                      <?php if ($filas['viernes'] == 'si') {
                        echo "Viernes";
                      }
                      ?>
                    </td>

                    <td><?php echo $filas['nombres'] ?> <?php echo $filas['ap_paterno'] ?> <?php echo $filas['ap_materno'] ?> </td>


                    <td>
                      <?php if ($filas['status'] == 1) {
                        echo '<span class="rounded-pill badge badgedefault bg-green px-3">Iniciada</span>';
                      } else {
                        echo '<span class="rounded-pill badge badgedefault bg-red px-3">Sin informacion</span>';
                      }
                      ?>

                      <?php if ($filas['status_finalizada'] == 4) {
                        echo '<span class="rounded-pill badge badgedefault bg-red px-3">Finalizada</span>';
                      } 
                      ?>



                    </td>

                    <td>
                      <?php
                      if ($filas['observacion_finalizada'] == null) {  ?>
                        '<span class="rounded-pill badge badgedefault bg-red px-3">Sin informacion</span>

                      <?php } else { ?>

                        <span class="rounded-pill badge badgedefault bg-yellow px-3"><?php echo $filas['observacion_finalizada']; ?></span>

                      <?php } ?>
                    </td>






                  </tr>









                  <!-- Button trigger modal -->


                  <!-- Modal -->


                  <!-- /.content -->
                <?php

                }


                ?>
            </div>


          </div>
          <!-- /.content-wrapper -->


          </table>


  </body>

  </html>
<?php
} else {
  echo "no existe sesión";
  header('Location:' . $URL . '/login');
} ?>
