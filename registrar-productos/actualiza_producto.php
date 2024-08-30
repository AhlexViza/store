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
        <div class="navbar-logo"><a href="../account/principal.php">MikroTel Panel</a></div>
        <ul class="navbar-menu">
            <li><a href="#create">Ver_Productos</a></li>
            <li><a href="#update">-------------</a></li>
            <li><a href="../registrar-productos/registra_producto.php">Ingresar_Producto</a></li>
            <li><a href="../registrar-productos/actualiza_producto.php">Actualizar_Producto</a></li>
            <li><a href="../registrar-productos/delete_producto.php">Eliminar_Producto</a></li>
            <li><a href="#update">-------------</a></li>
            
            <li><a href="../account/logout.php">cerrar sesion</a></li>
        </ul>
        <div class="navbar-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
</nav>
<h1 class="actualiza_producto_titulo">Lista de Productos</h1>

            <form class="busqueda" action="actualiza_producto.php" method="GET">
                <div class="actualiza_producto_search">
                <input class="input-text" name="search" type="text" placeholder="Buscar por código...">
                <button type="submit" class="btn-search"><img src="../assets/buscar.svg"></button>
                </div>
            </form>
</body>
<script src="../js/registrar-productos.js"></script>
</html>
<?php
    $conexion = new mysqli("localhost", "root", "rootroot", "mikrotel_cusco");
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    
    $sql = $conexion->prepare("SELECT `codigo_producto`, `titulo_producto`, `marca_producto`, `precio_producto`, `categoria_producto`, `cantidad_producto`, `descripcion_producto`, `imagen_producto` 
                                FROM `mikrotel_producto` 
                                WHERE `codigo_producto` LIKE ?");
   
    $search_param = "%$search%";
    $sql->bind_param("s", $search_param);

    $sql->execute();
    $resultado = $sql->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
            ?>
            <form id="api_crud_form" action="actualizar_producto.php" method="post" enctype="multipart/form-data">
                <table class="form1">
                    <tr>
                        <td colspan="2"><label class="form1-name">Actualizar Producto</label></td>
                    </tr>
                    <tr>
                        <td class="form1-title"><label for="codigo">Codigo Producto</label></td>
                        <td>
                            <input class="form1-textbox1" type="text" name="codigo" value="<?php echo htmlspecialchars($row['codigo_producto']); ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td class="form1-title"><label for="titulo_producto">Titulo del Producto</label></td>
                        <td>
                            <input class="form1-textbox1" name="titulo_producto" value="<?php echo htmlspecialchars($row['titulo_producto']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="form1-title"><label for="marca">Marca</label></td>
                        <td>
                            <input class="form1-textbox1" name="marca" value="<?php echo htmlspecialchars($row['marca_producto']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="form1-title"><label for="precio">Precio</label></td>
                        <td>
                            <input class="form1-textbox1" type="text" name="precio" value="<?php echo htmlspecialchars($row['precio_producto']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="form1-title"><label for="categoria">Categoria</label></td>
                        <td>
                            <input class="form1-textbox1" name="categoria" value="<?php echo htmlspecialchars($row['categoria_producto']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="form1-title"><label for="stock">Cantidad</label></td>
                        <td>
                            <input class="form1-textbox1" type="text" name="stock" value="<?php echo htmlspecialchars($row['cantidad_producto']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="form1-title"><label for="descripcion">Descripción</label></td>
                        <td>
                            <textarea class="form1-caracter" name="descripcion"><?php echo htmlspecialchars($row['descripcion_producto']); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="form1-title"><label for="img_producto">Imagen-Producto</label></td>
                        <td>
                        <!-- Campo para seleccionar una nueva imagen -->
                        <input class="form1-img" type="file" name="img_producto">
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input class="btn-registrar" type="submit" value="ACTUALIZAR">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><h3 class="product-aviso">Volver a subir la imagen</h3></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <?php echo '<img class="product-image" src="data:image/jpg;base64,' . base64_encode($row['imagen_producto']) . '" alt="producto"/>'; ?>
                        </td>
                    </tr>
                </table>  
            </form>
            <br>
            <?php
        
    } else {
        ?>
        <div>
            <h2>Ups. Lo sentimos, No encontramos ningún resultado para tu búsqueda</h2>
        </div>
        <?php
    }
?>



