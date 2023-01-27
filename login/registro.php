<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registrarte</title>
  <link rel="stylesheet" href="style.css" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container">
    <span class="big-circle"></span>
    <img src="img/shape.png" class="square" alt="" />
    <div class="form">
      <div class="contact-info">
        <h3 class="title">Bienvenido al Sistema de Creditos Complementarios
        </h3>
        <br>
        <h3 class="title">TECNM Campus China
        </h3>
        <p class="text">
          Una vez registrado dirigite a tu perfil para terminar con el registro de tus datos generales
        </p>



        <div class="social-media">
          <p>conecta con nosotros:</p>
          <div class="social-icons">
            <a href="https://www.facebook.com/SomosTecNM/">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/TecNM_MX?ref_src=twsrc%5Etfw%7Ctwcamp%5Eembeddedtimeline%7Ctwterm%5Eprofile%3ATecNM_MX&ref_url=https%3A%2F%2Fwww.itchina.edu.mx%2F">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.instagram.com/tecnmcampuschina/">
              <i class="fab fa-instagram"></i>
            </a>

          </div>
        </div>
      </div>

      <div class="contact-form">


        <form action="./controlador_create.php" method="post" enctype="multipart/form-data" class="Registro">
          <div class="row">

            <h3 class="title">Registro</h3>
            <div class="input-container">
              <input type="text" name="ap_paterno" class="input" required style="text-transform:uppercase;">
              <label for="">Apellido paterno</label>
              <span>Apellido paterno</span>
            </div>
            <div class="input-container">
              <input type="text" name="ap_materno" class="input" required style="text-transform:uppercase;">
              <label for="">Apellido materno</label>
              <span>Apellido materno</span>
            </div>
            <div class="input-container">
              <input type="text" name="nombres" class="input" required style="text-transform:uppercase;">
              <label for="">Nombre(s)</label>
              <span>Nombres</span>
            </div>
            <div class="input-container">
              <input type="email" name="correo" class="input" required style="text-transform:uppercase;">
              <label for="">Correo Institucional</label>
              <span>Correo Institucional</span>
            </div>
            <div class="input-container">
              <input type="text" name="numero_control" class="input" required>
              <label for="">Matricula</label>
              <span>Matricula</span>
            </div>

            <div class="input-container">
              <input type="password" name="contraseña" class="input">
              <label for="">Contraseña</label>
              <span>Contraseña</span>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Registrar</button>
              <!-- <input type="submit" value="Registrarse" class="btn btn-primary btn-block"> -->
              <a href="../index.php" class="btn btn-default btn-block">Cancelar</a>
            </div>
        </form>
      </div>
    </div>
  </div>

  <script src="app.js"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- <script src="js/sweetalert.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>

<script>
  $('.Registro').submit(function(e) {
    e.preventDefault();
    Swal.fire({
      title: '¿DESEAS GUARDAR LOS DATOS?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'SI, DESEO GUARDAR'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'DATOS GUARDADOS CORRECTAMENTE',
          icon: 'success',
          showConfirmButton: false,
        })
        setTimeout(() => {
          this.submit();
        }, "1000")

      }

    })

  });
</script>