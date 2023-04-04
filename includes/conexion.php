<?php
require_once('parametros.php');
try{
// Ejecutamos PDO con las variables creadas
$conexion = new PDO("mysql:host=".SERVIDOR.";dbname=".BD, USUARIO, CONTRASENIA,
array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}catch (PDOException $ex){
    exit("Detalles del Error: " . $ex->getMessage());
}
