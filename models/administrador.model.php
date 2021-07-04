<?php
require 'conexion.php';
date_default_timezone_set("America/Guayaquil");
class ModelAdministrador
{
    public static function mdlValidarAdministrador($username, $password)
    {
       $passwordEnc = md5($password);
        try {
            if ($username != null && $password != null) {
                $query = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE username=:username AND password=:password");
                $query->execute(["username" => $username, "password" => $passwordEnc]);
                if ($query->rowCount() > 0) {
                    $res = $query->fetch(PDO::FETCH_ASSOC);
                    ModelAdministrador::addLogueo($res["id"]);
                } else {
                    $res = false;
                }
            } else {
                $res = false;
            }
        } catch (PDOException $e) {
            error_log("ERRORPDO:: => Hubo un error en la conexixon: " . $e->getMessage());
        }
        return $res;
    }
    public static function addLogueo($idUsuario){
       try{
         $query = Conexion::conectar()->prepare("INSERT INTO historial_logueo VALUES(0,:fecha,:idUsuario)");
         $query->execute(["idUsuario" => $idUsuario,"fecha" => date("Y-m-d H:i:s")]);
       }catch(PDOException $e){
         error_log("PDOERROR:: addLogueo => " . $e->getMessage());
       }
    }
    public static function mdlGetUsers()
    {
        try {
            $query = Conexion::conectar()->prepare("SELECT * FROM usuarios");
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
        }
    }

    public static function mdlVerificarDni($dni){
        $stmt = Conexion::conectar()->prepare(("SELECT * FROM usuarios WHERE dni=:dni"));
        $stmt->execute(["dni" => $dni]);
        $dniExists = $stmt->rowCount();
        if($dniExists >  0){
           return true;
        }else{
           return false;
        }
     }
    public static function mdlVerificarEmail($email){
        $stmt = Conexion::conectar()->prepare(("SELECT * FROM usuarios WHERE email=:email"));
        $stmt->execute(["email" => $email]);
        $emailExists = $stmt->rowCount();
        if($emailExists >  0){
           return true;
        }else{
           return false;
        }
     }
     public static function mdlGetDataAdmin($id){
        $stmt = Conexion::conectar()->query("SELECT * FROM usuarios WHERE id=$id");
        return $stmt->fetch(PDO::FETCH_ASSOC);
     }
     public static function mdlAddNewUser($datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO usuarios VALUES(0,:dni,:nombre,:apellido,:telefono,:celular,:email,:username,:password,:rol,:image,:registrado_por,:fecha_creacion)");
        $stmt->execute([
           "dni" => $datos[1]["dni"],
           "nombre" => $datos[1]["nombre"],
           "apellido" => $datos[1]["apellido"],
           "telefono" => $datos[1]["telefono"],
           "celular" => $datos[1]["celular"],
           "email" => $datos[1]["email"],
           "username" => $datos[1]["username"],
           "password" => $datos[1]["password"],
           "rol" => $datos[1]["rol"],
           "image" => $datos[0],
           "registrado_por" => $datos[1]["registrado_por"],
           "fecha_creacion" => date("Y-m-d H:i:s")
        ]);
        if($stmt->rowCount() > 0){
           return true;
        }else{
           return false;
        }
     }
     public static function mdlEditUser($datos){
       $stmt = Conexion::conectar()->prepare("UPDATE usuarios set imagen=:image,email=:email, celular = :celular, telefono = :telefono WHERE id=:id");
       $stmt->execute([
          "image" => $datos[0],
         "telefono" => $datos[1]["telefono"],
         "celular" => $datos[1]["celular"],
         "email" => $datos[1]["email"],
         "id" => $datos[1]["id"]
       ]);
       if($stmt->rowCount() > 0){
          return true;
       }else{
          return false;
       }
     }
     public static function mdlDeleteAdmin($id){
        $stmt = Conexion::conectar()->prepare(("DELETE FROM usuarios WHERE id=:id"));
        $stmt->execute(['id' => $id]);
        $userDelete = $stmt->rowCount();
        if($userDelete > 0){
           return "OK";
        }
     }
     public static function mdlGetInitialData($idUsuario, $fecha = null){
        $tables = ["usuarios","clientes","productos","pedidos", "nuevos_pedidos"];
        $dataJson = [];
        try{
           for($i = 0; $i < count($tables); $i++){
              if($tables[$i] == "nuevos_pedidos"){
                 $dataJson[$tables[$i]]  = ModelAdministrador::queryCount($tables[$i],$idUsuario,$fecha);
               }else{
                 $dataJson[$tables[$i]]  = ModelAdministrador::queryCount($tables[$i]);
              }
           }
        }catch(PDOException $e){;
        }
        return $dataJson;
     }
     public static function queryCount($table, $idUsuario = 0, $fecha = null){
        try{
           if($table != 'nuevos_pedidos'){
              $res = Conexion::conectar()->prepare("SELECT count(*) FROM " . $table);
              $res->execute();
              return $res->fetchColumn(0);
           }else if($table == 'nuevos_pedidos' && $fecha != null){
              $res1 = Conexion::conectar()->prepare("SELECT fecha_logueo FROM historial_logueo WHERE id_usuario=$idUsuario  ORDER BY id DESC LIMIT 1");
              $res1->execute();
              $data = $res1->fetchAll(PDO::FETCH_ASSOC);
              $ultimo_logueo = $data[0]["fecha_logueo"];
              
              $res2 = Conexion::conectar()->prepare("SELECT count(*) FROM pedidos WHERE fecha_creacion > '$ultimo_logueo' AND fecha_creacion < '$fecha'");
              $res2->execute();
              ModelAdministrador::actualizarLogueo($fecha);
              return $res2->fetchColumn();
            }else{               
               error_log($fecha);
               $res1 = Conexion::conectar()->prepare("SELECT fecha_logueo FROM historial_logueo WHERE id_usuario=$idUsuario  ORDER BY id DESC LIMIT 2");
               $res1->execute();
               $data = $res1->fetchAll(PDO::FETCH_ASSOC);
               $ultimo_logueo = $data[0]["fecha_logueo"];
               $penultimo_logueo = $data[1]["fecha_logueo"];
               $res2 = Conexion::conectar()->prepare("SELECT count(*) FROM pedidos WHERE fecha_creacion > '$penultimo_logueo' AND fecha_creacion < '$ultimo_logueo'");
               $res2->execute();
               return $res2->fetchColumn();
           }
        }catch(PDOException $e){
        }
     }
   public static function actualizarLogueo($fecha)
   {
      try {
         $stmt = Conexion::conectar()->prepare("SELECT id FROM historial_logueo ORDER BY id DESC LIMIT 1");
         $stmt->execute();
         $idLogueo = $stmt->fetchColumn();
         try {
            $stmt2 = Conexion::conectar()->prepare("UPDATE historial_logueo SET fecha_logueo='$fecha' WHERE id=$idLogueo");
            $stmt2->execute();
         } catch (PDOException $e) {
            error_log($e);
         }
      } catch (PDOException $e){
         error_log($e);
      }
   }
}
