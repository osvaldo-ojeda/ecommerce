<?php

include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1> ingresa a De BUENA MADERa </h1>
        <form action="login.php" method="post" class="form" enctype="multipart/form-data">
            <label for="mail">Nombre</label>
            <br>
            <input type="text" id="mail" name="email" placeholder="Escribi tu email" required>
            <br>
            <label for="pass">Clave</label>
            <br>
            <input type="password" id="pass" name="pass" placeholder="Escribi tu contraseña" required>
            <br>
            <input type="submit" value="Ingresar">
        </form>
        <br>
        <a href="formAgregarUsuario.php" class="enlace">todavia no te registraste?</a>

        <a href="index.php" class="enlace" >
            Volver al inicio
        </a>
        <br>
        <?php
        if (isset($_GET['error'])) {
        ?>
            <h2>
                usuario y/o clave incorrecta
            </h2>



        <?php
        }
        ?>
    </div>

</main>

<?php
include 'includes/footer.php';
?>