<?php
require 'config/config.php';
$Usuario = new Usuario;
$autenticar = $Usuario->autenticarAdinistrador();


$chequeo = $Usuario->modificarUsuario();
$clase = "mal";
$mensaje = "No se pudo el usuario usuario";
if ($chequeo) {
    $clase = "bien";
    $mensaje = "Se modifico el usuario " . $Usuario->getUsuNombre() . ", con el id: " . $Usuario->getIdUsuario();
}

include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>modificacion de un usuario</h1>


        <div class="mensaje  <?= $clase; ?>">
            <?= $mensaje; ?>
        </div>


        <a href="adminUsuarios.php"class="enlace" >
            Volver al panel de usuarios
        </a>
        <br>
    </div>

</main>

<?php
include 'includes/footer.php';
?>

