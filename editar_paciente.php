<?php session_start();
if (isset($_SESSION['elusuario'])) { // VALIDAMOS QUE EXISTA LA SESIÓN 

    include('./layout/cabecera.php');
?>
    <h1>Edición de Paciente</h1>
    <?php
    require_once('./includes/conexion.php');
    if (isset($_GET['id'])) {
        $elIDp = $_GET['id'];
        $consulta2 = "select * from pacientes where id_paciente=:elidp";
        $sql2 = $conexion->prepare($consulta2);
        $sql2->bindParam(':elidp', $elIDp);
        $sql2->execute();
        $resultado2 = $sql2->fetchAll(PDO::FETCH_OBJ);
        if ($sql2->rowCount() > 0) {
            $elnombrep = $resultado2[0]->nombre_paciente;
            $elapellidosp = $resultado2[0]->apellidos_paciente;
            $laedadp = $resultado2[0]->edad;
            $lafechap = $resultado2[0]->fecha_alta;
            $elestatusp = $resultado2[0]->estatus;
    ?>
            <form action="procesar_editar_paciente.php" method="post">
                <input type="hidden" name="id" value="<?php echo $elIDp; ?>">
                <label>Nombre</label>
                <input name="nombre" value="<?= $elnombrep; ?> ">
                <label>Apellidos</label>
                <input name="apellidos" value="<?= $elapellidosp; ?> ">
                <label>Edad</label>
                <input name="edad" value="<?= $laedadp; ?> ">
                <label>Fecha</label>
                <input name="fecha_alta" value="<?= $lafechap; ?> ">
                <label>Estatus</label>
                <p>
                    <label>
                        <input class="with-gap" name="estatus" value="1" type="radio" <?= ($elestatusp == 1) ? 'checked' : ''; ?> />
                        <span>Activo</span>
                    </label>
                    <label>
                        <input class="with-gap" name="estatus" value="2" type="radio" <?= ($elestatusp == 2) ? 'checked' : ''; ?> />
                        <span>Inactivo</span>
                    </label>
                </p>
                <button type="submit" name="editarp" class="btn">Guardar cambios</button>
            </form>
<?php
        } // fin del if de row count

    } // fin del isset

    include('./layout/pie.php');
} else {
    header('location:index.php');
}
?>