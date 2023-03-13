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
        include('../php/extra/controlador_categorias.php');
    }

    include('../php/extra/ciclo.php');
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
                    SISTEMA DE EXTRAESCOLARES
                    <small>Listado de campos extraescolares</small>
                </h1>
                
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"> REGISTROS DE CICLO</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="">Buscar</label>
                                        <input type="search" name="" id="">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-secondary btn-lg">Todos</button>
                                    </div>
                                    <div class="col-md-2">
                                        <form action="nuevoCiclo.php" method="POST" class="formulario-ciclo_crear" >
                                            <input type="submit" class="btn btn-primary btn-lg" value="Crear Ciclo">
                                        </form>
                                    </div>
                                
                                    <br><br><br>

                                    <form action="createCiclo.php" method="post" enctype="multipart/form-data">
                                    </form>

                                    <div class="col-md-12">
                                        <table class="table table-light">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Ciclos</th>
                                                    <th>Descripcion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($ciclos)) {
                                                    foreach ($ciclos as $ciclo) {
                                                        echo"<tr>";
                                                        echo"<td>".$i++."</td>";
                                                        echo"<td>".$ciclo['cicloInicio']."</td>";
                                                        echo"<td>".$ciclo['descripcion']."</td>";
                                                        echo"<tr>";
                                                    }
                                                } else if(empty($ciclos)){
                                                    echo"<tr>";
                                                    echo"<td> SIN REGISTROS DE CICLOS </td>";
                                                    echo"<tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <!-- /.content -->
            </div>
        <!-- /.content-wrapper -->
        </div>
        <?php include ('../../layout/extraescolar/footer.php'); ?>
        <?php include ('../../layout/extraescolar/footer_links.php'); ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $('.formulario-ciclo_crear').submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Crear Nuevo Ciclo',
                text: "Acceder",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Acceder',
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
