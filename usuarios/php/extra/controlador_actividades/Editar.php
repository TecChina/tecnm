<?php
$id=$_POST['id'];//reciviendo el id de la actividad
$idCategoria = $_POST['idCategoria'];//reciviendo el id de la categoria

//Seleccionando los campos de la tabla categoria con la busqueda del id  de la categoria
$sql = "SELECT id,nombreCategoria FROM categorias WHERE id = ?;";
$red = $bdd->prepare($sql);
$red->execute([$idCategoria]);
$campitosos = $red->fetch(PDO::FETCH_LAZY);

$campor=$campitosos['id'];//almacenando datos de la seleccion de la categoria en la variable
$nomCat=$campitosos['nombreCategoria'];//almacenando datos de la seleccion de la categoria en la variable

//Seleccionando los campos de la tabla extraescolar con la busqueda del id extraescolar
$sql="SELECT id, nombreActividad,horaActividad,horaHacer, lugarActividad,idCategoria FROM extraescolar  where extraescolar.id = $id";
$req = $bdd->prepare($sql);
$req->execute();
$campor = $req->fetch(PDO::FETCH_LAZY);

$idActividad=$campor['id'];//almacenando datos de la seleccion de la categoria en la variable
$nombreActividad=$campor["nombreActividad"];//almacenando datos de la seleccion de la categoria en la variable
$horaActividad=$campor['horaActividad'];//almacenando datos de la seleccion de la categoria en la variable
$horaHacer = $campor['horaHacer'];//almacenando datos de la seleccion de la categoria en la variable
$lugarActividad=$campor ['lugarActividad'];//almacenando datos de la seleccion de la categoria en la variable
$id=$campor['idCategoria'];//almacenando datos de la seleccion de la categoria en la variable

$sql = "SELECT id, nombres, ap_paterno, ap_materno FROM tb_usuarios WHERE Responsable = 1 and cargo = 1 ORDER BY nombres ASC;";
$query = $bdd->prepare($sql);
$query->execute();
$responsables = $query->fetchAll(PDO::FETCH_ASSOC);
?>