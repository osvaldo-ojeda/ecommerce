<?php
require 'config/config.php';
$Usuario = new Usuario;
$autenticar = $Usuario->autenticarAdinistrador();
$Categoria = new Categoria();
$categorias = $Categoria->listarCategorias();
include 'includes/header.html';
include 'includes/nav.php';

?>
<main>
    <div class="contenido">
        <h1>Formulario para agregar un producto</h1>

        <form action="agregarProducto.php" method="post" enctype="multipart/form-data">
            <label for="nom">Nombre</label>
            <br>
            <input type="text" id="nom" name="prdNombre" placeholder="Nombre del producto.." required>
            <br>



            <label for="cat">Categoria</label>
            <br>
            <select name="idCategoria" id="cat" required>

                <option value=""> Selecciona una categoria</option>
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
            <input type="number" id="precio" name="prdPrecio" placeholder="Ponele el precio" required>
            <br>
            <label for="presentacion">Presentacion</label>
            <br>
            <input type="text" id="presentacion" name="prdPresentacion" placeholder="Cual es la presentacion.." required>
            <br>
            <label for="stock">Stock</label>
            <br>
            <input type="number" id="stock" name="prdStock" placeholder="Cual es el stock.." required>
            <br>
            <label for="img">Imagen</label>
            <br>
          
               
            <input type="file" id="img" name="prdImagen" class="hiddenFile" id="file-input">


           





            <input type="submit" value="Agregar">
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