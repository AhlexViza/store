
<?php
include 'db.php';
session_start();
// Verificar si el usuario está logueado y si es administrador
$isAdmin = isset($_SESSION['rol_id']) && $_SESSION['rol_id'] == 1;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <link rel="stylesheet" href="account.css">
</head>
<body>
    <div class="container">
        <h2>Registro de Usuarios</h2>
        <form action="register.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre Completo" required>
            <input type="email" name="email" placeholder="Correo Electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="password" name="confirm_password" placeholder="Confirmar Contraseña" required>

            <?php if ($isAdmin): ?>
                <!-- Solo los administradores pueden seleccionar el rol -->
                <select name="rol_id">
                    <option value="2">Usuario</option>
                    <option value="1">Administrador</option>
                </select>
            <?php else: ?>
                <!-- Si no es administrador, rol fijo a "usuario" -->
                <input type="hidden" name="rol_id" value="2">
            <?php endif; ?>

            <input type="submit" name="register" value="Registrar">
        </form>
    </div>
</body>
</html>
<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $rol_id = $_POST['rol_id'];

    // Validación adicional para evitar que un usuario normal se registre como administrador
    if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
        // Si no es un administrador, forzar rol_id a 2 (usuario)
        $rol_id = 2;
    }

    if ($password === $confirm_password) {
        // Hashear la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Preparar y ejecutar la consulta
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contrasena, rol_id) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$nombre, $email, $hashed_password, $rol_id])) {
            echo "Usuario registrado exitosamente.";
        } else {
            echo "Error al registrar el usuario.";
        }
    } else {
        echo "Las contraseñas no coinciden.";
    }
}
?>

