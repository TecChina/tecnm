<?php
include ('../../app/config/config.php');
session_start();



if(isset($_SESSION['u_usuario'])){
    //echo "existe sesión";
    //echo "bienvenido usuario";
$correo_sesion = $_SESSION['u_usuario'];
    $query_sesion = $pdo->prepare("SELECT * FROM tb_usuarios WHERE correo = '$correo_sesion' AND estado = '1' ");
    $query_sesion->execute();
    $sesion_usuarios = $query_sesion->fetchAll(PDO::FETCH_ASSOC);
    foreach ($sesion_usuarios as $sesion_usuario){
        include('../php/sesion/secion.php');
    }
    include('../php/extra/controlador_categorias.php');
?>

<!DOCTYPE html>
<html>
<head>
  <?php include ('../../layout/extraescolar/head.php'); ?>
  <title>Agregar Tutoriado</title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include ('../../layout/extraescolar/menu.php'); ?>


  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            SISTEMA DE CAMPOS
            <small>Agregar Campos Extraescolares</small>
        </h1>
        
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Agregar Campos Extraescolares</h3>
                            </div>
                            <div class="panel-body">

                                <form action="registro_categoria.php" class="formulario-categoria_editar" method="POST" enctype="multipart/form-data">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><i class="glyphicon glyphicon-user"></i> Nombre del campo extraescolar</label>
                                                <input type="text" class="form-control" value="<?php if (!empty($nombre)) {
                                                    echo $nombre;
                                                } ?>" name="nombreCampo" required style="text-transform:uppercase;">
                                                <input type="hidden" name="id" value="<?php if (!empty($id)) {
                                                    echo $id;
                                                } ?>">
                                            </div>
                                            <?php if (!empty($imagen)) {?>
                                                <div class="form-group">
                                                <label for=""><i class="glyphicon glyphicon-user"></i>Imagen Anterior</label>
                                                <br>
                                                <img src="data:image/jpg;base64,<?php echo base64_encode($campo['imagen']);?>" width = "100px" alt="">
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><i class="glyphicon glyphicon-user"></i> Imagen portada de campo</label>
                                                <input type="file" class="form-control" name="imagenCampo" required>
                                            </div>
                                    
                                        <div class="col-md-6">
                                        <br>
                                        <div class="form-group">
                                            <center>
                                            <a href="registro_categoria.php" class="btn btn-danger btn-lg">Cancelar</a>
                                            <input type='hidden' name='categoria' value='Registrar'>
                                            <input type='submit' class='btn btn-primary btn-lg' value='Registrar'>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
  <script>
        $('.formulario-categoria_editar').submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Registrar categoria',
            text: "Confirmar",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Crear',
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