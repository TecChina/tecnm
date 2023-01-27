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

<!DOCTYPE html>
<html>
<head>
  <?php include ('../../layout/extraescolar/head.php'); ?>
  <title>Editar Actividad</title>
  <script>
    function confirmacion(){
        var respuesta = confirm("¿Deseas editar esta informacion?");
        if (respuesta==true){
            return true;
        }else{
        return false;
    }
    } 
  </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<?php 
   if(isset ($_POST['enviar'])){
    $id=$_POST['id'];
    $nombreActividad=strtoupper($_POST['nombreActividad']);
    $horaActividad=$_POST['horaActividad'];
    $horaHacer = $_POST['horaHacer'];
    $lugarActividad=$_POST ['lugarActividad'];
    $lunes=(isset($_POST['lunes']))?$_POST['lunes']:"";
    $martes=(isset($_POST['martes']))?$_POST['martes']:"";
    $miercoles=(isset($_POST['miercoles']))?$_POST['miercoles']:"";
    $jueves=(isset($_POST['jueves']))?$_POST['jueves']:"";
    $viernes=(isset($_POST['viernes']))?$_POST['viernes']:"";
    
    $sql="UPDATE extraescolar set nombreActividad='".$nombreActividad."', horaActividad='".$horaActividad."', horaHacer='".$horaHacer."', lugarActividad='".$lugarActividad."' where id='".$id."'";
    
    $resultado=mysqli_query($conexion,$sql);
    echo "<script languaje='JavaScript'>
    alert('Los datos se actualizaron correctamente');
    location.assign('categorias.php')
    </script>";

   }else{
    $id=$_GET['id'];
    $sql="SELECT nombreActividad,horaActividad,horaHacer, lugarActividad FROM extraescolar  where extraescolar.id='".$id."'";
    $resultado=mysqli_query($conexion,$sql);

    $campor=mysqli_fetch_assoc($resultado);
    $nombreActividad=$campor["nombreActividad"];
    $horaActividad=$campor['horaActividad'];
    $horaHacer = $campor['horaHacer'];
    $lugarActividad=$campor ['lugarActividad'];
    

    mysqli_close($conexion);
   }

?>
    
<div class="wrapper">
<?php include ('../../layout/extraescolar/menu.php'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SISTEMA DE ACTIVIDADES EXTRAESCOLARES
        <small>Agregar actividad extraescolar</small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
		    <div class="col-md-12">
	         <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Editar extraescolar </h3>
               </div>
              <div class="panel-body">
                <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for=""><i class="glyphicon glyphicon-user"></i> Nombre de actividad</label> 
                        <input type="text" class="form-control" name="nombreActividad" required  style="text-transform:uppercase; " value="<?php echo $nombreActividad; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        
                      </div>

                      <div class="form-group">
                        <label for=""><i class="glyphicon glyphicon-user"></i> Horas a cumplir la actividad</label> 
                        <input type="text" class="form-control" name="horaActividad" required value="<?php echo $horaActividad; ?>">
                      </div>

                      <div class="form-group">
                        <label for=""><i class="glyphicon glyphicon-check"></i>Dias a cumplir la actividad</label>
                        <br>
                        <input name="lunes" value="lunes" id="lunes" type="checkbox" ><label for="lunes">Lunes</label>
                        <input name="martes" value="martes" id="martes" type="checkbox"><label for="martes">Martes</label>
                        <input name="miercoles" value="miercoles" id="miercoles" type="checkbox"><label for="miercoles">Miercoles</label>
                        <input name="jueves" value="jueves" id="jueves" type="checkbox"><label for="jueves">Jueves</label>
                        <input name="viernes" value="viernes" id="viernes" type="checkbox"><label for="viernes">Viernes</label>
                      </div>
                      
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for=""><i class="glyphicon glyphicon-book"></i>Horario de actividad</label>
                        <input type= "time" class="form-control" name="horaHacer" required value="<?php echo $horaHacer; ?>">
                        <!--<input type="text" class="form-control" name="horaHacer" required style="text-transform:uppercase;">-->
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
                        <input type="text" class="form-control" name="otroActividad" id="" style="text-transform:uppercase;">
                        <input type="hidden" name="idCampo" value="<?php echo $campor?>" style="text-transform:uppercase;" value="<?php echo $lugarActividad; ?>">
                      </div>

                      <div class="col-md-6">

                        <br>
                        <div class="form-group">
                          <center>
                            
                            <a href="lista_actividades.php" class="btn btn-danger btn-lg">Cancelar</a>
                            <input href="extraescolar.php" type="submit" name="enviar" class="btn btn-primary btn-lg" onclick="return confirmacion()"  value="Guardar" style="text-transform:uppercase;">
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




</body>
</html>
<script>
   
<?php
}else{
    echo "no existe sesión";
    header('Location:'.$URL.'/login');
}
