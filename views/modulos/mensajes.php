<div class="container-fluid">

    <!-- Page Heading -->
    <h3 class="h3 mb-2 text-gray-800">Mensajes Distribuidores</h3>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped dt-responsive" style="font-size: 12px;" id="dataTableMensajesDistribuidor" width="100%" cellspacing="0">
                    <thead style="font-weight: bold; color: black;" class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Nombres</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Mensaje</th>
                            <th>Fecha</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade" tabindex="-1" role="dialog" id="modalActionMensaje" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-gradient-primary text-white">
                                    <h4 class="modal-title font-weight-bold titleModal titleModalMensaje text-center" id="exampleModalLabel">DETALLE MENSAJE</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="formMensajesDistribuidor">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="hidden" class="mensajes">
                                                <div class="form-group mb-3">
                                                    <label for="regCategoria">Nombres</label>
                                                    <input type="text" name="inputNombres" id="inputNombres" class="form-control" disabled>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="regCategoria">Teléfono</label>
                                                    <input type="text" name="inputTelefono" id="inputTelefono" class="form-control" disabled>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="regCategoria">Email</label>
                                                    <input type="text" name="inputEmail" id="inputEmail" class="form-control" disabled>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="regCategoria">Mensaje</label>
                                                    <textarea name="textMensaje" id="textMensaje" rows="5" class="form-control" disabled></textarea>
                                                </div>
                                                <div class="form-group">
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
    if ($("#formMensajesDistribuidor")) {
        $("#dataTableMensajesDistribuidor").on("click", "button.btnAction", function() {
            let idMensaje = $(this).attr("idMensaje");
            let infoData = {
                getMensaje: idMensaje
            };
            $.ajax({
                type: "POST",
                url: 'ajax/mensajes.php',
                data: infoData,
                success: function(response) {
                    let data = JSON.parse(response);
                    $(".mensajes").val(data.id);
                    $("#inputNombres").val(data.nombres);
                    $("#inputTelefono").val(data.telefono);
                    $("#inputEmail").val(data.email);
                    $("#textMensaje").val(data.mensaje);
                }
            })
        })
        $("#formMensajesDistribuidor").on("click", "button.btnEliminar", function() {
            Swal.fire({
                title: '¿Estás seguro de eliminar este mensaje?',
                text: "¡Esta acción no se puede revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: "Cancelar",
            }).then((result) => {
                let idEliminarMensaje = $(".mensajes").val();
                console.log(idEliminarMensaje);
                let infoDelete = {
                    deleteMensaje: idEliminarMensaje
                }
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: 'ajax/mensajes.php',
                        data: infoDelete,
                        success: function(response) {
                            if (response) {
                                Swal.fire(
                                    'Eliminado',
                                    'El mensaje se ha eliminado',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "mensajes";
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