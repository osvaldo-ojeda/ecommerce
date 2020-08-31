<?php
require 'config/config.php';
$Usuario = new Usuario;
$usuarios = $Usuario->listarUsuarios();
$autenticar = $Usuario->autenticarAdinistrador();

include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>Panel de administracion de usuarios</h1>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Contraseña</th>
                    <th>Rol</th>
                    <th colspan="2"><a href="formAgregarUsuario.php">Agregar Usuario</a> </th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($usuarios as $usuario) {

                ?>
                    <tr>

                        <td><?= $usuario['idUsuario']; ?></td>
                        <td><?= $usuario['usuNombre']; ?></td>
                        <td><?= $usuario['usuApellido']; ?></td>
                        <td><?= $usuario['email']; ?></td>
                        <td><?= $usuario['pass']; ?></td>
                        <td><?= $usuario['rol']; ?></td>

                        <td><a href="formModificarUsuario.php?idUsuario=<?=$usuario['idUsuario'];?>">Modificar</a></td>
                        <td><a href="formEliminarUsuario.php?idUsuario=<?=$usuario['idUsuario'];?>">Eliminar</a></td>
                    </tr>
                <?php
                }

                ?>
            </tbody>

        </table>
        <br>
        <a href="admin.php" class="enlace">
            Volver al panel de administracion
        </a>
        <br>

    </div>

</main>

<?php
include 'includes/footer.php';
?>