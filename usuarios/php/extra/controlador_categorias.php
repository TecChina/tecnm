<?php


$pase=(isset($_POST['categoria']))?$_POST['categoria']:"";

switch ($pase) {
	case 'Registrar':

		include('ciclo.php');

		if (isset($_POST['nombreCampo']) && isset($_FILES['imagenCampo'])){

			$nombres=strtoupper($_POST['nombreCampo']);
			$imagen = addslashes(file_get_contents($_FILES['imagenCampo']['tmp_name']));
		
			$sql = "INSERT INTO imagen(imagen) VALUES ('$imagen')";
		
			$query = $bdd->prepare( $sql );
			if ($query == false) {
				print_r($bdd->errorInfo());
				die ('Erreur prepare');
			}
			$sth = $query->execute();
			if ($sth == false) {
				print_r($query->errorInfo());
				die ('Erreur execute');
			}
		
			$sql = ("SELECT id FROM imagen ORDER BY id DESC LIMIT 1;");
			$query = $bdd->prepare( $sql );
			$query->execute();
			$resultado = $query->fetch(PDO::FETCH_OBJ);
		
			$imagenes = $resultado === false ? 1 : $resultado->id;
		
			$sql = "INSERT INTO categorias(nombreCategoria,idImagen,idCiclo) VALUES ('$nombres','$imagenes','$idCiclo')";
		
			$query = $bdd->prepare( $sql );
			if ($query == false) {
				print_r($bdd->errorInfo());
				die ('Erreur prepare');
			}
			$sth = $query->execute();
			if ($sth == false) {
				print_r($query->errorInfo());
				die ('Erreur execute');
			}

			$preso = 1;
		}
		break;

	case 'Editar':

		$id=$_POST['id'];
		
		$sentencia = $con->prepare("SELECT categorias.id,nombreCategoria,imagen FROM categorias INNER JOIN imagen ON categorias.idImagen = imagen.id where categorias.id = $id");
		$sentencia->execute();
		$categoria = $sentencia->fetch(PDO::FETCH_LAZY);

		$nombre = $categoria['nombreCategoria'];
		$imagen = $categoria['imagen'];
		$idCategoria = $categoria['id'];
		break;

	case 'Actualizar':

		$id=$_POST['id'];
		$nombres=strtoupper($_POST['nombreCampo']);
		$imagen = addslashes(file_get_contents($_FILES['imagenCampo']['tmp_name']));

		$sql = ("SELECT idImagen FROM categorias WHERE categorias.id = $id");
		$query = $bdd->prepare( $sql );
		$query->execute();
		$resultado = $query->fetch(PDO::FETCH_OBJ);

		$idimagen = $resultado->idImagen;

		$sql = "UPDATE `imagen` SET `imagen` = '$imagen' WHERE imagen.id = '$idimagen'";
		$query = $bdd->prepare( $sql );
		if ($query == false) {
			print_r($bdd->errorInfo());
			die ('Erreur prepare');
		}
		$sth = $query->execute();
		if ($sth == false) {
			print_r($query->errorInfo());
			die ('Erreur execute');
		}

		$sql = "UPDATE `categorias` SET `nombreCategoria` = '$nombres' WHERE `categorias`.`id` = $id";
		$resultado=mysqli_query($conexion,$sql);

		$preso = 2;
		break;

	case 'Eliminar':

		$id=$_POST['id'];

		$sql = "DELETE FROM categorias WHERE id='$id'";
		$query = $bdd->prepare( $sql );
    	$query->execute();

		$preso = 3;
		break;
	
	default:
		# code...
		break;
}


	include('ciclo.php');

    $sql = ("SELECT id, descripcion FROM ciclo ORDER BY id DESC LIMIT 1;");
    $query = $bdd->prepare( $sql );
    $query->execute();
    $ciclos = $query->fetch(PDO::FETCH_OBJ);

    $sql = "SELECT categorias.id, categorias.nombreCategoria, imagen.imagen FROM categorias LEFT JOIN imagen ON categorias.idImagen = imagen.id WHERE idCiclo = $idCiclo;";
    $query = $bdd->prepare($sql);
    $query->execute();
    $campos = $query->fetchAll(PDO::FETCH_ASSOC);

	/*SELECCIONANDO  EL PRIMER ID DE LA CATEGORIAS DEL CICLO ACTUAL*/

	$sql = "SELECT categorias.id FROM categorias WHERE idCiclo = $idCiclo ORDER BY id ASC LIMIT 1;";
    $query = $bdd->prepare($sql);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_LAZY);

	if (!empty($resultado)) {
		$idCampo = $resultado['id'];
	}


?>

