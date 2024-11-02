<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleGeneral.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>WebGenerator3000</title>
</head>
<body>
    <header>
        <h1>WebGenerator 3000</h1>
    </header>
    <div class="container">
        <h2 class="titulo">Registrarte es simple</h2>
    <div class="login">
            <?php
                require_once 'conexion.php';
                if (isset($_GET['btn'])) {
                    $email = $_GET['email'];
                    $pass = $_GET['pass'];
                    $repass = $_GET['repass'];

                    $consulta=$conexion->prepare("SELECT * FROM `usuarios` WHERE email='$email'");
                    $consulta->execute();
                    $datos=$consulta->fetchALL(PDO::FETCH_ASSOC);
                    if (!isset($datos[0])){
                        if ($pass == $repass) {
                            $date = date("j-m-y");
                            $consulta=$conexion->prepare("INSERT INTO `usuarios`(`idUsuario`, `email`, `password`, `fechaRegistro`) VALUES (NULL, '$email', '$pass', '$date')");
                            $consulta->execute();
                            echo "<script> Swal.fire({   title: 'buen trabajo 👍',   text: 'Tu registro fue exitante, dijo exitoso',   icon: 'success' }).then(() => window.location.href = 'login.php') </script>";
                        }else{
                            echo "Las contraseñas no coinciden";
                        }
                    }else{
                        echo "El email existe";
                    }
                }
            ?>
            <h2>Registrarse es simple</h12>
            <form action="register.php" method="get">
                <input type="email" name="email" placeholder="Ingresar tu email" required>
                <br>
                <input type="password" name="pass" placeholder="Ingresar una Clave" required>
                <input type="password" name="repass" placeholder="Ingresar nuevamente una Clave" required>
                
                <div class="buttons">
                    <div class="register">
                        <a href="login.php"><h4>Iniciar sesion</h4></a>
                    </div>
                    <input type="submit" name="btn" value="Enviar">
                </div>
            </form>
        </div>
    </div>
</body>
</html>