<?php
//configuracion de la conexion
$servername="sql2******";
$username="if*****";
$password="********";
$dbname="i**********";
//crear conexion
$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error)
{
    die("Conexion Fallida:".$conn->connect_error);

}
//echo "Conexion exitosa a la base de datos:";
//cerrar conexion
//$conn->close();
?>
