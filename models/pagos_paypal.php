<?php
require_once("utils/bd.php");
require_once("models/usuario.php");

class pagos_paypal
{
    // public function registrar($_peticion)
    // {
    //     $conexion = bd::connection();
    //     $coleccion = $conexion->pagos_paypal;
    //     try {
    //         $resultados = $coleccion->insertOne($_peticion);
    //         $coleccion = $conexion->usuario;
    //         try {
    //             $resultados = $coleccion->updateOne(
    //                 ["cuenta_paypal" => $_peticion["payer_email"]],
    //                 ['$set' => [
    //                     "monto_pago" => $_peticion["payment_gross"]
    //                 ]]
    //             );
    //             $_SESSION["monto_pago"] = $_peticion["payment_gross"];
    //             return $resultados->getModifiedCount();
    //         } catch (Exception $e) {
    //             return 0;
    //         }
    //     } catch (Exception $e) {
    //     }
    // }

    public function registrar(){
        $conexion = bd::connection();
        $coleccion = $conexion->pagos_paypal;

        $id_usuario = $_SESSION["id_usuario"];
        $usuario = $_SESSION["usuario"];
        $correo = $_SESSION["correo"];
        $cuenta_paypal = $_SESSION["cuenta_paypal"];
        $monto_pago = 49.99;

        $datos[] = [];
        $datos = array("id_usuario" => $id_usuario, "usuario" => $usuario, "correo" => $correo, "cuenta_paypal" => $cuenta_paypal, "monto_pago" => $monto_pago);

        try
        {
            $resultados = $coleccion->insertOne($datos);
            $coleccion = $conexion->usuario;
            try
            {
                $resultados = $coleccion->updateOne(
                    ["_id" => $id_usuario],
                    ['$set' => [
                        "monto_pago" => $monto_pago
                    ]]
                    );
                    return $resultados->getModifiedCount();
            }
            catch(Exception $e){
                return 0;
            }

        }
        catch(Exception $e)
        {

        }
    }

    // public function registrar($_peticion)
    // {
    //     $conexion = bd::connection();
    //     $coleccion = $conexion->pagos_paypal;
    //     try {
    //         $resultados = $coleccion->insertOne($_peticion);
    //         $coleccion = $conexion->usuario;
    //         try {
    //             $resultados = $coleccion->updateOne(
    //                 ["cuenta_paypal" => $_peticion["payer_email"]],
    //                 ['$set' => [
    //                     "monto_pago" => $_peticion["payment_gross"]
    //                 ]]
    //             );
    //             $_SESSION["monto_pago"] = $_peticion["payment_gross"];
    //             return $resultados->getModifiedCount();
    //         } catch (Exception $e) {
    //             return 0;
    //         }
    //     } catch (Exception $e) {
    //     }
    // }

    // public function registrar($_peticion)
    // {
    //     $conexion = bd::connection();
    //     $coleccion = $conexion->pagos_paypal;
    //     try {
    //         $resultados = $coleccion->insertOne($_peticion);
    //         $coleccion = $conexion->usuario;

    //         $correo = "sebaskazuto@gmail.com";
    //         $headers = "From: grupo5@ddinnova.info\r\n";
    //         $headers .= "MIME-Version: 1.0\r\n";
    //         $headers .= "Content-Type: text/html; charset=utf-8\r\n";

    //             echo mail($correo, "primer try", "<h1>paso primer try</h1>", $headers);
    //         try {
    //             $resultados = $coleccion->updateOne(
    //                 ["cuenta_paypal" => $_peticion["payer_email"]],
    //                 ['$set' => [
    //                     "monto_pago" => $_peticion["payment_gross"]
    //                 ]]
    //             );

    //             $correo = "sebaskazuto@gmail.com";
    //             $headers = "From: grupo5@ddinnova.info\r\n";
    //             $headers .= "MIME-Version: 1.0\r\n";
    //             $headers .= "Content-Type: text/html; charset=utf-8\r\n";

    //             echo mail($correo, "segundo try", "paso segundo try", $headers);

    //             $_SESSION["monto_pago"] = $_peticion["payment_gross"];
    //             return $resultados->getModifiedCount();
    //             } catch (Exception $e) {

    //                 $correo = "sebaskazuto@gmail.com";
    //                 $headers = "From: grupo5@ddinnova.info\r\n";
    //                 $headers .= "MIME-Version: 1.0\r\n";
    //                 $headers .= "Content-Type: text/html; charset=utf-8\r\n";

    //                 echo mail($correo, "exception", $e, $headers);

    //                 return 0;
    //             }
    //         } catch (Exception $e) {

    //             $correo = "sebaskazuto@gmail.com";
    //             $headers = "From: grupo5@ddinnova.info\r\n";
    //                 $headers .= "MIME-Version: 1.0\r\n";
    //                 $headers .= "Content-Type: text/html; charset=utf-8\r\n";

    //                 echo mail($correo, "exception", $e, $headers);

    //         }
    // }
}
