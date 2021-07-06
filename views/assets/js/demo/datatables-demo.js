// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTableUsuarios').DataTable({
      "ajax": "ajax/dataTableUsuarios.php"
    });

  $("#dataTableClientes").DataTable({
    "ajax": "ajax/dataTableClientes.php"
  })
  $("#dataTableCategorias").DataTable({
    "ajax": "ajax/dataTableCategorias.php"
  })
  $("#dataTableProductos").DataTable({
    "ajax": "ajax/dataTableProductos.php"
  })
  $("#dataTablePedidos").DataTable({
    "ajax" :{
      "type": "POST",
      "url": "ajax/dataTablePedidos.php",
      "data": {
        "filter" : $("#dataTablePedidos").attr("filterTable")
      }
    }
  })
  $("#dataTableMensajesDistribuidor").DataTable({
    "ajax": "ajax/dataTableMensajesDistribuidor.php"
  })
  $("#dataTableNoticias").DataTable({
    "ajax": "ajax/dataTableNoticias.php"
  })

});
