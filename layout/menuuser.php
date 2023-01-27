<head>
  <link rel="stylesheet" href="../css/menu.css">
  <link rel="stylesheet" href="../css/perfiles.css">
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
</head>



<header class="main-header">
  <!-- Logo -->
  <a href="indexuser.php" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>Chiná</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Chiná</b>TecNM</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <div class="container_nav">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">


          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php
              $caracter_a_buscar = ".";
              $buscar = strpos($id_foto_perfil, $caracter_a_buscar);
              if ($buscar == true) {
                // echo "existe foto de perfil";
              ?>
                <img src="data:imagen/png;base64,<?php echo base64_encode($sesion_usuario['foto']) ?>" class="user-image" alt="User Image">
                <?php
              } else {
                if ($id_sexo  == "Hombre") {
                ?>

                  <img src="../public/images/avatar_hombre.png" class="user-image" alt="User Image">

                <?php
                } else {
                ?>

                  <img src="../public/images/avatar_mujer.png" class="user-image" alt="User Image">

              <?php
                }
              }
              ?>
              <span class="hidden-xs"><?php echo $id_nombres . " " . $id_ap_paterno . " " . $id_ap_materno; ?> </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php
                $caracter_a_buscar = ".";
                $buscar = strpos($id_foto_perfil, $caracter_a_buscar);
                if ($buscar == true) {
                  // echo "existe foto de perfil";
                ?>
                  <img src="data:imagen/png;base64,<?php echo base64_encode($sesion_usuario['foto']) ?>" class="user-image" alt="User Image">
                  <?php
                } else {
                  if ($id_sexo  == "Hombre") {
                  ?>

                    <img src="../public/images/avatar_hombre.png" class="user-image" alt="User Image">

                  <?php
                  } else {
                  ?>

                    <img src="../public/images/avatar_mujer.png" class="user-image" alt="User Image">

                <?php
                  }
                }
                ?>

                <p>
                  <?php echo $id_nombres . " " . $id_ap_paterno . " " . $id_ap_materno; ?> - <?php echo $id_carrera; ?>
                  <small><?php echo $id_numero_control; ?></small>
                </p>
              </li>

              <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="../usuarios/perfil.php" class="btn btn-default btn-flat">Perfil</a>
            </div>
            <div class="pull-right">
              <a href="../login/controller_cerrar_sesion.php" class="btn btn-default btn-flat">Cerrar Sesion</a>
            </div>
          </li>
        </ul>
        </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar sidebar-menu">
    <!-- Sidebar user panel -->
    <!-- <div class="user-panel">
      <div class="pull-left image">
        <?php
        $caracter_a_buscar = ".";
        $buscar = strpos($id_foto_perfil, $caracter_a_buscar);
        if ($buscar == true) {
          // echo "existe foto de perfil";
        ?>
          <img src="<?php echo $URL; ?>/usuarios/update_usuarios/<?php echo $sesion_usuario['foto_perfil']; ?>" class="user-image" alt="User Image">
          <?php
        } else {
          if ($id_sexo  == "HOMBRE") {
          ?>

            <img src="<?php echo $URL; ?>/public/images/avatar_hombre.png" class="user-image" alt="User Image">

          <?php
          } else {
          ?>

            <img src="<?php echo $URL; ?>/public/images/avatar_mujer.png" class="user-image" alt="User Image">

        <?php
          }
        }
        ?>
      </div>
      <div class="pull-left info">
        <p><?php echo $id_nombres . " " . $id_ap_paterno . " " . $id_ap_materno; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div><br> -->

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <li class="treeview">
      <a href="#">
        <i class="fa fa-users"></i> <span>ACTIVIDADES ACADÉMICAS</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="sidebar-menu treeview-menu">









        <li class="header">Calendario de Actividades</li>
        <li><a href="calendariovista.php"><i class="glyphicon glyphicon-calendar"></i> <span>Elegir Actividad Académica</span></a></li>


        <li class="header">Evidencias de créditos</li>

        <li><a href="agregar-credito-user.php"><i class="glyphicon glyphicon-folder-open"></i> <span>Cargar Documento</span></a></li>

        <li class="header">Evaluacion</li>

        <li><a href="generarconstancia_alumno.php"><i class="fa fa-book"></i> <span><b>Constancia</b></span></a></li>

        <li class="header">Extraescolar</li>

        <li><a href="actAlum.php"><i class="fa fa-users"></i> <span>Actividades</span></a></li>
        <li><a href="consAlum.php"><i class="fa fa-users"></i> <span>Generar constancia</span></a></li>
         <li><a href="asesorias_alumno.php"><i class="fa fa-users"></i> <span>Asesorias</span></a></li>

      </ul>
    </li>


    <!-- creditos -->
    <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i><span> DESARROLLADORES</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class=" sidebar-menu treeview-menu">

          <li class="treeview">
            <a href="#">
              <span>Versión 1.0</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>


            <ul class="treeview-menu">
              <br>
              <div class="row">
                <img src="../public/desarrolladores/daniel.PNG" class="imagen asdf">
                <div class="col-12 version">
                  <br>
                  <a class="uno">ING. DANIEL JESÚS PÉREZ M.</a>
                  <br>
                  <a class="uno">INGENIERÍA EN INFORMÁTICA <br></a>
                  <a class="uno matri">MATRÍCULA 16830180 <br></a>
                </div>

                <div class="social-media">
                  <div class="social-icons">
                    <a href="https://www.facebook.com/M10RG?mibextid=ZbWKwL" target="_blank">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.instagram.com/mexito10/" target="_blank">
                      <i class="fab fa-instagram"></i>
                    </a>
                  </div>
                </div>
                
              </div>
              <br>
              <div class="row">
                <img src="../public/desarrolladores/emmanuel.PNG" class="imagen asdf">
                <div class="col-12 version">
                  <br>
                  <a class="uno">ING. JOSÉ ESCAMILLA MORENO</a>
                  <br>
                  <a class="uno">INGENIERÍA EN INFORMÁTICA <br></a>
                  <a class="uno matri">MATRÍCULA 16830183 <br></a>
                </div>

                <div class="social-media">
                  <div class="social-icons">
                    <a href="https://www.facebook.com/profile.php?id=100000133948179&mibextid=ZbWKwL" target="_blank">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="" target="_blank">
                      <i class="fab fa-instagram"></i>
                    </a>
                  </div>
                </div>

              </div>

              <br>

            </ul>
          </li>


          <li class="treeview">
            <a href="#">
              <span>Versión 2.0</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <br>

              <div class="row">
                <img src="../public/desarrolladores/diana.jpeg" class="imagen asdf">
                <div class="col-12 version">
                  <br>
                  <a class="uno">DIANA L. MADRIGAL BENITEZ</a>
                  <br>
                  <a class="uno" >INGENIERÍA EN INFORMÁTICA <br></a>
                  <a class="uno matri">MATRÍCULA 19830012 <br></a>
                </div>

                <div class="social-media">
                  <div class="social-icons">
                    <a href="https://www.facebook.com/diana.madrigalbenitez?mibextid=ZbWKwL" target="_blank">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.instagram.com/dianalibz/" target="_blank">
                      <i class="fab fa-instagram"></i>
                    </a>
                  </div>
                </div>   
              </div>

              <br>

              <div class="row">
                <img src="../public/desarrolladores/chan.jpeg" class="imagen asdf">
                  <div class="col-12 version">
                    <br>
                    <a class="uno">JÓSE RICARDO CHAN MARIN</b>
                    <br>
                    <a class="uno">INGENIERÍA EN INFORMÁTICA <br></a>
                    <a class="uno matri">MATRÍCULA 19830002 <br></a>
                  </div>

                  <div class="social-media">
                    <div class="social-icons">
                      <a href="https://www.facebook.com/XxRick17xX/" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                      <a href="https://www.instagram.com/xxrick17xx/" target="_blank">
                        <i class="fab fa-instagram"></i>
                      </a>
                    </div>
                  </div> 
              </div>

              <br>

              <div class="row">
                <img src="../public/desarrolladores/cuca.jpeg" class="imagen asdf">
                  <div class="col-12 version">
                    <br>
                    <a class="uno">JUAN ANTONIO CU CAHUICH</a>
                    <br>
                    <a class="uno">INGENIERÍA EN INFORMÁTICA <br></a>
                    <a class="uno matri">MATRÍCULA 19830001 <br></a>
                  </div>

                  <div class="social-media">
                    <div class="social-icons">
                      <a href="https://www.facebook.com/JuanQK1?mibextid=ZbWKwL" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                      <a href="https://www.instagram.com/antonioqk0/?igshid=OGQ2MjdiOTE%3D" target="_blank">
                        <i class="fab fa-instagram"></i>
                      </a>
                    </div>
                  </div>
              </div>

              <br>

              <div class="row">
                <img src="../public/desarrolladores/farfan.jpeg" class="imagen asdf">
                  <div class="col-12 version">
                    <br>
                    <a class="uno">DANIEL FARFÁN CAHUICH</a>
                    <br>
                    <a class="uno">INGENIERÍA EN INFORMÁTICA <br></a>
                    <a class="uno matri">MATRÍCULA 19830027 <br></a>
                  </div>

                  <div class="social-media">
                    <div class="social-icons">
                      <a href="https://www.facebook.com/daniel.farfancahuich.9?mibextid=ZbWKwL" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                      <a href="https://www.instagram.com/fxrfxxn/?igshid=OGQ2MjdiOTE%3D" target="_blank">
                        <i class="fab fa-instagram"></i>
                      </a>
                    </div>
                  </div> 
              </div>

              <br>

              <div class="row">
                <img src="../public/desarrolladores/boton.jpeg" class="imagen asdf">
                  <div class="col-12 version">
                    <br>
                    <a class="uno">CARLOS FRANCISCO BOTON</a>
                    <br>
                    <a class="uno">INGENIERÍA EN INFORMÁTICA <br></a>
                    <a class="uno matri">MATRÍCULA 19830248 <br></a>
                  </div>

                  <div class="social-media">
                    <div class="social-icons">
                      <a href="https://www.facebook.com/carlos.boton.77?mibextid=ZbWKwL" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                      <a href="https://www.instagram.com/carlo_sboton/?igshid=OGQ2MjdiOTE%3D" target="_blank">
                        <i class="fab fa-instagram"></i>
                      </a>
                    </div>
                  </div> 
              </div>

              <br>

              <div class="row">
                <img src="../public/desarrolladores/kevin.jfif" class="imagen asdf">
                  <div class="col-12 version">
                    <br>
                    <a class="uno">KEVIN BONIFAZ HERNÁNDEZ</a>
                    <br>
                    <a class="uno">INGENIERÍA EN INFORMÁTICA <br></a>
                    <a class="uno matri">MATRÍCULA 19830014 <br></a>
                  </div>

                  <div class="social-media">
                    <div class="social-icons">
                      <a href="https://www.facebook.com/profile.php?id=100012771139647&mibextid=ZbWKwL" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                      <a href="https://www.instagram.com/_kevinhernandez/?igshid=OGQ2MjdiOTE%3D" target="_blank">
                        <i class="fab fa-instagram"></i>
                      </a>
                    </div>
                  </div> 
              </div>

              <br>

              <div class="row">
                <img src="../public/desarrolladores/felipe.jpeg" class="imagen asdf">
                  <div class="col-12 version">
                    <br>
                    <a class="uno">FELIPE GIL MAYOR</a>
                    <br>
                    <a class="uno">INGENIERÍA EN INFORMÁTICA <br></a>
                    <a class="uno matri">MATRÍCULA 19830007 <br></a>
                  </div>

                  <div class="social-media">
                    <div class="social-icons">
                      <a href="https://www.facebook.com/felipe.gilmayor.5?mibextid=ZbWKwL" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                      <a href="https://www.instagram.com/felipegilmayor/?igshid=OGQ2MjdiOTE%3D" target="_blank">
                        <i class="fab fa-instagram"></i>
                      </a>
                    </div>
                  </div>
              </div>

              <br>

            </ul>






  </section>
  <!-- /.sidebar -->
</aside>
