<?php require_once '../db/conection.php'?>

<?php 
    $nombre = $_POST['nombre'];

$stmtNombre = $conn->prepare("INSERT INTO generos (nombre) VALUES (?)");
$stmtNombre->bind_param("s", $nombre);
$stmtNombre->execute();

$stmtNombre->close();
$conn->close();

exit;
?>