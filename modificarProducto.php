<?php
require 'config/config.php';
$Usuario = new Usuario;
$autenticar = $Usuario->autenticarAdinistrador();

$Producto = new Producto;
$chequeo = $Producto->modificarProducto();
$clase = "mal";
$mensaje = "No se pudo modificar el producto";
if ($chequeo) {
    $clase = "bien";
    $mensaje = "Se modifico el producto " . $Producto->getPrdNombre() . ", con el id: " . $Producto->getIdProducto();
}

include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>modificacion de un producto</h1>


        <div class="mensaje  <?= $clase; ?>">
            <?= $mensaje; ?>
        </div>


        <a href="adminProductos.php"class="enlace">
            Volver al panel de productos
        </a>
        <br>
    </div>

</main>

<?php
include 'includes/footer.php';
?>

