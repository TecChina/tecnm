<?php


include('../app/config/config.php');


 
    $motivo = $_POST['motivo'];
    $motivo = strtoupper($motivo);
    $categoria = $_POST['categoria'];
    $prioridad = $_POST['prioridad'];
    //$matricula =$_POST['matricula'];
    $id_alumno = $_POST['id_alumno'];
    $incidencia = $_POST['incidencia'];
    
    
    $sql = "INSERT INTO tb_incidencia(motivo,categoria,prioridad,id_alumno,Estado) VALUES ('$motivo','$categoria','$prioridad','$id_alumno','$incidencia')";


    echo $sql;

    $query = $bdd->prepare($sql);

  
    if ($query == false) {
        print_r($bdd->errorInfo());
        die('Erreur prepare');
    }
    $sth = $query->execute();

    $id_incidencia = $bdd->lastInsertId();
   
    if ($sth == false) {
        print_r($query->errorInfo());
        die('Erreur execute');
    }



 
    $tema = $_POST['tema'];
    $materia = $_POST['materia'];
    $horario = $_POST['horario'];

    $asesor = $_POST['asesor'];
    $alumno = $_POST['id_alumno'];
    $lunes = $_POST['lunes'];
    $martes = $_POST['martes'];
    $miercoles = $_POST['miercoles'];
    $jueves = $_POST['jueves'];
    $viernes = $_POST['viernes'];

  
    
    

    if(empty($asesor == false)){
        $sqlo = "INSERT INTO tb_claseasesoria(tema,materia,horario,id_asesor,id_alumnoo,lunes,martes,miercoles,jueves,viernes,id_incidencia) VALUES ('$tema','$materia','$horario','$asesor','$alumno','$lunes','$martes','$miercoles','$jueves','$viernes','$id_incidencia')";


        echo $sqlo;
    
        $query = $bdd->prepare($sqlo);
        if ($query == false) {
            print_r($bdd->errorInfo());
            die('Erreur prepare');
        }
        
        $sth = $query->execute();
        
        if ($sth == false) {
            print_r($query->errorInfo());
            die('Erreur execute');
        }
        
    }
    



    

  

header('Location: incidencias.php');