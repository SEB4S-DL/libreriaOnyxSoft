<?php
// connection.php

$host = 'localhost';      // servidor
$user = 'admin';     // usuario de la base de datos
$password = '123456';// contraseña
$database = 'librosOnyxSoft'; // nombre de la base de datos

// Crear conexión
$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// No olvides cerrar la conexión cuando termines
// $conn->close();
?>
