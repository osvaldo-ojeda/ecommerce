<?php
require 'config/config.php';
$Usuario = new Usuario;
$autenticar = $Usuario->autenticarAdinistrador();
$Categoria = new Categoria;
$categoria = $Categoria->verCategoriaPorId();
include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>baja de una categoria</h1>
        <div class="contenido medio">
            <h3>Queres eliminar esta categoria?</h3>
            <div class="polaroid">
                <h4><?= $categoria['catNombre']; ?></h4>

                 <form action="eliminarCategoria.php" method="post" class="form">
                <input type="hidden" name="idCategoria" value="<?= $categoria['idCategoria']; ?>">
                <input type="hidden" id="nom" name="catNombre" value="<?= $categoria['catNombre']; ?>" required>
                <br>
                <input type="submit" value="Eliminar" id="eliminar">
            </form>
            </div>
           
        </div>


        <br>

        <a href="adminCategorias.php" class="enlace">
            Volver al panel de categorias
        </a>
        <br>

    </div>
    <script>
        Swal.fire({
            title: 'Ojo con lo que vas a hacer',
            text: "Esta accion no tiene retorno!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Queres eliminarlo?!',
            cancelButtonText: 'volver'
        }).then((result) => {
            if (!result.value) {
                window.location = 'adminCategorias.php';

            }
        })
    </script>
</main>

<?php
include 'includes/footer.php';
?>