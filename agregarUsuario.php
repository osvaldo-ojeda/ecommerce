<?php
require 'config/config.php';
$Usuario = new Usuario;
$chequeo = $Usuario->agregarUsuario();
$clase = "mal";
$mensaje = "No se pudo agregar al usuario";
if ($chequeo) {
    $clase = "bien";
    $mensaje = "Se agrego el usuario " . $Usuario->getUsuNombre() . ", con el id: " . $Usuario->getIdUsuario();
}

include 'includes/header.html';
include 'includes/nav.php';
?>
<main class="contenido">
    <div>
        <h1>Alta de un nuevo usuario</h1>


        <div class="mensaje  <?= $clase; ?>">
            <?= $mensaje; ?>
        </div>


        <a href="adminUsuarios.php" class="enlace">
            Volver al panel de usuarios
        </a>
        <br>
    </div>

</main>

<?php
include 'includes/footer.php';
?>

