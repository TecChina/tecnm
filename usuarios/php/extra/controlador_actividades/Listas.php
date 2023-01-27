<?php

if(!isset($_POST["id"])) exit();//Preguntando si recibio el valor del idActividad de lo contrario sale
		$id = $_POST["id"];

		//Selecionando los campos de la tabla excolar con la busqueda del id de la actividad y el idCiclo del cilo reciente
		$sql = "SELECT id,nombreActividad,idCategoria FROM extraescolar WHERE (id = ?) and (idCiclo = $idCiclo);";
		$req = $bdd->prepare($sql);
		$req->execute([$id]);
		$extraescolar = $req->fetch(PDO::FETCH_OBJ);

		$nombre = $extraescolar->nombreActividad;//almacenando valores recibidos de la base de datos en variables
		$categoria = $extraescolar->idCategoria;//almacenando valores recibidos de la base de datos en variables

		//Selecionando los campos de la tabla categoria con el id de la categoria la cual se obtuvo al buscar la actividad
		$sql = ("SELECT id,nombreCategoria FROM categorias WHERE id = $categoria;");
		$query = $bdd->prepare( $sql );
		$query->execute();
		$cate = $query->fetch(PDO::FETCH_LAZY);

		$idCategoria = $cate['id'];//almacenando valores recibidos de la base de datos en variables
		$nombreCategoria = $cate['nombreCategoria'];//almacenando valores recibidos de la base de datos en variables

		//Seleccion de varios campos con tablas unidas con INNER JOIN, para tener mayor precision de la busqueda requerida, con un where del id de la actividad
		$sql = "SELECT tb_usuarios.id, tb_usuarios.nombres,tb_usuarios.ap_paterno,tb_usuarios.ap_materno,tb_usuarios.carrera,tb_usuarios.numero_control,tb_usuarios.telefono,extragrupo.observacion,extragrupo.acreditacion,extragrupo.idActividad FROM extragrupo INNER JOIN tb_usuarios ON extragrupo.matricula = tb_usuarios.numero_control WHERE extragrupo.idActividad = $id";
		$req = $bdd->prepare($sql);
		$req->execute();
		$alumnados = $req->fetchAll(PDO::FETCH_ASSOC);

		$i=1;//dando valor a variable

?>