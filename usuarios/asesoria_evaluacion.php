<?php

include('../app/config/config.php');
// obtenemos el valor y el resultado

$obs = $_POST['obs'];
$status = $_POST['status_incidencia'];
$id_asesoria = $_POST['id'];



//sentencia sql
$sql = "UPDATE tb_claseasesoria SET observacion = '$obs', status = '$status'  WHERE id_asesoria = $id_asesoria";






//ejecutamos sql

echo $sql;

$query = $bdd->prepare($sql);
if ($query == false) {
    print_r($bdd->errorInfo());
    die('Erreur prepare');
}
$sth = $query->execute();
if ($sth == false) {
    print_r($query->errorInfo());
    die('Erreur execute');
}
header('Location: asesoriasevaluacion.php');
