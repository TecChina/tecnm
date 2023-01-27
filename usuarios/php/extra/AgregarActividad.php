<?php

include('ciclo.php');

$sql = ("SELECT extraescolar.id, extraescolar.nombreActividad, extraescolar.idCategoria, responsable.idUsuario, tb_usuarios.nombres FROM extraescolar INNER JOIN responsable ON extraescolar.id = responsable.idActividad INNER JOIN tb_usuarios ON tb_usuarios.id = responsable.idUsuario WHERE extraescolar.idCiclo = $idCiclo AND responsable.idUsuario = $id_sesion ORDER BY responsable.id");
$query = $bdd->prepare($sql);
$query->execute();
$extraescolar = $query->fetchAll(PDO::FETCH_ASSOC);

/********************************************************************************/

?>