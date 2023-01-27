<html>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<?php

include ('../app/config/config.php');

if (isset($_POST['id']) ){
	
	$id = $_POST['id'];
	$nombres = $_POST['nombres'];
	$correo = $_POST['correo'];
	

 $sql= "UPDATE tb_jefes SET nombres = '$nombres', correo = '$correo' WHERE id = $id";


 

	
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
header('Location: lista-jefes.php');
 