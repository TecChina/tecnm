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


  $a = 0;
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

  include('php/extra/actividadesEncargado.php');
  $preso=(isset($_GET['valor']))?$_GET['valor']:"";
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
                        SISTEMA DE CREDITOS COMPLENTARIOS
                        <small>Guia de Actividades Complementarias</small>
                        <a href="AgregarActividad.php" class="btn btn-primary" style="position: absolute; right: 10%;">Atras</a>
                    </h1>

                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="panel panel-primary">
                        <div class="panel-heading">ENCARGO DE ACTIVIDAD <?php echo $nombre_actividad ?> </div>
                            <div class="panel-body">
                                <?php
                                $where="";
                                ?>

                                <form class="d-flex">
                                    <input class="form-control me-2 light-table-filter" data-table="table_id" type="text" 
                                    placeholder="Buscar por matricula">
                                </form>

                                <br><br>
                                
                                <table class="table table-striped table-ligh table_id ">
                                    <thead>    
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Sexo</th>
                                            <th>Matrícula</th>
                                            <th>Email</th>
                                            <th>telefono</th>
                                            <th>ciudad</th>
                                            <th>Registro</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php      
                                        $SQL="SELECT id, nombres, sexo, numero_control, correo, telefono, ciudad FROM tb_usuarios WHERE cargo = 2 $where ORDER BY id LIMIT 5";
                                        $dato = mysqli_query($conexion, $SQL);

                                        if($dato -> num_rows >0){
                                            while($fila=mysqli_fetch_array($dato)){
                                        ?>
                                        <tr>
                                            <td><?php echo $fila['nombres']; ?></td>
                                            <td><?php echo $fila['sexo']; ?></td>
                                            <td><?php echo $fila['numero_control']; ?></td>
                                            <td><?php echo $fila['correo']; ?></td>
                                            <td><?php echo $fila['telefono']; ?></td>
                                            <td><?php echo $fila['ciudad']; ?></td>
                                            <td >
                                                <?php
                                                $parta = false;
                                                foreach ($matriculas as $matricula) {
                                                    if ($matricula['matricula'] == $fila['numero_control']) {
                                                        $parta = true;
                                                    }
                                                }

                                                if ($parta) {
                                                    echo "<i class='fa fa-info'></i> ALUMNO REGISTRADO <br> EN UNA ACTIVIDAD";
                                                }
                                                
                                                ?>
                                            </td>
                                            <td>
                                                <form action="agregandoAlumno.php" method="GET">
                                                    <input type="hidden" name="extra" value="<?php echo $id?>">
                                                    <input type="hidden" name="id" value="<?php echo $fila['id'] ?>">
                                                    <input type="submit" class="btn btn-primary btn-lg" value="agregar Alumno">
                                                </form>
                                            </td>
                                        </tr>

                                        <?php
                                            }
                                        }else{

                                            ?>
                                        <tr class="text-center">
                                            <td colspan="16">No existen registros</td>
                                        </tr>

                                        
                                        <?php          
                                        }
                                        ?>
                                
                            </div>
                        </div>
                        <!-- /.content -->
                    </div>
                    <!-- /.content-wrapper -->
                    <?php include('../layout/footer_links.php'); ?>
                </section>
            </div>
        </div>
        <script src="js/acciones.js"></script>
        <script src="js/buscador.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <?php if (!empty($preso)) {?>
            <?php
                if ($preso == 1) {?>
                    <script>
                        Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Alumno Agregado',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    </script>
            <?php } ?>

            <?php if ($preso == 2) {?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'El alumno ya esta dentro de la actividad!!',
                        footer: '<a href="">Revisa tu lista de alumno para verificarlo</a>'
                    })
                </script>
            <?php } ?>
        <?php } ?>
    </body>
    
</html>


<?php
} else {
  echo "no existe sesión";
  header('Location:' . $URL . '/login');
}
