<?php
include_once '../controllers/categorias.controller.php';
include_once '../models/categorias.model.php';

class AjaxCategorias
{
    public $idCategorias;
    public function ajaxVerificarCategoria($categoria)
    {
        $respuesta = array("verificado" => ControllerCategoria::ctrVerificarCategoria($categoria));
        echo json_encode($respuesta);
    }
    public function ajaxGetDataCategoria()
    {
        $idCategoria = $this->idCategorias;
        $respuesta = ControllerCategoria::ctrGetDataCategoria($idCategoria);
        echo json_encode($respuesta);
    }
    public function ajaxEliminarCategoria()
    {
        $id = $this->idCategorias;
        $respuesta = ControllerCategoria::ctrDeleteCategoria($id);
        echo json_encode($respuesta);
    }

    public function ajaxAgregarCategoria($datos)
    {
        $res = array("verificado" => ControllerCategoria::ctrAddCategoria($datos));
        echo json_encode($res);
    }
    public function ajaxEditarCategoria($datos)
    {
        $res = array("verificado" => ControllerCategoria::ctrEditarCategoria($datos));
        echo json_encode($res);
    }
    public function ajaxGetCategorias(){
        $res = ControllerCategoria::ctrGetCategoria();
        echo json_encode($res);
    }
}
if (isset($_POST["idCategoria"])) {
    $getData = new AjaxCategorias();
    $getData->idCategorias = $_POST["idCategoria"];
    $getData->ajaxGetDataCategoria();
}
if (isset($_POST["nameCategoria"])) {
    $verficar = new AjaxCategorias();
    $categoria = $_POST["nameCategoria"];
    $verficar->ajaxVerificarCategoria($categoria);
}
if (isset($_POST["idEliminarCategoria"])) {
    $eliminar = new AjaxCategorias();
    $eliminar->idCategorias = $_POST["idEliminarCategoria"];
    $eliminar->ajaxEliminarCategoria();
}
if (isset($_POST["accion"])) {
    $datos = [];
    if ($_POST["accion"] == "Editar") {
        $datos = [
            "idCategoria" => $_POST["editIdCategoria"],
            "categoria" => $_POST["regCategoria"]
        ];
        $editar = new AjaxCategorias();
        $editar->ajaxEditarCategoria($datos);
    } else {
        $datos = [
            "categoria" => $_POST["regCategoria"]
        ];
        $agregar = new AjaxCategorias();
        $agregar->ajaxAgregarCategoria($datos);
     }
}
if(isset($_POST["categoria_get"])){
    $dameCategorias = new AjaxCategorias();
    $dameCategorias->ajaxGetCategorias();
}   
