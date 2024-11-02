<?php
    require 'conexion.php';
    session_start();
    if(!isset($_SESSION['webgenerator11989']['email'])){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./styleGeneral.css">
    <title>WebGenerator3000</title>
</head>
<body>
    <header>
        <h1>WebGenerator 3000</h1>
        <div class="logout"><a href="logout.php"><i class="fa-solid fa-right-from-bracket"> Cerrar sesion         de <?php echo $_SESSION['webgenerator11989']['idUsuario']?></i></a></div>
    </header>
    <div class="container">
        <h2 class="titulo">Bienvenido a tu panel</h2>
        <div class="generar">
            <h2>Generar Web de:</h2>
            <form class="formWeb" action="panel.php">
                <input class="web" type="text" name="web" placeholder="Ingresar el nombre de la web" required>
                <br>
                <input class="crearWeb" type="submit" name="enviar" value="Crear web">
            </form>
            <div class="generarphp">
                <?php
                    if (isset($_GET['enviar'])) {
                        $dominio=strval($_SESSION['webgenerator11989']['idUsuario']).$_GET['web'];
                        $date = date("j-m-y");
                        
                        $consulta=$conexion->prepare("SELECT * FROM `webs` WHERE dominio='$dominio'");
                        $consulta->execute();
                        $datos=$consulta->fetchALL(PDO::FETCH_ASSOC);
                        if (!isset($datos[0])){
                            $consulta=$conexion->prepare("INSERT INTO `webs`(`idWeb`, `idUsuario`, `dominio`, `fechaCreacion`, `deleted`) VALUES (NULL, '".$_SESSION['webgenerator11989']['idUsuario']."', '$dominio', '$date', 1)");
                            $consulta->execute();
                            shell_exec("./wix.sh $dominio");
                        }else{
                            echo "Ese dominio ya existe";
                        }
                    }
                ?>
            </div>
        </div>
        <div class="listaContainer">
            <h2>Lista</h2>
            <div class="lista">
                <?php
                    if (isset($_GET['idWeb'])) {
                        $consulta=$conexion->prepare("SELECT * FROM `webs` WHERE idWeb='".$_GET['idWeb']."'");
                        $consulta->execute();
                        $datos=$consulta->fetchALL(PDO::FETCH_ASSOC);
                        if (isset($datos[0])) {
                            $consulta=$conexion->prepare("UPDATE `webs` SET deleted=0 WHERE idWeb='".$_GET['idWeb']."'");
                            $consulta->execute();
                            echo "Se elimino correctamente";
                        }else{
                            echo "Ese dominio no existe";
                        }
                    }
                ?>
                <div class="headerTable">
                    <div class="user"><p>ID del Usuario</p></div>
                    <div class="dominio"><p>Nombre de dominio</p></div>
                    <div class="descargar"><p>Descargar</p></div>
                    <div class="eliminar"><p>Eliminar</p></div>
                </div>
                <?php
                    if ($_SESSION['webgenerator11989']['idUsuario'] == 1003) {
                        foreach ($datos as $db) {
                            echo "<div class='listTable'>
                                        <div class='user'><p>".$db['idUsuario']."</p></div>
                                        <div class='dominio'><a href='webs/".$db['dominio']."'>".$db['dominio']."</a></div>
                                        <div class='descargar'><a href=''><i class='fa-solid fa-download'></i></a></div>
                                        <div class='eliminar'><a href='panel.php?idWeb=".$db['idWeb']."'><i class='fa-solid fa-trash'></i></a></div>
                                    </div>";
                        }
                    }else{
                        $consulta=$conexion->prepare("SELECT * FROM `webs` WHERE idUsuario='".$_SESSION['webgenerator11989']['idUsuario']."' AND deleted='1'");
                        $consulta->execute();
                        $datos=$consulta->fetchALL(PDO::FETCH_ASSOC);

                        foreach ($datos as $db) {
                            echo "<div class='listTable'>
                                        <div class='user'><p>".$db['idUsuario']."</p></div>
                                        <div class='dominio'><a href='webs/".$db['dominio']."'>".$db['dominio']."</a></div>
                                        <div class='descargar'><a href=''><i class='fa-solid fa-download'></i></a></div>
                                        <div class='eliminar'><a href='panel.php?idWeb=".$db['idWeb']."'><i class='fa-solid fa-trash'></i></a></div>
                                    </div>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>