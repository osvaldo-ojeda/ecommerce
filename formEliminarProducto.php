<?php
require 'config/config.php';
$Usuario = new Usuario;
$autenticar = $Usuario->autenticarAdinistrador();
$Producto = new Producto;
$producto = $Producto->verProductoPorId();
include 'includes/header.html';
include 'includes/nav.php';

?>
<main>
    <div class="contenido">
        <h1>baja de un producto</h1>

        <div class="contenido medio">
            <h3>Queres eliminar este producto?</h3>
            <div class="polaroid">
                <img src="images/productos/<?= $producto['prdImagen']; ?>" alt="<?= $producto['prdNombre']; ?>" style="width: 100%;">
                <h4><?= $producto['prdNombre']; ?></h4>
                <h4>Precio= $ <?= $producto['prdPrecio']; ?></h4>
                <h4>Categoria= <?= $producto['catNombre']; ?></h4>
                <h4>Presentacion= <?= $producto['prdPresentacion']; ?></h4>

                <form action="eliminarProducto.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="idProducto" value="<?= $producto['idProducto']; ?>">

                    <input type="hidden" id="nom" name="prdNombre" value="<?= $producto['prdNombre']; ?>" required>

                    <input type="hidden" name="imagenOriginal" value="<?= $producto['prdImagen']; ?>">

                    <input type="submit" value="Eliminar" id="eliminar">
                </form>
            </div>

        </div>


        <br>

        <a href="adminProductos.php" class="enlace">
            Volver al panel de productos
        </a>
        <br>


    </div>
    <script>
        Swal.fire({
            title: 'Ojo con lo que vas a hacer',
            text: "Esta accion no tiene retorno!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Queres eliminarlo?!',
            cancelButtonText: 'volver'
        }).then((result) => {
            if (!result.value) {
                window.location = 'adminProductos.php';

            }
        })
    </script>

</main>

<?php
include 'includes/footer.php';
?>