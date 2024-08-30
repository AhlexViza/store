<?php
$servername = "localhost";  
$username = "root";   
$password = "rootroot"; 
$dbname = "mikrotel_cusco";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['codigo'])) {
    $codigo_producto = $_GET['codigo'];

    $sql = "DELETE FROM mikrotel_producto WHERE codigo_producto = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $codigo_producto); 
        if ($stmt->execute()) {
            echo "Producto eliminado con éxito.";
        } else {
            echo "Error al eliminar el producto: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }
} else {
    echo "Código de producto no especificado.";
}

$conn->close();

header("Location: delete_producto.php");
exit();
?>
