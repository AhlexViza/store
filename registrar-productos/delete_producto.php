<?php
    session_start();

    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['user_id'])) {
        // Redirigir a la página de inicio de sesión si no está logueado
        header("Location: enter-account.php");
        exit();
    }
?>
<?php
$servername = "localhost";
$username = "root"; // Cambia según sea necesario
$password = "rootroot"; // Cambia según sea necesario
$dbname = "mikrotel_cusco";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Manejo de búsqueda por código
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT codigo_producto, titulo_producto, marca_producto, precio_producto, categoria_producto, cantidad_producto, descripcion_producto, imagen_producto 
            FROM mikrotel_producto 
            WHERE codigo_producto LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$search%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT codigo_producto, titulo_producto, marca_producto, precio_producto, categoria_producto, cantidad_producto, descripcion_producto, imagen_producto FROM mikrotel_producto";
    $result = $conn->query($sql);
}

// Si la solicitud es AJAX, devolvemos solo la tabla
if (isset($_GET['ajax'])) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["codigo_producto"] . "</td>";
        echo "<td>" . $row["titulo_producto"] . "</td>";
        echo "<td>" . $row["marca_producto"] . "</td>";
        echo "<td>" . $row["precio_producto"] . "</td>";
        echo "<td>" . $row["categoria_producto"] . "</td>";
        echo "<td>" . $row["cantidad_producto"] . "</td>";
        echo "<td>" . $row["descripcion_producto"] . "</td>";
        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['imagen_producto']) . "' alt='Imagen' width='100'></td>";
        echo "<td><a href='dele.php?codigo=" . $row["codigo_producto"] . "' class='delete-button'>Eliminar</a></td>";
        echo "</tr>";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MikroTel Panel</title>
    <link rel="icon"  type="image/png" href="../assets/icono-oficial.svg">
    <link rel="stylesheet" href="../css/product_register.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
        .delet {
        font-family: Arial, sans-serif; background-color: #f4f4f4;margin: 0;padding: 20px;
        }h1{text-align:center;}h2 {text-align: center;color: #333;font-size: 15px;}
        form {
            margin-bottom: 20px;text-align: center;
        }
        input[type="text"] {padding: 10px;width: 250px;border: 1px solid #ddd;border-radius: 5px;
        }
        button {padding: 10px 15px;background-color: #333;color: #fff;border: none;border-radius: 5px;cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
        table {width: 100%;border-collapse: collapse;margin: 10px 0;background-color: #fff;
        }
        th, td {
            height: 35px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .delete-button {
            color: white;
            background-color: red;
            text-decoration: none;
            padding: 5px;
            border-radius: 5px;
        }
        .delete-button:hover {
            text-decoration: none;
        }
</style>
<body>
<nav class="navbar">
        <div class="navbar-logo"><a href="../account/head.php">MikroTel Panel</a></div>
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

<div class="delet">
<h1>Lista de Productos</h1>

<!-- Formulario de Búsqueda -->
<form id="searchForm" method="GET" action="delete_producto.php">
    <input type="text" id="searchInput" name="search" placeholder="Buscar por código..." value="<?php echo htmlspecialchars($search); ?>">
</form>

<table id="productTable">
    <tr>
        <th>Código</th>
        <th>Título</th>
        <th>Marca</th>
        <th>Precio</th>
        <th>Categoría</th>
        <th>Cantidad</th>
        <th>Descripción</th>
        <th>Imagen</th>
        <th>Acción</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            
            echo "<td>" . $row["codigo_producto"] . "</td>";
            echo "<td>" . $row["titulo_producto"] . "</td>";
            echo "<td>" . $row["marca_producto"] . "</td>";
            echo "<td>" . $row["precio_producto"] . "</td>";
            echo "<td>" . $row["categoria_producto"] . "</td>";
            echo "<td>" . $row["cantidad_producto"] . "</td>";
            echo "<td>" . $row["descripcion_producto"] . "</td>";
            echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['imagen_producto']) . "' alt='Imagen' width='100'></td>";
            echo "<td><a href='dele.php?codigo=" . $row["codigo_producto"] . "' class='delete-button'>Eliminar</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No se encontraron productos</td></tr>";
    }
    ?>
</table>

</div>

<script src="../js/registrar-productos.js"></script>

</body>
</html>
