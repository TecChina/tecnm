<?php

include ('../../../app/config/config.php');

    $salida = "";
    $sql = ("SELECT * FROM tb_usuarios WHERE Responsable = 1 ORDER BY id DESC LIMIT 5;");


      if (isset($_POST['consulta'])) {
        $valor = $conect->real_escape_string($_POST['consulta']);
        $sql = "SELECT id, nombres, ap_paterno, ap_materno, correo, curp, telefono, cubiculo FROM tb_usuarios WHERE Responsable = 1 AND curp LIKE '%".$valor."%'";
      }

      $resultado = $conect->query($sql);

      if ($resultado->num_rows > 0) {
        $salida.="<table class='table table-light'>
                    <thead>
                      <tr>
                        <td>Nombre Completo</td>
                        <td>Correo</td>
                        <td>Telefono</td>
                        <td>Curp</td>
                        <td>Cubiculo</td>
                        <td>Accion</td>
                      </tr>
                    </thead>
                    <tbody>";

        while ($fila = $resultado->fetch_assoc()) {
          $salida.="<tr>
                      <th>".$fila['nombres']." ".$fila['ap_materno']." ".$fila['ap_materno']."</th>
                      <th>".$fila['correo']."</th>
                      <th>".$fila['telefono']."</th>
                      <th>".$fila['curp']."</th>
                      <th>".$fila['cubiculo']."</th>
                      <th><a class='btn btn-primary btn-lg' href='../extraescolar/encargado.php?id=".$fila ['id'] ."' >ASIGNAR</a></th>
                    </tr>
                  ";
        }

        $salida.="</tbody>
                </table>";

      } else {
        $salida.="No existen datos";
      }

      echo $salida;

      $conect->close();

      ?>