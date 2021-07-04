<?php
include_once '../controllers/productos.controller.php';
include_once '../models/productos.model.php';
class AjaxProductos{
    public function getLastProductPerCategoria($idCategoria){
        $res = ControllerProducto::getLastProductPerCategoria($idCategoria);
        echo json_encode($res);
    }
    public function ajaxEditarProductos($datos){
        $res = array("verificado" => ControllerProducto::ctrEditarProducto($datos));
        echo json_encode($res);
    }
    public function ajaxAgregarProductos($datos){
        $res = array("verificado" => ControllerProducto::ctrAgregarProducto($datos));
        echo json_encode($res);
    }
    public function ajaxGetInfoProducto($idProducto){
        $res = ControllerProducto::ctrGetInfoProducto($idProducto);
        echo json_encode($res);
    }
    public function ajaxDeleteProducto($idEliminarProducto){
        $res = ControllerProducto::ctrDeleteProducto($idEliminarProducto);
        echo json_encode($res);
    }
    public function ajaxGetAllProductos(){
        $res = ControllerProducto::ctrGetAllProductos();
        echo json_encode($res);
    }   
}
if(isset($_POST["idProducto"])){
    $productos = new AjaxProductos();
    $productos->ajaxGetInfoProducto($_POST["idProducto"]);
}
if (isset($_POST["uploadImage"])) {
    $productos = new AjaxProductos();
    $datos = [];
    if ($_POST["uploadImage"] == "SI") {
        if (isset($_FILES["regProductImage"])) {
            $archivo = $_FILES['regProductImage']['name'];
            if (isset($archivo) && $archivo != "") {
                $tipo = $_FILES["regProductImage"]["type"];
                $size = $_FILES["regProductImage"]["size"];
                $temp = $_FILES["regProductImage"]["tmp_name"];
                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg" || strpos($tipo, "png")) && ($size < 2000000)))) {
                    error_log("ERROR. La extension o tamaño del archivo no es correcta");
                } else {
                    if (move_uploaded_file($temp, '../uploads/productos/' . $archivo)) {
                        array_push($datos, $archivo);
                        chmod('../uploads/productos/' . $archivo, 0777);
                    }
                }
            }
        }
    } 
    else {
        array_push($datos, $_POST["productDefault"]);
    }
    if (isset($_POST["editIdProducto"])) {
        array_push($datos,[
            "id" => $_POST["editIdProducto"],
            "regIdCategoria" => $_POST["regIdCategoria"],
            "regCodigo" => $_POST["regCodigo"],
            "regNombreProducto" => $_POST["regNombreProducto"],
            "regDescProducto" => $_POST["regDescProducto"],
            "regStock" => $_POST["regStock"],
            "regPrecioPublico" => $_POST["regPrecioPublico"],
            "regPrecioMayorista" => $_POST["regPrecioMayorista"],
            "regDetalleMayorista" => $_POST["regDetalleMayorista"],
            "regPrecioMinorista" => $_POST["regPrecioMinorista"],
            "regDetalleMinorista" => $_POST["regDetalleMinorista"]
        ]);
        $productos->ajaxEditarProductos($datos);
    } else {
        array_push($datos,[
            "regIdCategoria" => $_POST["regIdCategoria"],
            "regCodigo" => $_POST["regCodigo"],
            "regNombreProducto" => $_POST["regNombreProducto"],
            "regDescProducto" => $_POST["regDescProducto"],
            "regStock" => $_POST["regStock"],
            "regPrecioPublico" => $_POST["regPrecioPublico"],
            "regPrecioMayorista" => $_POST["regPrecioMayorista"],
            "regDetalleMayorista" => $_POST["regDetalleMayorista"],
            "regPrecioMinorista" => $_POST["regPrecioMinorista"],
            "regDetalleMinorista" => $_POST["regDetalleMinorista"]
        ]);

        $productos->ajaxAgregarProductos($datos);
    }
}
if(isset($_POST["productsCategoria"])){
    $idCategoria = $_POST["productsCategoria"];
    $lastProduct = new AjaxProductos();
    $lastProduct->getLastProductPerCategoria($idCategoria);
}
if(isset($_POST["idEliminarProducto"])){
    $productos = new AjaxProductos();
    $productos->ajaxDeleteProducto($_POST["idEliminarProducto"]);
}
if(isset($_POST["getProductos"])){
    $getAllProductos = new AjaxProductos();
    $getAllProductos->ajaxGetAllProductos();
}