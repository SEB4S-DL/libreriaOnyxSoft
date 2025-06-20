<?php include_once __DIR__ . '/../config.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/header.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/footer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/crearGeneroForm.css">
    <link rel="icon" href="<?php echo BASE_URL; ?>assets/img/book.png">
    <title>Crear Genero</title>
</head>
<body>
    <?php include ROOT_PATH . '/includes/header.php'?>
    <div class="container">
        <h1>Crear Género</h1>

        <form id="crearGenero">
            <input type="text" name="nombre" placeholder="Ingrese el nombre del género" required>

            <button type="submit">Crear género</button>
            <button type="button" onclick="window.location.href='<?= BASE_URL ?>index.php'">Cancelar</button>
            
            <div id="respuesta4"></div>
        </form>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php'?>
</body>
<script src="<?php echo BASE_URL; ?>js/crearGeneroFetch.js"></script>
</html>