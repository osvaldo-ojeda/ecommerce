<?php

class Usuario
{
    private $idUsuario;
    private $usuNombre;
    private $usuApellido;
    private $email;
    private $pass;
    private $rol;
    ##### esto es para encriptar las contraseñas, pero ahora no lo voy a uar para subirlo a git####
    // static function hashPass()
    // {
    //     $pass = $_POST['pass'];
    //     $hash = password_hash($pass, PASSWORD_DEFAULT);
    //     $hash = substr($hash, 0, 60);
    //     return $hash;
    // }

    public function listarUsuarios()
    {
        $link = Conexion::conectar();
        $sql = "SELECT
                    idUsuario,
                    usuNombre,
                    usuApellido,
                    email,
                    pass,
                    rol
                FROM usuarios";
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $usuarios = $stmt->fetchAll();
        return $usuarios;
    }


    public function agregarUsuario()
    {
        $usuNombre = $_POST['usuNombre'];
        $usuApellido = $_POST['usuApellido'];
        $email = $_POST['email'];
        // $pass = Usuario::hashPass();
        $pass = $_POST['pass'];
        $link = Conexion::conectar();
        $sql = "INSERT INTO usuarios(
                            usuNombre,
                            usuApellido,
                            email,
                            pass)
                VALUES(
                    :usuNombre,
                    :usuApellido,
                    :email,
                    :pass)";
        $stmt = $link->prepare($sql);

        $stmt->bindParam(':usuNombre', $usuNombre, PDO::PARAM_STR);
        $stmt->bindParam(':usuApellido', $usuApellido, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $this->setUsuNombre($usuNombre);
            $this->setUsuApellido($usuApellido);
            $this->setEmail($email);
            $this->setPass($pass);
            $this->setIdUsuario($link->lastInsertId());
            return TRUE;
        }
        return FALSE;
    }
    public function verUsuarioPorId()
    {
        $idUsuario = $_GET['idUsuario'];
        $link = Conexion::conectar();
        $sql = "SELECT idUsuario,
                       usuNombre,
                       usuApellido,
                       email,
                       pass,
                       rol
                       FROM  usuarios
                    WHERE idUsuario=" . $idUsuario;
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $usuario = $stmt->fetch();
        return $usuario;
    }

    public function modificarUsuario()
    {
        $idUsuario = $_POST['idUsuario'];
        $usuNombre = $_POST['usuNombre'];
        $usuApellido = $_POST['usuApellido'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $rol = $_POST['rol'];
        // $pass = Usuario::hashPass();

        $link = Conexion::conectar();
        $sql = "UPDATE usuarios
                SET usuNombre=:usuNombre,
                    usuApellido=:usuApellido,
                    email=:email,
                    pass=:pass,
                    rol=:rol
                WHERE idUsuario=" . $idUsuario;
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':usuNombre', $usuNombre, PDO::PARAM_STR);
        $stmt->bindParam(':usuApellido', $usuApellido, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
        $stmt->bindParam(':rol', $rol, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $this->setIdUsuario($idUsuario);
            $this->setUsuNombre($usuNombre);
            return TRUE;
        }
        return FALSE;
    }
    public function eliminarUsuario()
    {

        $idUsuario = $_POST['idUsuario'];
        $usuNombre = $_POST['usuNombre'];
        $link = Conexion::conectar();
        $sql = "DELETE FROM usuarios
        WHERE idUsuario=" . $idUsuario;
        $stmt = $link->prepare($sql);
        if ($stmt->execute()) {
            $this->setUsuNombre($usuNombre);
            $this->setIdUsuario($idUsuario);
            return TRUE;
        }
        return FALSE;
    }

    ############autenticacion################################################################################

    ######esta es la funcion loging si uso el hash######
    // public function login()
    // {

    //     $email = $_POST['email'];
    //     $pass = $_POST['pass'];
    //     $link = Conexion::conectar();
    //     $sql = "SELECT usuNombre,
    //                      usuApellido,
    //                      pass
    //              FROM usuarios
    //              WHERE email=:email";
    //     $stmt = $link->prepare($sql);
    //     $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    //     $stmt->execute();
    //     $usu = $stmt->rowCount();
    //     if ($usu == 1) {
    //         $usuario = $stmt->fetch();
    //         $hash = $usuario['pass'];
    //         if (password_verify($pass, $hash)) {
    //             session_start();
    //             $_SESSION['login'] = 1;
    //             header('Location: admin.php');
    //         } else {

    //             header('Location: formLogin.php?error=1');
    //         }
    //     }
    // }

    public function login()
    {

        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $link = Conexion::conectar();
        $sql = "SELECT idUsuario,
                       usuNombre,
                       usuApellido,
                       rol
                 FROM usuarios
                 WHERE email=:email
                 AND pass=:pass";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
        $stmt->execute();
        $usu = $stmt->rowCount();
        if ($usu == 1) {
            session_start();
            $usuario = $stmt->fetch();
            $nombre = $usuario['usuNombre'];
            $rol = $usuario['rol'];
            if ($rol == 1) {
                $_SESSION['administrador'] = $nombre;
                header('Location: admin.php');
            } elseif ($rol == 0) {
                $_SESSION['usuarioComun'] = array(
                    "Nombre" => $usuario["usuNombre"],
                    "Apellido" => $usuario["usuApellido"],
                    "Id" => $usuario["idUsuario"]
                );
                header('Location: index.php');
            }
        } else {

            header('Location: formLogin.php?error=1');
        }
    }





    public function autenticarAdinistrador()
    {
        if (!isset($_SESSION['administrador'])) {
            header('location: formLogin.php');
        }
    }
    public function autenticarUsuComun()
    {
        if (!isset($_SESSION['usuarioComun'])) {
            header('location: formLogin.php');
        }
    }
    public function logout()
    {
        session_destroy();
        header('refresh:3; url=formLogin.php');
    }
    #####perfil del usuario######

    public function perfilUsuario()
    {
        $idUsuario = $_GET['idUsuario'];
        $link = Conexion::conectar();
        $sql = "SELECT idUsuario,
                       usuNombre,
                       usuApellido,
                       email,
                       pass
                       FROM  usuarios
                    WHERE idUsuario=" . $idUsuario;
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $usuario = $stmt->fetch();
        return $usuario;
    }
    public function verUsuarioComunPorId()
    {
        $idUsuario = $_GET['idUsuario'];
        $link = Conexion::conectar();
        $sql = "SELECT idUsuario,
                       usuNombre,
                       usuApellido,
                       email,
                       pass
                       FROM  usuarios
                    WHERE idUsuario=" . $idUsuario;
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $usuario = $stmt->fetch();
        return $usuario;
    }

    public function modificarUsuarioComun()
    {
        $idUsuario = $_POST['idUsuario'];
        $usuNombre = $_POST['usuNombre'];
        $usuApellido = $_POST['usuApellido'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        // $pass = Usuario::hashPass();

        $link = Conexion::conectar();
        $sql = "UPDATE usuarios
                SET usuNombre=:usuNombre,
                    usuApellido=:usuApellido,
                    email=:email,
                    pass=:pass
                    
                WHERE idUsuario=" . $idUsuario;
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':usuNombre', $usuNombre, PDO::PARAM_STR);
        $stmt->bindParam(':usuApellido', $usuApellido, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->setIdUsuario($idUsuario);
            $this->setUsuNombre($usuNombre);
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Get the value of idUsuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     *
     * @return  self
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get the value of usuNombre
     */
    public function getUsuNombre()
    {
        return $this->usuNombre;
    }

    /**
     * Set the value of usuNombre
     *
     * @return  self
     */
    public function setUsuNombre($usuNombre)
    {
        $this->usuNombre = $usuNombre;

        return $this;
    }

    /**
     * Get the value of usuApellido
     */
    public function getUsuApellido()
    {
        return $this->usuApellido;
    }

    /**
     * Set the value of usuApellido
     *
     * @return  self
     */
    public function setUsuApellido($usuApellido)
    {
        $this->usuApellido = $usuApellido;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of contraseña
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set the value of contraseña
     *
     * @return  self
     */
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get the value of rol
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     *
     * @return  self
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }
}
