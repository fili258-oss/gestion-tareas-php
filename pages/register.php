
<?php
include("../includes/db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $codigo = $_POST['codigo'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, apellidos, codigo, email, telefono, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nombre, $apellidos, $codigo, $email, $telefono, $username, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Error en el registro";
    }
}
?>

<?php include("../includes/header.php"); ?>

<h1 class="title">Registro de Usuario</h1>
<form method="POST" action="register.php">
    <div class="field">
        <label class="label">Nombre</label>
        <div class="control">
            <input class="input" type="text" name="nombre" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Apellidos</label>
        <div class="control">
            <input class="input" type="text" name="apellidos" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Código</label>
        <div class="control">
            <input class="input" type="text" name="codigo" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Correo Electrónico</label>
        <div class="control">
            <input class="input" type="email" name="email" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Teléfono</label>
        <div class="control">
            <input class="input" type="text" name="telefono" required>
        </div>
    </div>
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
        <button type="submit" class="button is-primary">Registrar</button>
    </div>
</form>

<?php include("../includes/footer.php"); ?>

