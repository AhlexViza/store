<style>
    .btn-volver-registro{
    width: 120px;
    background-color: red;
    height: 35px;
    color:white;
    border-radius:25px;
    place-items:center;
    display:grid;
    cursor: pointer;
    
}
</style>
<?php
$codigo_producto = $_POST['codigo'];
$titulo_producto = $_POST['titulo_producto'];
$marca_producto = $_POST['marca'];
$precio_producto = $_POST['precio'];
$categoria_producto = $_POST['categoria'];
$cantidad_producto = $_POST['stock'];
$descripcion_producto = $_POST['descripcion'];
if (isset($_FILES['img_producto']) && $_FILES['img_producto']['error'] == UPLOAD_ERR_OK) {
    $imagen_producto = addslashes(file_get_contents($_FILES['img_producto']['tmp_name']));
    // Procesa la imagen como necesites
} else {
    echo "Error: No se pudo subir el archivo.";
}
/*$imagen_producto = addslashes(file_get_contents($_FILES['img_producto']['tmp_name']));*/

$conexion = mysqli_connect("localhost","root","rootroot","mikrotel_cusco");
$insertar = "INSERT INTO `mikrotel_producto`(`codigo_producto`, `titulo_producto`, `marca_producto`, 
            `precio_producto`, `categoria_producto`, `cantidad_producto`, `descripcion_producto`, `imagen_producto`) 
            VALUES ('$codigo_producto','$titulo_producto','$marca_producto','$precio_producto','$categoria_producto',
            '$cantidad_producto','$descripcion_producto','$imagen_producto')";
$resultado=mysqli_query($conexion, $insertar);

if($resultado)
{
    echo "PRODUCTO REGISTRADO";
    ?><div class="btn-volver-registro"><a href="registra_producto.php">Nuevo Producto</a></div><?php
}else{
    echo "PRODUCTO NO REGISTRADO";
    ?>
    <script>
        function volver() {
            window.history.back();
        }
    </script>
    <div class="btn-volver-registro" onclick="volver()">Volver</div><?php
}
?>

