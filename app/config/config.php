<?php
//$conexion = mysqli_connect("bxgvbqru5r7prhsdpnvr-mysql.services.clever-cloud.com", "utur7aovmczn6qtf", "Pp83ju823IBh0nmPhQ9v", "bxgvbqru5r7prhsdpnvr");

$conexion = mysqli_connect("b4zvuzltbielkxf4zjs3-mysql.services.clever-cloud.com", "ur1re1yuwciacaux", "V9tdRrTHovr3L2CrwSNR", "b4zvuzltbielkxf4zjs3");
?>


<?php
/**
 * Created by PhpStorm.
 * User: DELL-SYSTEM
 * Date: 01/07/2020
 * Time: 16:41
 */

/*
define('SERVIDOR', 'bxgvbqru5r7prhsdpnvr-mysql.services.clever-cloud.com');
define('USUARIO', 'utur7aovmczn6qtf');
define('PASSWOD', 'Pp83ju823IBh0nmPhQ9v');
define('BD', 'bxgvbqru5r7prhsdpnvr');
*/
define('SERVIDOR', 'b4zvuzltbielkxf4zjs3-mysql.services.clever-cloud.com');
define('USUARIO', 'ur1re1yuwciacaux');
define('PASSWOD', 'V9tdRrTHovr3L2CrwSNR');
define('BD', 'b4zvuzltbielkxf4zjs3');

//$URL = 'http://localhost/tecnm';

$URL = 'mysql://ur1re1yuwciacaux:V9tdRrTHovr3L2CrwSNR@b4zvuzltbielkxf4zjs3-mysql.services.clever-cloud.com:3306/b4zvuzltbielkxf4zjs3';
//$URL = 'http://localhost/tecnm';

$servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR;

try {
  $pdo = new PDO($servidor, USUARIO, PASSWOD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  // echo "<script>alert('La conexión a la base de datos fue exitosa.')</script>";
} catch (PDOException $e) {
  echo "<script>alert('Error a la conexión con la base de datos')</script>";
}
?>

<?php
/*
$server = "bxgvbqru5r7prhsdpnvr-mysql.services.clever-cloud.com";
$user = "utur7aovmczn6qtf";
$pass = "Pp83ju823IBh0nmPhQ9v";
$bd = "bxgvbqru5r7prhsdpnvr";

$conect = new mysqli($server, $user, $pass, $bd);
?>
<?php
$database = "bxgvbqru5r7prhsdpnvr";
$user = 'utur7aovmczn6qtf';
$password = 'Pp83ju823IBh0nmPhQ9v';


try {

  $con = new PDO('mysql:host=bxgvbqru5r7prhsdpnvr-mysql.services.clever-cloud.com;dbname=' . $database, $user, $password);
} catch (PDOException $e) {
  echo "Error" . $e->getMessage();
}
*/
$server = "b4zvuzltbielkxf4zjs3-mysql.services.clever-cloud.com";
$user = "ur1re1yuwciacaux";
$pass = "";
$bd = "b4zvuzltbielkxf4zjs3";

$conect = new mysqli($server, $user, $pass, $bd);
?>
<?php
$database = "b4zvuzltbielkxf4zjs3";
$user = 'ur1re1yuwciacaux';
$password = 'V9tdRrTHovr3L2CrwSNR';


try {

  $con = new PDO('mysql:host=b4zvuzltbielkxf4zjs3-mysql.services.clever-cloud.com;dbname=b4zvuzltbielkxf4zjs3' . $database, $user, $password);
} catch (PDOException $e) {
  echo "Error" . $e->getMessage();
}
?>
<?php
/*
try {
  $bdd = new PDO('mysql:host=bxgvbqru5r7prhsdpnvr-mysql.services.clever-cloud.com;dbname=bxgvbqru5r7prhsdpnvr;charset=utf8', 'utur7aovmczn6qtf', 'Pp83ju823IBh0nmPhQ9v');
} catch (Exception $e) {
  die('Error : ' . $e->getMessage());
}
*/
try {
  $bdd = new PDO('mysql:host=b4zvuzltbielkxf4zjs3-mysql.services.clever-cloud.com;dbname=b4zvuzltbielkxf4zjs3', 'ur1re1yuwciacaux', 'V9tdRrTHovr3L2CrwSNR');
} catch (Exception $e) {
  die('Error : ' . $e->getMessage());
}
