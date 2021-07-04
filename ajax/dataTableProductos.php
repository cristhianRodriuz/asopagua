<?php
include_once '../controllers/productos.controller.php';
include_once '../models/productos.model.php';
class TablaProductos
{
    public function mostrarTablaProductos()
    {
        $respuesta = ControllerProducto::ctrGetProductos();
        if(count($respuesta) == 0){
            echo '{"data" : []}';
            return;
        }
        $datosJson = '{"data":[';
        for($i  = 0; $i < count($respuesta); $i++){
            if($respuesta[$i]["stock"] <= 10){
                $stock = "<button class='btn btn-danger' style='font-size:12px;'>" . $respuesta[$i]["stock"]. "</button>";
            }else if($respuesta[$i]["stock"] > 11 && $respuesta[$i]["stock"] <= 15){
                $stock = "<button class='btn btn-warning' style='font-size:12px;'>".$respuesta[$i]["stock"]."</button>";
            }else{
                $stock = "<button class='btn btn-success' style='font-size:12px;'>".$respuesta[$i]["stock"]."</button>";

            }
            $boton = "<button class='btn btn-warning btnAction' idProducto='" . $respuesta[$i]["id"] . "' data-toggle='modal' data-target='#modalProducto'><i class='fas fa-edit'></i></button>";
            $datosJson.='[
                "'.$respuesta[$i]["id"].'",
                "'.$respuesta[$i]["codigo"].'",
                "'.$respuesta[$i]["nombre"].'",
                "'.$respuesta[$i]["descripcion"].'",
                "'.$respuesta[$i]["categoria"].'",
                "'.$stock.'",
                "$ '.$respuesta[$i]["precio_publico"].'",
                "$ '.$respuesta[$i]["precio_mayorista"].'",
                "'.$respuesta[$i]["d_precio_mayorista"].'",
                "$ '.$respuesta[$i]["precio_minorista"].'",
                "'.$respuesta[$i]["d_precio_minorista"].'",
                "'.$respuesta[$i]["fecha_add"].'",
                "'.$boton.'"
            ],';
        }
        $datosJson = substr($datosJson, 0, -1);
        $datosJson.=']}';
        echo $datosJson;
    }
}

$activarProductos = new TablaProductos();
$activarProductos->mostrarTablaProductos();
