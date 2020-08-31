<?php
require "config/config.php";

$Usuario=new Usuario;
$autenticar = $Usuario->autenticarUsuComun();

$usuario=$Usuario->perfilUsuario();
include 'includes/header.html';
include 'includes/nav.php';
?>
<main>
    <div class="contenido">
        <h1>Perfil de usuario</h1>
    
    <table>
            <thead>
                <tr>
                    <th hidden>id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Contraseña</th>
                    
                    <th colspan="2"> </th>
                </tr>
            </thead>

            <tbody>
                
                    <tr>

                        <td hidden><?= $usuario['idUsuario']; ?></td>
                        <td><?= $usuario['usuNombre']; ?></td>
                        <td><?= $usuario['usuApellido']; ?></td>
                        <td><?= $usuario['email']; ?></td>
                        <td><?= $usuario['pass']; ?></td>
                        

                        <td><a href="formModificarPerfil.php?idUsuario=<?=$usuario['idUsuario'];?>">Modificar</a></td>
                        <td><a href="formEliminarPerfil.php?idUsuario=<?=$usuario['idUsuario'];?>">Eliminar</a></td>
                    </tr>
               
            </tbody>

        </table>
        <br>
        <a href="index.php" class="enlace">
            Volver al panel principal
        </a>
        <br>

    </div>

</main>
</div>
<?php
include 'includes/footer.php';
?>