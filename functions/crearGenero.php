<?php
require_once '../db/conection.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Función para validar que solo haya letras y espacios
function soloLetras($texto) {
    return preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', $texto);
}

// Obtener y limpiar el nombre
$nombre = trim($_POST['nombre'] ?? '');

if (!$nombre) {
    echo json_encode(["status" => "error", "message" => "El campo nombre es obligatorio."]);
    exit;
}

if (!soloLetras($nombre)) {
    echo json_encode(["status" => "error", "message" => "El nombre del género solo puede contener letras y espacios."]);
    exit;
}

// Verificar si ya existe
$stmtVerificar = $conn->prepare("SELECT id FROM generos WHERE nombre = ?");
$stmtVerificar->bind_param("s", $nombre);
$stmtVerificar->execute();
$stmtVerificar->store_result();

if ($stmtVerificar->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Ya existe un género con ese nombre."]);
    $stmtVerificar->close();
    $conn->close();
    exit;
}
$stmtVerificar->close();

// Insertar nuevo género
$stmtInsertar = $conn->prepare("INSERT INTO generos (nombre) VALUES (?)");
$stmtInsertar->bind_param("s", $nombre);

if ($stmtInsertar->execute()) {
    echo json_encode(["status" => "success", "message" => "Género creado exitosamente."]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al insertar el género."]);
}

$stmtInsertar->close();
$conn->close();
exit;
