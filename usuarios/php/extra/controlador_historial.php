<?php

$pase=(isset($_POST['alumnos']))?$_POST['alumnos']:"";

switch ($pase) {
    case 'Ver':

        $matricula=$_POST['matricula'];

        $sql = ("SELECT ciclo.descripcion, extraescolar.nombreActividad, extraescolar.horaHacer, extragrupo.matricula, extragrupo.valor, extragrupo.acreditacion FROM ciclo INNER JOIN extraescolar ON ciclo.id = extraescolar.idCiclo INNER JOIN extragrupo ON extragrupo.idActividad = extraescolar.id INNER JOIN tb_usuarios ON tb_usuarios.numero_control = extragrupo.matricula WHERE tb_usuarios.numero_control = $matricula;");
        $query = $bdd->prepare( $sql );
        $query->execute();
        $registros = $query->fetchAll(PDO::FETCH_ASSOC);
        break;
    
    default:
        # code...
        break;
}

$sql = ("SELECT numero_control, nombres FROM tb_usuarios WHERE cargo = 2");
$query = $bdd->prepare( $sql );
$query->execute();
$extragrupo = $query->fetchAll(PDO::FETCH_ASSOC);



?>