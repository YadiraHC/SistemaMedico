<?php
include_once('./includes/conexion.php');
try {
    if (isset($_POST['guardarp'])) {
        $nombrep = $_POST['nombre'];
        $apellidosp = $_POST['apellidos'];
        $edadp = $_POST['edad'];
        $fecha_altap = $_POST['fecha_alta'];
        $estatusp = $_POST['estatus'];
        $sql2 = "INSERT INTO pacientes(nombre_paciente,apellidos_paciente,edad,fecha_alta, estatus) VALUES(:elnombrep,:elapellidosp,:laedadp,:lafechap,:elestatusp);";
        $sql2 = $conexion->prepare($sql2);

        $sql2->bindParam(':elnombrep', $nombrep);
        $sql2->bindParam(':elapellidosp', $apellidosp);
        $sql2->bindParam(':laedadp', $edadp);
        $sql2->bindParam(':lafechap', $fecha_altap);
        $sql2->bindParam(':elestatusp', $estatusp);

        $sql2->execute();

        $ultimoID = $conexion->lastInsertId();
        if ($ultimoID > 0) {
            header('location:pacientes.php?respuesta=El paciente fue AGREGAD correctamente');
        } else {
            header('location:pacientes.php?respuesta=Eror al agregar el paciente');
        }
    }
} catch (Exception $e) {
    header('location:pacientes.php?respuesta=Eror al agregar el paciente');
}
