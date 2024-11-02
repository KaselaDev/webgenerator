<?php
    $user="adm_webgenerator";
    $psw="webgenerator2024";
    $dbname="webgenerator";
    $host="localhost";
    
    try {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $conexion = new PDO($dsn, $user, $psw);
        echo '<script>console.log("El servidor esta conectado a la base de datos correctamente");</script>';
    } catch (PDOException $e) {
        echo '<script>console.log("El servidor no se pudo conectar con la base de datos");</script>';
    }
?>