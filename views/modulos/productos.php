<div class="container-fluid">

    <!-- Page Heading -->
    <h3 class="h3 mb-2 text-gray-800">Tabla de Productos</h3>
    <div class="card shadow mb-4">
        <div class="card-header border-0">
            <button class="btn btn-primary btnNuevo" data-toggle="modal" data-target="#modalProducto">Agregar nuevo producto</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped dt-responsive" style="font-size: 12px;" id="dataTableProductos" width="100%" cellspacing="0">
                    <thead style="font-weight: bold; color: black;" class="text-center">
                        <tr>
                            <th>Id</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>$(Público)</th>
                            <th>$(Mayorista)</th>
                            <th>Detalle</th>
                            <th>$(Minorista)</th>
                            <th>Detalle</th>
                            <th>Fecha</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalProducto" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-gradient-primary text-white">
                                    <h4 class="modal-title font-weight-bold titleModalProducto text-center" id="exampleModalLabel">NUEVO PRODUCTO</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" enctype="multipart/form-data" id="formProducto">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <form method="POST" enctype="multipart/form-data" id="agregarFoto">
                                                    <div class="card text-center">
                                                        <div class="card-header bg-white">
                                                            <output id="imageProducto">
                                                                <img src="<?php echo URL; ?>uploads/productos/productoDefault.jpg" data-dir="<?php echo URL; ?>uploads/productos/" alt="" id="imgProducto" class="img-thumbnail">
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
                                                <input type="hidden" class="idProducto">
                                                <div class="form-group mb-3">
                                                    <label for="inputCategoria">Categoria</label>
                                                    <select id="selectCategoria" class="form-control">
                                                        <option selected disabled>--- Seleccione una categoría</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="regCodigo">Código</label>
                                                    <input type="number" id="regCodigo" name="regCodigo" class="form-control form-control-lg" disabled>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="regNombreProducto">Nombre</label>
                                                    <input type="text" id="regNombreProducto" name="regNombreProducto" class="form-control form-control-lg">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="regDescProducto">Descripción</label>
                                                    <input type="text" class="form-control form-control-lg" name="regDescProducto" id="regDescProducto">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="regStock">Stock</label>
                                                    <input type="number" minlength="1" class="form-control form-control-lg" name="regStock" id="regStock">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="regPrecioPublico">$(Precio al público)</label>
                                                    <input type="number" step="0.01" min="0" class="form-control form-control-lg" name="regPrecioPublico" id="regPrecioPublico">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="regPrecioMayorista">$(Precio mayorista)</label>
                                                    <input type="number" step="0.01" min="0" class="form-control form-control-lg" name="regPrecioMayorista" id="regPrecioMayorista">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="regDetalleMayorista">Detalle</label>
                                                    <input type="text" class="form-control form-control-lg" name="regDetalleMayorista" id="detalleMayorista">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="regPrecioMinorista">$(Precio minorista)</label>
                                                    <input type="number" step="0.01" min="0" class="form-control form-control-lg" name="regPrecioMinorista" id="regPrecioMinorista">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="regDetalleMinorista">Detalle</label>
                                                    <input type="text" class="form-control form-control-lg" name="regDetalleMinorista" id="regDetalleMinorista">
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
    if ($("#formProducto")) {
        let ajaxCategoria;
        $.ajax({
            type: "POST",
            url: "ajax/categorias.php",
            data: {
                "categoria_get": ""
            },
            success: function(response) {
                ajaxCategoria = JSON.parse(response);
                let createHtml = '<option selected disabled>--- Seleccione una categoría ---</option>';
                for (const item of ajaxCategoria) {
                    createHtml += `<option value=${item.id}>${item.categoria}</option>`;
                }
                $("#selectCategoria").html(createHtml);
            }
        });
        $("#selectCategoria").on("change", function(e) {
            let refCategoria = e.target.value;
            if (refCategoria != '') {
                $.ajax({
                    type: "POST",
                    url: "ajax/productos.php",
                    data: {
                        "productsCategoria": refCategoria
                    },
                    success: function(response) {
                        let codResponse = JSON.parse(response);
                        $("#regCodigo").val(Number(codResponse.codigo) + 1);
                    }
                });
            }
        })
        $(document).on("change", "#files", function() {
            $("#btnAñadir").removeAttr("disabled");
            let file = this.files;
            let supporteImages = ["image/jpeg", "image/png", "image/jpeg", "image/jpg"];
            let element = file[0];
            if (supporteImages.indexOf(element.type) != -1) {
                createPreview(element);
            }
            function createPreview(file) {
                let imgCodified = URL.createObjectURL(file);
                $("#imgProducto").removeAttr('src');
                $("#imgProducto").attr('src', imgCodified);
            }
        })
        $("#dataTableProductos").on("click","button.btnAction",function(){
            $(".titleModalProducto").html("EDITAR PRODUCTO");
            let idProducto = $(this).attr("idProducto");
            let imgUrl = $("#imgProducto").data("dir");
            $(".btnEditAdd").attr("disabled",false);
            $(".btnEditAdd").html("Editar");
            let infoData = {
                idProducto
            };
            $.ajax({
                type: "POST",
                url: 'ajax/productos.php',
                data: infoData,
                success: function (response) {
                    let data = JSON.parse(response)
                    $(".idProducto").val(data.id);
                    $("#selectCategoria option[value='" + data.id_categoria + "']").attr("selected", true);
                    $("#selectCategoria").attr("disabled", true);
                    $("#regCodigo").val(data.codigo);
                    $("#regNombreProducto").val(data.nombre);
                    $("#regDescProducto").val(data.descripcion);
                    $("#regStock").val(data.stock);
                    $("#regPrecioPublico").val(data.precio_publico);
                    $("#regPrecioMayorista").val(data.precio_mayorista);
                    $("#detalleMayorista").val(data.d_precio_mayorista);
                    $("#regPrecioMinorista").val(data.precio_minorista);
                    $("#regDetalleMinorista").val(data.d_precio_minorista);
                    $("#imgProducto").attr('src', imgUrl + data.imagen);
                    $("#imgProducto").attr('data-title',data.imagen);
                    $(".btnEditAdd").html("Editar");
                    $(".btnEliminar").show();
                    $(".btnEliminar").attr("id", idProducto);
                }
            })
        })
        $("#formProducto").on("submit", function(e) {
            e.preventDefault();
            let formData = new FormData();
            let files = $("#files")[0].files[0];
            formData.append("accion", ($("#btnEditAdd").html() == "Editar") ? "Editar" : "Agregar");
            if (formData.get("accion") == "Editar" && files == undefined) {
                formData.append("uploadImage", "NO");
                formData.append("productDefault", $("#imgProducto").data('title'));
            } else if (formData.get("accion") == "Agregar" && files == undefined) {
                formData.append("uploadImage", "NO");
                formData.append("productDefault", "productoDefault.jpg");
            } else {
                formData.append("uploadImage", "SI");
                formData.append("regProductImage", files);
            }
            if ($("#btnEditAdd").html() == "Editar") {
                formData.append("editIdProducto", $(".idProducto").val());
            }
      
            formData.append("regIdCategoria", $("#selectCategoria").val());
            formData.append("regCodigo", $("#regCodigo").val());
            formData.append("regNombreProducto", $("#regNombreProducto").val());
            formData.append("regDescProducto", $("#regDescProducto").val());
            formData.append("regStock", $("#regStock").val());
            formData.append("regPrecioPublico", $("#regPrecioPublico").val());
            formData.append("regPrecioMayorista", $("#regPrecioMayorista").val());
            formData.append("regDetalleMayorista", $("#detalleMayorista").val());
            formData.append("regPrecioMinorista", $("#regPrecioMinorista").val());
            formData.append("regDetalleMinorista", $("#regDetalleMinorista").val());
            $.ajax({
                type: "POST",
                url: "ajax/productos.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    let status = JSON.parse(response);
                    let mensaje = (formData.get("accion") == "Editar") ? "Producto editado correctamente" : "Producto agregado correctamente";
                    if (status.verificado) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: mensaje,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "productos";
                            }
                        })
                    }else {
                        Swal.fire(
                            'No se ha realizado ningun cambio',
                            'Se actualizará la página',
                            'warning'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "productos";
                            }
                        })
                    }
                }
            });
        })
        $("#formProducto").on("click", "button.btnEliminar", function () {
            Swal.fire({
                title: '¿Estás seguro de eliminar este producto?',
                text: "¡Esta acción no se puede revertir, se eliminará el producto seleccionado!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!',
                cancelButtonText: "Cancelar",
            }).then((result) => {
                let idEliminarProducto = $(".idProducto").val();
                let infoDelete = {
                    idEliminarProducto
                }
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: 'ajax/productos.php',
                        data: infoDelete,
                        success: function (response) {
                            if (response) {
                                Swal.fire(
                                    'Eliminado',
                                    'EL producto ha sido eliminado.',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "productos";
                                    }
                                })
                            }
                        }
                    })
                }
            })
        })
    }
</script>
<!-- /.container-fluid -->