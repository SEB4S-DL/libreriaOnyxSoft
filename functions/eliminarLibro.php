<?php
require_once '../db/conection.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id_libro']) ? (int)$_POST['id_libro'] : 0;

    if ($id > 0) {
        $stmt = $conn->prepare("UPDATE libros SET estado = 0 WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo "✅ Libro eliminado exitosamente";
        } else {
            echo "❌ Error al ejecutar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "❌ ID inválido";
    }

    $conn->close();
} else {
    echo "❌ Método no permitido";
}
