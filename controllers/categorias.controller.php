<?php
class ControllerCategoria{
    public static function ctrGetCategoria(){
        return ModelCategoria::mdlGetCategorias();
    }
    public static function ctrVerificarCategoria($categoria){
        return  ModelCategoria::mdlVerificarCategoria($categoria);
    }
    public static function ctrGetDataCategoria($idCategoria){
        return  ModelCategoria::mdlGetDataCategoria($idCategoria);
    }
    public static function ctrDeleteCategoria($idCategoria){
        return  ModelCategoria::mdlDeleteCategoria($idCategoria);
    }
    public static function ctrAddCategoria($datos){
        return  ModelCategoria::mdlAddNewCategoria($datos);
    }
    public static function ctrEditarCategoria($datos){
        return  ModelCategoria::mdlEditarCategoria($datos);
    }
}
?>