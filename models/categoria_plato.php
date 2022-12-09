<?php
require_once("utils/bd.php");
class categoria_plato
{
    private $id;
    private $_id_usuario;
    private $nombre_categoria;
    private $fecha_creacion;
    private $fecha_actualizacion;

    public function __construct()
    {
    }

    public function listar_categorias()
    {
        $conexion = bd::connection();
        $coleccion = $conexion->categoria_plato;
        $resultado = $coleccion->find(["_id_usuario" => ($this->_id_usuario)]);
        return $resultado;
    }
    public function buscar_categoria()
    {
        $conexion = bd::connection();
        $coleccion = $conexion->categoria_plato;
        $resultado = $coleccion->find(["_id" => new MongoDB\BSON\ObjectId($this->id)]);
        foreach ($resultado as $r)
            return $r;
    }


    public function insertar()
    {
        $conexion = bd::connection();
        $coleccion = $conexion->categoria_plato;
        try {
            $resultados = $coleccion->insertOne([
                "_id_usuario" => $this->_id_usuario,
                "nombre_categoria" => $this->nombre_categoria,
                "fecha_creacion" => date("Y-m-d"),
                "fecha_actualizacion" => date("Y-m-d")
            ]);
            $this->id = $resultados->getInsertedId();
            return $this;
        } catch (Exception $e) {
            return null;
        }
    }

    public function actualizar()
    {
        $conexion = bd::connection();
        $coleccion = $conexion->categoria_plato;
        try {
            $resultados = $coleccion->updateOne(
                ["_id" => new MongoDB\BSON\ObjectId($this->id)],
                ['$set' => [
                    "_id_usuario" => $this->_id_usuario,
                    "nombre_categoria" => $this->nombre_categoria,
                    "nombre_restaurante" => $this->nombre_restaurante,
                    "fecha_actualizacion" => date("Y-m-d")
                ]]
            );
            return $resultados->getModifiedCount();
        } catch (Exception $e) {
            return 0;
        }
    }

    public function eliminar()
    {
        $conexion = bd::connection();
        $coleccion = $conexion->categoria_plato;
        try {
            $resultados = $coleccion->deleteOne(
                ["_id" => new MongoDB\BSON\ObjectId($this->id)]
            );
            return $resultados->getDeletedCount();
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of _id_usuario
     */
    public function get_id_usuario()
    {
        return $this->_id_usuario;
    }

    /**
     * Set the value of _id_usuario
     *
     * @return  self
     */
    public function set_id_usuario($_id_usuario)
    {
        $this->_id_usuario = $_id_usuario;

        return $this;
    }

    /**
     * Get the value of nombre_categoria
     */
    public function getNombre_categoria()
    {
        return $this->nombre_categoria;
    }

    /**
     * Set the value of nombre_categoria
     *
     * @return  self
     */
    public function setNombre_categoria($nombre_categoria)
    {
        $this->nombre_categoria = $nombre_categoria;

        return $this;
    }

    /**
     * Get the value of fecha_creacion
     */
    public function getFecha_creacion()
    {
        return $this->fecha_creacion;
    }

    /**
     * Set the value of fecha_creacion
     *
     * @return  self
     */
    public function setFecha_creacion($fecha_creacion)
    {
        $this->fecha_creacion = $fecha_creacion;

        return $this;
    }

    /**
     * Get the value of fecha_actualizacion
     */
    public function getFecha_actualizacion()
    {
        return $this->fecha_actualizacion;
    }

    /**
     * Set the value of fecha_actualizacion
     *
     * @return  self
     */
    public function setFecha_actualizacion($fecha_actualizacion)
    {
        $this->fecha_actualizacion = $fecha_actualizacion;

        return $this;
    }
}
