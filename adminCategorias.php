<?php
require 'config/config.php';
$Categoria = new Categoria;
$categorias = $Categoria->listarCategorias();
$Usuario=new Usuario;
$autenticar = $Usuario->autenticarAdinistrador();
include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>panel de administracion de categorias</h1>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th colspan="2"><a href="formAgregarCategoria.php">Agregar Categoria</a> </th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($categorias as $categoria) {

                ?>
                    <tr>

                        <td><?= $categoria['idCategoria']; ?></td>
                        <td><?= $categoria['catNombre']; ?></td>
                       
                        <td><a href="formModificarCategoria.php?idCategoria=<?=$categoria['idCategoria']; ?>
                        ">Modificar</a></td>
                        <td><a href="formEliminarCategoria.php?idCategoria=<?=$categoria['idCategoria']; ?>">Eliminar</a> </td>
                    </tr>
                <?php
                }

                ?>
            </tbody>

        </table>
        <br>
        <a href="admin.php"  class="enlace">
            Volver al panel de administracion
        </a>
        <br>

    </div>

</main>

<?php
include 'includes/footer.php';
?>