<?php
require_once '../db/conection.php';

// Validar que llegan los datos
if (
    !isset($_POST['id_libro']) ||
    !isset($_POST['titulo']) ||
    !isset($_POST['genero']) ||
    !isset($_POST['anio'])
) {
    die("Faltan datos para actualizar el libro.");
}

$id = (int)$_POST['id_libro'];
$titulo = $_POST['titulo'];
$generoId = (int)$_POST['genero'];
$anio = (int)$_POST['anio'];

// Actualizar el libro 
$stmt = $conn->prepare("UPDATE libros SET titulo = ?, genero_id = ?, anio_publicacion = ? WHERE id = ?");
$stmt->bind_param("siii", $titulo, $generoId, $anio, $id);

if ($stmt->execute()) {
} else {
}

$stmt->close();
$conn->close();
?>

