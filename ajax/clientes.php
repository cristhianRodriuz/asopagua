<?php
include_once '../controllers/clientes.controller.php';
include_once '../models/clientes.model.php';
class AjaxClientes{
    public function ajaxVerificateEmail($email){
        $res = array("verificado" => ControllerClientes::ctrVerificateEmailCliente($email));
        echo json_encode($res);
    }
    public function ajaxVerificateDNI($email){
        $res = array("verificado" => ControllerClientes::ctrVerificateDNICliente($email));
        echo json_encode($res);
    }
    public function ajaxUpdateCliente($datos){
        $res= array("verificado" => ControllerClientes::ctrEditarCliente($datos));
        echo json_encode($res);
    }
    public function ajaxAgregarCliente($datos){
        $res= array("verificado" => ControllerClientes::ctrAgregarCliente($datos));
        echo json_encode($res);
    }
    public function ajaxGetInfoCliente($idCliente){
        $res= ControllerClientes::ctrGetDataCliente($idCliente);
        echo json_encode($res);
    }
    public function ajaxEliminarCliente($idCliente){
        $res = ControllerClientes::ctrDeleteCliente($idCliente);
        echo json_encode($res);
    }
    public function ajaxVerifyDataCliente($dniVerificate,$emailVerificate){
        $res = ControllerClientes::ctrVerifyDataCliente($dniVerificate,$emailVerificate);
        echo json_encode($res);
    }
}
if(isset($_POST["emailCliente"])){
    $verificarEmail = new AjaxClientes();
    $verificarEmail->ajaxVerificateEmail($_POST["emailCliente"]);
}
if(isset($_POST["dniCliente"])){
    $verificarDNI = new AjaxClientes();
    $verificarDNI->ajaxVerificateDNI($_POST["dniCliente"]);
}
if(isset($_POST["idEditCliente"])){
    $dataCliente = new AjaxClientes();
    $dataCliente->ajaxGetInfoCliente($_POST["idEditCliente"]);
}
if(isset($_POST["regNombreCliente"])){
    $datos = [];
    $actionCliente = new AjaxClientes();
    if(isset($_POST["editIdCliente"])){
        $datos = [
            "idCliente" => $_POST["editIdCliente"],
            "regNombreCliente" => $_POST["regNombreCliente"],
            "regApellidoCliente" => $_POST["regApellidoCliente"],
            "regDNICliente" => $_POST["regDNICliente"],
            "regEmailCliente" => $_POST["regEmailCliente"],
            "regProvinciaCliente" => $_POST["regProvinciaCliente"],
            "regCantonCliente" => $_POST["regCantonCliente"],
            "regParroquiaCliente" => $_POST["regParroquiaCliente"],
            "regDireccionCliente" => $_POST["regDireccionCliente"],
            "regTelefonoCliente" => $_POST["regTelefonoCliente"],
            "regCelularCliente" => $_POST["regCelularCliente"]
        ];
        $actionCliente->ajaxUpdateCliente($datos);
    }else{
        $datos = [
            "regNombreCliente" => $_POST["regNombreCliente"],
            "regApellidoCliente" => $_POST["regApellidoCliente"],
            "regDNICliente" => $_POST["regDNICliente"],
            "regEmailCliente" => $_POST["regEmailCliente"],
            "regProvinciaCliente" => $_POST["regProvinciaCliente"],
            "regCantonCliente" => $_POST["regCantonCliente"],
            "regParroquiaCliente" => $_POST["regParroquiaCliente"],
            "regDireccionCliente" => $_POST["regDireccionCliente"],
            "regTelefonoCliente" => $_POST["regTelefonoCliente"],
            "regCelularCliente" => $_POST["regCelularCliente"]
        ];
        $actionCliente->ajaxAgregarCliente($datos);
    }

}
if(isset($_POST["idEliminarCliente"])){
    $eliminarCliente = new AjaxClientes();
    $eliminarCliente->ajaxEliminarCliente($_POST["idEliminarCliente"]);
}
if(isset($_POST["verifiyDNI"])){
    $dniVerificate = $_POST["verifiyDNI"];
    $emailVerificate = $_POST["verifyEmail"];
    
    $verifiyDataCliente = new AjaxClientes();
    $verifiyDataCliente->ajaxVerifyDataCliente($dniVerificate,$emailVerificate);
}