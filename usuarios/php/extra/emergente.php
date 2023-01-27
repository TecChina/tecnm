<?php

$data=(isset($_GET['valor']))?$_GET['valor']:"";

if ($data == 1){
    //alert('Se ha guardado correctamente el registro: ' + data);
    echo'<script type="text/javascript">
    alert("Alumno Agregado");
    </script>';
}

?>

<script>
    function confirmacion(){
        Swal.fire({
        title: 'ACTUALIZACIÓN',
        text: "SEGURO QUE QUIERES ACTUALIZAR",
        icon: 'PELIGRO',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        })
        if (respuesta==true){
            return true;
        }else{
        return false;
    }
    }
    function edit(){
        var respuesta = confirm("¿Deseas editar esta informacion?");
        if (respuesta==true){
            return true;
        }else{
        return false;
    }
    } 
</script>