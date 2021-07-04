<?php
include_once '../controllers/pedidos.controller.php';
include_once '../models/pedidos.model.php';
class TablaPedidos
{
    public function mostrarTablaPedidos($filter)
    {
        $respuesta = ControllerPedidos::ctrGetPedidosFilter($filter);
        if(count($respuesta) == 0){
            echo '{"data" : []}';
            return;
        }
        $datosJson = '{"data":[';
        for($i  = 0; $i < count($respuesta); $i++){
            $classEstado = '';
            $boton = "<button class='btn btn-warning btnAction' idCliente='" . $respuesta[$i]["id_cliente"] ."' idPedido='" . $respuesta[$i]["id"] . "' data-toggle='modal' data-target='#modalActionPedido'><i class='fas fa-edit'></i></button>";
            if($respuesta[$i]["estado"] == "Pendiente"){
                $classEstado = "btn-danger";
            }else if($respuesta[$i]["estado"] == "Verificado"){
                $classEstado = "btn-info";
            }else if($respuesta[$i]["estado"] == "Enviado"){
                $classEstado = "btn-success";
            }
            $estado = "<button class='btn $classEstado' style='font-size:12px;'>" . $respuesta[$i]["estado"] . "</button>";
            $datosJson.='[
                "'.$respuesta[$i]["id"].'",
                "'.$respuesta[$i]["codigo"].'",
                "'.$respuesta[$i]["nombre"]. ' ' . $respuesta[$i]["apellido"] .'",
                "'.$respuesta[$i]["total"].'",
                "'.$respuesta[$i]["fecha_creacion"].'",
                "'.$estado.'",
                "'.$boton.'"
            ],';
        }
        $datosJson = substr($datosJson, 0, -1);
        $datosJson.=']}';
        echo $datosJson;
    }
}
if(isset($_POST["filter"])){
    $activarTable = new TablaPedidos();
    $activarTable->mostrarTablaPedidos($_POST["filter"]);
}
