<?php
class ControllerNoticias{
    public static function ctrGetNoticias(){
        return ModelNoticias::mdlGetNoticias();
    }
    public static function ctrGetNoticia($idNoticia){
        return ModelNoticias::mdlGetNoticia($idNoticia);
    }
    public static function ctrAgregarNoticia($noticia){
        return ModelNoticias::mdlAddNoticias($noticia);
    }
    public static function ctrEditarNoticias($noticia){
        return ModelNoticias::mdlUpdateNoticias($noticia);
    }
    public static function ctrEliminarNoticias($idEliminarNoticia){
        return ModelNoticias::mdlEliminarNoticias($idEliminarNoticia);
    }

}