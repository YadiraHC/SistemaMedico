<?php

include_once('./includes/conexion.php');
try {
    if (isset($_POST['editarp'])) {
        $elidp = $_POST['id'];
        $nombrep = $_POST['nombre'];
        $apellidosp = $_POST['apellidos'];
        $edadp = $_POST['edad'];
        $fechap = $_POST['fecha_alta'];
        $estatusp = $_POST['estatus'];
        $sql2 = "update pacientes set nombre_paciente=:elnombrep, apellidos_paciente=:elapellidosp,edad=:laedadp,
            fecha_alta=:lafechap, estatus=:elestatusp where id_paciente=:elidp";
        $sql2 = $conexion->prepare($sql2);

        $sql2->bindParam(':elnombrep', $nombrep);
        $sql2->bindParam(':elapellidosp', $apellidosp);
        $sql2->bindParam(':laedadp', $edadp);
        $sql2->bindParam(':lafechap', $fechap);
        $sql2->bindParam(':elestatusp', $estatusp);
        $sql2->bindParam(':elidp', $elidp);

        $sql2->execute();
        header('location:pacientes.php?respuesta=El paciente fue modificado correctamente');
    }
} catch (Exception $e) {
    header('location:pacientes.php?respuesta=Eror al editar el paciente ' . $e->getMessage());
}
