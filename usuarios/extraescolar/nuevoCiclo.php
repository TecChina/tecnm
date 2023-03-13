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
        SISTEMA DE EXTRAESCOLARES
        <small>Listado de campos extraescolares</small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="panel panel-primary">
        <div class="panel-heading">CREACION DE NUEVO CICLO</div>

        <div class="panel-body">
            <form action="categorias.php" method="POST" class="formulario-ciclo_crear" enctype="multipart/form-data">
                <div class="row">
    
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for=""><i class="glyphicon glyphicon-check"></i>Inicio de Ciclo</label> 
                            <input type="date" class="form-control" name="inicio" required>
                        </div>

                        <div class="form-group">
                            <label for=""><i class="glyphicon glyphicon-book"></i>Descripcion Ciclo</label> 
                            <input type="text" class="form-control" name="descripcion" required style="text-transform:uppercase;">
                        </div>
                
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""><i class="glyphicon glyphicon-check"></i>Fin de Ciclo</label> 
                            <input type="date" class="form-control" name="fin" required>
                        </div>
                    </div>

                    <br>

                    <div class="col-md-6">
                        <div class="form-group">
                        <center>
                            <a href="registro_ciclo.php" class="btn btn-danger btn-lg">Cancelar</a>
                            <input type="hidden" name="ciclo" value="Crear">
                            <input type="submit" class="btn btn-primary btn-lg" value="Crear">
                        </center>
                        </div>
                    </div>
                </div>
            </form>
        </div>

                    


                    <div class="panel-body">
                        
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
            $('.formulario-ciclo_crear').submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Crear Nuevo Ciclo',
                text: "Seguro que quieres crear un nuevo Ciclo?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Crear ciclo',
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
