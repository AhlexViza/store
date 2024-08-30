const toggleButton = document.querySelector('.navbar-toggle');
    const navbarMenu = document.querySelector('.navbar-menu');

    toggleButton.addEventListener('click', () => {
        navbarMenu.classList.toggle('active');
    });
/*deleteproduct*/
$(document).ready(function(){
    $('#searchInput').on('input', function(){
        var search = $(this).val();
        $.ajax({
            url: 'delete_producto.php',
            method: 'GET',
            data: {
                search: search,
                ajax: true
            },
            success: function(response) {
                $('#productTable').html('<tr><th>Acción</th><th>Código</th><th>Título</th><th>Marca</th><th>Precio</th><th>Categoría</th><th>Cantidad</th><th>Descripción</th><th>Imagen</th></tr>' + response);
            }
        });
    });
});