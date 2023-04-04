<?php session_start();
if (isset($_SESSION['elusuario'])) { // VALIDAMOS QUE EXISTA LA SESIÓN 

    include('./layout/cabecera.php');
?>
    <h1>Médicamentos Recetado</h1>
    <a href="agregar_medicamento_recetado.php" class="btn">Agregar Nuevo Medicamento Recetado</a>
    <?php
    if (isset($_GET['respuesta'])) {
        echo "<div class='card-panel red darken-1'>" . $_GET['respuesta'] . "</div>";
    }
    ?>
    <p>A continuación se muestra la lista de Medicamentos Resetados registrados en el sistema.</p>
    <table>
        <thead>
            <tr>
                <th>Id receta</th>
                <th>Id medicamento</th>
                <th>Cantidad</th>
                <th>Indicaciones</th>
            </tr>
        </thead>

        <tbody>
            <?php
            require_once('./includes/conexion.php');
            $sql = "SELECT id_receta, id_medicamento, cantidad, indicaciones FROM medicamentos_recetados where id_receta >0;";
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
            <td>" . $registro->id_receta. "</td>
            <td>" . $registro->id_medicamento . "</td> 
            <td>" . $registro->cantidad . "</td>
            <td>" . $registro->indicaciones . "</td>
            <td>
                <a class='btn' href='editar_medico.php?id=" . $registro->id_receta . "'>Editar</a>
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
            if (confirm("Desea eliminar el medicamento recetado seleccionado")) {
                location.href = "eliminar_medicamento_recetado.php?id=" + valor;
            }
        }
    </script>
<?php
    include('./layout/pie.php');
} else {
    header('location:index.php');
}
?>