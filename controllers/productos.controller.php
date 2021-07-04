<?php
class ControllerProducto{
    public static function ctrGetProductos(){
        return ModelProducto::mdlGetProductos();
    }
    public static function getLastProductPerCategoria($idCategoria){
        return ModelProducto::mdlGetLastProductPerCategoria($idCategoria);
    }
    public static function ctrEditarProducto($datos){
        return ModelProducto::mdlEditarProducto($datos);
    }
    public static function ctrAgregarProducto($datos){
        return ModelProducto::mdlAgregarProducto($datos);
    }
    public static function ctrGetInfoProducto($idProducto){
        return ModelProducto::mdlGetInfoProducto($idProducto);
    }
    public static function ctrDeleteProducto($idEliminarProducto){
        return ModelProducto::mdlDeleteProducto($idEliminarProducto);
    }
    public static function ctrGetAllProductos(){
        return ModelProducto::mdlGetAllProductos();
    }
}
?>