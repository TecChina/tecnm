<?php

$lunes=(isset($_POST['lunes']))?$_POST['lunes']:0;//preguntando si recibimos valor, de lo contrario se almacena con valor vacio
$martes=(isset($_POST['martes']))?$_POST['martes']:0;//preguntando si recibimos valor, de lo contrario se almacena con valor vacio
$miercoles=(isset($_POST['miercoles']))?$_POST['miercoles']:0;//preguntando si recibimos valor, de lo contrario se almacena con valor vacio
$jueves=(isset($_POST['jueves']))?$_POST['jueves']:0;//preguntando si recibimos valor, de lo contrario se almacena con valor vacio
$viernes=(isset($_POST['viernes']))?$_POST['viernes']:0;//preguntando si recibimos valor, de lo contrario se almacena con valor vacio

if ($lunes == "1") {$lunes = 1;}
if ($martes == "1") {$martes = 1;}
if ($miercoles == "1") {$miercoles = 1;}
if ($jueves == "1") {$jueves = 1;}
if ($viernes == "1") {$viernes = 1;}

if (isset($_POST['nombreActividad']) && isset($_POST['horaActividad']) && isset($_POST['horaHacer']) && isset($_POST['lugarActividad']) && isset($_POST['id']) && isset($_POST['encargado']) ){//preguntando por todos los datos que se reciben
    
    $nombres=strtoupper($_POST['nombreActividad']);//almacenando en mayusculas el dato recibido en la variable; el STRTOUPPER es para combertir caracteres en minuscualas a mayusculas
    $ap_paterno=$_POST['horaActividad'];//almacenando el dato recibido en la variable
    $numero_control=$_POST['horaHacer'];//almacenando el dato recibido en la variable
    $encargado=$_POST['encargado'];//almacenando el dato recibido en la variable
    $estado=strtoupper($_POST['lugarActividad']);//almacenando en mayusculas el dato recibido en la variable; el STRTOUPPER es para combertir caracteres en minuscualas a mayusculas
    $id=$_POST['id'];//almacenando el dato recibido en la variable

    $dias = $lunes.$martes.$miercoles.$jueves.$viernes;

    $sql = "INSERT INTO extraescolar(nombreActividad, horaActividad, diaActividad, horaHacer, encargadoActividad, lugarActividad, idCategoria, idCiclo) values ('$nombres','$ap_paterno', '$dias', '$numero_control', $encargado , '$estado', '$id','$idCiclo')";
    
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

    $sql = ("SELECT id FROM extraescolar WHERE idCategoria = $id ORDER BY id DESC LIMIT 1" );
    $query = $bdd->prepare($sql);
    $query->execute();
    $extra = $query->fetch(PDO::FETCH_LAZY);

    $idExtra = $extra['id'];

    $sql = "INSERT INTO responsable(idUsuario, idActividad) VALUES ($encargado, $idExtra)";

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

$preso = 1;

}
?>