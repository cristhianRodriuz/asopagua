<?php
require 'conexion.php';
class ModelCategoria
{
   public static function mdlGetCategorias()
   {
      try {
         $stmt = Conexion::conectar()->prepare("SELECT * FROM categorias");
         $stmt->execute();
         return $stmt->fetchAll();
      } catch (PDOException $e) {
         error_log("hubo un error");
      }
   }
   public static function mdlVerificarCategoria($categoria)
   {
      try {
         $stmt = Conexion::conectar()->prepare("SELECT * FROM categorias WHERE categoria=:categoria");
         $stmt->execute(["categoria" => $categoria]);
         if ($stmt->rowCount() > 0) {
            return true;
         } else {
            return false;
         }
      } catch (PDOException $e) {
         return false;
      }
   }
   public static function mdlGetDataCategoria($idcategoria)
   {
      $stmt = Conexion::conectar()->query("SELECT * FROM categorias WHERE id=$idcategoria");
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }
   public static function mdlDeleteCategoria($idCategoria)
   {
      $stmt = Conexion::conectar()->prepare(("DELETE FROM categorias WHERE id=:idCategoria"));
      $stmt->execute(['idCategoria' => $idCategoria]);
      if ($stmt->rowCount() > 0) {
         return true;
      }
   }
   public static function mdlAddNewCategoria($datos)
   {
      $stmt = Conexion::conectar()->prepare("INSERT INTO categorias VALUES(0,:categoria)");
      $stmt->execute([
         "categoria" => $datos["categoria"],
      ]);
      if ($stmt->rowCount() > 0) {
         return true;
      } else {
         return false;
      }
   }
   public static function mdlEditarCategoria($datos)
   {
      try{
         $stmt = Conexion::conectar()->prepare("UPDATE categorias set categoria=:categoria WHERE id=:id");
         $stmt->execute([
            "categoria" => $datos["categoria"],
            "id" => $datos["idCategoria"]
         ]);
         if ($stmt->rowCount() > 0) {
            return true;
         } else {
            return false;
         }
      }catch(PDOException $e){
         error_log("ERROR => " . $e->getMessage());
         return false;
      }  
   }
}
