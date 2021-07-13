
<?php


//________________________aqui hacemos la coneccionde la base de datos______________
$host="sql203.byethost7.com";
$bd="b7_28345283_ventas";
$usuario="b7_28345283";
$contrasenia="pancho321";
try {
    $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia);
    
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>