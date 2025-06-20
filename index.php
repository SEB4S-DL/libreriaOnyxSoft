<?php include_once 'config.php'; ?>
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
            libros.id,
            libros.titulo,
            autores.nombre AS autor,
            generos.nombre AS genero,
            libros.anio_publicacion
        FROM libros
        JOIN autores ON libros.autor_id = autores.id
        JOIN generos ON libros.genero_id = generos.id 
        WHERE libros.estado = 1";


        $result = $conn->query($sql);
    ?>
    <?php include ROOT_PATH . '/includes/header.php'?>
    <div class="container">
        <h1>Libros Disponibles</h1>
        <div id="respuesta3"></div>
        <br>
         <?php if ($result && $result->num_rows > 0): ?>
        <div class="book-list">
            <?php while ($libro = $result->fetch_assoc()): ?>
                <div class="book">
                    <h2><?= htmlspecialchars($libro['titulo']) ?></h2>
                    <p><strong>Autor:</strong> <?= htmlspecialchars($libro['autor']) ?></p>
                    <p><strong>Género:</strong> <?= htmlspecialchars($libro['genero']) ?></p>
                    <p><strong>Año de publicación:</strong> <?= htmlspecialchars($libro['anio_publicacion']) ?></p>
                    <form action="<?php echo BASE_URL ?>/pages/editarLibroForm.php" method="POST" style="display: inline;">
                    <input type="hidden" name="id_libro" value="<?= $libro['id'] ?>">
                    <button type="submit" class="btn">Editar</button>
                </form>

                <form id="eliminarLibro">
                    <input type="hidden" name="id_libro" value="<?= $libro['id'] ?>">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No hay libros disponibles </p>
    <?php endif; ?>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php'?>

</body>
<script src="<?php echo BASE_URL; ?>js/eliminarLibroFetch.js"></script>

</html>