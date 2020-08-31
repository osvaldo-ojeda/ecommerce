<?php
require "config/config.php";
$Producto = new Producto;
$productos = $Producto->listarProductos();
$paginas = $Producto->paginador();
include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>Nuestros productos</h1>

        <div class="productos">
            <?php
            foreach ($productos as $producto) {

            ?>


                <div class="producto">
                    <div class="gallery">
                        <img src="images/productos/<?= $producto['prdImagen']; ?>" alt="<?= $producto['prdNombre']; ?>" style="width: 100%; height:100%">
                        <div class="desc">
                            <h3 ><?= $producto['prdNombre']; ?> </h3>
                            <h4>presentacion: <?= $producto['prdPresentacion']; ?></h4>
                            <button class="buttonVerMas">
                                 <a href="producto.php?idProducto=<?= $producto['idProducto'];?>" >
                                Mas detalles
                            </a>
                            </button>
                           
                        </div>
                    </div>
                </div>



            <?php
            }

            ?>


        </div>
        <a href="index.php" class="enlace">
            Volver al inicio
        </a>
    </div>

<?php
include "includes/paginador.php"

?>
</main>

<?php
include 'includes/footer.php';
?>