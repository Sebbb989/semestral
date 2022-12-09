<?php
require_once("utils/seg.php");
require_once("models/pagos_paypal.php");
class pagos_paypal_controller
{
    public static function registar_notificacion()
    {
        $pagos = new pagos_paypal();
        $pagos->registrar();

        if($pagos > 0){
            pagos_paypal_controller::retorno();
        }
    }

    public static function retorno()
    {
        header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Gracias por su pago, su cuenta se ha actualizado satisfactoriamente!!<br>Debes inicar sesion nuevamente para que los cambos sean aplicados");
    }

    public static function cancelar()
    {
        header("location:" . "index.php?c=" . seg::codificar("principal") . "&m=" . seg::codificar("mensaje") . "&msg=Has cancelado tu compra!!");
    }
}
