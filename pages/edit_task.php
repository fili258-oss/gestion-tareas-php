<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("../includes/db.php");
include("../includes/header.php");

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM tareas WHERE id = ?");
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $task_id = $_POST['task_id'];

    $stmt = $conn->prepare("UPDATE tareas SET titulo = ?, descripcion = ? WHERE id = ?");
    $stmt->bind_param("ssi", $titulo, $descripcion, $task_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Error al actualizar la tarea";
    }
}

?>

<h1 class="title">Editar Tarea</h1>
<form method="POST" action="edit_task.php">
    <div class="field">
        <label class="label">Título</label>
        <div class="control">
            <input class="input" type="text" name="titulo" value="<?php echo $task['titulo']; ?>" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Descripción</label>
        <div class="control">
            <textarea class="textarea" name="descripcion" required><?php echo $task['descripcion']; ?></textarea>
        </div>
    </div>
    <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
    <div class="control">
        <button type="submit" class="button is-primary">Actualizar</button>
    </div>
</form>

<?php include("../includes/footer.php"); ?>

