<?php include_once __DIR__ . '/../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/header.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/index.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/footer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/editarLibroForm.css">
    <link rel="icon" href="<?php echo BASE_URL; ?>assets/img/book.png">
    <title>Editar libro</title>
</head>
<body>
    <?php require_once '../db/conection.php';

        if (!isset($_POST['id_libro'])) {
            die("ID de libro no recibido.");
        }

        $id = (int)$_POST['id_libro'];

        // Consulta del libro
        $sql = "SELECT * FROM libros WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            die("Libro no encontrado.");
        }

        $libro = $result->fetch_assoc();

        // Consulta de géneros
        $sql2 = "SELECT id, nombre FROM generos";
        $resultGeneros = $conn->query($sql2);
        ?>

    <?php include ROOT_PATH . '/includes/header.php'?>
    <div class="container">
        <h1>Editar libro</h1>

        <form id="editarLibro">
        <input type="hidden" name="id_libro" value="<?= $libro['id'] ?>" required>
            <label for="">Titulo</label>
        <input type="text" name="titulo" value="<?= htmlspecialchars($libro['titulo']) ?>" required pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" title="Solo letras y espacios">
            <label for="">Año</label>
        <input type="number" name="anio" value="<?= $libro['anio_publicacion'] ?>" required>

        <!-- Puedes hacer selects si también quieres editar autor o género -->
            <label for="">Genero</label>
        <select name="genero" required>
            <?php while ($genero = $resultGeneros->fetch_assoc()): ?>
                <option value="<?= $genero['id'] ?>" <?= $genero['id'] == $libro['genero_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($genero['nombre']) ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit">Editar</button>
        <button type="button" onclick="window.location.href='<?php echo BASE_URL ?>index.php'">Cancelar</button>
    </form>
        <div id="respuesta2"></div>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php'?>
</body>
<script src="<?php echo BASE_URL; ?>js/editarLibroFetch.js"></script>

</html>