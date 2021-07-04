<?php
include_once '../controllers/administrador.controller.php';
include_once '../models/administrador.model.php';

class AjaxAdministrador
{
    public $idPerfil;
    public function ajaxGetUsers()
    {
        $respuesta = ControllerAdministrador::ctrGetUsers();
        echo json_encode($respuesta);
    }
    public function ajaxVerificarDni($dni)
    {
        $respuesta = array("verificado" => ControllerAdministrador::ctrVerificarDni($dni));
        echo json_encode($respuesta);
    }
    public function ajaxVerificarEmail($email)
    {
        $respuesta = array("verificado" => ControllerAdministrador::ctrVerificarEmail($email));
        echo json_encode($respuesta);
    }
    public function ajaxEditarPerfil()
    {
        $valor = $this->idPerfil;
        $respuesta = ControllerAdministrador::ctrGetDataAdmin($valor);
        echo json_encode($respuesta);
    }
    public function ajaxEliminarPerfil()
    {
        $respuesta = "";
        $id = $this->idPerfil;
        $respuesta = ControllerAdministrador::ctrDeleteAdmin($id);
        echo json_encode($respuesta);
    }
    public function ajaxAgregarUsuario($datos)
    {
        $res = array("verificado" => ControllerAdministrador::ctrAddNewUser($datos));
        echo json_encode($res);
    }
    public function ajaxEditarUsuario($datos)
    {
        $respuesta = ["verificado" => ControllerAdministrador::ctrEditUser($datos)];
        echo json_encode($respuesta);
    }
    public function ajaxGetDataInitial($idUsuario,$fecha = null){
        $respuesta = ControllerAdministrador::ctrGetDataInitial($idUsuario,$fecha);
        echo json_encode($respuesta);
    }

}
if (isset($_POST["getUsers"])) {
    $getUsers = new AjaxAdministrador();
    $getUsers->ajaxgetUsers();
}
if (isset($_POST["dniUser"])) {
    $verificarDni = new AjaxAdministrador();
    $verificarDni->ajaxVerificarDni($_POST["dniUser"]);
}
if (isset($_POST["emailUser"])) {
    $verificarEmail = new AjaxAdministrador();
    $verificarEmail->ajaxVerificarEmail($_POST["emailUser"]);
}
if (isset($_POST["idPerfil"])) {
    $editar = new AjaxAdministrador();
    $editar->idPerfil = $_POST["idPerfil"];
    $editar->ajaxEditarPerfil();
}
if (isset($_POST["idEliminar"])) {
    $eliminar = new AjaxAdministrador();
    $eliminar->idPerfil = $_POST["idEliminar"];
    $eliminar->ajaxEliminarPerfil();
}
if (isset($_POST["uploadImage"])) {
    $administrador = new AjaxAdministrador();
    $datos = [];
    if ($_POST["uploadImage"] == "SI") {
        if (isset($_FILES["regImagenUser"])) {
            $archivo = $_FILES['regImagenUser']['name'];
            if (isset($archivo) && $archivo != "") {
                $tipo = $_FILES["regImagenUser"]["type"];
                $size = $_FILES["regImagenUser"]["size"];
                $temp = $_FILES["regImagenUser"]["tmp_name"];
                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg" || strpos($tipo, "png")) && ($size < 2000000)))) {
                    error_log("ERROR. La extension o tamaño del archivo no es correcta");
                } else {
                    if (move_uploaded_file($temp, '../uploads/perfiles/' . $archivo)) {
                        array_push($datos, $archivo);
                        chmod('../uploads/perfiles/' . $archivo, 0777);
                    }
                }
            }
        }
    } else {
        array_push($datos, $_POST["imageDefault"]);
    }
    if (isset($_POST["editIdUser"])) {
        array_push($datos,[
            "id" => $_POST["editIdUser"],
            "nombre" => $_POST["regNombreUser"],
            "apellido" => $_POST["regApellidoUser"],
            "email" => $_POST["regEmailUser"],
            "dni" => $_POST["regDniUser"],
            "celular" => $_POST["regCelularUser"],
            "telefono" => $_POST["regTelefonoUser"],
            "username" => $_POST["regUsernameUser"],
            "password" => md5($_POST["regPasswordUser"]),
            "registrado_por" => $_POST["regRegistrado_porUser"],
            "rol" => $_POST["regRolUser"],
            "fecha_creacion" => $_POST["regFecha_creacionUser"]
        ]);
        $administrador->ajaxEditarUsuario($datos);
    } else {
        array_push($datos,[
            "nombre" => $_POST["regNombreUser"],
            "apellido" => $_POST["regApellidoUser"],
            "email" => $_POST["regEmailUser"],
            "dni" => $_POST["regDniUser"],
            "celular" => $_POST["regCelularUser"],
            "telefono" => $_POST["regTelefonoUser"],
            "username" => $_POST["regUsernameUser"],
            "password" => md5($_POST["regPasswordUser"]),
            "registrado_por" => $_POST["regRegistrado_porUser"],
            "rol" => $_POST["regRolUser"],
            "fecha_creacion" => $_POST["regFecha_creacionUser"]
        ]);

        $administrador->ajaxAgregarUsuario($datos);
    }
}
if(isset($_POST["initialData"])){
    $initialize = new AjaxAdministrador();
    if($_POST["reload"] == "No"){
        $initialize->ajaxGetDataInitial($_POST["initialData"]);
    }else{
        $fecha_reload = date("Y-m-d H:i:s");
        $initialize->ajaxGetDataInitial($_POST["initialData"],$fecha_reload);
    }
}
