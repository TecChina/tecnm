<?php
if(!isset($_POST["id"])) exit();//Preguntando si recibio el valor del idCategoria
$id = $_POST["id"];//almacenando en una variable el valor del idCategoria

//Seleccionando los campos de la tabla estraescolar para tomar uso de ello
$sql = "SELECT extraescolar.id, extraescolar.nombreActividad, extraescolar.horaActividad, extraescolar.encargadoActividad, tb_usuarios.nombres FROM extraescolar LEFT JOIN tb_usuarios ON extraescolar.encargadoActividad = tb_usuarios.id WHERE (idCategoria = ?) and (idCiclo = $idCiclo);";
$req = $bdd->prepare($sql);
$req->execute([$id]);
$actividades = $req->fetchAll();

//Seleccionando los campos de la tabla categoria buscada por el idCategoria que recibimos con el metodo POST
$sql = "SELECT id,nombreCategoria FROM categorias WHERE id = ?;";
$red = $bdd->prepare($sql);
$red->execute([$id]);
$campitos = $red->fetch(PDO::FETCH_LAZY);

//Almacenando valores en variables para hacer su llamado y ser vistas por el usuario
$idCampos=$campitos['id'];
$campos=$campitos['nombreCategoria'];
?>