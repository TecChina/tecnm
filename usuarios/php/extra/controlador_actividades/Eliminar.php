<?php

$idE=$_POST['id'];

		$sql = "SELECT idCategoria FROM extraescolar WHERE id = ?";
		$red = $bdd->prepare($sql);
		$red->execute([$idE]);
		$categoria = $red->fetch(PDO::FETCH_LAZY);

		$id = $categoria['idCategoria'];

		$sql = "DELETE FROM extraescolar WHERE id= ?";
		$red = $bdd->prepare($sql);
		$red->execute([$idE]);

		//Seleccionando los campos de la tabla estraescolar para tomar uso de ello
		$sql = "SELECT id, nombreActividad, encargadoActividad FROM extraescolar WHERE (idCategoria = ?) and (idCiclo = $idCiclo);";
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