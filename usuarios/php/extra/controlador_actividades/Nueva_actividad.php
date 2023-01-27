<?php
if(!isset($_POST["id"])) exit();//preguntando si el metodo get tiene un valor, si no tiene uno sale del porceso
$id = $_POST["id"];

$sql = "SELECT id,nombreCategoria FROM categorias WHERE id = ?;";
$red = $bdd->prepare($sql);
$red->execute([$id]);
$campitosos = $red->fetch(PDO::FETCH_LAZY);

$campor=$campitosos['id'];
$nomCat=$campitosos['nombreCategoria'];

$sql = "SELECT id, nombres, ap_paterno, ap_materno FROM tb_usuarios WHERE Responsable = 1 and cargo = 1 ORDER BY nombres ASC;";
$query = $bdd->prepare($sql);
$query->execute();
$responsables = $query->fetchAll(PDO::FETCH_ASSOC);

?>