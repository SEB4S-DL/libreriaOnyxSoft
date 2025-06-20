<?php
require_once '../db/conection.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Validar existencia de datos
if (
    !isset($_POST['id_libro'], $_POST['titulo'], $_POST['genero'], $_POST['anio'])
) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Faltan datos obligatorios.']);
    exit;
}

// Limpiar y validar entrada
$id = filter_var($_POST['id_libro'], FILTER_VALIDATE_INT);
$titulo = trim($_POST['titulo']);
$generoId = filter_var($_POST['genero'], FILTER_VALIDATE_INT);
$anio = filter_var($_POST['anio'], FILTER_VALIDATE_INT);

// Validar valores
if (!$id || !$generoId || !$anio || empty($titulo) || preg_match('/\d/', $titulo)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Datos inválidos. Asegúrese de no usar números en el título.']);
    exit;
}

// Preparar y ejecutar actualización
$stmt = $conn->prepare("UPDATE libros SET titulo = ?, genero_id = ?, anio_publicacion = ? WHERE id = ?");
$stmt->bind_param("siii", $titulo, $generoId, $anio, $id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Libro actualizado correctamente.']);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el libro.']);
}

$stmt->close();
$conn->close();
exit;
?>
