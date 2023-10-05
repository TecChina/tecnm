<?php
$conexion = mysqli_connect("localhost", "root", "", "sistema");


?>

<?php
/**
 * Created by PhpStorm.
 * User: DELL-SYSTEM
 * Date: 01/07/2020
 * Time: 16:41
 */

define('SERVIDOR','localhost');
define('USUARIO','root');
define('PASSWOD','');
define('BD','sistema');

$URL = 'http://localhost/tecnm';

$servidor = "mysql:dbname=".BD.";host=".SERVIDOR;

try{
    $pdo = new PDO($servidor,USUARIO,PASSWOD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    // echo "<script>alert('La conexiÃ³n a la base de datos fue exitosa.')</script>";
}catch (PDOException $e){
    echo "<script>alert('Error a la conexiÃ³n con la base de datos')</script>";
}
?>

<?php
$server = "localhost";
$user = "root";
$pass = "";
$bd = "sistema";

$conect = new mysqli($server,$user,$pass,$bd);
?>
<?php
	$database="sistema";
	$user='root';
	$password='';


try {
	
	$con=new PDO('mysql:host=localhost;dbname='.$database,$user,$password);

} catch (PDOException $e) {
	echo "Error".$e->getMessage();
}

?>
<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=sistema;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}
