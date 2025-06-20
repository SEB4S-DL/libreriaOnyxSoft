<?php include_once 'config.php'; 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/header.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/index.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/footer.css">
    <link rel="icon" href="<?php echo BASE_URL; ?>assets/img/book.png">
    <title>Inicio</title>
</head>
<body>
    <?php require_once './db/conection.php' ?>
    <?php
        $sql = $sql = "SELECT 
            libros.titulo,
            autores.nombre AS autor,
            generos.nombre AS genero,
            libros.anio_publicacion
        FROM libros
        JOIN autores ON libros.autor_id = autores.id
        JOIN generos ON libros.genero_id = generos.id";


        $result = $conn->query($sql);
    ?>
    <?php include ROOT_PATH . '/includes/header.php'?>
    <div class="container">
        <h1>Libros Disponibles</h1>
         <?php if ($result && $result->num_rows > 0): ?>
        <div class="book-list">
            <?php while ($libro = $result->fetch_assoc()): ?>
                <div class="book">
                    <h2><?= htmlspecialchars($libro['titulo']) ?></h2>
                    <p><strong>Autor:</strong> <?= htmlspecialchars($libro['autor']) ?></p>
                    <p><strong>Género:</strong> <?= htmlspecialchars($libro['genero']) ?></p>
                    <p><strong>Año de publicación:</strong> <?= htmlspecialchars($libro['anio_publicacion']) ?></p>
                    <button>Editar</button>
                    <button>Eliminar</button>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No hay libros disponibles todavía.</p>
    <?php endif; ?>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php'?>

</body>
</html>