<?php
class ControllerMensajes{
    public static function crtGetMensajes(){
        return ModelMensajes::mdlGetMensajes();
    }
    public static function crtGetMensaje($idMensaje){
        return ModelMensajes::mdlGetMensaje($idMensaje);
    }
    public static function ctrDeleteMensaje($idMensaje){
        return ModelMensajes::mdlDeleteMensaje($idMensaje);
    }
}
