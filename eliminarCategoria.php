<?php
require 'config/config.php';
$Usuario = new Usuario;
$autenticar = $Usuario->autenticarAdinistrador();
$Categoria = new Categoria;
$chequeo = $Categoria->eliminarCategoria();
$clase = "mal";
$mensaje = "No se pudo eliminar la categoria";
if ($chequeo) {
    $clase = "bien";
    $mensaje = "Se elimino la categoria " . $Categoria->getCatNombre() . ", con el id: " . $Categoria->getIdCategoria();
}

include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>baja de una categoria</h1>


        <div class="mensaje  <?= $clase; ?>">
            <?= $mensaje; ?>
        </div>


        <a href="adminCategorias.php" class="enlace">
            Volver al panel de categorias
        </a>
        <br>
    </div>

</main>

<?php
include 'includes/footer.php';
?>

