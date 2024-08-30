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

    $conexion = mysqli_connect("localhost","root","rootroot","mikrotel_cusco");

    $insertar = "UPDATE `mikrotel_producto` SET `titulo_producto` = '$titulo_producto', `marca_producto` = '$marca_producto', `precio_producto` = '$precio_producto', `categoria_producto` = '$categoria_producto', `cantidad_producto` = '$cantidad_producto', `descripcion_producto` = '$descripcion_producto', `imagen_producto` = '$imagen_producto' 
                WHERE `mikrotel_producto`.`codigo_producto` = '$codigo_producto'";
    $resultado=mysqli_query($conexion, $insertar);

    if($resultado)
    {
        echo "PRODUCTO ACTUALIZADO";
        ?><div class="btn-volver-registro"><a href="actualiza_producto.php">Actualizar nuevo Producto</a></div><?php
    }else{
        echo "PRODUCTO NO ACTUALIZADO";
        ?>
        <script>
            function volver() {
                window.history.back();
            }
        </script>
        <div class="btn-volver-registro" onclick="volver()">Volver</div><?php
    }
?>