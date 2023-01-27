<?php


$pase=(isset($_POST['actividad']))?$_POST['actividad']:"";

switch ($pase) {
	case 'Acceder':

		include('ciclo.php');//incluyendo el codigo del llamado del ciclo
		include('controlador_actividades/Entrar.php');

		break;

	case 'ATRAS':

		include('ciclo.php');//incluyendo el codigo del llamado del ciclo
		include('controlador_actividades/Atras.php');
		break;

	case 'Cancelar':

		include('ciclo.php');//incluyendo el codigo del llamado del ciclo
		include('Controlador_actividades/Cancelar.php');
		break;

	case 'Registrar':

		include('ciclo.php');//incluyendo el codigo del ciclo actual
		include('controlador_actividades/Registrar.php');

		break;

	case 'Nueva actividad':
		include ('controlador_actividades/Nueva_actividad.php');
		break;

	case 'Eliminar':

		include('ciclo.php');//incluyendo el codigo del llamado del ciclo
		include('controlador_actividades/Eliminar.php');
		$preso = 2;
		break;

	case 'Listas':
		include('ciclo.php');//incluyendo el codigo del llamado del ciclo
		include('controlador_actividades/Listas.php');
		break;

	case 'Editar':
		include('controlador_actividades/Editar.php');
		break;

	case 'Actualizar':
		include('ciclo.php');//incluyendo el codigo del llamado del ciclo
		include('controlador_actividades/Actualizar.php');//controlador para actualizar
		$preso = 3;
		break;	
	default:
		# code...
		break;
}

if(!isset($_POST["id"])) {//Preguntando si recibio el valor del idCategoria
	$id = $_POST["id"];//almacenando en una variable el valor del idCategoria

	include('ciclo.php');//incluyendo el codigo del llamado del ciclo

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

}
?>


