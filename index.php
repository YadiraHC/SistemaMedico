<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Médico</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Sistema Médico</h1>
        <p>Ingresa los siguientes datos</p>
        <?php
        if (isset($_GET['error'])) {
            echo "<div class='card-panel red darken-1'>" . $_GET['error'] . "</div>";
        }
        ?>
        <div class="row">
            <form class="col s12" action="validar_login.php" method="POST">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="email" name="email" class="validate">
                        <label for="email">Correo Electrónico</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" name="contrasenia" class="validate">
                        <label for="password">Contraseña</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn" name="ingresar" type="submit">Ingresar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>