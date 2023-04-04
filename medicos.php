<?php session_start();
if (isset($_SESSION['elusuario'])) { // VALIDAMOS QUE EXISTA LA SESIÓN 

    include('./layout/cabecera.php');
?>
    <h1>Médicos</h1>
    <a href="agregar_medico.php" class="btn">Agregar Nuevo Médico</a>
    <?php
    if (isset($_GET['respuesta'])) {
        echo "<div class='card-panel red darken-1'>" . $_GET['respuesta'] . "</div>";
    }
    ?>
    <p>A continuación se muestra la lista de Médicos registrados en el sistema.</p>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre completo</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>
            <?php
            require_once('./includes/conexion.php');
            $sql = 'call todos_los_medicos()';
                    /* "SELECT id_medico,CONCAT(nombre_medico,' ',apellidos_medico) 
                    AS nombre_completo FROM medicos where estatus >0"; */
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_OBJ);
            $i = 1;
            if ($consulta->rowCount() > 0) {
                foreach ($resultado as $registro) {
                    echo "
          <tr>
            <td>" . $i++ . "</td>
            <td>" . $registro->nombre_completo . "</td> 
            <td>
                <a class='btn' href='editar_medico.php?id=" . $registro->id_medico . "'>Editar</a>
                <a class='btn' onclick='javascript:eliminar(" . $registro->id_medico . ")'>Eliminar</a>
            </td>
          </tr>  ";
                }
            }
            ?>
        </tbody>
    </table>
    <script>
        function eliminar(valor) {
            if (confirm("Desea eliminar al médico seleccionado")) {
                location.href = "eliminar_medico.php?id=" + valor;
            }
        }
    </script>
<?php
    include('./layout/pie.php');
} else {
    header('location:index.php');
}
?>