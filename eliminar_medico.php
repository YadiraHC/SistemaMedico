<?php
require_once('./includes/conexion.php');
try {
    if (isset($_GET['id'])) {
        $elID = $_GET['id'];
        $consulta = "update medicos set estatus=0 where id_medico=:elid";
        $sql = $conexion->prepare($consulta);
        $sql->bindParam(':elid', $elID);
        $sql->execute();
        header('location:medicos.php?respuesta=El médico fue eliminado correctamente');
    }
} catch (Exception $e) {
    header('location:medicos.php?respuesta=Eror al eliminar el médico');
}
