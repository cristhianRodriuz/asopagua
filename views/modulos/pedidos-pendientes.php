<div class="container-fluid">

    <!-- Page Heading -->
    <h3 class="h3 mb-2 text-gray-800">Pedidos a verificar</h3>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped dt-responsive text-center " id="dataTablePedidos" style="font-size: 12px;"  filterTable="Pendiente" width="100%" cellspacing="0">
                    <thead style="font-weight: bold; color: black;" class="text-center">
                        <tr>
                            <th>Id</th>
                            <th>Código</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Fecha de pedido</th>
                            <th>Estado</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalActionPedido" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-gradient-primary text-white">
                                    <h4 class="modal-title font-weight-bold titleMOdalPedido text-center" id="exampleModalLabel">DETALLE DEL PEDIDO</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="card">
                                                <div class="card-header text-white bg-info">
                                                    <h5>Detalle del cliente</h5>
                                                </div>
                                                <div class="card-body">
                                                    <form action="" id="formDataCliente">
                                                        <div class="row form-group">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="">Nombre</label>
                                                                <input type="text" name="pNombreCliente" id="pNombreCliente" class="form-control" disabled>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="">Apellido</label>
                                                                <input type="text" name="pApellidoCliente" id="pApellidoCliente" class="form-control" disabled>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="">DNI</label>
                                                                <input type="text" name="pDNICliente" id="pDNICliente" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="">Télefono</label>
                                                                <input type="text" name="pTelefonoCliente" id="pTelefonoCliente" class="form-control" disabled>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="">Celular</label>
                                                                <input type="text" name="pCelularCliente" id="pCelularCliente" class="form-control" disabled>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="">Email</label>
                                                                <input type="text" name="pEmailCliente" id="pEmailCliente" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="">Provincia</label>
                                                                <input type="text" name="pProvinciaCliente" id="pProvinciaCliente" class="form-control" disabled>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="">Cantón</label>
                                                                <input type="text" name="pCantonCliente" id="pCantonCliente" class="form-control" disabled>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="">Parroquia</label>
                                                                <input type="text" name="pParroquiaCliente" id="pParroquiaCliente" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="card">
                                                <div class="card-header bg-info text-white">
                                                    <h5>Pedido</h5>
                                                </div>
                                                <div class="card-body">
                                                    <form action="">
                                                        <div class="row mb-3">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="">Número de pedido</label>
                                                                <input type="text" name="pNumeroPedido" id="pNumeroPedido" class="form-control" disabled>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="">Hora - Fecha</label>
                                                                <input type="text" name="pFechaPedido" id="pFechaPedido" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label for="">Estado actual</label>
                                                                <input type="text" class="form-control" disabled id="estadoActualPedido" name="estadoActualPedido">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="">Nuevo Estado</label>
                                                                <select id="selectEstadoPedido" class="form-control">
                                                                    <option disabled selected>-- Nuevo Estado --</option>
                                                                    <option value="Verificado">Verificado</option>
                                                                    <option value="Enviado">Enviado</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <table class="table table-striped">
                                                            <thead class="thead">
                                                                <tr>
                                                                    <th>Producto</th>
                                                                    <th>Descripcion</th>
                                                                    <th>Precio Unitario</th>
                                                                    <th>Cantidad</th>
                                                                    <th>Subtotal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbodyDetallePedido">
                                                            </tbody>
                                                        </table>
                                                        <div class="form-group">
                                                            <button class="btn btn-outline-success btnCambiarEstado">Cambiar estado</button>
                                                            <button class="btn btn-outline-danger btnEliminarPedido">Eliminar pedido</button>
                                                            <button class="btn btn-outline-dark float-right" data-dismiss="modal">Cerrar</button>
                                                        </div>
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
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    if ($("#formDataCliente")) {
        let totalPago = 0.0;
        $(".dataTablePedidos").on("click", "button.btnAction", function() {
            let idEditCliente = $(this).attr("idCliente");
            let idPedido = $(this).attr("idpedido");
            let infoData = {
                idEditCliente
            }
            $.ajax({
                type: "POST",
                url: "ajax/clientes.php",
                data: infoData,
                success: function(response) {
                    let dataJson = JSON.parse(response);
                    $("#pNombreCliente").val(dataJson.nombre);
                    $("#pApellidoCliente").val(dataJson.apellido);
                    $("#pDNICliente").val(dataJson.dni);
                    $("#pTelefonoCliente").val(dataJson.telefono);
                    $("#pCelularCliente").val(dataJson.celular);
                    $("#pEmailCliente").val(dataJson.email);
                    $("#pProvinciaCliente").val(dataJson.provincia);
                    $("#pCantonCliente").val(dataJson.canton);
                    $("#pParroquiaCliente").val(dataJson.parroquia);
                    
                    $.ajax({
                        type: "POST",
                        url: "ajax/pedidos.php",
                        data: {
                            idPedido
                        },
                        success: function (response) {
                            console.log(response);
                            let dataPedido = JSON.parse(response);
                            $("#pNumeroPedido").val(dataPedido.codigo);
                            $("#pFechaPedido").val(dataPedido.fecha_creacion);
                            $("#estadoActualPedido").val(dataPedido.estado);
                            totalPago = Number(dataPedido.total);
                            if($(".btnCambiarEstado") && $(".btnEliminarPedido")){
                                $(".btnCambiarEstado").attr('cmPedido',dataPedido.id);
                                $(".btnEliminarPedido").attr('deletePedido',dataPedido.id);
                            }   
    
                            $.ajax({
                                type: "POST",
                                url: "ajax/pedidos.php",
                                data: {
                                    "getDetallePedido" : idPedido
                                },
                                success: function (response) {
                                    let dataDetallePedidos = JSON.parse(response);
                                    printTableDetallePedido(dataDetallePedidos);
                                }
                            });
                        }
                    });
                }
            });
        })
    
        function printTableDetallePedido(data){
            console.log(data);
            let insertDetallePedido = '';
            for(const item of data){
                insertDetallePedido += `<tr>
                <td>${item.nombre_producto}</td>
                <td>${item.descripcion_producto}</td>
                <td>$ ${item.precio}</td>
                <td>${item.cantidad}</td>
                <td>$ ${item.subtotal}</td>
                </tr>`;
            }
            $("#tbodyDetallePedido").html(insertDetallePedido);
            printFooter();
        }
        function printFooter(){
            let tbody = document.getElementById('tbodyDetallePedido');
            let insertFooter = `<tr class="bg-dark text-white">
            <th colspan="4">Total</th>
            <th colspan="1">$ ${totalPago.toFixed(2)}</th> 
            </tr>`;
    
            tbody.innerHTML += insertFooter;
        }


        $(".btnCambiarEstado").on("click",function(e){
            e.preventDefault();
            let cmbPedidoPerId = $(this).attr("cmPedido");
            let newEstado = $("#selectEstadoPedido").val();
            if(newEstado != '' && newEstado != undefined){
                Swal.fire({
                    title: '¿Desea confirmar esta acción?',
                    text: "¡Al aceptar, el estado del pedido cambiará por el estado seleccionado. Se le redirigirá a la tabla correspondiente!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Confirmar!',
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if(result.isConfirmed){
                        $.ajax({
                            type: "POST",
                            url: "ajax/pedidos.php",
                            data: {
                                cmbPedidoPerId,
                                newEstado
                            },
                            success: function (response) {
                                let dataJson = JSON.parse(response);
                                if(dataJson.verificado == true){
                                    Swal.fire(
                                        'Actualizado',
                                        'El estado del pedido se ha actualizado',
                                        'success'
                                    ).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = (newEstado == "Verificado") ? "pedidos-verificados" : "pedidos-enviados";
                                        }
                                    })
                                }
                            }
                        });
                    }
                })
            }else{
                Swal.fire(
                    'No existen cambios detectados',
                    'La página actual se recargará',
                    'warning'
                ).then((result) => {
                    if (result.isConfirmed) {
                        let pageRedirect = '';
                        if($("#estadoActualPedido").val() == "Pendiente"){
                            pageRedirect = "pedidos-pendientes";
                        }else if($("#estadoActualPedido"). val() == "Verificado"){
                            pageRedirect = "pedidos-verificados";
                        }else if($("#estadoActualPedido").val() == "Enviado"){
                            pageRedirect = "pedidos-enviados";
                        }
                        window.location.href = pageRedirect;
                    }
                })
            }
        })
        $(".btnEliminarPedido").on("click",function(e){
            e.preventDefault();
            Swal.fire({
                title: '¿Se eliminará este pedido?',
                text: "¡Esta acción no se puede revertir, se eliminarán todo lo relacionado con este pedido!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!',
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if(result.isConfirmed){
                    let deletePedidoPerId = $(this).attr("deletePedido");
                    $.ajax({
                        type: "POST",
                        url: "ajax/pedidos.php",
                        data: {
                            deletePedidoPerId
                        },
                        success: function (response) {
                            let dataJson = JSON.parse(response);
                            if(dataJson.verificado == true){
                                Swal.fire(
                                    'Eliminado',
                                    'El pedido y sus detalles se han eliminado.',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        let pageRedirect = '';
                                        if($("#estadoActualPedido").val() == "Pendiente"){
                                            pageRedirect = "pedidos-pendientes";
                                        }else if($("#estadoActualPedido"). val() == "Verificado"){
                                            pageRedirect = "pedidos-verificados";
                                        }else if($("#estadoActualPedido").val() == "Enviado"){
                                            pageRedirect = "pedidos-enviados";
                                        }
                                        window.location.href = pageRedirect;
                                    }
                                })
                            }
                        }
                    });
                }
            })
        })
    }
})


</script>
<!-- /.container-fluid -->