<?php
include_once '../controllers/noticias.controller.php';
include_once '../models/noticias.model.php';
class AjaxNoticias{
    public function ajaxGetNoticia($idNoticia){
        $respuesta = ControllerNoticias::ctrGetNoticia($idNoticia);
        echo json_encode($respuesta);
    }
    public function ajaxAgregarNoticia($noticia){
        $respuesta = array("verificado" => ControllerNoticias::ctrAgregarNoticia($noticia));
        echo json_encode($respuesta);
    }
    public function ajaxEditarNoticia($noticia){
        $respuesta = array("verificado" => ControllerNoticias::ctrEditarNoticias($noticia));
        echo json_encode($respuesta);
    }
    public function ajaxEliminarNoticias($idEliminar){
        $respuesta = array("verificado" => ControllerNoticias::ctrEliminarNoticias($idEliminar));
        echo json_encode($respuesta);
    }
    public function ajaxGetAllNoticias(){
        $res = ControllerNoticias::ctrGetNoticias();
        echo json_encode($res);
    }
}
if(isset($_POST["idNoticia"])){
    $getNoticia = new AjaxNoticias();
    $getNoticia->ajaxGetNoticia($_POST["idNoticia"]);
}
if (isset($_POST["uploadImageNoticia"])) {
    $noticias = new AjaxNoticias();
    $datos = [];
    if ($_POST["uploadImageNoticia"] == "SI") {
        if (isset($_FILES["regImageNoticia"])) {
            $archivo = $_FILES['regImageNoticia']['name'];
            if (isset($archivo) && $archivo != "") {
                $tipo = $_FILES["regImageNoticia"]["type"];
                $size = $_FILES["regImageNoticia"]["size"];
                $temp = $_FILES["regImageNoticia"]["tmp_name"];
                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg" || strpos($tipo, "png")) && ($size < 2000000)))) {
                    error_log("ERROR. La extension o tamaño del archivo no es correcta");
                } else {
                    if (move_uploaded_file($temp, '../uploads/noticias/' . $archivo)) {
                        array_push($datos, $archivo);
                        chmod('../uploads/noticias/' . $archivo, 0777);
                    }
                }
            }
        }
    } else {
        array_push($datos, $_POST["imageDefault"]);
    }
    if (isset($_POST["editIDNoticia"])) {
        array_push($datos,[
            "id" => $_POST["editIDNoticia"],
            "titulo" => $_POST["regTituloNoticia"],
            "descripcion" => $_POST["regDescripcionNoticia"],
            "desarrollo" => $_POST["regDesarrolloNoticia"],
            "publicador" => $_POST["regCreadoPor"]
            ]);
            $noticias->ajaxEditarNoticia($datos);
        } else {
            array_push($datos,[
                "titulo" => $_POST["regTituloNoticia"],
                "descripcion" => $_POST["regDescripcionNoticia"],
                "desarrollo" => $_POST["regDesarrolloNoticia"],
            "publicador" => $_POST["regCreadoPor"]
        ]);

        $noticias->ajaxAgregarNoticia($datos);
    }
}
if(isset($_POST["idEliminarNoticia"])){
    $eliminarNoticia = new AjaxNoticias();
    $eliminarNoticia->ajaxEliminarNoticias($_POST["idEliminarNoticia"]);
}
if(isset($_POST["getAllNoticias"])){
    $getAllNotices = new AjaxNoticias();
    $getAllNotices->ajaxGetAllNoticias();
}