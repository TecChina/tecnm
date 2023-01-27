<?php
include ('../../app/config/config.php');
session_start();

if(isset($_SESSION['u_usuario']) && $_SESSION['u_privilegio']  == 0){
    //echo "existe sesión";
    //echo "bienvenido usuario";
    $correo_sesion = $_SESSION['u_usuario'];
    $query_sesion = $pdo->prepare("SELECT * FROM tb_usuarios WHERE correo = '$correo_sesion' AND estado = '1' ");
    $query_sesion->execute();
    $sesion_usuarios = $query_sesion->fetchAll(PDO::FETCH_ASSOC);
    foreach ($sesion_usuarios as $sesion_usuario){
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

    include ('../php/extra/controlador_actividad.php');
    $i = 1;

?>



<!DOCTYPE html>
<html>
    <head>
    <?php include ('../../layout/extraescolar/head.php'); ?>
    <title>Listado de Alumnos Activos</title>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php include ('../../layout/extraescolar/menu.php'); ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Actividades Extraescolares
                        <small>Listado de actividades extraescolares</small>
                        <a href="categorias.php" class="btn btn-primary" style="position: absolute; right: 10%;">ATRAS</a>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="panel panel-primary">
                        <div class="panel-heading">CATEGORIAS <?php echo "".$campos?></div>

                        <div class="panel-body">

                            <form action="nueva_actividad.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $idCampos?>">
                                <input type="submit" class="btn btn-primary btn-lg" name="actividad" value="Nueva actividad">
                            </form>

                            <br><br>

                            <table class="table table-light">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>ACTIVIDAD</th>
                                        <th>ENCARGADO</th>
                                        <th>HORAS</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody class="thead-light">
                                        <?php
                                        if (!empty($actividades)) {
                                            foreach ($actividades as $actividad) {
                                                echo"<tr>";
                                                echo"<td>".$i++."</td>";
                                                echo"<td>".$actividad['nombreActividad']."</td>";
                                                if (!empty($actividad['nombres'])) {
                                                    echo"<td>".$actividad['nombres']."</td>";
                                                } else {
                                                    echo "<td>Sin Asignar</td>";
                                                }
                                                if (!empty($actividad['horaActividad'])) {
                                                    echo"<td>".$actividad['horaActividad']." HORAS ACADEMICAS</td>";
                                                } else {
                                                    echo "<td>Sin Asignar</td>";
                                                }
                                                echo "<form action='lista_alumno_actividad.php' method='POST'>";
                                                echo"<td style='width: 8%;'>
                                                <input type='hidden' name='id' value='".$actividad['id']."'>
                                                <input type='submit' name='actividad' class='btn btn-primary' value='Listas'>";
                                                echo "</form>";
                                                echo "<form action='editar_actividad.php' class='formulario-actividad_editar' method='POST'>";
                                                echo "<td style='width: 8%;'>";
                                                echo "<input type='hidden' name='id' value='".$actividad['id']."'>";
                                                echo "<input type='hidden' name='idCategoria' value='".$idCampos."'>";
                                                echo "<input type='hidden' name='actividad' value='Editar'>";
                                                echo "<input type='submit' class='btn btn-primary' value='Editar'>";
                                                echo "</td>";
                                                echo "</form>";
                                                echo "<form action='lista_actividades.php' class='formulario-actividad_eliminar' method='POST'>";
                                                echo "<td style='width: 8%;'>";
                                                echo "<input type='hidden' name='id' value='".$actividad['id']."'>";
                                                echo "<input type='hidden' name='actividad' value='Eliminar'>";
                                                echo "<input type='submit' class='btn btn-danger' value='Eliminar'>";
                                                echo "</td>";
                                                echo "</form>";
                                                echo"<tr>";
                                                
                                            }
                                        } else if(empty($actividades)){
                                            echo"<tr>";
                                            echo"<td> SIN REGISTROS DE ACTIVIDADES </td>";
                                            echo"<tr>";
                                        }
                                        ?>
                                    
                                </tbody>
                            </table>
                        
                    </div>
                </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include ('../../layout/extraescolar/footer.php'); ?>
  <?php include ('../../layout/extraescolar/footer_links.php'); ?>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (!empty($preso)) {?>
        <?php
            if ($preso == 1) {?>
                <script>
                    Swal.fire(
                    'Actividad Creada',
                    'La Actividad se creo con exito',
                    'Correcto',
                    )
                </script>
        <?php } ?>

        <?php
            if ($preso == 2) {?>
                <script>
                    Swal.fire(
                    'Actividad Eliminada',
                    'La Actividad se Elimino con exito',
                    'Correcto',
                    )
                </script>
        <?php } ?>

        <?php
            if ($preso == 3) {?>
                <script>
                    Swal.fire(
                    'Actividad Actualizada',
                    'La Actividad se Actualizo con exito',
                    'Correcto',
                    )
                </script>
        <?php } ?>
    <?php } ?>

    <script>
        $('.formulario-actividad_eliminar').submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Eliminar Actividad',
            text: "Confirmar si accede a Eliminar actividad",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });

        $('.formulario-actividad_editar').submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Editar Actividad',
            text: "Confirmar si accede a Editar actividad",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
      </script>


</body>
</html>
<script>
    function archivo(evt) {
        var files = evt.target.files; // FileList object
        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function (theFile) {
                return function (e) {
                    // Insertamos la imagen
                    document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="',e.target.result, '" width="200px" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }
    document.getElementById('file').addEventListener('change', archivo, false);
</script>
<?php
}else{
    echo "no existe sesión";
    header('Location:'.$URL.'/login');
}
