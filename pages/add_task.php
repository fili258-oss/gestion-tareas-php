
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("../includes/db.php");
include("../includes/header.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO tareas (usuario_id, titulo, descripcion) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $titulo, $descripcion);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Error al agregar tarea";
    }
}
?>

<h1 class="title">Agregar Nueva Tarea</h1>
<form method="POST" action="add_task.php">
    <div class="field">
        <label class="label">Título</label>
        <div class="control">
            <input class="input" type="text" name="titulo" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Descripción</label>
        <div class="control">
            <textarea class="textarea" name="descripcion" required></textarea>
        </div>
    </div>
    <div class="control">
        <button type="submit" class="button is-primary">Agregar</button>
    </div>
</form>

<?php include("../includes/footer.php"); ?>
