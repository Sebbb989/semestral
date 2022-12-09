<?php
require_once("utils/seg.php");
require_once("utils/utils.php");
require_once("models/plato.php");
require_once("models/categoria_plato.php");
class plato_controller
{

    public static function mostrar()
    {
        if (!isset($_SESSION["id_usuario"])) {
            header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Notiene acceso a esta pantalla, debe acceder para continuar");
            exit();
        }
        if (isset($_GET["msg"])) $msg=$_GET["msg"];

        $obj = new plato();
        $obj->set_id_usuario($_SESSION["id_usuario"]);
        $resultado = $obj->listar_platos();

        require_once("views/template/header.php");
        require_once("views/template/navbar.php");
        require_once("views/plato/mostrar.php");
        require_once("views/template/footer.php");
    }

    public static function registro($error=[], $nombre="", $descripcion="", $precio="")
    {
        if (!isset($_SESSION["id_usuario"])) {
            header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Notiene acceso a esta pantalla, debe acceder para continuar");
            exit();
        }

        $obj = new categoria_plato();
        $obj->set_id_usuario($_SESSION["id_usuario"]);
        $lista_categoria = $obj->listar_categorias();

        $obj = new usuario();
        $obj->setId($_SESSION["id_usuario"]);
        $resultados = $obj->ver_mis_datos();
        require_once("views/template/header.php");
        require_once("views/template/navbar.php");
        require_once("views/plato/registro.php");
        require_once("views/template/footer.php");
    }

    public static function insertar()
    {
        if ($_POST) {
            if (!isset($_POST["token"]) ||  !seg::validaSession($_POST["token"])) {
                echo "Acceso restringido";
                exit();
            }

            $nombre="";
            $descripcion="";
            $precio="";
            empty($_POST["txtNombre"]) ? $error[0] = "El nombre es necesario" : $nombre = $_POST["txtNombre"];
            empty($_POST["txtDescripcion"]) ? $error[1] = "La descripcion es necesaria" : $descripcion = $_POST["txtDescripcion"];
            empty($_POST["txtPrecio"]) ? $error[2] = "El precio es necesario" : $precio = $_POST["txtPrecio"];
            ($_FILES["txtFoto"]["size"]==0)?$error[3] = "La foto es necesaria" : "";            
            
            $id_categoria = $_POST["lstCategoria"];
            if (isset($error)) {
                plato_controller::registro($error, $nombre, $descripcion, $precio);
            } else {
                $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $descripcion = filter_var($descripcion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $precio = filter_var($precio, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $foto = utils::subir_archivo($_FILES["txtFoto"]["tmp_name"],$_FILES["txtFoto"]["name"], "uploads");
                $id_categoria = filter_var($id_categoria, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $obj = new plato();
                $obj->setNombre_plato($nombre);
                $obj->setDescripcion_plato($descripcion);
                $obj->setPrecio_plato($precio);
                $obj->setFoto_plato($foto);
                $obj->set_id_categoria($id_categoria);
                $obj->set_id_usuario($_SESSION["id_usuario"]);
                $resultados = $obj->insertar();
                if (isset($resultados)) {
                    header("location:" . "index.php?c=" . seg::codificar("plato") . "&m=" . seg::codificar("mostrar") . "&msg=Se ha registrado satisfactoriamente el plato ");
                } else
                    header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=No se pudo registrar, intentelo nuevamente!");
            }
        }
    }

    public static function actualizar(){
        if ($_POST) {
            if (!isset($_POST["token"]) ||  !seg::validaSession($_POST["token"])) {
                echo "Acceso restringido";
                exit();
            }

            $nombre="";
            $descripcion="";
            $precio="";
            empty($_POST["txtNombre"]) ? $error[0] = "El nombre es necesario" : $nombre = $_POST["txtNombre"];
            empty($_POST["txtDescripcion"]) ? $error[1] = "La descripcion es necesaria" : $descripcion = $_POST["txtDescripcion"];
            empty($_POST["txtPrecio"]) ? $error[2] = "El precio es necesario" : $precio = $_POST["txtPrecio"];
            ($_FILES["txtFoto"]["size"]==0)?$error[3] = "La foto es necesaria" : "";            
            
            $id_categoria = $_POST["lstCategoria"];
            if (isset($error)) {
                plato_controller::registro($error, $nombre, $descripcion, $precio);
            } else {
                $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $descripcion = filter_var($descripcion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $precio = filter_var($precio, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $foto = utils::subir_archivo($_FILES["txtFoto"]["tmp_name"],$_FILES["txtFoto"]["name"], "uploads");
                $id_categoria = filter_var($id_categoria, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $obj = new plato();
                $obj->setId($_POST["id_plato"]);
                $obj->setNombre_plato($nombre);
                $obj->setDescripcion_plato($descripcion);
                $obj->setPrecio_plato($precio);
                $obj->setFoto_plato($foto);
                $obj->set_id_categoria($id_categoria);
                $obj->set_id_usuario($_SESSION["id_usuario"]);

                $resultados = $obj->actualizar();

                if (isset($resultados)) {
                    header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Se ha actualizado satisfactoriamente su plato <br><br>Gracias");
                } else
                    header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=No se pudo actualizar, intentelo nuevamente!");
            }
        }
    }

    public static function modificar()
    {
        if (!isset($_SESSION["id_usuario"])) {
            header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Notiene acceso a esta pantalla, debe acceder para continuar");
            exit();
        }

        $obj = new plato();
        $obj->setId($_SESSION["id_usuario"]);
        $resultados = $obj->ver_mis_platos();

        $objcat = new categoria_plato();
        $objcat->set_id_usuario($_SESSION["id_usuario"]);
        $lista_categoria = $objcat->listar_categorias();

        if(count($resultados) > 0){
            $id_plato = $resultados["_id"];
            $nombre_plato = $resultados["nombre_plato"];
            $descripcion_plato = $resultados["descripcion_plato"];
            $precio_plato = $resultados["precio_plato"];
            $foto_plato = $resultados["foto_plato"];
            $id_categoria = $resultados["_id_categoria"];
        require_once("views/template/header.php");
        require_once("views/template/navbar.php");
        require_once("views/plato/modificar.php");
        require_once("views/template/footer.php");
        }
    }


    public static function eliminar()
    {
        $id =  $_GET["id"];
        $id = filter_var($id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $obj = new plato();
        $obj->setId($id);
        $resultados = $obj->eliminar();
        if ($resultados > 0)
            header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Se ha eliminado  el plato ");
        else
            header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=No se pudo eliminar, intentelo nuevamente!");
    }
}
