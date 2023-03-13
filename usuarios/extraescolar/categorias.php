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
        include('../php/sesion/secion.php');
    }

    include('../php/extra/controlador_ciclo.php');
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
                                                        <img src="data:image/jpg;base64,<?php echo base64_encode($campo['imagen']);?>" width = "150px" alt="...">

                                                        
                                                    </td>
                                        
                                                    <td>
                                                    <form action="lista_actividades.php" method="POST">
                                                        <input type="hidden" name="id" value="<?php echo $campo ['id'] ?>">
                                                        <input type="submit" name="actividad" class="btn btn-primary btn-lg" value="Acceder">
                                                    </form>
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
                    'CICLOS EXTRAESCOLAR',
                    'CICLO CREADO CON EXITO',
                    'CORRECTO',
                    )
                </script>
        <?php } ?>
    <?php } ?>


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
