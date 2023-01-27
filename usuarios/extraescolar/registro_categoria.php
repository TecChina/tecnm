<?php
include ('../../app/config/config.php');
session_start();

if(isset($_SESSION['u_usuario']) && $_SESSION['u_privilegio']  == 0 ){
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

    include('../php/extra/controlador_categorias.php');

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
            <?php
                if (isset($ciclos->descripcion) == "") {
                    echo "No Existen Ciclos";
                } else if (isset($ciclos->descripcion) == $ciclos->descripcion) {
                    echo $ciclos->descripcion;
                }
            ?>
            <small>Listado de categoria</small>
        </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            CATEGORIAS
                        </div>
                        <div class="panel-body">

                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                <?php
                                    if (isset($ciclos->descripcion) == "") {
                                        
                                    } else if (isset($ciclos->descripcion) == $ciclos->descripcion) {
                                        echo "<a class='btn btn-primary' href='nuevoCampo.php'>NUEVA CATEGORIA</a>";
                                    }
                                ?>
                                    
                                    <table class="table table-light">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Categoría</th>
                                                <th>Logotipo</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                    
                                            <tbody>
                                                <?php foreach($campos as $campo){?>
                                                <tr>
                                                    <td>
                                                        <h3><?php echo $campo['nombreCategoria'] ?></h3>
                                                    </td>

                                                    <td>
                                                        <img src="data:image/jpg;base64,<?php echo base64_encode($campo['imagen']);?>" width = "100px" alt="">
                                                    </td>
                                        
                                                    <td>     
                                                        <?php
                                                        if ($campo['id'] >= $idCampo + 4 ) {?>
                                                            <form action="editar_categoria.php" method="POST" class="formulario-categoria_editar" >
                                                            <input type="hidden" name="id" value="<?php echo $campo ['id']?>">
                                                            <input type="hidden" name="categoria" value="Editar">
                                                            <input type="submit" class="btn btn-primary" value="Editar">
                                                            </form>
                                                            <form action="registro_categoria.php" method="POST" class="formulario-categoria_eliminar">
                                                            <input type="hidden" name="id" value="<?php echo $campo ['id']?>">
                                                            <input type="hidden" name="categoria" value="Eliminar">
                                                            <input type="submit" class="btn btn-danger" name="categoria" value="Eliminar">
                                                            </form>
                                                        <?php } else {?>
                                                            <form action="editar_categoria.php" method="POST" class="formulario-categoria_editar">
                                                            <input type="hidden" name="id" value="<?php echo $campo ['id']?>">
                                                            <input type="hidden" name="categoria" value="Editar">
                                                            <input type="submit" class="btn btn-primary" value="Editar">
                                                            </form>
                                                        <?php }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                    
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                    'Categoria Creada',
                    'La categoria se creo con exito',
                    'Correcto',
                    )
                </script>
        <?php } ?>

        <?php
            if ($preso == 2) {?>
                <script>
                    Swal.fire(
                    'Categoria Editada',
                    'La categoria se Edito con exito',
                    'Correcto',
                    )
                </script>
        <?php } ?>

        <?php
            if ($preso == 3) {?>
                <script>
                    Swal.fire(
                    'Categoria Eliminada',
                    'La categoria se Elimino con exito',
                    'Correcto',
                    )
                </script>
        <?php } ?>
  <?php }
  ?>
 

  <script>

    $('.formulario-categoria_eliminar').submit(function (e) {
    e.preventDefault();
    Swal.fire({
        title: 'Eliminar categoria',
        text: "Confirmar si accede a Eliminarlo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ELIMINAR',
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });

    $('.formulario-categoria_editar').submit(function (e) {
    e.preventDefault();
    let categoria = "Editar";
    Swal.fire({
        title: 'Editar categoria',
        text: "Confirmar si accede a Editar",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(categoria);
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
