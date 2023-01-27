<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php
  $sq = "SELECT * FROM tb_ciclos 
 ";

  $result = mysqli_query($conexion, $sq);


  $carrera = "SELECT * FROM cat_carreras; 
 ";

  $result_carrera = mysqli_query($conexion, $carrera);

  ?>
</head>

<body>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Nuevo Grupo
  </button>

  <form action="grupoCreate.php" method="post" enctype="multipart/form-data" class="actualizar_grupo">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Alta de grupo</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="row">

              <div class="col">
                <div class="form-group" class="col-sm2 control-label">
                  <label for="prioridad">Seleccionar carrera</label>
                  <select name="carrera" id="" class="form-control" required>
                    <option value="">Seleccionar carrera</option>
                    <?php
                    while ($filos= mysqli_fetch_assoc($result_carrera)) {
                    ?> 
                    

                      <option value="<?php echo $filos['carrera'] ?>"> <?php echo $filos['carrera'] ?></option>
                    <?php
                    }
                    ?>
                  </select>
                  </select>
                </div>
              </div>
              <div class="col">
                <div class="form-group" class="col-sm2 control-label">
                  <label for="prioridad">Seleccionar ciclo escolar</label>
                  <select name="periodo" id="" class="form-control" required>
                  <option value="">Seleccionar ciclo escolar</option>
                    <?php
                    while ($filo = mysqli_fetch_assoc($result)) {
                    ?>

                      <option value="<?php echo $filo['ciclo_escolar'] ?>"> <?php echo $filo['ciclo_escolar'] ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">

                <div class="form-group" class="col-sm2 control-label">
                  <label for="id_alumno">Semestre</label>
                  <div>
                    <select name="semestre" id="" class="form-control">
                      <option value="">Selecciona una opcion</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                    </select>
                  </div>
                </div>

              </div>
              <div class="col">
                <div class="form-group" class="col-sm2 control-label">
                  <label for="categoria">Dias tutoria</label>
                  <select name="dias_tutoria" id="" class="form-control">
                    <option value="">Selecciona una opcion</option>
                    <option value="LUNES">LUNES</option>
                    <option value="MARTES">MARTES</option>
                    <option value="MIERCOLES">MIERCOLES</option>
                    <option value="JUEVES">JUEVES</option>
                    <option value="VIERNES">VIERNES</option>
                  </select>
                </div>
              </div>


            </div>

            <div class="row">
              <div class="col">
                <div class="form-group" class="col-sm2 control-label">
                  <label for="categoria">Hora inicio tutoria</label>
                  <input type="time" name="inicio_tutoria" value="" class="form-control">
                </div>
              </div>



              <div class="col">
                <div class="form-group" class="col-sm2 control-label">
                  <label for="categoria">Hora de fin tutoria</label>
                  <input type="time" name="fin_tutoria" value="" class="form-control">
                </div>
              </div>
            </div>




          </div>




          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success" value="Registrar">Guardar</button>
          </div>


        </div>
      </div>
    </div>
  </form>

  <script>
    $('.actualizar_grupo').submit(function(e) {
      e.preventDefault();
      Swal.fire({
        title: '¿ESTAS SEGURO QUE DESEAS GUARDAR EL GRUPO?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, DESEO GUARDAR'
      }).then((result) => {
        if (result.isConfirmed) {
          this.submit();
        }
      })

    });
  </script>


</body>

</html>