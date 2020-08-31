<?php
require "config/config.php";
$Usuario= new Usuario;
$autenticar = $Usuario->autenticarAdinistrador();

$usuario=$Usuario->verUsuarioPorId();
include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>Formulario para modificar un ausuario</h1>

        <form action="modificarUsuario.php" method="post" class="form">
            <input type="hidden" name="idUsuario"value="<?=$usuario['idUsuario'];?>">


            <label for="nom">Nombre</label>
            <br>
            <input type="text" id="nom" name="usuNombre"value="<?=$usuario['usuNombre'];?>"  required>
            <br>

            <label for="ape">Apellido</label>
            <br>
            <input type="text" id="ape" name="usuApellido"value="<?=$usuario['usuApellido'];?>"  required>
            <br>
            <label for="email">Email</label>
            <br>
            <input type="email" id="email" name="email"value="<?=$usuario['email'];?>" required>
            <br>
            <label for="pass">Contraseña</label>
            <br>
            <input type="password" id="pass" name="pass"value="<?=$usuario['pass'];?>" required>
            <br>
            <label for="rol">Estado</label>
            <br>
            <input type="number" id="rol" name="rol"value="<?=$usuario['rol'];?>" required>
            <br>
            <input type="submit" value="Modificar">
        </form>
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