<?php
include_once '../controllers/clientes.controller.php';
include_once '../models/clientes.model.php';
class TablaClientes
{
    public function mostrarTablaClientes()
    {$respuesta = ControllerClientes::ctrGetClientes();
        if(count($respuesta) == 0){
            echo '{"data" : []}';
            return;
        }
        $datosJson = '{"data":[';
        for($i  = 0; $i < count($respuesta); $i++){
            $boton = "<button class='btn btn-warning btnAction' idCliente='" . $respuesta[$i]["id"] . "' data-toggle='modal' data-target='#modalActionCliente'><i class='fas fa-edit'></i></button>";
            $datosJson.='[
                "'.$respuesta[$i]["id"].'",
                "'.$respuesta[$i]["dni"].'",
                "'.$respuesta[$i]["nombre"].'",
                "'.$respuesta[$i]["apellido"].'",
                "'.$respuesta[$i]["celular"].'",
                "'.$respuesta[$i]["email"].'",
                "'.$respuesta[$i]["provincia"].'",
                "'.$respuesta[$i]["canton"].'",
                "'.$respuesta[$i]["parroquia"].'",
                "'.$boton.'"
            ],';
        }
        $datosJson = substr($datosJson, 0, -1);
        $datosJson.=']}';
        echo $datosJson;
    }
}

$activarProductos = new TablaClientes();
$activarProductos->mostrarTablaClientes();