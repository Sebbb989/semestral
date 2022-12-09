<?php
    require_once("utils/seg.php");
    class principal_controller {
        public static function index() {
            if (isset($_COOKIE["usurio"]))
            {
                $_SESSION["nombre"]=seg::decodificar($_COOKIE["nombre"]);
                $_SESSION["usurio"]=seg::decodificar($_COOKIE["usurio"]);
            }
            $titulo ="Pagina Principal ";
            require_once("views/template/header.php");
            require_once("views/template/navbar.php");
            require_once("views/principal/index.php");
            require_once("views/template/footer.php");
        }  
        
        public static function error(){
            require_once("views/template/header.php");
            require_once("views/template/navbar.php");
            require_once("views/principal/error.php");
            require_once("views/template/footer.php");
        }

        public static function mensaje(){
            $mensaje=$_GET["msg"];
            require_once("views/template/header.php");
            require_once("views/template/navbar.php");
            require_once("views/principal/mensajes.php");
            require_once("views/template/footer.php");
        }
    }
