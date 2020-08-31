<?php
require "config/config.php";
$Usuario = new Usuario;
$autenticar = $Usuario->autenticarAdinistrador();
include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>Formulario para agregar una categoria</h1>

        <form action="agregarCategoria.php" method="post" class="form">
            <label for="nom">Nombre</label>
            <br>
            <input type="text" id="nom" name="catNombre" placeholder="Escaribi el nombre de la categoria" required>
            <br>
            <input type="submit" value="Agregar">
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