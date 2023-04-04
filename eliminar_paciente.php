<?php
require_once('./includes/conexion.php');
try {
    if (isset($_GET['id'])) {
        $elIDp = $_GET['id'];
        $consulta2 = "update pacientes set estatus=0 where id_paciente=:elid";
        $sql2 = $conexion->prepare($consulta2);
        $sql2->bindParam(':elid', $elIDp);
        $sql2->execute();
        header('location:pacientes.php?respuesta=El paciente fue eliminado correctamente');
    }
} catch (Exception $e) {
    header('location:pacientes.php?respuesta=Eror al eliminar el paciente' . $e->getMessage());
}
