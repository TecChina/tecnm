<?php

$sql = ("SELECT id FROM ciclo ORDER BY id DESC LIMIT 1;");
$query = $bdd->prepare( $sql );
$query->execute();
$resultado = $query->fetch(PDO::FETCH_OBJ);

$idCiclo = $resultado === false ? 1 : $resultado->id;

$sql = ('SELECT cicloInicio , cicloFin, descripcion FROM ciclo');
$query = $bdd->prepare($sql);
$query->execute();
$ciclos = $query->fetchAll(PDO::FETCH_ASSOC);

?>