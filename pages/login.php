
<?php
include("../includes/db.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $hashed_password);

    if ($stmt->num_rows > 0 && $stmt->fetch()) {
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            header("Location: dashboard.php");
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
}
?>
<?php include("../includes/header.php"); ?>

<h1 class="title">Inicio de Sesión</h1>
<form method="POST" action="login.php">
    <div class="field">
        <label class="label">Nombre de Usuario</label>
        <div class="control">
            <input class="input" type="text" name="username" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Contraseña</label>
        <div class="control">
            <input class="input" type="password" name="password" required>
        </div>
    </div>
    <div class="control">
        <button type="submit" class="button is-primary">Iniciar Sesión</button>
    </div>
</form>
<p>¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>

<?php include("../includes/footer.php"); ?>
