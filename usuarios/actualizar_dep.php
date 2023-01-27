<?php

include ('../app/config/config.php');

if (isset($_POST['departamento']) ){
	
    $id=$_POST['id'];
	$Departamento = $_POST['departamento'];

    $sql= "UPDATE departamento SET departamento = '$Departamento' WHERE id = $id";


 
 

	echo $sql;
	
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

}
header('Location: añadirDepartamento.php');
 