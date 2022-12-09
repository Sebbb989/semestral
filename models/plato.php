<?php
require_once("utils/bd.php");
class plato
{
    private $id;
    private $nombre_plato;
    private $descripcion_plato;
    private $precio_plato;
    private $foto_plato;
    private $_id_categoria;
    private $_id_usuario;
    private $fecha_creacion;
    private $fecha_actualizacion;

    public function __construct()
    {
    }

    public function listar_platos()
    {
        $conexion = bd::connection();
        $coleccion = $conexion->plato;
        $resultado = $coleccion->find(["_id_usuario" => ($this->_id_usuario)]);
        return $resultado;
    }
    
    public function insertar()
    {
        $conexion = bd::connection();
        $coleccion = $conexion->plato;
        try {
            $resultados = $coleccion->insertOne([
                "nombre_plato" => $this->nombre_plato,
                "descripcion_plato" => $this->descripcion_plato,
                "precio_plato" => $this->precio_plato,
                "foto_plato" => $this->foto_plato,
                "_id_categoria" => $this->_id_categoria,
                "_id_usuario" => $this->_id_usuario,
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
        $coleccion = $conexion->plato;
        try {
            $resultados = $coleccion->updateOne(
                ["_id" => new MongoDB\BSON\ObjectId($this->id)],
                ['$set' => [
                    // "nombre_plato" => $this->nombre_plato,
                    // "descripcion_plato" => $this->descripcion_plato,
                    // "precio_plato" => $this->precio_plato,
                    // "_id_categoria" => $this->_id_categoria,
                    // "_id_usuario" => $this->_id_usuario,
                    // "fecha_actualizacion" => date("Y-m-d")
                    "nombre_plato" => $this->nombre_plato,
                    "descripcion_plato" => $this->descripcion_plato,
                    "precio_plato" => $this->precio_plato,
                    "foto_plato" => $this->foto_plato,
                    "_id_categoria" => $this->_id_categoria,
                    "_id_usuario" => $this->_id_usuario,
                    "fecha_creacion" => date("Y-m-d"),
                    "fecha_actualizacion" => date("Y-m-d")
                ]]
            );
            return $resultados->getModifiedCount();
        } catch (Exception $e) {
            return 0;
        }
    }

    public function ver_mis_platos()
    {
        $conexion = bd::connection();
        $coleccion = $conexion->plato;
        $resultado = $coleccion->find(["_id_usuario" => $_SESSION["id_usuario"]]);

        foreach ($resultado as $r) {
            return $r;
        }
        return [];
    }

    public function eliminar()
    {
        $conexion = bd::connection();
        $coleccion = $conexion->plato;
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
     * Get the value of nombre_plato
     */
    public function getNombre_plato()
    {
        return $this->nombre_plato;
    }

    /**
     * Set the value of nombre_plato
     *
     * @return  self
     */
    public function setNombre_plato($nombre_plato)
    {
        $this->nombre_plato = $nombre_plato;

        return $this;
    }

    /**
     * Get the value of descripcion_plato
     */
    public function getDescripcion_plato()
    {
        return $this->descripcion_plato;
    }

    /**
     * Set the value of descripcion_plato
     *
     * @return  self
     */
    public function setDescripcion_plato($descripcion_plato)
    {
        $this->descripcion_plato = $descripcion_plato;

        return $this;
    }

    /**
     * Get the value of precio_plato
     */
    public function getPrecio_plato()
    {
        return $this->precio_plato;
    }

    /**
     * Set the value of precio_plato
     *
     * @return  self
     */
    public function setPrecio_plato($precio_plato)
    {
        $this->precio_plato = $precio_plato;

        return $this;
    }

    /**
     * Get the value of _id_categoria
     */
    public function get_id_categoria()
    {
        return $this->_id_categoria;
    }

    /**
     * Set the value of _id_categoria
     *
     * @return  self
     */
    public function set_id_categoria($_id_categoria)
    {
        $this->_id_categoria = $_id_categoria;

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

    /**
     * Get the value of foto_plato
     */
    public function getFoto_plato()
    {
        return $this->foto_plato;
    }

    /**
     * Set the value of foto_plato
     *
     * @return  self
     */
    public function setFoto_plato($foto_plato)
    {
        $this->foto_plato = $foto_plato;

        return $this;
    }
}
