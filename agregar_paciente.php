<?php session_start();
if (isset($_SESSION['elusuario'])) { // VALIDAMOS QUE EXISTA LA SESIÓN 

    include('./layout/cabecera.php');
?>
    <h1>Agregar Pacientes</h1>
    <form action="procesar_agregar_paciente.php" method="post">
        <input type="hidden" name="id" value="">
        <label>Nombre</label>
        <input name="nombre" value="">
        <label>Apellidos</label>
        <input name="apellidos" value="">
        <label>Edad</label>
        <input name="edad" value="">
        <label>Fecha Alta</label>
        <input name="fecha_alta" value="">
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
        <button type="submit" name="guardarp" class="btn">Guardar Paciante</button>
    </form>
<?php

    include('./layout/pie.php');
} else {
    header('location:index.php');
}
?>