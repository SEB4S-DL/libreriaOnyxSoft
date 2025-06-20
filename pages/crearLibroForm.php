<?php include_once __DIR__ . '/../config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear nuevo libro</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/header.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/footer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/crearLibroForm.css">
    <link rel="icon" href="<?php echo BASE_URL; ?>assets/img/book.png">

</head>
<body>
    <?php include ROOT_PATH . '/includes/header.php'; ?>
    <?php require_once '../db/conection.php' ?>
    <?php $sql = "SELECT id, nombre FROM generos";
        $result = $conn->query($sql);?>

    <div class="container">
        <h1>Crear libro</h1>
        <form id="crearLibro">
            <input type="text" name="titulo" placeholder="Ingrese el nombre del libro">
            <input type="text" name="autor" placeholder="Ingrese el nombre del autor">
           <select name="genero" required>
                <option selected disabled>Seleccione el género</option>
                <?php while ($genero = $result->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($genero['id']) ?>">
                        <?= htmlspecialchars($genero['nombre']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <input type="text" name="anio" placeholder="Ingrese el año del libro">

            <button type="submit">Crear libro</button>
            <button type="button" onclick="window.location.href='<?= BASE_URL ?>index.php'">Cancelar</button>
            
            <div id="respuesta"></div>

        </form>
    </div>

    <?php include ROOT_PATH . '/includes/footer.php'; ?>
</body>
<script src="../js/crearLibroFetch.js"></script>
</html>
