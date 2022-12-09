<?php
require_once("utils/seg.php");
require_once("utils/utils.php");
require_once("models/usuario.php");
require_once("models/categoria_plato.php");
require_once("models/plato.php");
class usuario_controller
{

    public static function registro()
    {
        require_once("views/template/header.php");
        require_once("views/template/navbar.php");
        require_once("views/usuario/registro.php");
        require_once("views/template/footer.php");
    }

    public static function insertar()
    {
        if ($_POST) {
            if (!isset($_POST["token"]) ||  !seg::validaSession($_POST["token"])) {
                echo "Acceso restringido";
                exit();
            }

            empty($_POST["txtUsuario"]) ? $error[0] = "El nombre de usuario es necesario" : $usuario = $_POST["txtUsuario"];
            empty($_POST["txtCorreo"]) ? $error[1] = "El correo de contacto es necesario" : $correo = $_POST["txtCorreo"];
            empty($_POST["txtPassword"]) ? $error[2] = "El Password es obligatorio" : $password = $_POST["txtPassword"];
            !($_POST["txtPassword2"] == $_POST["txtPassword"]) ? $error[3] = "Los password no coinciden" : "";
            $nombre_contacto = $_POST["txtNombre"];
            $nombre_empresa = $_POST["txtNombreEmpresa"];
            empty($_POST["txtCuentaPaypal"]) ? $error[4] = "La cuenta de Paypal es obligatoria" : $cuenta_paypal = $_POST["txtCuentaPaypal"];

            if (isset($error)) {
                $titulo = "Registro de Usuario";
                require_once("views/template/header.php");
                require_once("views/template/navbar.php");
                require_once("views/usuario/registro.php");
                require_once("views/template/footer.php");
            } else {
                $usuario = filter_var($usuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $correo = filter_var($correo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $nombre_contacto = filter_var($nombre_contacto, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $nombre_empresa = filter_var($nombre_empresa, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $cuenta_paypal = filter_var($cuenta_paypal, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $obj = new usuario();
                $obj->setUsuario($usuario);
                $obj->setCorreo($correo);
                $obj->setPassword($password);
                $obj->setNombre_contacto($nombre_contacto);
                $obj->setNombre_restaurante($nombre_empresa);
                $obj->setCuenta_paypal($cuenta_paypal);
                $resultados = $obj->insertar();
                if (isset($resultados)) {
                    utils::enviarcorreo($resultados->getCorreo(), $resultados->getId());
                    header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Se ha registrado satisfactoriamente <br>Revise su correo para activar la cuenta y continuar con el pago. <br><br>Gracias");
                } else
                    header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=El usuario y/o correo ya estan registrados, favor intente nuevamente!");
            }
        }
    }

    public static function modificar()
    {
        if ($_POST) {
            if (!isset($_POST["token"]) ||  !seg::validaSession($_POST["token"])) {
                echo "Acceso restringido";
                exit();
            }

            empty($_POST["txtCorreo"]) ? $error[1] = "El correo de contacto es necesario" : $correo = $_POST["txtCorreo"];
            $nombre_contacto = $_POST["txtNombre"];
            $nombre_empresa = $_POST["txtNombreEmpresa"];
            empty($_POST["txtCuentaPaypal"]) ? $error[2] = "La cuenta de Paypal es obligatoria" : $cuenta_paypal = $_POST["txtCuentaPaypal"];
            $logo_restaurante = utils::subir_archivo($_FILES["imgLogo"]["tmp_name"],$_FILES["imgLogo"]["name"], "uploads");
            $imagen_fondo = utils::subir_archivo($_FILES["imgFondo"]["tmp_name"],$_FILES["imgFondo"]["name"], "uploads");

            // $logo_restaurante = $_POST["imgLogo"];
            // $imagen_fondo = $_POST["imgFondo"];

            if (isset($error)) {
                $titulo = "Registro de Usuario";
                require_once("views/template/header.php");
                require_once("views/template/navbar.php");
                require_once("views/usuario/modificar_cuenta.php");
                require_once("views/template/footer.php");
            } else {
                $correo = filter_var($correo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $nombre_contacto = filter_var($nombre_contacto, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $nombre_empresa = filter_var($nombre_empresa, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $cuenta_paypal = filter_var($cuenta_paypal, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $obj = new usuario();
                $obj->setId($_SESSION["id_usuario"]);
                $obj->setCorreo($correo);
                $obj->setNombre_contacto($nombre_contacto);
                $obj->setNombre_restaurante($nombre_empresa);
                $obj->setCuenta_paypal($cuenta_paypal);
                $obj->setLogo_empresa($logo_restaurante);
                $obj->setImagen_fondo($imagen_fondo);

                $resultados = $obj->actualizar_datos_generales();
                if (isset($resultados)) {
                    header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Se ha modificado satisfactoriamente su cuenta <br><br>Gracias");
                } else
                    header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=No se pudo actualizar, intentelo nuevamente!");
            }
        }
    }

    public static function cambiar_contra()
    {
        if ($_POST) {
            

            $password = $_POST["password"];
            $newpassword = $_POST["newPassword"];
            $newpassword1 = $_POST["newPassword1"];
            
            $obj = new usuario();
            $obj->setId($_SESSION["id_usuario"]);
            // $obj->setPassword($password);
            if ($newpassword == $newpassword1){
            $obj->setNewpassword($newpassword);
            }else {
                header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=las contraseñas no coinciden.");
                exit();
            }
            $resultado = $obj->valida_contrasena($password);

            // if (count($resultado) > 0){
            if(count($resultado) > 0){

            $resultados = $obj->actualizar_contrasena($newpassword);
            if (isset($resultados)) {
                header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Se ha modificado satisfactoriamente su cuenta <br><br>Gracias");
            } else
                header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=No se pudo actualizar, intentelo nuevamente!");
        
            }else {
                header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Su contraseña es incorrecta.");
            }    
        }
    }

    public static function activar()
    {
        $obj = new usuario();
        $obj->setId($_GET["s"]);
        $resultado = $obj->activar_usuario();
        if ($resultado == 1) {
            header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Ya has activado tu cuenta, puedes entrar");
        } else
            header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=No se pudo actiivar tu cuenta. Intenta más tarde");
    }

    public static function login()
    {
        require_once("views/template/header.php");
        require_once("views/template/navbar.php");
        require_once("views/usuario/login.php");
        require_once("views/template/footer.php");
    }

    public static function modificar_cuenta()
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
        require_once("views/usuario/modificar_cuenta.php");
        require_once("views/template/footer.php");
    }

    public static function modificar_contrasena()
    {
        if (!isset($_SESSION["id_usuario"])) {
            header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Notiene acceso a esta pantalla, debe acceder para continuar");
            exit();
        }

        require_once("views/template/header.php");
        require_once("views/template/navbar.php");
        require_once("views/usuario/modificar_contrasena.php");
        require_once("views/template/footer.php");
    }

    public static function vercodigoqr()
    {
        if (!isset($_SESSION["id_usuario"])) {
            header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Notiene acceso a esta pantalla, debe acceder para continuar");
            exit();
        }

        $url= $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . "/index.php?c=" . seg::codificar("usuario") . "&m=" . seg::codificar("ver_menu") . "&id=" . $_SESSION["id_usuario"] ;
        
        require_once("views/template/header.php");
        require_once("views/template/navbar.php");
        require_once("views/usuario/vercodigoqr.php");
        require_once("views/template/footer.php");
    }

    public static function validar_usuario()
    {
        if ($_POST) {
            if (!isset($_POST["token"]) ||  !seg::validaSession($_POST["token"])) {
                echo "Acceso restringido";
                exit();
            }
            $obj = new usuario();
            $obj->setUsuario($_POST["txtUsuario"]);
            $obj->setPassword($_POST["txtPassword"]);
            $resultado = $obj->valida_usuario();

            if (count($resultado) > 0) {
                if ($resultado->status == "0") {
                    header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=El usuario todavía no ha confirmado el correo");
                    exit();
                }
                $_SESSION["nombre_contacto"] =  $resultado["nombre_contacto"];
                $_SESSION["usuario"] = $resultado["usuario"];
                $_SESSION["correo"] = $resultado["correo"];
                $_SESSION["id_usuario"] = $resultado["_id"];
                $_SESSION["monto_pago"] = $resultado["monto_pago"];
                $_SESSION["cuenta_paypal"] = $resultado["cuenta_paypal"];
                $_SESSION["tipo_usuario"] = $resultado["tipo_usuario"];
                if (isset($_POST["chkRecordar"])) {
                    setcookie(seg::codificar("nombre"),  seg::codificar($resultado["nombre"]), time() + 40);
                    setcookie(seg::codificar("usuario"),  seg::codificar($resultado["usuario"]), time() + 40);
                }
                header("location:index.php");
            } else
                header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Usuario o Contraseña incorrectos");
        }
    }

    public static function cerrar_sesion()
    {
        session_destroy();
        header("location:index.php");
    }


    public static function ver_menu()
    {
        $id_usuario = $_GET["id"];
        $objUsuario  = new usuario();
        $objUsuario->setId($id_usuario);
        $datos_usuario = $objUsuario->ver_mis_datos();
        $nombre_empresa = $datos_usuario["nombre_restaurante"];
        $logo = $datos_usuario["logo_empresa"];
        $imagen_fondo = $datos_usuario["imagen_fondo"];
        $objcategorias = new categoria_plato();
        $objcategorias->set_id_usuario(new MongoDB\BSON\ObjectId($id_usuario));
        $lista_categoria = $objcategorias->listar_categorias();
        foreach ($lista_categoria as $l)
            $listaCat[] = $l;
        $objplatos = new plato();
        $objplatos->set_id_usuario(new MongoDB\BSON\ObjectId($id_usuario));
        $lista_plato = $objplatos->listar_platos();
        foreach ($lista_plato as $p)
            $listaPlat[] = $p;
        require_once("views/template/header.php");
        require_once("views/usuario/ver_menu.php");
        require_once("views/template/footer.php");
    }

    public static function ver_pago()
    {
        $id_usuario = $_GET["id"];
        $objUsuario  = new usuario();
        $objUsuario->setId($id_usuario);
        $resultado = $objUsuario->ver_mis_pagos();

        require_once("views/template/header.php");
        require_once("views/usuario/ver_pago.php");
        require_once("views/template/footer.php");
        
    }

    public static function admin_ver_pago()
    {
        $objUsuario  = new usuario();
        $resultado = $objUsuario->admin_ver_mis_pagos();

        require_once("views/template/header.php");
        require_once("views/usuario/ver_pago.php");
        require_once("views/template/footer.php");
        
    }

    public static function admin_ver_usuarios()
    {
        $objUsuario  = new usuario();
        $resultado = $objUsuario->ver_usuarios();

        require_once("views/template/header.php");
        require_once("views/usuario/ver_usuarios.php");
        require_once("views/template/footer.php");
        
    }

    public function actMontop()
    {
        $monto_pago = $_POST["monto_pago"];

        $obj = new usuario();
                $obj->setId($_SESSION["id_usuario"]);
                $obj->setMonto_pago($monto_pago);

                $resultados = $obj->actMonto();
                if (isset($resultados)) {
                    header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Se ha modificado satisfactoriamente su cuenta <br><br>Gracias");
                } else
                    header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=No se pudo actualizar, intentelo nuevamente!");
    }
}
