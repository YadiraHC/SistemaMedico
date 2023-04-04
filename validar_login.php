<?php
session_start();  // obligatorio cuando usemos sesiones y debe ir en la primera línea
include_once('./includes/conexion.php');
// isset evalua si una variable esta definida o no
if (isset($_POST['ingresar'])) {
   // recuperamos del formulario
   // trim quita espacios en blanco
   $email = trim($_POST['email']);
   $contrasenia = trim($_POST['contrasenia']);
   // escribimos la consulta
   $consulta = "select * from usuario where correo_electronico=:email and contrasenia=:contrasenia";
   echo $consulta;
   // pasamos la consulta a la conexión
   $sql = $conexion->prepare($consulta);
   // evitamos hackings
   $sql->bindParam(':email', $email);
   $sql->bindParam(':contrasenia', $contrasenia);
   // ejecutamos la consulta
   $sql->execute();
   if ($sql->rowCount() > 0) {
      $_SESSION['elusuario'] = $email;  // VARIABLE DE SESIÓN
      header('location:dashboard.php');
   } else {
      header('location:index.php?error=Usuario o contraseña errónea');
   }
}
