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
    

  include('../php/extra/controlador_actividad.php');
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
            SISTEMA DE ACTIVIDADES EXTRAESCOLARES
            <small>Agregar actividad extraescolar</small>
            <?php
            if (!empty($nombreActividad)) {
              echo "<form action='lista_actividades.php' style='position: absolute; top: 30%; right: 10%;'  method='POST'>";
              echo "<input type='hidden' name='id' value='".$idCategoria."'>";
              echo "<input type='submit' class='btn btn-primary' name='actividad'  value='ATRAS'>";
            echo "</form>";
            }
            ?>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title"> <?php if (!empty($nombreActividad)) {
                    echo "ACTUALIZAR ACTIVIDAD A CATEGORIA  ".$nomCat;
                  }elseif (empty($nombreActividad)) {
                    echo "AGREGAR ACTIVIDAD A CATEGORIA  ".$nomCat;
                  }?> </h3>
                </div>

                <div class="panel-body">

                  <form action="lista_actividades.php" method="POST" class="formulario-actividad_crear" enctype="multipart/form-data">

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-user"></i> Nombre de actividad</label> 
                          <input type="text" class="form-control" name="nombreActividad" value="" required  style="text-transform:uppercase;">
                        </div>

                        

                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-user"></i> Horas a cumplir la actividad</label> 
                          <input type="text" class="form-control" name="horaActividad" required value="" >
                        </div>

                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-check"></i>Dias a cumplir la actividad</label>
                          <br>
                          <input name="lunes" value="1" id="lunes" type="checkbox" ><label for="lunes">Lunes</label>
                          <input name="martes" value="1" id="martes" type="checkbox"><label for="martes">Martes</label>
                          <input name="miercoles" value="1" id="miercoles" type="checkbox" ><label for="miercoles">Miercoles</label>
                          <input name="jueves" value="1" id="jueves" type="checkbox"><label for="jueves">Jueves</label>
                          <input name="viernes" value="1" id="viernes" type="checkbox" ><label for="viernes">Viernes</label>
                        </div>

                        <br>

                        <div class="form-group">
                          <center>
                            <input type="hidden" name="actividad" value="Registrar">
                            <input type='submit' class='btn btn-primary btn-lg' value='Registrar'>
                          </center>
                        </div>
                        
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-book">
                          </i>Horas de actividad</label>
                          <br>
                          <input type="time" class="form-control" value="" name="horaHacer" required >
                        </div>

                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-book"></i>Encargado</label> 
                          <select class="form-control" name="encargado">
                            <option value="">SELECCIONE AL ENCARGADO</option>
                            <?php
                            foreach ($responsables as $responsable) {
                              echo "<option value='".$responsable['id']."'>".$responsable['nombres']."</option>";
                            }
                            ?>
                          </select>
                          <br>
                        </div>
                        
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-book"></i>Lugar de actividad</label> 
                          <select class="form-control" name="lugarActividad">
                            <option value="">Seleccione</option>
                            <option value="CampoFutbol">Campo de futbol</option>
                            <option value="Cancha">Cancha usos multiples</option>
                            <option value="biblioteca">Biblioteca</option>
                            <option value="beisbol">Campo Beisbol</option>
                          </select>
                          <br>
                          <label for=""><i class="glyphicon glyphicon-user"></i>Otros</label> 
                          <input type="text" class="form-control" name="otroActividad" style="text-transform:uppercase;">
                          <input type="hidden" name="id" value="<?php echo $id ?>">
                          <input type="hidden" name="idActividad" value="<?php echo $idActividad ?>" >
                          
                        </div>
                      </div>
                    </div>
                  </form>

                  <form action="lista_actividades.php" style="position: absolute; top: 70%; left: 12%;" method="POST">
                    <div class="form-group">
                      <input type="hidden" name="id" value="<?php echo $campor ?>">
                      <input type="submit" name="actividad" class="btn btn-danger btn-lg" value="Cancelar">
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
        $('.formulario-actividad_crear').submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Crear Actividad',
            text: "Confirmar si accede a Crear actividad",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'COMFIRMAR',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });

        </script>

    </div>
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
