<?php
require 'config/config.php';
$Usuario = new Usuario;
$autenticar = $Usuario->autenticarAdinistrador();

$Producto = new Producto;
$producto = $Producto->verProductoPorId();
$Categoria = new Categoria();
$categorias = $Categoria->listarCategorias();
include 'includes/header.html';
include 'includes/nav.php';

?>
<main>
    <div class="contenido">
        <h1>Formulario para modificar un producto</h1>

        <form action="modificarProducto.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="idProducto" value="<?= $producto['idProducto']; ?>">
            <label for="nom">Nombre</label>
            <br>
            <input type="text" id="nom" name="prdNombre" value="<?= $producto['prdNombre']; ?>" required>
            <br>



            <label for="cat">Categoria</label>
            <br>
            <select name="idCategoria" id="cat" required>

                <option value="<?= $producto['idCategoria']; ?>"><?= $producto['catNombre']; ?></option>
                <?php
                foreach ($categorias as $categoria) {
                ?>
                    <option value="<?= $categoria['idCategoria']; ?>">
                        <?= $categoria['catNombre']; ?>
                    </option>
                <?php
                }
                ?>

            </select>
            <br>
            <label for="precio">Precio</label>
            <br>
            <input type="number" id="precio" name="prdPrecio" value="<?= $producto['prdPrecio']; ?>" required>
            <br>


            <label for="presentacion">Presentacion</label>
            <br>
            <input type="text" id="presentacion" name="prdPresentacion" value="<?= $producto['prdPresentacion']; ?>" required>
            <br>

            <label for="stock">Stock</label>
            <br>
            <input type="number" id="stock" name="prdStock" value="<?= $producto['prdStock']; ?>" required>
            <br>


            <label for="img">Imagen</label>
            <br>
            <img src="images/productos/<?= $producto['prdImagen']; ?>" alt="<?= $producto['prdNombre']; ?>" style="width: 300px;" id="img">
            
            <br>
            <label for="newI">Queres cambiar la foto?</label>

            <input type="file" id="newI" name="prdImagen" value="$producto['prdImagen']" class="hiddenFile">
            


            <input type="hidden" name="imagenOriginal" value="<?= $producto['prdImagen']; ?>">

            <br>

            <input type="submit" value="Modificar">
        </form>
        <br>

        <a href="adminProductos.php" class="enlace">
            Volver al panel de productos
        </a>
        <br>


    </div>

</main>

<?php
include 'includes/footer.php';
?>