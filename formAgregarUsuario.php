<?php
require "config/config.php";
include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>Formulario para agregar un ausuario</h1>

        <form action="agregarUsuario.php" method="post" class="form">
            <label for="nom">Nombre</label>
            <br>
            <input type="text" id="nom" name="usuNombre" placeholder="Tu nombre.."required>
            <br>

            <label for="ape">Apellido</label>
            <br>
            <input type="text" id="ape" name="usuApellido" placeholder="Tu apellido.."required>
            <br>
            <label for="email">Email</label>
            <br>
            <input type="email" id="email" name="email" placeholder="Tu email.."required>
            <br>
            <label for="pass">Contraseña</label>
            <br>
            <input type="password" id="pass" name="pass" placeholder="Tu contraseña.."required>
            <br>
            <input type="submit" value="Agregar">
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