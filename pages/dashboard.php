
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("../includes/db.php");
include("../includes/header.php");

$user_id = $_SESSION['user_id'];

// Obtener las tareas del usuario
$stmt = $conn->prepare("SELECT * FROM tareas WHERE usuario_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<h1 class='title'>Mis Tareas</h1>";
echo "<a href='add_task.php' class='button is-primary'>Agregar Nueva Tarea</a>";

while ($row = $result->fetch_assoc()) {
    echo "<div class='box mt-2'>";
    echo "<h3 class='title is-4'>" . $row['titulo'] . "</h3>";
    echo "<p>" . $row['descripcion'] . "</p>";
    echo "<a href='edit_task.php?id=" . $row['id'] . "' class='button is-link'>Editar</a> ";
    echo "<a href='delete_task.php?id=" . $row['id'] . "' class='button is-danger'>Eliminar</a>";
    echo "</div>";
}

include("../includes/footer.php");
?>

