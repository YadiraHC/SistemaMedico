<?php
include_once('./includes/conexion.php');
try {
    if (isset($_POST['guardarm'])) {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $cedula = $_POST['cedula'];
        $estatus = $_POST['estatus'];
        $sql = "INSERT INTO medicos(nombre_medico,apellidos_medico,cedula_profesional,estatus) 
                VALUES(:elnombre,:elapellido,:lacedula,:elestatus);";
        $sql = $conexion->prepare($sql);

        $sql->bindParam(':elnombre', $nombre);
        $sql->bindParam(':elapellido', $apellidos);
        $sql->bindParam(':lacedula', $cedula);
        $sql->bindParam(':elestatus', $estatus);

        $sql->execute();

        $ultimoID = $conexion->lastInsertId();
        if ($ultimoID > 0) {
            header('location:medicos.php?respuesta=El médico fue AGREGAD correctamente');
        } else {
            header('location:medicos.php?respuesta=Error al agregar el médico 3V');
        }
    }
} catch (Exception $e) {
    header('location:medicos.php?respuesta=Eror al agregar el médico');
}
