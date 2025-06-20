<?php
require_once '../db/conection.php';

function soloLetras($texto) {
    return preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', $texto);
}

$titulo = trim($_POST['titulo'] ?? '');
$nombreAutor = trim($_POST['autor'] ?? '');
$generoId = $_POST['genero'] ?? '';
$anio = $_POST['anio'] ?? '';

// Validaciones
if (!$titulo || !$nombreAutor || !$generoId || !$anio) {
    echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios."]);
    exit;
}

if (!soloLetras($titulo)) {
    echo json_encode(["status" => "error", "message" => "El título solo puede contener letras y espacios."]);
    exit;
}

if (!soloLetras($nombreAutor)) {
    echo json_encode(["status" => "error", "message" => "El nombre del autor solo puede contener letras y espacios."]);
    exit;
}

$anio = (int)$anio;

// Buscar si el autor ya existe
$stmtCheckAutor = $conn->prepare("SELECT id FROM autores WHERE nombre = ?");
$stmtCheckAutor->bind_param("s", $nombreAutor);
$stmtCheckAutor->execute();
$stmtCheckAutor->store_result();

if ($stmtCheckAutor->num_rows > 0) {
    $stmtCheckAutor->bind_result($autorId);
    $stmtCheckAutor->fetch();
    $stmtCheckAutor->close();
} else {
    // Insertar autor nuevo
    $stmtInsertAutor = $conn->prepare("INSERT INTO autores (nombre) VALUES (?)");
    $stmtInsertAutor->bind_param("s", $nombreAutor);
    if (!$stmtInsertAutor->execute()) {
        echo json_encode(["status" => "error", "message" => "Error al insertar el autor."]);
        exit;
    }
    $autorId = $stmtInsertAutor->insert_id;
    $stmtInsertAutor->close();
}

// Verificar si el libro ya existe con ese título y autor
$stmtCheckLibro = $conn->prepare("SELECT id FROM libros WHERE titulo = ? AND autor_id = ?");
$stmtCheckLibro->bind_param("si", $titulo, $autorId);
$stmtCheckLibro->execute();
$stmtCheckLibro->store_result();

if ($stmtCheckLibro->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Este libro ya existe en la base de datos."]);
    exit;
}
$stmtCheckLibro->close();

// Insertar libro
$stmtLibro = $conn->prepare("INSERT INTO libros (titulo, autor_id, genero_id, anio_publicacion) VALUES (?, ?, ?, ?)");
$stmtLibro->bind_param("siii", $titulo, $autorId, $generoId, $anio);
if (!$stmtLibro->execute()) {
    echo json_encode(["status" => "error", "message" => "Error al insertar el libro."]);
    exit;
}
$stmtLibro->close();
$conn->close();

echo json_encode(["status" => "success", "message" => "📚 Libro creado exitosamente."]);
exit;
