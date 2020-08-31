<?php
require "config/config.php";
$Usuario = new Usuario;

$autenticar = $Usuario->autenticarAdinistrador();



include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>Panel de administracion</h1>
        <a href="adminCategorias.php" class="enlace">ir al panel de administracion de categorias</a>
        <a href="adminProductos.php" class="enlace">ir al panel de administracion de productos</a>
        <a href="adminUsuarios.php" class="enlace">ir al panel de administracion de usuarios</a>
        <br>
    </div>

</main>

<?php
include 'includes/footer.php';
?>