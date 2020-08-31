<nav>
    <div id="dropdown">
        <a href="index.php" class="home">home</a>
        <div id="dropdown-content">
            <a href="productos.php" class="products">productos</a>
            <a href="#contacto" class="contacto">contactos</a>


<!-- esto es para ocultar el link del carrito si no hay nada, pero no lo voy a usar -->

    <?php
    // if (empty($_SESSION["carrito"])) {
    ?>
    <!-- <a href="vistaCarrito.php" hidden>carrito</a> -->
    <?php
    // } else {
    ?>
    <!-- <a href="vistaCarrito.php">carrito(<?php echo (empty($_SESSION["carrito"])) ? 0 : count($_SESSION["carrito"]); ?>)</a> -->
    <?php
    // }
    ?>
    <a href="vistaCarrito.php" class="carrito">carrito(<?php echo (empty($_SESSION["carrito"])) ? 0 : count($_SESSION["carrito"]); ?>)</a>
            
        </div>
    </div>

    




    <?php
    if (isset($_SESSION['administrador'])) {
    ?>
        <div class="dropdown" style="float:right;">
            <a href="" class="">
                <?= $_SESSION['administrador']; ?></a>
            <div class="dropdown-content ">
                <div class="one">
                    <a href="admin.php">admin</a>
                </div>
                <div class="two">
                    <a href="logout.php">salir</a>
                </div>
            </div>
        </div>
    <?php
    } elseif (isset($_SESSION['usuarioComun'])) {
    ?>
        <div class="dropdown" style="float:right;">
            <a href="#" class="">
                <?= $_SESSION['usuarioComun']["Apellido"]; ?></a>
            <div class="dropdown-content ">
                <div class="one">
                    <a href="perfilUsuario.php?idUsuario=<?= $_SESSION['usuarioComun']['Id']; ?>">Perfil</a>
                </div>
                <div class="two">
                    <a href="logout.php">salir</a>
                </div>
            </div>
        </div>
    <?php
    } else {
    ?>
        <a href="formLogin.php" class="log">Ingresar</a>
    <?php
    }
    ?>

</nav>