<?php
    require_once("controllers/principal_controller.php");
    require_once("controllers/subscripcion_controller.php");
    require_once("controllers/usuario_controller.php");
    require_once("controllers/pagos_paypal_controller.php");
    require_once("controllers/categoria_plato_controller.php");
    require_once("controllers/plato_controller.php");
    require_once("utils/seg.php");

    // phpinfo();

    if (count($_GET)==0)
        call_user_func("principal_controller::index");
    else {
        $controlador = seg::decodificar($_GET["c"]);
        $metodo = seg::decodificar($_GET["m"]);
        call_user_func($controlador."_controller::".$metodo);
    }