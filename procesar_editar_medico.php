<?php

include_once('./includes/conexion.php');
try {
    if (isset($_POST['editar'])) {
        $elid = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $cedula = $_POST['cedula'];
        $estatus = $_POST['estatus'];
        $sql = "update medicos set nombre_medico=:elnombre, apellidos_medico=:elapellido,cedula_profesional=:lacedula,estatus=:elestatus where id_medico=:elid";
        $sql = $conexion->prepare($sql);

        $sql->bindParam(':elnombre', $nombre);
        $sql->bindParam(':elapellido', $apellidos);
        $sql->bindParam(':lacedula', $cedula);
        $sql->bindParam(':elestatus', $estatus);
        $sql->bindParam(':elid', $elid);

        $sql->execute();
        header('location:medicos.php?respuesta=El médico fue modificado correctamente');
    }
} catch (Exception $e) {
    header('location:medicos.php?respuesta=Eror al editar el médico'. $e->getMessage());
}
