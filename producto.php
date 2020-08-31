<?php
require "config/config.php";
$Producto = new Producto;
$producto = $Producto->verProductoPorId();
$Categoria = new Categoria();
$categorias = $Categoria->listarCategorias();


include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <?php
        if (isset($_GET['error'])) {
        ?>
            <h3 class="mal">
                Este producto ya esta agregado al carrito
            </h3>



        <?php
        }
        ?>
        <h1>
            <?= $producto['prdNombre']; ?>
        </h1>
        <div class="detalle">
            <div class="imgDetalle">
                <img src="images/productos/<?= $producto['prdImagen']; ?>" alt="<?= $producto['prdNombre']; ?>" width: 100px; height:120px>


            </div>
            <div class="prdDetalle">

                <h3>Categoria= <?= $producto['catNombre']; ?></h3>
                <h3>Precio= $ <?= $producto['prdPrecio']; ?></h3>
                <h3>Stock= <?= $producto['prdStock']; ?></h3>
                <h3>Presentacion= <?= $producto['prdPresentacion']; ?></h3>

                <button class="buttonAgregar">


                    <a href="carrito.php?idProducto=<?= $producto['idProducto']; ?>">Agregar al carrito</a>

                </button>

                <button class="buttonComprar">


                    <a href="#">Comprar</a>


                </button>

            </div>

        </div>
        <a href="productos.php" class="enlace">
            Volver a productos
        </a>
    </div>

</main>

<?php
include 'includes/footer.php';
?>