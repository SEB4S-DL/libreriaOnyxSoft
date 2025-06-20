<?php
require_once '../db/conection.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$titulo = $_POST['titulo'];
$nombreAutor = $_POST['autor'];
$generoId = $_POST['genero'];
$anio = (int)$_POST['anio'];

//Insertar autor y obtener su ID
$stmtAutor = $conn->prepare("INSERT INTO autores (nombre) VALUES (?)");
$stmtAutor->bind_param("s", $nombreAutor);
$stmtAutor->execute();

$autorId = $stmtAutor->insert_id; 

// Insertar libro con el autor_id 
$stmtLibro = $conn->prepare("INSERT INTO libros (titulo, autor_id, genero_id, anio_publicacion) VALUES (?, ?, ?, ?)");
$stmtLibro->bind_param("siii", $titulo, $autorId, $generoId, $anio);
$stmtLibro->execute();

$stmtAutor->close();
$stmtLibro->close();
$conn->close();

header("Location: index.php");
exit;
?>
