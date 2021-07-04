<div class="container-fluid">

    <!-- Page Heading -->
    <h3 class="h3 mb-2 text-gray-800">Categorías</h3>
    <div class="card shadow mb-4">
        <div class="card-header border-0">
            <button class="btn btn-primary btnNuevaCategoria" data-toggle="modal" data-target="#modalCategoria">Agregar nueva categoría</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped dt-responsive" style="font-size: 12px;" id="dataTableCategorias" width="100%" cellspacing="0">
                    <thead style="font-weight: bold; color: black;" class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Categoría</th>  
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade" tabindex="-1" role="dialog" id="modalCategoria" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-gradient-primary text-white">
                                    <h4 class="modal-title font-weight-bold titleModal titleModalCategoria text-center" id="exampleModalLabel">NUEVA CATEGORÍA</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="formCategoria">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="hidden" class="categoria">
                                                <div class="form-group mb-3">
                                                    <label for="regCategoria">Categoría</label>
                                                    <input type="text"  name="regCategoria" id="regCategoria" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btnEditAdd" id="btnEditAdd" disabled>Registrar</button>
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
    if ($("#formCategoria")) {
        $("#formCategoria").on("change", function (e) {
            let id = e.target.id;
            if (e.target.value.length > 0 && id != 'files') {
                if (id == "regCategoria") {
                    $.ajax({
                        type: "POST",
                        url: "ajax/categorias.php",
                        data: {
                            nameCategoria: e.target.value
                        },
                        success: function (response) {
                            let resCategoria = JSON.parse(response);
                            Swal.fire({
                                title: "Verificando categoría",
                                html: "Esperando a que el sistema verifique la categoría. Esto puede tardar un momento",
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    timeInterval = setInterval(() => {
                                        const content = Swal.getHtmlContainer()
                                        if (content) {
                                            const b = content.querySelector('b');
                                            if (b) {
                                                b.textContent = Swal.getTimerLeft()
                                            }
                                        }
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timeInterval)
                                }
                            }).then(() => {
                                if (resCategoria.verificado == false) {
                                    $("#btnEditAdd").removeAttr("disabled");
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Esta categoría ya existe',
                                        text: 'Ingrese un nombre de categoría diferente'
                                    })
                                    $("#btnEditAdd").attr("disabled", true);
                                }
                            })
                        }
                    });
                } 
            }
        })
        $("#dataTableCategorias").on("click", "button.btnAction", function () {
            let idCategoria = $(this).attr("idCategorias");
            $(".btnEditAdd").attr("disabled",true);
            $(".btnEditAdd").html("Editar");
            let infoData = {
                idCategoria
            };
            $.ajax({
                type: "POST",
                url: 'ajax/categorias.php',
                data: infoData,
                success: function (response) {
                    let data = JSON.parse(response);
                    $(".titleModalCategoria").html("EDITAR CATEGORÍA");
                    $(".categoria").val(data.id);
                    $("#regCategoria").val(data.categoria);
                    $(".btnEliminar").show();
                }
            })
        })
        $(".btnNuevaCategoria").on("click", function () {
            $(".titleModalCategoria").html("NUEVA CATEGORÍA");
            $("#regCategoria").val("");
            $(".btnEditAdd").attr("disabled",true);
            $(".btnEditAdd").html("Agregar");
            $(".btnEliminar").hide();
        })

        $("#formCategoria").on("click", "button.btnEliminar", function () {
            Swal.fire({
                title: '¿Estás seguro de eliminar a esta categoría?',
                text: "¡Esta acción no se puede revertir, se eliminarán todos los productos relacionados a esta categoríia!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!',
                cancelButtonText: "Cancelar",
            }).then((result) => {
                let idEliminarCategoria = $(".categoria").val();
                console.log(idEliminarCategoria);
                let infoDelete = {
                    idEliminarCategoria
                }
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: 'ajax/categorias.php',
                        data: infoDelete,
                        success: function (response) {
                            if (response) {
                                Swal.fire(
                                    'Eliminado',
                                    'La categoría se ha eliminado.',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "categorias";
                                    }
                                })
                            }
                        }
                    })
                }
            })
        })
        $("#formCategoria").on("submit", function (e) {
            e.preventDefault();
            let formData = new FormData();
            formData.append("accion", ($("#btnEditAdd").html() == "Editar") ? "Editar" : "Agregar");
            if ($("#btnEditAdd").html() == "Editar") {
                formData.append("editIdCategoria", $(".categoria").val());
            }
            formData.append("regCategoria",$("#regCategoria").val())
            $.ajax({
                type: "POST",
                url: "ajax/categorias.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (status) {
                    console.log(status);
                    let stat = JSON.parse(status);
                    let mensaje = (formData.get("accion") == "Editar") ? "Categoría editada correctamente" : "Categoría agregada correctamente";
                    if (stat.verificado) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: mensaje,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "categorias";
                            }
                        })
                    }else {
                        Swal.fire(
                            'No se ha realizado ningun cambio',
                            'Se actualizará la página',
                            'warning'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "categorias";
                            }
                        })
                    }
                }
            })
        })

    }
</script>
<!-- /.container-fluid -->