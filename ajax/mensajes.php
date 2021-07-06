<?php
include_once '../controllers/mensajes.controller.php';
include_once '../models/mensajes.model.php';

class AjaxMensajes{
    public function ajaxGetMensaje($idMensaje){
        $res = ControllerMensajes::crtGetMensaje($idMensaje);
        echo json_encode($res);
    }
    public function ajaxDeleteMensaje($idMensaje){
        $res = array("verificado" => ControllerMensajes::ctrDeleteMensaje($idMensaje));
        echo json_encode($res);
    }
}
if(isset($_POST["getMensaje"])){
    $getMensaje = new AjaxMensajes();
    $getMensaje->ajaxGetMensaje($_POST["getMensaje"]);
}
if(isset($_POST["deleteMensaje"])){
    $deleteMensaje = new AjaxMensajes();
    $deleteMensaje->ajaxDeleteMensaje($_POST["deleteMensaje"]);
}