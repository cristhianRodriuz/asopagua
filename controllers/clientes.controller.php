<?php
class ControllerClientes{
    public static function ctrGetClientes(){
        return  ModelClientes::mdlGetClientes();
    }
    public static function ctrVerificateEmailCliente($email){
        return ModelClientes::mdlVerificateEmail($email);
    }
    public static function ctrVerificateDNICliente($dni){
        return ModelClientes::mdlVerificateDNI($dni);
    }
    public static function ctrEditarCliente($datos){
        return ModelClientes::mdlEditarCliente($datos);
    }
    public static function ctrAgregarCliente($datos){
        return ModelClientes::mdlAgregarCliente($datos);
    }
    public static function ctrGetDataCliente($datos){
        return ModelClientes::mdlGetDataCliente($datos);
    }
    public static function ctrDeleteCliente($idCliente){
        return ModelClientes::mdlDeleteCliente($idCliente);
    }
    public static function ctrVerifyDataCliente($dniVerificateCliente,$emailVerificateCliente){
        return ModelClientes::mdlVerificateCliente($dniVerificateCliente,$emailVerificateCliente);
    }
}