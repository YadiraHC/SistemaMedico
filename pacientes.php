<?php session_start();
if (isset($_SESSION['elusuario'])) { // VALIDAMOS QUE EXISTA LA SESIÓN 

    include('./layout/cabecera.php');
?>
    <h1>Pacientes</h1>
    <a href="agregar_paciente.php" class="btn">Agregar Nuevo Paciente</a>
    <?php
    if (isset($_GET['respuesta'])) {
        echo "<div class='card-panel red darken-1'>" . $_GET['respuesta'] . "</div>";
    }
    ?>
    <p>A continuación se muestra la lista de Pacientes registrados en el sistema.</p>
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
            $sql2 = "SELECT id_paciente,CONCAT(nombre_paciente,' ',apellidos_paciente) AS nombre_completo FROM pacientes where estatus >0";
            $consulta2 = $conexion->prepare($sql2);
            $consulta2->execute();
            $resultado2 = $consulta2->fetchAll(PDO::FETCH_OBJ);
            $i = 1;
            if ($consulta2->rowCount() > 0) {
                foreach ($resultado2 as $registro2) {
                    echo "
          <tr>
            <td>" . $i++ . "</td>
            <td>" . $registro2->nombre_completo . "</td> 
            <td>
                <a class='btn' href='editar_paciente.php?id=" . $registro2->id_paciente . "'>Editar</a>
                <a class='btn' onclick='javascript:eliminar(" . $registro2->id_paciente . ")'>Eliminar</a>
            </td>
          </tr>  ";
                }
            }
            ?>
        </tbody>
    </table>
    <script>
        function eliminar(valor) {
            if (confirm("¿Desea eliminar al paciente seleccionado?")) {
                location.href = "eliminar_paciente.php?id=" + valor;
            }
        }
    </script>
<?php
    include('./layout/pie.php');
} else {
    header('location:index.php');
}
?>