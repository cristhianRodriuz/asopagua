<?php
include_once '../controllers/categorias.controller.php';
include_once '../models/categorias.model.php';
class TablaCategorias
{
    public function mostrarTablaCategorias()
    {
        $respuesta = ControllerCategoria::ctrGetCategoria();
        if(count($respuesta) == 0){
            echo '{"data" : []}';
            return;
        }
        $datosJson = '{"data":[';
        for($i  = 0; $i < count($respuesta); $i++){
            $boton = "<button class='btn btn-warning btnAction' idCategorias='" . $respuesta[$i]["id"] . "' data-toggle='modal' data-target='#modalCategoria'><i class='fas fa-edit'></i></button>";
            $datosJson.='[
                "'.$respuesta[$i]["id"].'",
                "'.$respuesta[$i]["categoria"].'",
                "'.$boton.'"
            ],';
        }
        $datosJson = substr($datosJson, 0, -1);
        $datosJson.=']}';
        echo $datosJson;
    }
}

$activarProductos = new TablaCategorias();
$activarProductos->mostrarTablaCategorias();
