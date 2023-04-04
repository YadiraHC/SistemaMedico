<?php
include_once('./includes/conexion.php');
try {
    if (isset($_POST['guardarMedicamento'])) {
        $nMedicamento = $_POST['nombre'];
        $via = $_POST['via'];
        $precio = $_POST['precio'];
        $estatus = $_POST['estatus'];
        $sql3 = "INSERT INTO medicamentos(nombre_medicamento,via_administracion,precio,estatus) 
                VALUES(:elmedicamento,:elvia,:elprecio,:elestatus);";
        $sql3 = $conexion->prepare($sql3);

        $sql3->bindParam(':elmedicamento', $nMedicamento);
        $sql3->bindParam(':elvia', $via);
        $sql3->bindParam(':elprecio', $precio);
        $sql3->bindParam(':elestatus', $estatus);

        $sql3->execute();

        $ultimoID = $conexion->lastInsertId();
        if ($ultimoID > 0) {
            header('location:medicamentos.php?respuesta=El médico fue AGREGAD correctamente');
        } else {
            header('location:medicamentos.php?respuesta=Eror al agregar el médicamento');
        }
    }
} catch (Exception $e) {
    header('location:medicamentos.php?respuesta=Eror al agregar el médicamento');
}
