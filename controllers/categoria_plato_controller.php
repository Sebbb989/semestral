<?php
require_once("utils/seg.php");
require_once("models/categoria_plato.php");
class categoria_plato_controller
{
    public static function mostrar()
    {
        if (!isset($_SESSION["id_usuario"])) {
            header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Notiene acceso a esta pantalla, debe acceder para continuar");
            exit();
        }
        $obj = new categoria_plato();
        $obj->set_id_usuario($_SESSION["id_usuario"]);
        $resultado = $obj->listar_categorias();
        require_once("views/template/header.php");
        require_once("views/template/navbar.php");
        require_once("views/categoria_plato/mostrar.php");
        require_once("views/template/footer.php");
    }

    public static function registro()
    {
        if (!isset($_SESSION["id_usuario"])) {
            header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Notiene acceso a esta pantalla, debe acceder para continuar");
            exit();
        }

        $obj = new usuario();
        $obj->setId($_SESSION["id_usuario"]);
        $resultados = $obj->ver_mis_datos();
        require_once("views/template/header.php");
        require_once("views/template/navbar.php");
        require_once("views/categoria_plato/registro.php");
        require_once("views/template/footer.php");
    }

    public static function modificar()
    {
        if (!isset($_SESSION["id_usuario"])) {
            header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Notiene acceso a esta pantalla, debe acceder para continuar");
            exit();
        }

        $id = $_GET["id"];
        $obj = new categoria_plato();
        $obj->setId($id);
        $resultado = $obj->buscar_categoria();

        require_once("views/template/header.php");
        require_once("views/template/navbar.php");
        require_once("views/categoria_plato/modificar.php");
        require_once("views/template/footer.php");
    }

    public static function insertar()
    {
        if ($_POST) {
            if (!isset($_POST["token"]) ||  !seg::validaSession($_POST["token"])) {
                echo "Acceso restringido";
                exit();
            }
            empty($_POST["txtDescripcion"]) ? $error[0] = "La descripcion es necesaria" : $descripcion = $_POST["txtDescripcion"];
            if (isset($error)) {
                $titulo = "Registro de categoria";
                require_once("views/template/header.php");
                require_once("views/template/navbar.php");
                require_once("views/categoria_plato/registro.php");
                require_once("views/template/footer.php");
            } else {
                $descripcion = filter_var($descripcion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $obj = new categoria_plato();
                $obj->setNombre_categoria($descripcion);
                $obj->set_id_usuario($_SESSION["id_usuario"]);
                $resultados = $obj->insertar();
                if (isset($resultados)) {
                    header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Se ha registrado satisfactoriamente la categoria ");
                } else
                    header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=No se pudo registrar, intentelo nuevamente!");
            }
        }
    }


    public static function actualizar()
    {
        if ($_POST) {
            if (!isset($_POST["token"]) ||  !seg::validaSession($_POST["token"])) {
                echo "Acceso restringido";
                exit();
            }
            empty($_POST["txtDescripcion"]) ? $error[0] = "La descripcion es necesaria" : $descripcion = $_POST["txtDescripcion"];
            $id =  $_POST["_id"];

            if (isset($error)) {
                $titulo = "Registro de categoria";
                require_once("views/template/header.php");
                require_once("views/template/navbar.php");
                require_once("views/categoria_plato/modificar.php");
                require_once("views/template/footer.php");
            } else {
                $descripcion = filter_var($descripcion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $id = filter_var($id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $obj = new categoria_plato();
                $obj->setId($id);
                $obj->setNombre_categoria($descripcion);
                $obj->set_id_usuario($_SESSION["id_usuario"]);
                $resultados = $obj->actualizar();
                if (isset($resultados)) {
                    header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Se ha registrado satisfactoriamente la categoria ");
                } else
                    header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=No se pudo registrar, intentelo nuevamente!");
            }
        }
    }



    public static function eliminar()
    {
        $id =  $_GET["id"];
        $id = filter_var($id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $obj = new categoria_plato();
        $obj->setId($id);
        $resultados = $obj->eliminar();
        if ($resultados > 0)
            header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Se ha eliminado  la categoria ");
        else
            header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=No se pudo eliminar, intentelo nuevamente!");
    }
}
