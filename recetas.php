<?php session_start();
if (isset($_SESSION['elusuario'])) { // VALIDAMOS QUE EXISTA LA SESIÓN 

    include('./layout/cabecera.php');
?>
    <h1>Médicos</h1>
    <a href="agregar_receta.php" class="btn">Agregar Nueva Receta</a>
    <?php
    if (isset($_GET['respuesta'])) {
        echo "<div class='card-panel red darken-1'>" . $_GET['respuesta'] . "</div>";
    }
    ?>
    <p>A continuación se muestra la lista de Recetas registradas en el sistema.</p>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha Receta</th>
                <th>Proxima cita</th>
                <th>Id Medico</th>
                <th>Id paciente</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>
            <?php
            require_once('./includes/conexion.php');
            $sql = "SELECT id_receta, fecha_receta, proxima_cita, id_medico, id_paciente
                    FROM recetas where estatus >0";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_OBJ);
            $i = 1;
            if ($consulta->rowCount() > 0) {
                foreach ($resultado as $registro) {
                    echo "
          <tr>
            <td>" . $i++ . "</td>
            <td>" . $registro->fecha_receta . "</td> 
            <td>" . $registro->proxima_cita . "</td> 
            <td>" . $registro->id_medico . "</td> 
            <td>" . $registro->id_paciente . "</td> 
            </tr>
                <a class='btn' href='editar_receta.php?id=" . $registro->id_receta. "'>Editar</a>
                <a class='btn' onclick='javascript:eliminar(" . $registro->id_receta . ")'>Eliminar</a>
            </td>
          </tr>  ";
                }
            }
            ?>
        </tbody>
    </table>
    <script>
        function eliminar(valor) {
            if (confirm("Desea eliminar la receta seleccionada")) {
                location.href = "eliminar_receta.php?id=" + valor;
            }
        }
    </script>
<?php
    include('./layout/pie.php');
} else {
    header('location:index.php');
}
?>