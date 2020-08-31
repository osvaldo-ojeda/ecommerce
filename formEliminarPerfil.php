<?php
require "config/config.php";
$Usuario = new Usuario;
$autenticar = $Usuario->autenticarUsuComun();

$usuario = $Usuario->verUsuarioComunPorId();
include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>baja de perfil</h1>


        <div class="contenido medio">
            <h3>Queres eliminar tu perfil?</h3>
            <div class="polaroid">

                <h4><?= $usuario['usuNombre']; ?></h4>
                <h4>Apellido= <?= $usuario['usuApellido']; ?></h4>
                <h4>email= <?= $usuario['email']; ?></h4>
                <form action="eliminarPerfil.php" method="post" class="form">
                    <input type="hidden" name="idUsuario" value="<?= $usuario['idUsuario']; ?>">

                    <input type="hidden" name="usuNombre" value="<?= $usuario['usuNombre']; ?>" required>
                    <br>
                    <input type="submit" value="Eliminar" id="eliminar">
                </form>


            </div>

        </div>
        <!-- ------------------------------------- -->


        <br>

        <a href="perfilUsuario.php?idUsuario=<?=$_SESSION['usuarioComun']['Id'];?>" class="enlace">
            Volver al panel de tu perfil
        </a>
        <br>


    </div>

</main>

<?php
include 'includes/footer.php';
?>