<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Tareas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>
<body></body>
<nav class="navbar is-primary">
    <div class="navbar-brand">
        <a class="navbar-item" href="dashboard.php">Sistema de Tareas</a>
    </div>
    <div class="navbar-menu">
        <div class="navbar-end">
            <div class="navbar-item">
                <?php
                if (isset($_SESSION['user_id'])) {
                ?>
                <a href="logout.php" class="button is-light">Cerrar sesión</a>
                <?php }?>
            </div>
        </div>
    </div>
</nav>
<div class="container">
    <div class="section">
