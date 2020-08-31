<?php
require 'config/config.php';
$Usuario = new Usuario;
$autenticar = $Usuario->autenticarUsuComun();


$chequeo = $Usuario->modificarUsuarioComun();
$clase = "mal";
$mensaje = "No se pudo el usuario usuario";
if ($chequeo) {
    $clase = "bien";
    $mensaje = "Se modifico el usuario " . $Usuario->getUsuNombre() ;
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


        <a href="perfilUsuario.php?idUsuario=<?=$_SESSION['usuarioComun']['Id'];?>"class="enlace" >
            Volver al panel de tu perfil
        </a>
        <br>
    </div>

</main>

<?php
include 'includes/footer.php';
?>

