<?php

include ('../app/config/config.php');

if (isset($_POST['departamento'])){
	
    $departamento=$_POST['departamento'];
    
	$sql = "INSERT INTO departamento(departamento) VALUES ('$departamento')";
	
	
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
