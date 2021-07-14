<?php
require 'conexion.php';
date_default_timezone_set("America/Guayaquil");
class ModelNoticias{
    public static function mdlGetNoticias(){
        try{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM noticias");
            $stmt->execute();
            return ($stmt->rowCount() > 0)  ? $stmt->fetchAll() : [];
        }catch(PDOException $e){
            return [];
        }
    }
    public static function mdlGetNoticia($idNoticia){
        try{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM noticias WHERE id=:idNoticia");
            $stmt->execute(["idNoticia" => $idNoticia]);
            return ($stmt->rowCount() > 0)  ? $stmt->fetch() : [];
        }catch(PDOException $e){
            return [];
        }
    }
    public static function mdlAddNoticias($noticia){
        try{
            $stmt = Conexion::conectar()->prepare("INSERT INTO noticias VALUES(0,:imagen,:titulo,:descripcion,:creador,:fecha,:desarrollo)");
            $stmt->execute([
                "titulo" => $noticia[1]["titulo"],
                "descripcion" => $noticia[1]["descripcion"],
                "creador" => $noticia[1]["publicador"],
                "imagen" => $noticia[0],
                "fecha" => date("Y-m-d H:i:s"),
                "desarrollo" => $noticia[1]["desarrollo"],
            ]);
            return ($stmt->rowCount() > 0)  ? true : false;
        }catch(PDOException $e){
            return false;
        }
    }
    
    public static function mdlUpdateNoticias($noticia){
        try{
            $stmt = Conexion::conectar()->prepare("UPDATE noticias set imagen=:image,titulo=:titulo, descripcion = :descripcion, publicador = :publicador, desarrollo=:desarrollo WHERE id=:id");
            $stmt->execute([
               "image" => $noticia[0],
              "titulo" => $noticia[1]["titulo"],
              "descripcion" => $noticia[1]["descripcion"],
              "publicador" => $noticia[1]["publicador"],
              "desarrollo" => $noticia[1]["desarrollo"],
              "id" => $noticia[1]["id"]
            ]);
            if($stmt->rowCount() > 0){
               return true;
            }else{
               return false;
            }
        }catch(PDOException $e){
            return false;
        }
    }
    public static function mdlEliminarNoticias($idEliminarNoticia){
        try{
            $stmt = Conexion::conectar()->prepare("DELETE FROM noticias WHERE id=:id");
            $stmt->execute([
              "id" => $idEliminarNoticia]);
            if($stmt->rowCount() > 0){
               return true;
            }else{
               return false;
            }
        }catch(PDOException $e){
            return false;
        }
    }
}