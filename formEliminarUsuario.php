<?php
require "config/config.php";
$Usuario = new Usuario;
$autenticar = $Usuario->autenticarAdinistrador();

$usuario = $Usuario->verUsuarioPorId();
include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>baja de un ausuario</h1>


        <div class="contenido medio">
            <h3>Queres eliminar a este usuario?</h3>
            <div class="polaroid">

                <h4><?= $usuario['usuNombre']; ?></h4>
                <h4>Apellido= <?= $usuario['usuApellido']; ?></h4>
                <h4>email= <?= $usuario['email']; ?></h4>
                <form action="eliminarUsuario.php" method="post" class="form">
                    <input type="hidden" name="idUsuario" value="<?= $usuario['idUsuario']; ?>">

                    <input type="hidden" name="usuNombre" value="<?= $usuario['usuNombre']; ?>" required>
                    <br>
                    <input type="submit" value="Eliminar" id="eliminar">
                </form>


            </div>

        </div>
        <!-- ------------------------------------- -->


        <br>

        <a href="adminUsuarios.php" class="enlace">
            Volver al panel de usuarios
        </a>
        <br>


    </div>

</main>

<?php
include 'includes/footer.php';
?>