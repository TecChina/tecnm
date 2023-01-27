

<?php

include('../app/config/config.php');





if($_POST["buscar"] == null  ){

}else{

$buscardor = mysqli_query($conexion, "SELECT * FROM tb_tutorias WHERE id LIKE LOWER('" . $_POST["buscar"] . "') ");
$numero = mysqli_num_rows($buscardor);
?>



<?php while ($resultado = mysqli_fetch_assoc($buscardor)) { ?>


    <link rel="stylesheet" href="../usuarios/estilos.css">
    <div class="container_buscador">

        <div class="row">
            <div class="col ">
                <label class="control-label">Nombre completo:</label>
                <?php echo $resultado["nombres"] ?>  <?php echo $resultado["ap_paterno"] ?>
                <?php echo $resultado["ap_materno"] ?>
            </div>

            <div class="col ">
            <label class="control-label">Carrera: </label>
                <?php echo $resultado["carrera"] ?>  
            </div>

            <div class="col  ">
            <label class="control-label">Semestre:</label>
                <?php echo $resultado["semestre"] ?>
            </div>
            
            </div>
            
        

            



      

        </div>
        <br><br><br><br>

       





        


    


       
    <?php }
    } ?>