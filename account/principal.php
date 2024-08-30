<?php
    session_start();

    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['user_id'])) {
        // Redirigir a la página de inicio de sesión si no está logueado
        header("Location: enter-account.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MikroTel Panel</title>
    <link rel="icon"  type="image/png" href="../assets/icono-oficial.svg">
    <link rel="stylesheet" href="../css/product_register.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-logo"><a href="principal.php"><img src="../assets/logo-principal.svg"></a></div>
        <ul class="navbar-menu">
            <li><a href="#create">Ver_Productos</a></li>
            <li><a href="#update">-------------</a></li>
            <li><a href="../registrar-productos/registra_producto.php">Ingresar_Producto</a></li>
            <li><a href="../registrar-productos/actualiza_producto.php">Actualizar_Producto</a></li>
            <li><a href="../registrar-productos/delete_producto.php">Eliminar_Producto</a></li>
            <li><a href="#update">-------------</a></li>
            
            <li><a href="logout.php">cerrar sesion</a></li>
        </ul>
        <div class="navbar-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <h1 class="actualiza_producto_titulo">Bienvenido</h1>


</body>
<script src="../js/registrar-productos.js"></script>
</html>
