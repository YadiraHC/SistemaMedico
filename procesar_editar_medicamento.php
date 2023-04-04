<?php

include_once('./includes/conexion.php');
try {
    if (isset($_POST['editar'])) {
        $elidmedicamento = $_POST['id'];
        $nMedicamento = $_POST['nombre'];
        $via = $_POST['via'];
        $precio = $_POST['precio'];
        $estatus = $_POST['estatus'];
        $sql3 = "update medicamentos set nombre_medicamento=:elmedicamento, 
        via_administracion=:elvia,precio=:elprecio ,estatus=:elestatus 
        where id_medicamento=:elidmedicamento;";
        $sql3 = $conexion->prepare($sql3);

        
        $sql3->bindParam(':elmedicamento', $nMedicamento);
        $sql3->bindParam(':elvia', $via);
        $sql3->bindParam(':elprecio', $precio);
        $sql3->bindParam(':elestatus', $estatus);
        $sql3->bindParam(':elidmedicamento', $elidmedicamento);

        $sql3->execute();
        header('location:medicamentos.php?respuesta=El médicamento fue modificado correctamente');
    }
} catch (Exception $e) {
    header('location:medicamentos.php?respuesta=Eror al editar el médicamento' . $e->getMessage());
}
