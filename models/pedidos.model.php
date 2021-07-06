<?php
require 'conexion.php';
class ModelPedidos{
    public static function mdlGetPedidos(){
        try{
            $query = Conexion::conectar()->prepare("SELECT p.id,p.codigo,p.total,p.fecha_creacion,p.estado,p.id_cliente,c.nombre,c.apellido FROM pedidos p INNER JOIN clientes c ON c.id = p.id_cliente");
            $query->execute();
            return ($query->rowCount() > 0) ? $query->fetchAll() : [];
        }catch(PDOException $e){
            return [];
        }
    }
    public static function mdlGetPedido($idPedido){
        try{
            $query = Conexion::conectar()->prepare("SELECT * FROM pedidos WHERE id=:idPedido");
            $query->execute(["idPedido" => $idPedido]);
            return ($query->rowCount()>0) ? $query->fetch() : [];
        }catch(PDOException $e){
            return [];
        }
    }
    public static function mdlGetDetallePedido($idPedido){
        try{
            $query = Conexion::conectar()->prepare("SELECT * FROM detalle_pedido WHERE id_pedido=:idPedido");
            $query->execute(["idPedido" => $idPedido]);
            $query->execute(["idPedido" => $idPedido]);
            return ($query->rowCount()>0) ? $query->fetchAll() : [];
        }catch(PDOException $e){
            return [];
        }
    }
    public static function mdlGetPedidosFilter($filter){
        try{
            $query = Conexion::conectar()->prepare("SELECT p.id,p.codigo,p.total,p.fecha_creacion,p.estado,p.id_cliente,c.nombre,c.apellido FROM pedidos p INNER JOIN clientes c ON c.id = p.id_cliente WHERE p.estado=:estado");
            $query->execute(["estado" => $filter]);
            return ($query->rowCount()>0) ? $query->fetchAll() : [];
        }catch(PDOException $e){

        }
    }
    public static function mdlDeletePedido($idPedido){
        $bandera = false;
        try{
            if(ModelPedidos::mdlDeleteDetallePedido($idPedido)){
                $query = Conexion::conectar()->prepare("DELETE FROM pedidos WHERE id=:idPedido");
                $query->execute(["idPedido" => $idPedido]);
                $bandera = ($query->rowCount() > 0);
            }
        }catch(PDOException $e){
        }
        return $bandera;
    }
    public static function mdlDeleteDetallePedido($idPedido){
        try{
            $query = Conexion::conectar()->prepare("DELETE FROM detalle_pedido WHERE id_pedido=:idPedido");
            $query->execute(["idPedido" => $idPedido]);
            return ($query->rowCount()>0) ? true : false;
        }catch(PDOException $e){
            return false;

        }
    }
    public static function mdlSetEstadoPedido($idPedido,$estado){
        try{
            $query = Conexion::conectar()->prepare("UPDATE pedidos set estado=:estado WHERE id=:idPedido");
            $query->execute(["estado" => $estado,"idPedido" => $idPedido]);
            return ($query->rowCount() > 0) ? true : false;
        }catch(PDOException $e){

        }
    }
    public static function mdlAddNuevoPedido($idCliente,$detallePedido,$totalPago){
        try{
            $newCodigoPedido = ModelPedidos::getNewCodigo();
            $query = Conexion::conectar()->prepare("INSERT INTO pedidos VALUES(0,:codigo,:idCliente,:total,:fecha,:estado)");
            $query->execute(["codigo" => $newCodigoPedido,"idCliente" => $idCliente,"total"=> explode('$',$totalPago)[1], "fecha" => date("Y-m-d H:i:s"),"estado" => "Pendiente"]);
            if($query->rowCount() > 0){
                $stmt = Conexion::conectar()->prepare("SELECT * FROM pedidos p INNER JOIN clientes c ON c.id = p.id_cliente WHERE codigo=:codigo");
                $stmt->execute(["codigo" => $newCodigoPedido]);
                if($stmt->rowCount()> 0){
                    ModelPedidos::mdlSaveDetallePedido($stmt->fetchColumn(0),$detallePedido);
                    return $stmt->fetchAll();
                }
            }
        }catch(PDOException $e){
            return "Fallaste: ".$e->getMessage();
        }
    }
    public static function mdlSaveDetallePedido($idPedido,$detallePedido){
        $key = array();
        foreach($detallePedido as $clave => $valor){
            array_push($key,$clave);
        }
        $sql = "INSERT INTO detalle_pedido VALUES(0,:idPedido,:nombreProducto,:cantidad,:precio)";
        for($i = 0; $i < count($key); $i++){
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute([
                "idPedido" => $idPedido,
                "nombreProducto" => $detallePedido[$key[$i]]["nombre"], 
                "cantidad" => $detallePedido[$key[$i]]["cantidad"],
                "precio" => $detallePedido[$key[$i]]["precio"]
                ]);
        }
    }
    public static function getNewCodigo(){
        try{
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $newCodigo = "ASO-". substr(str_shuffle($permitted_chars), 0, 10);
            $query = Conexion::conectar()->prepare("SELECT codigo FROM pedidos WHERE codigo=:codigo");
            $query->execute(["codigo" => $newCodigo]);
            if($query->rowCount() > 0){
                ModelPedidos::getNewCodigo();
            }else{
                return $newCodigo;
            }
        }catch(PDOException $e){

        }
    }
}