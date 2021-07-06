<?php
include_once '../controllers/noticias.controller.php';
include_once '../models/noticias.model.php';
class TablaNoticias
{
    public function mostrarTableNoticias()
    {$respuesta = ControllerNoticias::ctrGetNoticias();
        if(count($respuesta) == 0){
            echo '{"data" : []}';
            return;
        }
        $datosJson = '{"data":[';
        for($i  = 0; $i < count($respuesta); $i++){
            $boton = "<button class='btn btn-warning btnAction' idNoticia='" . $respuesta[$i]["id"] . "' data-toggle='modal' data-target='#modalActionNoticias'><i class='fas fa-edit'></i></button>";
            $datosJson.='[
                "'.$respuesta[$i]["id"].'",
                "'.$respuesta[$i]["titulo"].'",
                "'.$respuesta[$i]["descripcion"].'",
                "'.$respuesta[$i]["publicador"].'",
                "'.$respuesta[$i]["fecha_creacion"].'",
                "'.$boton.'"
            ],';
        }
        $datosJson = substr($datosJson, 0, -1);
        $datosJson.=']}';
        echo $datosJson;
    }
}

$mostrarNoticias = new TablaNoticias();
$mostrarNoticias->mostrarTableNoticias();