<?php

include ('../app/config/config.php');

if (isset($_POST['tutor']) ){
	
    $id=$_POST['id'];
	$tutor = $_POST['tutor'];

	$sql= "UPDATE `tb_usuarios` SET `grupo` = $id WHERE `tb_usuarios`.`id` = $tutor";


 
 

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
header('Location: añadirGrupo.php');
 