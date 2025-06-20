<?php
require_once '../db/conection.php';


// Función para validar texto sin números ni caracteres raros
function soloLetras($texto) {
    return preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', $texto);
}

// Recoger datos
$titulo = trim($_POST['titulo'] ?? '');
$nombreAutor = trim($_POST['autor'] ?? '');
$generoId = $_POST['genero'] ?? '';
$anio = $_POST['anio'] ?? '';

// Validaciones básicas
if (!$titulo || !$nombreAutor || !$generoId || !$anio) {
    echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios."]);
    exit;
}

// Validar que título y autor solo tengan letras y espacios
if (!soloLetras($titulo)) {
    echo json_encode(["status" => "error", "message" => "El título solo puede contener letras y espacios."]);
    exit;
}

if (!soloLetras($nombreAutor)) {
    echo json_encode(["status" => "error", "message" => "El nombre del autor solo puede contener letras y espacios."]);
    exit;
}



$anio = (int)$anio;

// Insertar autor y obtener ID
$stmtAutor = $conn->prepare("INSERT INTO autores (nombre) VALUES (?)");
$stmtAutor->bind_param("s", $nombreAutor);
if (!$stmtAutor->execute()) {
    echo json_encode(["status" => "error", "message" => "Error al insertar el autor."]);
    exit;
}
$autorId = $stmtAutor->insert_id;
$stmtAutor->close();

// Insertar libro
$stmtLibro = $conn->prepare("INSERT INTO libros (titulo, autor_id, genero_id, anio_publicacion) VALUES (?, ?, ?, ?)");
$stmtLibro->bind_param("siii", $titulo, $autorId, $generoId, $anio);
if (!$stmtLibro->execute()) {
    echo json_encode(["status" => "error", "message" => "Error al insertar el libro."]);
    exit;
}
$stmtLibro->close();
$conn->close();

// Todo ok
echo json_encode(["status" => "success", "message" => "Libro creado exitosamente."]);
exit;
