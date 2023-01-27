<?php
include ('../app/config/config.php');

$idEstados = $_POST['idEstados'];

$queryM = "SELECT idMunicipios, Municipio FROM municipios 
    WHERE idEstados = '$idEstados'";
$resultadoM = mysqli_query($conexion, $queryM);



$html = "<option value=''>*SELECCIONE MUNICIPIO</option>";


while ($rowM =  mysqli_fetch_assoc($resultadoM)) 
{

    $html.= "<option value=".$rowM['idMunicipios'].">".$rowM['Municipio']."</option>";
}

echo $html;

?>
