<?php
require 'config/config.php';
$Usuario = new Usuario;
$autenticar = $Usuario->autenticarAdinistrador();
$Categoria = new Categoria;
$categoria=$Categoria->verCategoriaPorId();
include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>Formulario para modificar una categoria</h1>

        <form action="modificarCategoria.php" method="POST" class="form">

            <input type="hidden" name="idCategoria" value="<?=$categoria['idCategoria'] ;?>">

            <label for="nom">Nombre</label>
            <br>
            <input type="text" id="nom" name="catNombre" value="<?=$categoria['catNombre'] ;?>" required>
            <br>
            <input type="submit" value="Modificar">
        </form>
        <br>

        <a href="adminCategorias.php" class="enlace">
            Volver al panel de categorias
        </a>
        <br>


    </div>

</main>

<?php
include 'includes/footer.php';
?>