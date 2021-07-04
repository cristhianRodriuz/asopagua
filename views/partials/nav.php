    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>


        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter" id="qyNewOrders"></span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Nuevos pedidos
                    </h6>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-donate text-white"></i>
                            </div>
                        </div>
                        <div id="mensajeNuevosPedidos">
                        </div>
                    </a>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Ver todos los pedidos</a>
                </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["full_name"]; ?></span>
                    <img class="img-profile rounded-circle" src="<?php echo URL;?>uploads/perfiles/<?php echo $_SESSION["perfil"];?>">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="logout" id="logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Cerrar sesión
                    </a>
                </div>
            </li>

        </ul>
    </nav>
    <script>
    $().ready(function() {
        let idUsuario = <?php echo $_SESSION["id"] ?>;
        let dataInicio = {
            "initialData": idUsuario
        };
        if (localStorage.getItem("initialize_data")) {
            dataInicio["reload"] = "Yes";
        } else {
            dataInicio["reload"] = "No";
            localStorage.setItem("initialize_data", "OK");
        }
        $.ajax({
            type: "POST",
            url: "ajax/administrador.php",
            data: dataInicio,
            success: function(response) {
                initialData(JSON.parse(response));
            }
        });

        function initialData(dataJson) {
            $("#qyProductos").html(dataJson.productos);
            $("#qyPedidos").html(dataJson.pedidos);
            $("#qyClientes").html(dataJson.clientes);
            $("#qyUsuarios").html(dataJson.usuarios);
            if (dataJson.nuevos_pedidos == 0) {
                $("#qyNewOrders").html(dataJson.nuevos_pedidos);
                $("#mensajeNuevosPedidos").html("Hola, no hay nuevos pedidos registrados");
            } else {
                $("#qyNewOrders").html(dataJson.nuevos_pedidos + '+');
                $("#mensajeNuevosPedidos").html("Hola, desde la última vez que se conectó, hemos recibido " + dataJson.nuevos_pedidos + ' pedidos nuevos.');
            }
        }
        $("#logout").on("click", () => {
            localStorage.removeItem("initialize_data");
        });
    });
</script>