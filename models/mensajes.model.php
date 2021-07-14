<?php
require 'conexion.php';
date_default_timezone_set("America/Guayaquil");
class ModelMensajes{
    public static function mdlGetMensajes(){
        try{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM mensajes");
            $stmt->execute();
            return ($stmt->rowCount() > 0) ? $stmt->fetchAll() : [];
        }catch(PDOException $e){
            return [];
        }
    }
    public static function mdlGetMensaje($idMensaje){
        try{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM mensajes WHERE id=:idMensaje");
            $stmt->execute(["idMensaje" =>$idMensaje]);
            return ($stmt->rowCount() > 0) ? $stmt->fetch() : [];
        }catch(PDOException $e){
            return [];
        }
    }
    public static function mdlDeleteMensaje($idMensaje){
        try{
            $stmt = Conexion::conectar()->prepare("DELETE FROM mensajes  WHERE id=:idMensaje");
            $stmt->execute(["idMensaje" =>$idMensaje]);
            return ($stmt->rowCount() > 0) ? true : false;
        }catch(PDOException $e){
            return false;
        }
    }
}