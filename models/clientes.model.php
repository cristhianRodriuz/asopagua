<?php
require 'conexion.php';
class ModelClientes{
    public static function mdlGetClientes()
    {
        try {
            $query = Conexion::conectar()->prepare("SELECT * FROM clientes");
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
        }
    }
    public static function mdlVerificateEmail($email){
        try{
            $query = Conexion::conectar()->prepare("SELECT * FROM clientes WHERE email=:email");
            $query->execute(["email" => $email]);
            return ($query->rowCount() > 0)  ? true : false;
        }catch(PDOException $e){
            return false;
        }
    }
    public static function mdlVerificateDNI($dni){
        try{
            $query = Conexion::conectar()->prepare("SELECT * FROM clientes WHERE dni=:dni");
            $query->execute(["dni" => $dni]);
            return ($query->rowCount() > 0)  ? true : false;
        }catch(PDOException $e){
            return false;
        }
    }
    public static function mdlGetDataCliente($idCliente){
        try{
            $query = Conexion::conectar()->prepare("SELECT * FROM clientes WHERE id=:idCliente");
            $query->execute(["idCliente" => $idCliente]);
            return $query->fetch();
        }catch(PDOException $e){

        }
    }
    public static function mdlAgregarCliente($datos){
        try{
            $query = Conexion::conectar()->prepare("INSERT INTO clientes VALUES(0,:dni,:nombre,:apellido,:telefono,:celular,:email,:provincia,:canton,:parroquia,:direccion)");
            $query->execute([
                "dni" => $datos["regDNICliente"],
                "nombre" => $datos["regNombreCliente"],
                "apellido" => $datos["regApellidoCliente"],
                "telefono" => $datos["regTelefonoCliente"],
                "celular" => $datos["regCelularCliente"],
                "email" => $datos["regEmailCliente"],
                "provincia" => $datos["regProvinciaCliente"],
                "canton" => $datos["regCantonCliente"],
                "parroquia" => $datos["regParroquiaCliente"],
                "direccion" => $datos["regDireccionCliente"]
            ]);
            return ($query->rowCount() > 0) ? true : false;
        }catch(PDOException $e){
            return false;
        }
    }
    public static function mdlDeleteCliente($idCliente){
        try{
            $query = Conexion::conectar()->prepare("DELETE FROM clientes WHERE id=:idCliente");
            $query->execute(["idCliente" => $idCliente]);
            return ($query->rowCount()  > 0) ? true : false;
        }catch(PDOException $e){
            return false;
        }
    }
    public static function mdlEditarCliente($datos){
        try{
            $query = Conexion::conectar()->prepare("UPDATE clientes set dni=:dni,nombre=:nombre,apellido=:apellido,telefono=:telefono,celular=:celular,email=:email,provincia=:provincia,canton=:canton,parroquia=:parroquia,direccion=:direccion WHERE id=:idCliente");
            $query->execute([
                "dni" => $datos["regDNICliente"],
                "nombre" => $datos["regNombreCliente"],
                "apellido" => $datos["regApellidoCliente"],
                "telefono" => $datos["regTelefonoCliente"],
                "celular" => $datos["regCelularCliente"],
                "email" => $datos["regEmailCliente"],
                "provincia" => $datos["regProvinciaCliente"],
                "canton" => $datos["regCantonCliente"],
                "parroquia" => $datos["regParroquiaCliente"],
                "direccion" => $datos["regDireccionCliente"],
                "idCliente" => $datos["idCliente"]
            ]);
            return ($query->rowCount() > 0) ? true : false;
        }catch(PDOException $e){
            return false;
        }
    }
    public static function mdlVerificateCliente($dniVerificate,$emailVerificate){
        try{
            $query = Conexion::conectar()->prepare("SELECT * FROM clientes WHERE dni=:dniCliente AND email=:emailCliente");
            $query->execute(["dniCliente" => $dniVerificate, "emailCliente" => $emailVerificate]);
            return ($query->rowCount()> 0) ? $query->fetchAll() : [];
        }catch(PDOException $e){

        }
    }
}