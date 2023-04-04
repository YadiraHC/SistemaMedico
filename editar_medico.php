<?php session_start();
if (isset($_SESSION['elusuario'])) { // VALIDAMOS QUE EXISTA LA SESIÓN 

    include('./layout/cabecera.php');
?>
    <h1>Edición de Médicos</h1>
    <?php
    require_once('./includes/conexion.php');
    if (isset($_GET['id'])) {
        $elID = $_GET['id'];
        $consulta = "select * from medicos where id_medico=:elid";
        $sql = $conexion->prepare($consulta);
        $sql->bindParam(':elid', $elID);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        if ($sql->rowCount() > 0) {
            $elnombre = $resultado[0]->nombre_medico;
            $elapellido = $resultado[0]->apellidos_medico;
            $lacedula = $resultado[0]->cedula_profesional;
            $elestatus = $resultado[0]->estatus;
    ?>
            <form action="procesar_editar_medico.php" method="post">
                <input type="hidden" name="id" value="<?php echo $elID; ?>">
                <label>Nombre</label>
                <input name="nombre" value="<?= $elnombre; ?> ">
                <label>Apellidos</label>
                <input name="apellidos" value="<?= $elapellido; ?> ">
                <label>Cédula Profesional</label>
                <input name="cedula" value="<?= $lacedula; ?> ">
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