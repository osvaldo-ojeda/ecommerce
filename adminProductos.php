<?php
require 'config/config.php';

$Producto = new Producto;
$productos = $Producto->listarProductos();
$paginas = $Producto->paginador();
$Usuario=new Usuario;
$autenticar = $Usuario->autenticarAdinistrador();
include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>Panel de administracion de productos</h1>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Precio</th>
                    <th>Presentacion</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                    <th colspan="2"><a href="formAgregarProducto.php">Agregar Producto</a> </th>
                </tr>
            </thead>

            <tbody>

                <?php
                foreach ($productos as $producto) {

                ?>
                    <tr>
                        <td><?= $producto['idProducto']; ?> </td>
                        <td><?= $producto['prdNombre']; ?> </td>
                        <td><?= $producto['catNombre']; ?> </td>
                        <td><?= $producto['prdPrecio']; ?> </td>
                        <td><?= $producto['prdPresentacion']; ?> </td>
                        <td><?= $producto['prdStock']; ?> </td>
                        <td><img src="images/productos/<?= $producto['prdImagen']; ?> " alt="productos" style="width: 100px; height:120px"></td>
                        <td><a href="formModificarProducto.php?idProducto=<?=$producto['idProducto'];?>">Modificar</a> </td>
                        <td><a href="formEliminarProducto.php?idProducto=<?=$producto['idProducto'];?>">Eliminar</a> </td>
                    </tr>

                <?php

                }

                ?>
            </tbody>

        </table>

        
        <?php
        include 'includes/paginador.php';
        ?>



        <br>
        <a href="admin.php" class="enlace">
            Volver al panel de administracion
        </a>
        <br>

    </div>

</main>

<?php
include 'includes/footer.php';
?>