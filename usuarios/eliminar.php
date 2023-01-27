<?php 

include ('../app/config/config.php');
	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];
		$delete=$con->prepare('DELETE FROM tb_tutorias WHERE id=:id');
		$delete->execute(array(
			':id'=>$id
		));
        echo "<script languaje='JavaScript'>
        alert('Los datos se eliminaron correctamente');
        location.assign('lista_tutoria.php')
        </script>";
	}else{
        echo "<script languaje='JavaScript'>
        alert('Los datos no se eliminaron correctamente');
        location.assign('lista_tutoria.php')
        </script>";
    
    }

?>