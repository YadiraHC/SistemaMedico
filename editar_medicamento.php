<?php session_start();
if (isset($_SESSION['elusuario'])) { // VALIDAMOS QUE EXISTA LA SESIÓN 

    include('./layout/cabecera.php');
?>
    <h1>Edición de Médicamento</h1>
    <?php
    require_once('./includes/conexion.php');
    if (isset($_GET['id'])) {
        $elIDmedicamento = $_GET['id'];
        $consulta3 = "select * from medicamentos where id_medicamento=:elidmedicamento";
        $sql3 = $conexion->prepare($consulta3);
        $sql3->bindParam(':elidmedicamento', $elIDmedicamento);
        $sql3->execute();
        $resultado3 = $sql3->fetchAll(PDO::FETCH_OBJ);
        if ($sql3->rowCount() > 0) {
            $nMedicamento = $resultado3[0]->nombre_medicamento;
            $via = $resultado3[0]->via_administracion;
            $precio = $resultado3[0]->precio;
            $elestatus = $resultado3[0]->estatus;
    ?>
            <form action="procesar_editar_medicamento.php" method="post">
                <input type="hidden" name="id" value="<?php echo $elIDmedicamento; ?>">
                <label>Nombre</label>
                <input name="nombre" value="<?= $nMedicamento; ?> ">
                <label>Via Administracion</label>
                <input name="via" value="<?= $via; ?> ">
                <label>Precio</label>
                <input name="precio" value="<?= $precio; ?> ">
                <label>Estatus</label>
                <p>
                    <label>
                        <input class="with-gap" name="estatus" value="1" type="radio" <?= ($elestatus == 1) ? 'checked' : ''; ?> />
                        <span>Activo</span>
                    </label>
                    <label>
                        <input class="with-gap" name="estatus" value="2" type="radio" <?= ($elestatus == 2) ? 'checked' : ''; ?> />
                        <span>Inactivo</span>
                    </label>
                </p>
                <button type="submit" name="editar" class="btn">Guardar cambios</button>
            </form>
<?php
        } // fin del if de row count

    } // fin del isset

    include('./layout/pie.php');
} else {
    header('location:index.php');
}
?>