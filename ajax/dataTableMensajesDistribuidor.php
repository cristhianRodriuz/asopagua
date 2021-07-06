<?php
include_once '../controllers/mensajes.controller.php';
include_once '../models/mensajes.model.php';
class TablaMensajes
{
    public function mostrarTableMensajes()
    {$respuesta = ControllerMensajes::crtGetMensajes();
        if(count($respuesta) == 0){
            echo '{"data" : []}';
            return;
        }
        $datosJson = '{"data":[';
        for($i  = 0; $i < count($respuesta); $i++){
            $boton = "<button class='btn btn-warning btnAction' idMensaje='" . $respuesta[$i]["id"] . "' data-toggle='modal' data-target='#modalActionMensaje'><i class='fas fa-edit'></i></button>";
            $datosJson.='[
                "'.$respuesta[$i]["id"].'",
                "'.$respuesta[$i]["nombres"].'",
                "'.$respuesta[$i]["telefono"].'",
                "'.$respuesta[$i]["email"].'",
                "'.$respuesta[$i]["mensaje"].'",
                "'.$respuesta[$i]["fecha_creacion"].'",
                "'.$boton.'"
            ],';
        }
        $datosJson = substr($datosJson, 0, -1);
        $datosJson.=']}';
        echo $datosJson;
    }
}

$mostrarMensajes = new TablaMensajes();
$mostrarMensajes->mostrarTableMensajes();