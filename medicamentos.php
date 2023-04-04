<?php session_start();
if (isset($_SESSION['elusuario'])) { // VALIDAMOS QUE EXISTA LA SESIÓN 

    include('./layout/cabecera.php');
?>
    <h1>Medicamentos</h1>
    <a href="agregar_medicamento.php" class="btn">Agregar Nuevo Medicamento</a>
    <?php
    if (isset($_GET['respuesta'])) {
        echo "<div class='card-panel red darken-1'>" . $_GET['respuesta'] . "</div>";
    }
    ?>
    <p>A continuación se muestra la lista de medicamentos registrados en el sistema.</p>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre Medicamento</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>
            <?php
            require_once('./includes/conexion.php');
            $sql3 = 'call todos_los_medicamentos';
                    /* "SELECT id_medicamento,CONCAT(nombre_medicamento) 
                    AS nombre_medicamento FROM medicamentos where estatus >0"; */ 
            $consulta3 = $conexion->prepare($sql3);
            $consulta3->execute();
            $resultado3 = $consulta3->fetchAll(PDO::FETCH_OBJ);
            $i = 1;
            if ($consulta3->rowCount() > 0) {
                foreach ($resultado3 as $registro3) {
                    echo "
          <tr>
            <td>" . $i++ . "</td>
            <td>" . $registro3->nombre_medicamento . "</td> 
            <td>
                <a class='btn' href='editar_medicamento.php?id=" . $registro3->id_medicamento . "'>Editar</a>
                <a class='btn' onclick='javascript:eliminar(" . $registro3->id_medicamento . ")'>Eliminar</a>
            </td>
          </tr>  ";
                }
            }
            ?>
        </tbody>
    </table>
    <script>
        function eliminar(valor) {
            if (confirm("Desea eliminar el medicamento seleccionado")) {
                location.href = "eliminar_medicamento.php?id=" + valor;
            }
        }
    </script>
<?php
    include('./layout/pie.php');
} else {
    header('location:index.php');
}
?>