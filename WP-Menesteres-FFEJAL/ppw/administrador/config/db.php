
<?php

$host = "localhost";
#$bd = "menesteres_menu";
$bd = "php_login_database";
$usuario = "root";
$password = "";


try {
    
        $conexion = new PDO("mysql:host=$host;dbname=$bd",$usuario,$password);

} catch (Exception $ex) {
    
    echo $ex->getMessage();

}

?>