<?php
require 'conexion.php';
date_default_timezone_set("America/Guayaquil");
class ModelProducto
{
   public static function mdlGetProductos()
   {
      try {
         $query = Conexion::conectar()->prepare("SELECT p.codigo,p.id,p.nombre,p.descripcion,p.imagen,p.stock,p.precio_publico,p.precio_mayorista,p.d_precio_mayorista,p.precio_minorista,p.d_precio_minorista,p.fecha_add, c.categoria FROM productos p INNER JOIN categorias c ON p.id_categoria = c.id");
         $query->execute();
         return $query->fetchAll();
      } catch (PDOException $e) {
      }
   }
   public static function mdlGetLastProductPerCategoria($idCategoria){
      try{
         $query = Conexion::conectar()->prepare("SELECT codigo FROM productos WHERE id_categoria = :idCategoria ORDER BY id DESC LIMIT 1");
         $query->execute(["idCategoria" => $idCategoria]);
         return $query->fetch();
      }catch(PDOException $e){

      }
   }
   public static function mdlGetInfoProducto($idProducto){
      try{
         $query = Conexion::conectar()->prepare("SELECT * FROM productos WHERE id=:idProducto");
         $query->execute(["idProducto" => $idProducto]);
         return $query->fetch();
      }catch(PDOException $e){

      }
   }
   public static function mdlEditarProducto($datos){
      $stmt = Conexion::conectar()->prepare("UPDATE productos set id_categoria=:categoria,codigo=:codigo,nombre=:nombre,descripcion=:descripcion,imagen=:imagen,stock=:stock,precio_publico=:precio_publico,precio_mayorista=:precio_mayorista,d_precio_mayorista=:d_mayorista,precio_minorista=:precio_minorista,d_precio_minorista=:d_minorista,fecha_add=:fecha_creacion WHERE id=:idProducto");
      $stmt->execute([
         "categoria" => $datos[1]["regIdCategoria"],
         "codigo" => $datos[1]["regCodigo"],
         "nombre" => $datos[1]["regNombreProducto"],
         "descripcion" => $datos[1]["regDescProducto"],
         "imagen" => $datos[0],
         "stock" => $datos[1]["regStock"],
         "precio_publico" => $datos[1]["regPrecioPublico"],
         "precio_mayorista" => $datos[1]["regPrecioMayorista"],
         "d_mayorista" => $datos[1]["regDetalleMayorista"],
         "precio_minorista" => $datos[1]["regPrecioMinorista"],
         "d_minorista" => $datos[1]["regDetalleMinorista"],
         "fecha_creacion" => date("Y-m-d H:i:s"),
         "idProducto" => $datos[1]["id"]
      ]);
      if($stmt->rowCount() > 0){
         return true;
      }else{
         return false;
      }
   }
   public static function mdlAgregarProducto($datos){
      $stmt = Conexion::conectar()->prepare("INSERT INTO productos VALUES(0,:categoria,:codigo,:nombre,:descripcion,:imagen,:stock,:precio_publico,:precio_mayorista,:d_mayorista,:precio_minorista,:d_minorista,:fecha_creacion)");
      $stmt->execute([
         "categoria" => $datos[1]["regIdCategoria"],
         "codigo" => $datos[1]["regCodigo"],
         "nombre" => $datos[1]["regNombreProducto"],
         "descripcion" => $datos[1]["regDescProducto"],
         "imagen" => $datos[0],
         "stock" => $datos[1]["regStock"],
         "precio_publico" => $datos[1]["regPrecioPublico"],
         "precio_mayorista" => $datos[1]["regPrecioMayorista"],
         "d_mayorista" => $datos[1]["regDetalleMayorista"],
         "precio_minorista" => $datos[1]["regPrecioMinorista"],
         "d_minorista" => $datos[1]["regDetalleMinorista"],
         "fecha_creacion" => date("Y-m-d H:i:s")
      ]);
      if($stmt->rowCount() > 0){
         return true;
      }else{
         return false;
      }
   }
   public static function mdlDeleteProducto($idEliminarProducto){
      try{
         $stmt = Conexion::conectar()->prepare("DELETE FROM productos WHERE id=:idEliminar");
         $stmt->execute(["idEliminar" => $idEliminarProducto]);
         return ($stmt->rowCount() >  0) ? true : false;
      }catch(PDOException $e){
         return false;
      }

   }
   public static function mdlGetAllProductos(){
      try{
         $stmt = Conexion::conectar()->prepare("SELECT * FROM productos");
         $stmt->execute();
         return ($stmt->rowCount() > 0) ? $stmt->fetchAll() : [];
      }catch(PDOException $e){
         return [];
      }
   }
}