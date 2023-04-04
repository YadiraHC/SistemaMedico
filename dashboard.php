<?php session_start();
if (isset($_SESSION['elusuario'])) { // VALIDAMOS QUE EXISTA LA SESIÓN 
?>
    <?php
    include('./layout/cabecera.php');
    ?>
    <p>Seleccione una de las opciones para acceder al catálogo.</p>
    <a class="waves-effect waves-light btn-large" href="medicos.php">Médicos</a>
    <a class="waves-effect waves-light btn-large" href="pacientes.php">Pacientes</a>
    <a class="waves-effect waves-light btn-large" href="medicamentos.php">Medicamentos</a>
    <a class="waves-effect waves-light btn-large" href="recetas.php">Recetas</a>
    <a class="waves-effect waves-light btn-large" href="medicamentos_recetados.php">Medicamentos Recetados</a>
<?php
    include('./layout/pie.php');
} else {
    header('location:index.php');
}
?>