// $(document).ready(function(){
//     if ($("#formDataCliente")) {
//         let totalPago = 0.0;
//         $("#dataTablePedidos").on("click", "button.btnAction", function() {
//             let idEditCliente = $(this).attr("idCliente");
//             let infoData = {
//                 idEditCliente
//             }
//             $.ajax({
//                 type: "POST",
//                 url: "ajax/clientes.php",
//                 data: infoData,
//                 success: function(response) {
//                     let dataJson = JSON.parse(response);
//                     $("#pNombreCliente").val(dataJson.nombre);
//                     $("#pApellidoCliente").val(dataJson.apellido);
//                     $("#pDNICliente").val(dataJson.dni);
//                     $("#pTelefonoCliente").val(dataJson.telefono);
//                     $("#pCelularCliente").val(dataJson.celular);
//                     $("#pEmailCliente").val(dataJson.email);
//                     $("#pProvinciaCliente").val(dataJson.provincia);
//                     $("#pCantonCliente").val(dataJson.canton);
//                     $("#pParroquiaCliente").val(dataJson.parroquia);
    
//                     let idPedido = $(".btnAction").attr("idpedido");
//                     console.log(idPedido);
//                     $.ajax({
//                         type: "POST",
//                         url: "ajax/pedidos.php",
//                         data: {
//                             idPedido
//                         },
//                         success: function (response) {
//                             console.log(response);
//                             let dataPedido = JSON.parse(response);
//                             $("#pNumeroPedido").val(dataPedido.codigo);
//                             $("#pFechaPedido").val(dataPedido.fecha_creacion);
//                             $("#estadoActualPedido").val(dataPedido.estado);
//                             totalPago = Number(dataPedido.total);
//                             if($(".btnCambiarEstado") && $(".btnEliminarPedido")){
//                                 $(".btnCambiarEstado").attr('cmPedido',dataPedido.id);
//                                 $(".btnEliminarPedido").attr('deletePedido',dataPedido.id);
//                             }   
    
//                             $.ajax({
//                                 type: "POST",
//                                 url: "ajax/pedidos.php",
//                                 data: {
//                                     "getDetallePedido" : idPedido
//                                 },
//                                 success: function (response) {
//                                     let dataDetallePedidos = JSON.parse(response);
//                                     printTableDetallePedido(dataDetallePedidos);
//                                 }
//                             });
//                         }
//                     });
//                 }
//             });
//         })
    
//         function printTableDetallePedido(data){
//             console.log(data);
//             let insertDetallePedido = '';
//             for(const item of data){
//                 insertDetallePedido += `<tr>
//                 <td>${item.nombre_producto}</td>
//                 <td>${item.descripcion_producto}</td>
//                 <td>$ ${item.precio}</td>
//                 <td>${item.cantidad}</td>
//                 <td>$ ${item.subtotal}</td>
//                 </tr>`;
//             }
//             $("#tbodyDetallePedido").html(insertDetallePedido);
//             printFooter();
//         }
//         function printFooter(){
//             let tbody = document.getElementById('tbodyDetallePedido');
//             let insertFooter = `<tr class="bg-dark text-white">
//             <th colspan="4">Total</th>
//             <th colspan="1">$ ${totalPago.toFixed(2)}</th> 
//             </tr>`;
    
//             tbody.innerHTML += insertFooter;
//         }


//         $(".btnCambiarEstado").on("click",function(e){
//             e.preventDefault();
//             let cmbPedidoPerId = $(this).attr("cmPedido");
//             let newEstado = $("#selectEstadoPedido").val();
//             if(newEstado != '' && newEstado != undefined){
//                 Swal.fire({
//                     title: '¿Desea confirmar esta acción?',
//                     text: "¡Al aceptar, el estado del pedido cambiará por el estado seleccionado. Se le redirigirá a la tabla correspondiente!",
//                     icon: 'warning',
//                     showCancelButton: true,
//                     confirmButtonColor: '#3085d6',
//                     cancelButtonColor: '#d33',
//                     confirmButtonText: '¡Confirmar!',
//                     cancelButtonText: "Cancelar",
//                 }).then((result) => {
//                     if(result.isConfirmed){
//                         $.ajax({
//                             type: "POST",
//                             url: "ajax/pedidos.php",
//                             data: {
//                                 cmbPedidoPerId,
//                                 newEstado
//                             },
//                             success: function (response) {
//                                 let dataJson = JSON.parse(response);
//                                 if(dataJson.verificado == true){
//                                     Swal.fire(
//                                         'Actualizado',
//                                         'El estado del pedido se ha actualizado',
//                                         'success'
//                                     ).then((result) => {
//                                         if (result.isConfirmed) {
//                                             window.location.href = (newEstado == "Verificado") ? "pedidos-verificados" : "pedidos-enviados";
//                                         }
//                                     })
//                                 }
//                             }
//                         });
//                     }
//                 })
//             }else{
//                 Swal.fire(
//                     'No existen cambios detectados',
//                     'La página actual se recargará',
//                     'warning'
//                 ).then((result) => {
//                     if (result.isConfirmed) {
//                         let pageRedirect = '';
//                         if($("#estadoActualPedido").val() == "Pendiente"){
//                             pageRedirect = "pedidos-pendientes";
//                         }else if($("#estadoActualPedido"). val() == "Verificado"){
//                             pageRedirect = "pedidos-verificados";
//                         }else if($("#estadoActualPedido").val() == "Enviado"){
//                             pageRedirect = "pedidos-enviados";
//                         }
//                         window.location.href = pageRedirect;
//                     }
//                 })
//             }
//         })
//         $(".btnEliminarPedido").on("click",function(e){
//             e.preventDefault();
//             Swal.fire({
//                 title: '¿Se eliminará este pedido?',
//                 text: "¡Esta acción no se puede revertir, se eliminarán todo lo relacionado con este pedido!",
//                 icon: 'warning',
//                 showCancelButton: true,
//                 confirmButtonColor: '#3085d6',
//                 cancelButtonColor: '#d33',
//                 confirmButtonText: 'Si, eliminarlo!',
//                 cancelButtonText: "Cancelar",
//             }).then((result) => {
//                 if(result.isConfirmed){
//                     let deletePedidoPerId = $(this).attr("deletePedido");
//                     $.ajax({
//                         type: "POST",
//                         url: "ajax/pedidos.php",
//                         data: {
//                             deletePedidoPerId
//                         },
//                         success: function (response) {
//                             let dataJson = JSON.parse(response);
//                             if(dataJson.verificado == true){
//                                 Swal.fire(
//                                     'Eliminado',
//                                     'El pedido y sus detalles se han eliminado.',
//                                     'success'
//                                 ).then((result) => {
//                                     if (result.isConfirmed) {
//                                         let pageRedirect = '';
//                                         if($("#estadoActualPedido").val() == "Pendiente"){
//                                             pageRedirect = "pedidos-pendientes";
//                                         }else if($("#estadoActualPedido"). val() == "Verificado"){
//                                             pageRedirect = "pedidos-verificados";
//                                         }else if($("#estadoActualPedido").val() == "Enviado"){
//                                             pageRedirect = "pedidos-enviados";
//                                         }
//                                         window.location.href = pageRedirect;
//                                     }
//                                 })
//                             }
//                         }
//                     });
//                 }
//             })
//         })
//     }
// })

