<div class="container-fluid">

    <!-- Page Heading -->
    <h3 class="h3 mb-2 text-gray-800">Pedidos Enviados</h3>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped dt-responsive text-center" style="font-size: 12px;" id="dataTablePedidos" filterTable="Enviado" width="100%" cellspacing="0">
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
                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="">Número de pedido</label>
                                                                <input type="text" name="pNumeroPedido" id="pNumeroPedido" class="form-control" disabled>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="">Hora - Fecha</label>
                                                                <input type="text" name="pFechaPedido" id="pFechaPedido" class="form-control" disabled>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="">Estado actual</label>
                                                                <input type="text" class="form-control" disabled id="estadoActualPedido" name="estadoActualPedido">
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
<!-- /.container-fluid -->