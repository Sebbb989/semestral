<?php
require_once("utils/bd.php");
class subscripcion
{
    private $id;
    private $correo;
    private $fecha_registro;
    
    public function __construct()
    {
    }

    public function insertar()
    {
        $conexion = bd::connection();
        $coleccion = $conexion->subscripcion;
        try {
            $resultados = $coleccion->insertOne([
                "correo" => $this->correo,
                "fecha_registro" => date("Y-m-d H:i:s")
            ]);
            $this->id = $resultados->getInsertedId();
            return $this;
        } catch (Exception $e) {
            return null;
        }
    }

    public function ver_subscripciones()
    {
        $conexion = bd::connection();
        $coleccion = $conexion->subscripcion;
        $resultado = $coleccion->find();

        return $resultado;

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
     * Get the value of correo
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @return  self
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get the value of fecha_registro
     */
    public function getFecha_registro()
    {
        return $this->fecha_registro;
    }

    /**
     * Set the value of fecha_registro
     *
     * @return  self
     */
    public function setFecha_registro($fecha_registro)
    {
        $this->fecha_registro = $fecha_registro;

        return $this;
    }
}
