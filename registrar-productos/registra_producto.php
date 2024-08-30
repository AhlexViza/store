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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <form id="api_crud_form" action="registrar_producto.php" method="post" enctype="multipart/form-data">
        <table class="form1">
            <td colspan="2"><label class="form1-name">Registrar Producto</label></td>
            <tr></tr>
            <td class="form1-title"><label for="opciones">Codigo Producto</label></td>
            <td>
                <input onkeyup="javascript:this.value=this.value.toUpperCase();" class="form1-textbox1" type="text" placeholder="Ingrese el codigo del producto '6G5F'" name="codigo" id="codigo">
            </td>
            <tr></tr>
            <td class="form1-title"><label for="opciones">Titulo del Producto</label></td>
            <td>
                <input class="form1-textbox1" placeholder="Laptop Hp Intel Core i5 RAM 8GB SSD 480GB" list="opciones" id="titulo_producto" name="titulo_producto" id="titulo_producto">
                <datalist id="opciones">
                    <option value="Laptop ">
                    <option value="Pc ">
                    <option value="Monitor ">
                    <option value="Teclado ">
                    <option value="Mouse ">
                    <option value="Disco Solido ">
                    <option value="Memoria Ram ">
                    <option value="Audifono ">
                    <option value="Impresora ">
                </datalist>
            </td>
            <tr></tr>
            <td class="form1-title"><label for="opciones">Marca</label></td>
            <td>
                <input class="form1-textbox1" list="opciones1" id="marca" name="marca">
                <datalist id="opciones1">
                    <option value="ACER ">
                    <option value="HP ">
                    <option value="ASUS ">
                    <option value="LENOVO ">
                    <option value="LOGITECH ">
                </datalist>
            </td>
            <tr></tr>
            <td class="form1-title"><label for="opciones">Precio</label></td>
            <td>
                <input class="form1-textbox1" type="text" id="precio" name="precio">
            </td>
            <tr></tr>
            <td class="form1-title"><label for="opciones">Categoria</label></td>
            <td>
                <input class="form1-textbox1" list="opciones2" id="categoria" name="categoria">
                <datalist id="opciones2">
                    <option value="Laptop ">
                    <option value="Pc ">
                    <option value="Oficina ">
                    <option value="Gaming ">
                    <option value="Accesorios ">
                    <option value="Componentes ">                
                </datalist>
            </td>
            <tr></tr>
            <td class="form1-title"><label for="opciones">Cantidad</label></td>
            <td>
                <input class="form1-textbox1" type="text" name="stock" id="stock">
            </td>
            <tr></tr>
            <td class="form1-title"><label for="opciones">Descripción</label></td>
            <td>
                <textarea  class="form1-caracter"  placeholder="Este campo no es obligatorio" name="descripcion"></textarea>
            </td>
            <tr></tr>
            <td class="form1-title"><label for="opciones">Imagen-Producto</label></td>
            <td>
                <input class="form1-img" type="file" name="img_producto">
            </td>
            <tr></tr>
            <td colspan="2">
                <input class="btn-registrar" type="submit" value="REGISTRAR">
            </td>
        </table>  
    </form>

</body>
<script src="../js/registrar-productos.js"></script>
<script type="text/javascript">
$(document).ready(function () {
 $('#api_crud_form').on('submit', function (event) {
        event.preventDefault();
        if ($('#codigo').val() == '' || 
        $('#titulo_producto').val() == '' || 
        $('#marca').val() == '' || 
        $('#precio').val() == '' || 
        $('#categoria').val() == '' || 
        $('#stock').val() == '') {
            alert("Ingresar todos los campos, excepto la descripcion");
        }
        else{
            this.submit();
        }
    });
  });

</script>
</html>

