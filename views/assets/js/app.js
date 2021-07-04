let idLast;
$().ready(async () => {
    if ($("#formUser")) {
        $("#formUser").on("change", function (e) {
            let id = e.target.id;
            if (e.target.value.length > 0 && id != 'files') {
                if (id == "email") {
                    $.ajax({
                        type: "POST",
                        url: "ajax/administrador.php",
                        data: {
                            emailUser: e.target.value
                        },
                        success: function (response) {
                            let resDNI = JSON.parse(response);
                            Swal.fire({
                                title: "Verificando e-mail",
                                html: "Esperando a que el sistema verifique el e-mail. Esto puede tardar un momento",
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
                                if (resDNI.verificado == false) {
                                    removeDisabled();
                                    createUsername();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Esta dirección de correo no está disponible!',
                                        text: 'Ingrese una dirección de correo diferente'
                                    })
                                    addDisabled();
                                }
                            })
                        }
                    });
                } else if (id == "dni") {
                    let value = e.target.value;
                    if (value.length != 10) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Un DNI esta compuesto por 10 números',
                            text: 'Ingrese un número de DNI válido...'
                        })
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "ajax/administrador.php",
                            data: {
                                dniUser: value
                            },
                            success: function (response) {
                                let respuesta = JSON.parse(response);
                                Swal.fire({
                                    title: "Verificando DNI",
                                    html: "Esperando a que el sistema verifique el DNI. Esto puede tardar un momento",
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
                                    if (respuesta.verificado == false) {
                                        $("#email").removeAttr("disabled");
                                    } else {
                                        $("#email").attr("disabled", true);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Esta número de DNI no está disponible!',
                                            text: 'Ingrese un número de DNI diferente!'
                                        })
                                    }
                                })
                            }
                        });
                    }
                } else if (id == "celular") {
                    let value = e.target.value
                    if (value.length != 10) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Debe contener al menos 10 números',
                            text: 'Ingrese un número de celular válido...'
                        })
                    }
                } else if (id == "telefono") {
                    let value = e.target.value
                    if (value.length != 10) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Debe contener al menos 10 números',
                            text: 'Ingrese un número de teléfono válido...'
                        })
                    }
                }
            }
        })
        $("#dataTableUsuarios").on("click", "button.btnAction", function () {
            let idPerfil = $(this).attr("idUsuario");
            console.log(idPerfil);
            console.log($(this));
            let infoData = {
                idPerfil
            };
            $.ajax({
                type: "POST",
                url: 'ajax/administrador.php',
                data: infoData,
                success: function (response) {
                    let imgUrl = $("#imgUser").data("dir");
                    let data = JSON.parse(response);
                    $(".titleModal").html("CONFIGURACIÓN PERFIL DE USUARIO");
                    $(".idUsuario").val(data.id);
                    $("#nombre").val(data.nombre);
                    $("#apellido").val(data.apellido);
                    $("#dni").val(data.dni);
                    $("#email").val(data.email);
                    $("#celular").val(data.celular);
                    $("#telefono").val(data.telefono);
                    $("#username").val(data.username);
                    $("#password").val("**********");
                    $("#inputState option[value='" + data.rol + "']").attr("selected", true);
                    $("#imgUser").attr('src', imgUrl + data.imagen);
                    $("#imgUser").attr('data-title',data.imagen);
                    $(".btnEditAdd").html("Editar");
                    $(".btnEliminar").show();
                    $(".btnEliminar").attr("id", idPerfil);
                    editInputs();
                }
            })
        })
        $(".btnNuevo").on("click", function () {
            let imgUrl = $("#imgUser").data("dir");
            $(".titleModal").html("Nuevo Usuario");
            $("#nombre").val("");
            $("#apellido").val("");
            $("#dni").val("");
            $("#email").val("");
            $("#celular").val("");
            $("#telefono").val("");
            $("#username").val("");
            $("#password").val("");
            $(".btnEditAdd").html("Registrar");
            $("#imgUser").attr('src', imgUrl + "userDefault.png");
            $(".btnEliminar").hide();
            initializeInputs();
        })

        $("#formUser").on("click", "button.btnEliminar", function () {
            Swal.fire({
                title: '¿Estás seguro de eliminar a este usuario?',
                text: "¡Esta acción no se puede revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!',
                cancelButtonText: "Cancelar",
            }).then((result) => {
                let idEliminar = $(this).attr("id");
                let infoDelete = {
                    idEliminar
                }
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: 'ajax/administrador.php',
                        data: infoDelete,
                        success: function (response) {
                            if (response) {
                                Swal.fire(
                                    'Eliminado',
                                    'El usuario ha sido eliminado satisfactoriamente.',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "usuarios";
                                    }
                                })
                            }
                        }
                    })
                }
            })
        })
        $("#formUser").on("submit", function (e) {
            e.preventDefault();
            let formData = new FormData();
            let files = $("#files")[0].files[0];
            formData.append("accion", ($("#btnEditAdd").html() == "Editar") ? "Editar" : "Agregar");
            console.log(formData.get("accion"));
            if (formData.get("accion") == "Editar" && files == undefined) {
                formData.append("uploadImage", "NO");
                formData.append("imageDefault", $("#imgUser").data('title'));
            } else if (formData.get("accion") == "Agregar" && files == undefined) {
                formData.append("uploadImage", "NO");
                formData.append("imageDefault", "userDefault.png");
            } else {
                formData.append("uploadImage", "SI");
                formData.append("regImagenUser", files);
            }
            if ($("#btnEditAdd").html() == "Editar") {
                formData.append("editIdUser", $(".idUsuario").val());
            }
            formData.append("regNombreUser", $("#nombre").val());
            formData.append("regApellidoUser", $("#apellido").val());
            formData.append("regDniUser", $("#dni").val());
            formData.append("regEmailUser", $("#email").val());
            formData.append("regCelularUser", $("#celular").val());
            formData.append("regTelefonoUser", $("#telefono").val());
            formData.append("regUsernameUser", $("#username").val());
            formData.append("regPasswordUser", $("#password").val());
            formData.append("regRolUser", $("#inputState").val());
            formData.append("regRegistrado_porUser", $("#registrado_por").val());
            formData.append("regFecha_creacionUser", new Date());
            $.ajax({
                type: "POST",
                url: "ajax/administrador.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (status) {
                    let stat = JSON.parse(status);
                    let mensaje = (formData.get("accion") == "Editar") ? "Usuario editado correctamente" : "Usuario agregado correctamente";
                    if (stat.verificado) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: mensaje,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "usuarios";
                            }
                        })
                    } else {
                        Swal.fire(
                            'No se ha realizado ningun cambio',
                            'Se actualizará la página',
                            'warning'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "usuarios";
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
                $("#imgUser").removeAttr('src');
                $("#imgUser").attr('src', imgCodified);
            }
        })
        function addDisabled() {
            $("#celular").attr("disabled", true);
            $("#telefono").attr("disabled", true);
            $("#username").attr("disabled", true);
            $("#password").attr("disabled", true);
            $(".btnEditAdd").attr("disabled", true);
        }

        function removeDisabled() {
            $("#celular").removeAttr("disabled");
            $("#telefono").removeAttr("disabled");
            $("#password").removeAttr("disabled");
            $(".btnEditAdd").removeAttr("disabled");
            $("#inputState").removeAttr("disabled");
        }

        function createUsername() {
            let nombre = $("#nombre").val();
            let apellido = $("#apellido").val();
            let dni = $("#dni").val();
            let nameUsuario = nombre.charAt(0).toLowerCase() + apellido.toLowerCase() + dni.substring(6, dni.length);
            $("#username").val(nameUsuario);
        }

        function editInputs() {
            $("#nombre").attr("disabled", true);
            $("#apellido").attr("disabled", true);
            $("#dni").attr("disabled", true);
            $("#email").removeAttr("disabled");
            $("#celular").removeAttr("disabled");
            $("#telefono").attr("disabled", false);
            $("#password").attr("disabled", true);
            $("#btnEditAdd").removeAttr("disabled");
            $("#inputState").attr("disabled", true);
        }

        function initializeInputs() {
            $("#nombre").attr("disabled", false);
            $("#apellido").attr("disabled", false);
            $("#dni").attr("disabled", false);
            $("#email").attr("disabled", true);
            $("#celular").attr("disabled", true);
            $("#telefono").attr("disabled", true);
            $("#password").attr("disabled", true);
            $("#btnEditAdd").attr("disabled", false);
            $("#inputState").attr("disabled", true);
        }

    }
})
