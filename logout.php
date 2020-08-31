<?php
require "config/config.php";
 $Usuario=new Usuario;
 $logout=$Usuario->logout();
include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>hasta luego</h1>
    </div>

</main>

<?php
include 'includes/footer.php';
?>