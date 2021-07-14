<div class="container-fluid">

    <!-- Page Heading -->
    <h3 class="h3 mb-2 text-gray-800">Noticias</h3>
    <div class="card shadow mb-4">
        <div class="card-header border-0">
            <button class="btn btn-primary btnNuevo" data-toggle="modal" data-target="#modalActionNoticias">Agregar nuevo noticia</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped dt-responsive" style="font-size: 12px;" id="dataTableNoticias" width="100%" cellspacing="0">
                    <thead style="font-weight: bold; color: black;" class="text-center">
                        <tr>
                            <th>Id</th>
                            <th>Título</th>
                            <th>Decripción</th>
                            <th>Creador</th>
                            <th>Fecha</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalActionNoticias" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-gradient-primary text-white">
                                    <h4 class="modal-title font-weight-bold titleModal text-center" id="exampleModalLabel">NUEVA NOTICIA</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" enctype="multipart/form-data" id="formNoticia">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <form method="POST" enctype="multipart/form-data" id="agregarFoto">
                                                    <div class="card text-center">
                                                        <div class="card-header bg-white">
                                                            <output id="imageNoticia">
                                                                <img src="<?php echo URL;?>uploads/noticias/noticiasDefault.png" data-dir="<?php echo URL;?>uploads/noticias/" alt="" id="imgNoticia" class="img-thumbnail">
                                                            </output>
                                                        </div>
                                                        <div class="card-body">
                                                            <label class="btn btn-primary d-block mb-3" for="files">Cargar foto</label>
                                                            <div class="files" style="visibility: hidden; width: 0.1px; height: 0.1px;">
                                                                <input accept="images/" name="file" type="file" id="files">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="hidden" class="noticia">
                                                <div class="form-group mb-3">
                                                    <label for="regTituloNoticia">Título</label>
                                                    <input type="text" id="regTituloNoticia" name="regTituloNoticia" class="form-control form-control-lg">

                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="regDescripcionNoticia">Descripcion</label>
                                                    <input type="text" name="regDescripcionNoticia" id="regDescripcionNoticia" class="form-control form-control-lg" placeholder="20 palabras max.">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="regDesarrolloNoticia">Desarrollo</label>
                                                    <textarea name="regDesarrolloNoticia" id="regDesarrolloNoticia" class="form-control" rows="7"></textarea>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="regCreadoPor">Registrado por</label>
                                                    <input type="text" id="regCreadoPor" name="regCreadoPor" class="form-control text-secondary"  value="<?php echo $_SESSION["full_name"]; ?>" disabled style="font-size: 14px;">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btnEditAdd" id="btnEditAdd">Registrar</button>
                                                    <button type="button" class="btn btn-danger btnEliminar" data-dismiss="modal">Eliminar</button>
                                                    <button type="button" class="btn btn-dark float-right" id="btnCancelar" data-dismiss="modal">Cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--- ROW-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$().ready(function(){
    if ($("#formNoticia")) {
        $("#dataTableNoticias").on("click", "button.btnAction", function () {
            let idNoticia = $(this).attr("idNoticia");
            let infoData = {
                idNoticia
            };
            $.ajax({
                type: "POST",
                url: 'ajax/noticias.php',
                data: infoData,
                success: function (response) {
                    let jsonNoticia = JSON.parse(response);
                    let imgUrl = $("#imgNoticia").data("dir");
                    let data = JSON.parse(response);
                    $(".titleModal").html("CONFIGURACIÓN DE NOTICIAS");
                    $(".noticia").val(data.id);
                    $("#regTituloNoticia").val(data.titulo);
                    $("#regDescripcionNoticia").val(data.descripcion);
                    $("#regDesarrolloNoticia").val(data.desarrollo);
                    $("#regCreadoPor").val(data.publicador);
                    $("#imgNoticia").attr('src', imgUrl + data.imagen);
                    $("#imgNoticia").attr('data-title',data.imagen);
                    $(".btnEditAdd").html("Editar");
                    $(".btnEliminar").show();
                    $(".btnEliminar").attr("id", idNoticia);
                }
            })
        })
        $(".btnNuevo").on("click", function () {
            let imgUrl = $("#imgNoticia").data("dir");
            $(".titleModal").html("Nueva Noticia");
            $("#regTituloNoticia").val("");
            $("#regDescripcionNoticia").val("");
            $("#regDesarrolloNoticia").val("");
            $(".btnEditAdd").html("Registrar");
            $("#imgNoticia").attr('src', imgUrl + "noticiasDefault.png");
            $(".btnEliminar").hide();
            initializeInputs();
        })

        $("#formNoticia").on("click", "button.btnEliminar", function () {
            Swal.fire({
                title: '¿Estás seguro de eliminar a este noticia?',
                text: "¡Esta acción no se puede revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, elminarla!',
                cancelButtonText: "Cancelar",
            }).then((result) => {
                let idEliminarNoticia = $(".noticia").val();
                let infoDelete = {
                    idEliminarNoticia
                }
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: 'ajax/noticias.php',
                        data: infoDelete,
                        success: function (response) {
                            if (response) {
                                Swal.fire(
                                    'Eliminada',
                                    'La noticia ha sido eliminada satisfactoriamente.',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "noticias";
                                    }
                                })
                            }
                        }
                    })
                }
            })
        })
        $("#formNoticia").on("submit", function (e) {
            e.preventDefault();
            let formData = new FormData();
            let files = $("#files")[0].files[0];
            formData.append("accion", ($("#btnEditAdd").html() == "Editar") ? "Editar" : "Agregar");
            if (formData.get("accion") == "Editar" && files == undefined) {
                formData.append("uploadImageNoticia", "NO");
                formData.append("imageDefault", $("#imgNoticia").data('title'));
            } else if (formData.get("accion") == "Agregar" && files == undefined) {
                formData.append("uploadImageNoticia", "NO");
                formData.append("imageDefault", "noticiasDefault.png");
            } else {
                formData.append("uploadImageNoticia", "SI");
                formData.append("regImageNoticia", files);
            }
            if ($("#btnEditAdd").html() == "Editar") {
                formData.append("editIDNoticia", $(".noticia").val());
            }
            formData.append("regTituloNoticia", $("#regTituloNoticia").val());
            formData.append("regDescripcionNoticia", $("#regDescripcionNoticia").val());
            formData.append("regDesarrolloNoticia",$("#regDesarrolloNoticia").val());
            formData.append("regCreadoPor", $("#regCreadoPor").val());
            console.log($(".noticia").val());
            $.ajax({
                type: "POST",
                url: "ajax/noticias.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (status) {
                    let stat = JSON.parse(status);
                    let mensaje = (formData.get("accion") == "Editar") ? "Noticia editada correctamente" : "Noticia agregada correctamente";
                    if (stat.verificado) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: mensaje,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "noticias";
                            }
                        })
                    } else {
                        Swal.fire(
                            'No se ha realizado ningun cambio',
                            'Se actualizará la página',
                            'warning'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "noticias";
                            }
                        })
                    }
                }
            })
        })
        $(document).on("change", "#files", function () {
            $("#btnAñadir").removeAttr("disabled");
            let file = this.files;
            let supporteImages = ["image/jpeg", "image/png", "image/jpeg", "image/jpg"];
            let element = file[0];
            if (supporteImages.indexOf(element.type) != -1) {
                createPreview(element);
            }
            function createPreview(file) {
                let imgCodified = URL.createObjectURL(file);
                $("#imgNoticia").removeAttr('src');
                $("#imgNoticia").attr('src', imgCodified);
            }
        })
        function initializeInputs() {
            $("#regTituloNoticia").attr("disabled", false);
            $("#regDescripcionNoticia").attr("disabled", false);
            $("#btnEditAdd").attr("disabled", false);
        }

    }
})
</script>
<!-- /.container-fluid -->