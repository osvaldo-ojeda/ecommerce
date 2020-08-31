<?php
require 'config/config.php';
$Usuario = new Usuario;
$autenticar = $Usuario->autenticarAdinistrador();
$chequeo = $Usuario->eliminarUsuario();
$clase = "mal";
$mensaje = "No se pudo eliminar el usuario";
if ($chequeo) {
    $clase = "bien";
    $mensaje = "Se elimino al usiario " . $Usuario->getUsuNombre() . ", con el id: " . $Usuario->getIdUsuario();
}

include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>baja de una usuario</h1>


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