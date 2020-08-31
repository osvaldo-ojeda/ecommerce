<?php

class Categoria
{

    private $idCategoria;
    private $catNombre;

    public function listarCategorias()
    {
        $link = Conexion::conectar();
        $sql = "SELECT 
            idCategoria,
            catNombre
            FROM  categorias";
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $categorias = $stmt->fetchAll();
        return $categorias;
    }

    public function agregarCategoria()
    {
        $catNombre = $_POST['catNombre'];
        $link = Conexion::conectar();
        $sql = "INSERT INTO categorias(catNombre) 
            VALUES (:catNombre)";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':catNombre', $catNombre, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $this->setCatNombre($catNombre);
            $this->setIdCategoria($link->lastInsertId());
            return TRUE;
        }

        return FALSE;
    }



    public function verCategoriaPorId()
    {

        $idCategoria = $_GET['idCategoria'];
        $link = Conexion::conectar();
        $sql = "SELECT idCategoria,
            catNombre
            FROM  categorias
            WHERE idCategoria=" . $idCategoria;
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $categoria = $stmt->fetch();
        return $categoria;
    }

    public function modificarCategoria()
    {

        $idCategoria = $_POST['idCategoria'];
        $catNombre = $_POST['catNombre'];
        $link = Conexion::conectar();
        $sql = "UPDATE categorias
              SET catNombre=:catNombre
              WHERE idCategoria=:idCategoria";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_INT);
        $stmt->bindParam(':catNombre', $catNombre, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $this->setCatNombre($catNombre);
            $this->setIdCategoria($idCategoria);
            return TRUE;
        }
        return FALSE;
    }

    public function eliminarCategoria()
    {
        $idCategoria = $_POST['idCategoria'];
        $catNombre = $_POST['catNombre'];
        $link = Conexion::conectar();
        $sql = "DELETE FROM categorias
              WHERE idCategoria=" . $idCategoria;
        $stmt = $link->prepare($sql);
        if ($stmt->execute()) {
            $this->setIdCategoria($idCategoria);
            $this->setCatNombre($catNombre);
            return TRUE;
        }
        return FALSE;
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
     * Get the value of catNombre
     */
    public function getCatNombre()
    {
        return $this->catNombre;
    }

    /**
     * Set the value of catNombre
     *
     * @return  self
     */
    public function setCatNombre($catNombre)
    {
        $this->catNombre = $catNombre;

        return $this;
    }
}
