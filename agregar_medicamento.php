<?php session_start();
if (isset($_SESSION['elusuario'])) { // VALIDAMOS QUE EXISTA LA SESIÓN 

    include('./layout/cabecera.php');
?>
    <h1>Agregar Médicos</h1>
    <form action="procesar_agregar_medicamento.php" method="post">
        <input type="hidden" name="id" value="">
        <label>Nombre</label>
        <input name="nombre" value="">
        <label>Via de transmicion</label>
        <input name="via" value="">
        <label>Precio</label>
        <input name="precio" value="">
        <label>Estatus</label>
        <p>
            <label>
                <input class="with-gap" name="estatus" value="1" type="radio" checked />
                <span>Activo</span>
            </label>
            <label>
                <input class="with-gap" name="estatus" value="2" type="radio" />
                <span>Inactivo</span>
            </label>
        </p>
        <button type="submit" name="guardarMedicamento" class="btn">Guardar Medicamento</button>
    </form>
<?php

    include('./layout/pie.php');
} else {
    header('location:index.php');
}
?>