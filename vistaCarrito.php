<?php
require "config/config.php";
$Producto = new Producto;
$carrito = $Producto->agregarCarrito();

include 'includes/header.html';
include 'includes/nav.php';

?>
<main>
    <div class="contenido">
        <h1>tu carrito</h1>
        <!-- ---------- -->
        <?php
        if (!empty($_SESSION["carrito"])) {
        ?>



            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Imagen</th>
                        <th colspan="2"><a href="">Agregar Producto</a> </th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $total = 0;
                    foreach ($_SESSION["carrito"] as $producto) {
                    ?>
                        <tr>

                            <td><?= $producto["Nombre"]; ?> </td>
                            <td><?= $producto["Categoria"]; ?> </td>
                            <td><?= $producto["Precio"]; ?> </td>
                            <td><?= $producto["Cantidad"]; ?> </td>
                            <td><img src="images/productos/<?= $producto["Imagen"]; ?> " alt="productos" style="width: 100px; height:120px"></td>
                            <td>
                                <a href="unoMasAlCarrito.php?idProducto=<?= $producto['id']; ?>">agregar uno mas</a> </td>
                            <td>

                                <a href="quitarCarrito.php?idProducto=<?= $producto['id']; ?>">
                                    quitar
                                </a>


                            </td>
                        </tr>
                    <?php
                        $total = $total + ($producto["Precio"] * $producto["Cantidad"]);
                    }
                    ?>
                </tbody>
                <tr>
                    <td colspan="2">total</td>
                    <td colspan="3"><?= $total; ?></td>
                    <td colspan="2">pagar</td>
                </tr>
            </table>
        <?php
        } else {
        ?>
            <h2 class="mal">no hay nada en el carrito</h2>
        <?php
        }
        ?>
        <!-- ----------- -->
        <a href="productos.php" class="enlace">
            Volver a productos
        </a>
    </div>
</main>
<?php
include 'includes/footer.php';
?>