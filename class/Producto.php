<?php

class Producto
{
    private $idProducto;
    private $prdNombre;
    private $idCategoria;
    private $prdPrecio;
    private $prdPresentacion;
    private $prdStock;
    private $cantidad;
    private $prdImagen;

    public function listarProductos()
    {
        
        $limit = 2;
       
        $pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : $_GET['pagina'] = 1;

        
        $offset = ($pagina > 1) ? (($pagina * $limit) - $limit) : 0;
        $link = Conexion::conectar();
        $sql = "SELECT idProducto,
             prdNombre,
             p.idCategoria,
             catNombre,
             prdPrecio,
             prdPresentacion,
             prdStock,
             prdImagen
           FROM productos p, categorias c     
           WHERE p.idCategoria=c.idCategoria
           LIMIT $limit OFFSET $offset";
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $productos = $stmt->fetchAll();
        return $productos;
    }

    public function paginador()
    {
        $limit = 2;
        $link = Conexion::conectar();
        $sql = "SELECT idProducto
        FROM productos ";
        $stmt = $link->prepare($sql);
        $stmt->execute(array());
        
        $row = $stmt->rowCount();
       
        $paginas = ceil($row / $limit);
        if ($_GET['pagina'] > $paginas || $_GET['pagina'] < 1) {
            header("Location:adminProductos.php?pagina=1");
        }
        return $paginas;
    }

    public function agregarProducto()
    {

        $prdNombre = $_POST['prdNombre'];
        $idCategoria = $_POST['idCategoria'];
        $precio = $_POST['prdPrecio'];
        $presentacion = $_POST['prdPresentacion'];
        $stock = $_POST['prdStock'];
        $imagen = Producto::subirArchivo();
        $link = Conexion::conectar();
        $sql = "INSERT INTO productos
                            (prdNombre,idCategoria,
                            prdPrecio,prdPresentacion,
                            prdStock,prdImagen)
                            VALUES(:prdNombre,:idCategoria,
                            :prdPrecio,:prdPresentacion,
                            :prdStock,:prdImagen)";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':prdNombre', $prdNombre, PDO::PARAM_STR);
        $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_INT);
        $stmt->bindParam(':prdPrecio', $precio, PDO::PARAM_INT);
        $stmt->bindParam(':prdPresentacion', $presentacion, PDO::PARAM_STR);
        $stmt->bindParam(':prdStock', $stock, PDO::PARAM_STR);
        $stmt->bindParam(':prdImagen', $imagen, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $this->setPrdNombre($prdNombre);
            $this->setIdProducto($link->lastInsertId());
            return TRUE;
        }

        return FALSE;
    }

    public  static function subirArchivo()
    {
        $imagen = 'noDisponible.jpg';
        if (isset($_POST['imagenOriginal'])) {
            $imagen = $_POST['imagenOriginal'];
        }
        if ($_FILES['prdImagen']['error'] == 0) {
            $ruta = 'images/productos/';
            $tmp = $_FILES['prdImagen']['tmp_name'];
            $imagen = $_FILES['prdImagen']['name'];
            move_uploaded_file($tmp, $ruta . $imagen);
        }
        return $imagen;
    }

    public function verProductoPorId()
    {
        $idProducto = $_GET['idProducto'];
        $link = Conexion::conectar();
        $sql = "SELECT idProducto,
                    prdNombre,
                    p.idCategoria,
                    catNombre,
                    prdPrecio,
                    prdPresentacion,
                    prdStock,
                    prdImagen
               FROM productos p, categorias c     
               WHERE p.idCategoria=c.idCategoria
               AND idProducto=" . $idProducto;
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $producto = $stmt->fetch();
        return $producto;
    }
    public function modificarProducto()
    {
        $idProducto = $_POST['idProducto'];
        $prdNombre = $_POST['prdNombre'];
        $idCategoria = $_POST['idCategoria'];
        $prdPrecio = $_POST['prdPrecio'];
        $prdPresentacion = $_POST['prdPresentacion'];
        $prdStock = $_POST['prdStock'];
        $prdImagen = Producto::subirArchivo();
        $link = Conexion::conectar();
        $sql = "UPDATE productos
            SET prdNombre=:prdNombre,
              idCategoria=:idCategoria,
              prdPrecio=:prdPrecio,
              prdPresentacion=:prdPresentacion,
              prdStock=:prdStock,
              prdImagen=:prdImagen
            WHERE idProducto=" . $idProducto;
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':prdNombre', $prdNombre, PDO::PARAM_STR);
        $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_STR);
        $stmt->bindParam(':prdPrecio', $prdPrecio, PDO::PARAM_STR);
        $stmt->bindParam(':prdPresentacion', $prdPresentacion, PDO::PARAM_STR);
        $stmt->bindParam(':prdStock', $prdStock, PDO::PARAM_STR);
        $stmt->bindParam(':prdImagen', $prdImagen, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $this->setIdProducto($idProducto);
            $this->setPrdNombre($prdNombre);
            return TRUE;
        }
        return FALSE;
    }
    public function eliminarProducto()
    {

        $idProducto = $_POST['idProducto'];
        $prdNombre = $_POST['prdNombre'];
        $prdImagen = $_POST['imagenOriginal'];
        $link = Conexion::conectar();
        $sql = "DELETE FROM productos
                WHERE idProducto=" . $idProducto;
        $stmt = $link->prepare($sql);
        if ($stmt->execute()) {
            $this->setIdProducto($idProducto);
            $this->setPrdNombre($prdNombre);
            if ($prdImagen != 'noDisponible.jpg') {
                unlink('images/productos/' . $prdImagen);
            }

            return TRUE;
        }
        return FALSE;
    }
    public function previewImagen()
    {

        $imagen = $_GET['prdImagen'];
        $link = Conexion::conectar();
        $sql = "SELECT 
                    prdImagen
               FROM productos 
               WHERE prdImagen=" . $imagen;
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $imagen = $stmt->fetch();
        return $imagen;
    }
    ###################carritoooo############################

    public function carrito()
    {
        $idProducto = $_GET['idProducto'];
        $link = Conexion::conectar();
        $sql = "SELECT idProducto,
                     prdNombre,
                     p.idCategoria,
                     catNombre,
                     prdPrecio,
                     prdPresentacion,
                     prdStock,
                     cantidad,
                     prdImagen
                FROM productos p, categorias c     
                WHERE p.idCategoria=c.idCategoria
                AND prdStock>=cantidad
                AND idProducto=" . $idProducto;
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $producto = $stmt->fetch();
        if (!isset($_SESSION["carrito"])) {
            $producto = array(
                "id" => $producto["idProducto"],
                "Nombre" => $producto["prdNombre"],
                "Categoria" => $producto["catNombre"],
                "Precio" => $producto["prdPrecio"],
                "Cantidad" => $producto["cantidad"],
                "Imagen" => $producto["prdImagen"],
            );
            $_SESSION["carrito"][0] = $producto;
            header('location: producto.php?idProducto=' . $idProducto);
        } else {
            
            $idProductos = array_column($_SESSION['carrito'], 'id');
            if (in_array($idProducto, $idProductos)) {
                header('Location: producto.php?idProducto=' . $idProducto . '&error=1');
            } else {
               
                $numProductos = count($_SESSION["carrito"]);
                $producto = array(
                    "id" => $producto["idProducto"],
                    "Nombre" => $producto["prdNombre"],
                    "Categoria" => $producto["catNombre"],
                    "Precio" => $producto["prdPrecio"],
                    "Cantidad" => $producto["cantidad"],
                    "Imagen" => $producto["prdImagen"],
                );
                $_SESSION['carrito'][$numProductos] = $producto;
                header('location: producto.php?idProducto=' . $idProducto);
            }
        }
    }
    public function agregarCarrito()
    {
        $agregarCarrito = isset($_SESSION['carrito']);
        return $agregarCarrito;
    }


    public function quitarDelCarrito()
    {  
        
        
        $idProducto = $_GET["idProducto"];
        foreach ($_SESSION['carrito'] as $key => $producto) {
            if ($producto['id'] == $idProducto) {
                unset($_SESSION['carrito'][$key]);
            }
        }
        header('location: vistaCarrito.php');
    }

    public function unoMasAlCarrito()
    {
        $idProducto = $_GET["idProducto"];
        foreach ($_SESSION['carrito'] as $key => $producto) {
            if ($producto['id'] == $idProducto) {
                ($_SESSION['carrito'][$key]['Cantidad']++);
            }
        }
        header('location: vistaCarrito.php');
    }






    /**
     * Get the value of idProducto
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Set the value of idProducto
     *
     * @return  self
     */
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    /**
     * Get the value of prdNombre
     */
    public function getPrdNombre()
    {
        return $this->prdNombre;
    }

    /**
     * Set the value of prdNombre
     *
     * @return  self
     */
    public function setPrdNombre($prdNombre)
    {
        $this->prdNombre = $prdNombre;

        return $this;
    }

    /**
     * Get the value of idCategoria
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    /**
     * Set the value of idCategoria
     *
     * @return  self
     */
    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }

    /**
     * Get the value of precio
     */
    public function getPrdPrecio()
    {
        return $this->prdPrecio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */
    public function setPrdPrecio($prdPrecio)
    {
        $this->prdPrecio;

        return $this;
    }

    /**
     * Get the value of presentacion
     */
    public function getPrdPresentacion()
    {
        return $this->prdPresentacion;
    }

    /**
     * Set the value of presentacion
     *
     * @return  self
     */
    public function setPresentacion($prdPresentacion)
    {
        $this->prdPresentacion = $prdPresentacion;

        return $this;
    }

    /**
     * Get the value of stock
     */
    public function getPrdStock()
    {
        return $this->prdStock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */
    public function setPrdStock($prdStock)
    {
        $this->prdStock = $prdStock;

        return $this;
    }

    /**
     * Get the value of imagen
     */
    public function getPrdImagen()
    {
        return $this->prdImagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */
    public function setPrdImagen($prdImagen)
    {
        $this->prdImagen = $prdImagen;

        return $this;
    }

    /**
     * Get the value of cantidad
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     *
     * @return  self
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }
}
