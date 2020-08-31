<?php
require 'config/config.php';
$Usuario = new Usuario;
$autenticar = $Usuario->autenticarUsuComun();
$chequeo = $Usuario->eliminarUsuario();
$logout=$Usuario->logout();
$clase = "mal";
$mensaje = "No se pudo eliminar el perfil";
if ($chequeo) {
    $clase = "bien";
    $mensaje = "Se elimino perfil " . $Usuario->getUsuNombre() ;
}

include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>baja de perfil</h1>


        <div class="mensaje  <?= $clase; ?>">
            <?= $mensaje; ?>
        </div>


       
    </div>

</main>

<?php
include 'includes/footer.php';
?>