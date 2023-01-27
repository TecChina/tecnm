<?php
/* LLAMAMOS AL ULTIMO ID DE LA TABLA CICLO */
$sentencia = $con->prepare("SELECT id FROM ciclo ORDER BY id DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

if (!empty($resultado['id'])) {
    $idCicloA = $resultado['id'];
}

$lase=(isset($_POST['ciclo']))?$_POST['ciclo']:"";

    
switch ($lase) {
    case 'Crear':
        if (!empty($idCicloA)) {/* si la variable $idCicloA esta definida entra en la sentencia */

            /* insertamos nuevo registro con los datos recividos por el metodo POST */
            $inicio=$_POST['inicio'];
            $fin=$_POST['fin'];
            $descripcion=strtoupper($_POST['descripcion']);
            $sentencia = $con->prepare("INSERT INTO ciclo( cicloInicio, cicloFin, descripcion) VALUES (?, ?, ?);");
            $ciclo = $sentencia->execute([$inicio, $fin, $descripcion]);
        
            /* Seleccionamos la tabla categoria con indicacion especifica del where */
            $sentencia = $con->prepare("SELECT nombreCategoria, idImagen FROM categorias WHERE idCiclo = $idCicloA ORDER BY id ASC LIMIT 4");
            $sentencia->execute();
            $categorias = $sentencia->fetchAll(PDO::FETCH_OBJ);
        
            /* incluimos el archivo Ciclo.php */
            include('ciclo.php');
        
            /* damos inicio a inserciones de datos con desconexcion de la base de datos */
            $con->beginTransaction();
                
                /* insertamos registros en la tabla categorais con un foreach */
                $cate = $con->prepare("INSERT INTO categorias (nombreCategoria, idImagen, idCiclo) VALUES (?,?,?);");
        
                foreach ($categorias as $categoria) {
        
                    $cate->execute([$categoria->nombreCategoria, $categoria->idImagen, $idCiclo]);
        
                }
        
            $con->commit();
        
        
            $con->beginTransaction();

                $sentencia = $con->prepare("SELECT count(id) FROM categorias WHERE idCiclo = $idCicloA");
                $sentencia->execute();
                $resultado = $sentencia->fetchColumn();

                $filas = $resultado;

                /* Seleccionamos categorias con el ciclo anterior */
                $sentencia = $con->prepare("SELECT id FROM categorias WHERE idCiclo = $idCicloA ORDER BY id ASC LIMIT 1");
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        
                $idCategoria = $resultado->id;
                $fin = $idCategoria + $filas;
        
                $sentencia = $con->prepare("SELECT id FROM categorias WHERE idCiclo = $idCiclo ORDER BY id ASC LIMIT 1");
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        
                $idCategoriaU = $resultado->id;
        
                while ($idCategoria < $fin) {
                    $sentencia = $con->prepare("SELECT nombreActividad, idCategoria FROM extraescolar WHERE idCategoria = $idCategoria");
                    $sentencia->execute();
                    $extraescolar = $sentencia->fetchAll(PDO::FETCH_OBJ);
        
                    $acti = $con->prepare("INSERT INTO extraescolar( nombreActividad, horaActividad, diaActividad, horaHacer, encargadoActividad, lugarActividad, idCategoria, idCiclo) VALUES (?,?,?,?,?,?,?,?);");
        
                    foreach ($extraescolar as $extra) {
        
                        $acti->execute([$extra->nombreActividad, NULL,NULL,NULL,NULL,NULL, $idCategoriaU, $idCiclo]);

                    }
        
                    $idCategoria++;
                    $idCategoriaU++;
                }
        
            /* Conectamos a la base de datos para insertar todas los registros en la tabla */
            $con->commit();

            $preso = 1;
        
        } else if (empty($idCicloA)) {/* si la variable $idCicloA esta definida pero esta vacia entra en la sentencia */
            if (isset($_POST['inicio']) && isset($_POST['fin']) && isset($_POST['descripcion'])){
        
        
                /* Insertamos un nuevo registro en la tabla Ciclo */
                $inicio=$_POST['inicio'];
                $fin=$_POST['fin'];
                $descripcion=strtoupper($_POST['descripcion']);
                $sentencia = $con->prepare("INSERT INTO ciclo( cicloInicio, cicloFin, descripcion) VALUES (?, ?, ?);");
                $ciclo = $sentencia->execute([$inicio, $fin, $descripcion]);
        
                /* Seleccionamos al ciclo que insertamos */
                $sentencia = $con->prepare("SELECT id FROM ciclo");
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
                $ciclos = $resultado->id;
        
                /* Definimos la imagen de la siguiente Ruta */
                $imagen = "update_usuarios/Categorias.png";
                // $imagen = addslashes(file_get_contents($_FILES['Categorias.png']['tmp_name']));
                $a = 1;
        
                /* Insertamos 4 registros de imagen de una solo imagen en la tabla imagen */
                while ($a < 5) {
                    $sql = $con->prepare("INSERT INTO imagen(imagen) VALUES (?)");
                    $imagenes = $sql->execute([$imagen]);
                    $a++;
                }
        
                /* Seleccionamos el primer registro de la imagenes que insertamos */
                $sentencia = $con->prepare("SELECT id FROM imagen ORDER BY id ASC LIMIT 1");
                $sentencia->execute();
                $imagenL = $sentencia->fetch(PDO::FETCH_OBJ);
                $imagenM = $imagenL->id;
        
                /* Definimos un array para las categorias con sus respectivos nombres */
                $categoriaR = array('DEPORTIVAS','DESARROLLO HUMANO','CULTURALES','CIVICAS');
                /* Definimos la variable i */
                $i = 0;
        
                /* Insertamos las categorias con el array definida y usando la variable i para darle fin a la sentencia while */
                while ($i < 4) {
                    $sentencia = $con->prepare("INSERT INTO categorias( nombreCategoria, idImagen, idCiclo) VALUES (?, ?, ?);");
                    $ciclo = $sentencia->execute([$categoriaR[$i],$imagenM, $ciclos]);
                    $imagenM++;
                    $i++;
                }
        
                /* Definos 4 arrays para las actividades de las categorias */
                $Deportivas = array('FUTBOL MASCULINO','FUTBOL FEMENINO','BASQUETBALL','BEISBOL');
                $Desarrollo = array('CURSO DE PREVENCION DE ADICCIONES','CURSO DE MANEJO DE ALIMENTOS');
                $Culturales = array('TALLER DE AJEDREZ','TALLER DE CINE');
                $Civicas = array('ESCOLTA');
        
                /* Contamos los atributos de cada array que definimos */
                $Dep = count($Deportivas);
                $Des = count($Desarrollo);
                $Cul = count($Culturales);
                $Civ = count($Civicas);
                
                /* Seleccinamos la primera fila del registro que insertamos en la tabla categorias */
                $sentencia = $con->prepare("SELECT id FROM categorias ORDER BY id ASC LIMIT 1");
                $sentencia->execute();
                $categoriaL = $sentencia->fetch(PDO::FETCH_OBJ);
                $categoriaM = $categoriaL->id;
        
                /* Seleccionamos todas los registros id de la tabla categorias */
                $sentencia = $con->prepare("SELECT id FROM categorias");
                $sentencia->execute();
                $categoriaS = $sentencia->fetchAll(PDO::FETCH_OBJ);
        
                /* Damos uso de un foreach para soltar cada registro de la variable categoriaS */
                foreach ($categoriaS as $categoria) {
                    $j = 0;
                    if ($categoriaM == $categoria->id) {
                        while ($j < $Dep) {
                            /* Insertamos registros en la tabla extraescolar */
                            $sentencia = $con->prepare("INSERT INTO extraescolar( nombreActividad, horaActividad, diaActividad, horaHacer, encargadoActividad, lugarActividad, idCategoria, idCiclo) VALUES (?,?,?,?,?,?,?,?);");
                            $ciclo = $sentencia->execute([$Deportivas[$j],NULL,NULL,NULL,NULL,NULL,$categoria->id, $ciclos]);
                            $j++;
                        }
                    }
                    if (($categoriaM + 1) == $categoria->id) {
                        while ($j < $Des) {
                            /* Insertamos registros en la tabla extraescolar */
                            $sentencia = $con->prepare("INSERT INTO extraescolar( nombreActividad, horaActividad, diaActividad, horaHacer, encargadoActividad, lugarActividad, idCategoria, idCiclo) VALUES (?,?,?,?,?,?,?,?);");
                            $ciclo = $sentencia->execute([$Desarrollo[$j],NULL,NULL,NULL,NULL,NULL,$categoria->id, $ciclos]);
                            $j++;
                        }
                    }
                    if (($categoriaM + 2) == $categoria->id) {
                        while ($j < $Cul) {
                            /* Insertamos registros en la tabla extraescolar */
                            $sentencia = $con->prepare("INSERT INTO extraescolar( nombreActividad, horaActividad, diaActividad, horaHacer, encargadoActividad, lugarActividad, idCategoria, idCiclo) VALUES (?,?,?,?,?,?,?,?);");
                            $ciclo = $sentencia->execute([$Culturales[$j],NULL,NULL,NULL,NULL,NULL,$categoria->id, $ciclos]);
                            $j++;
                        }
                    }
                    if (($categoriaM + 3) == $categoria->id) {
                        while ($j < $Civ) {
                            /* Insertamos registros en la tabla extraescolar */
                            $sentencia = $con->prepare("INSERT INTO extraescolar( nombreActividad, horaActividad, diaActividad, horaHacer, encargadoActividad, lugarActividad, idCategoria, idCiclo) VALUES (?,?,?,?,?,?,?,?);");
                            $ciclo = $sentencia->execute([$Civicas[$j],NULL,NULL,NULL,NULL,NULL,$categoria->id, $ciclos]);
                            $j++;
                        }
                    }
                }

                $preso = 1;
                
        
            }
        }
        break;
    
    default:
        break;
}


	
?>
