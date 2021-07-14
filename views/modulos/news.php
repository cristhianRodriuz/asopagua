<link rel="stylesheet" href="https://assets.jumpseller.com/store/verduleria-online/themes/290816/styles.css?1619244409" />
<link rel="stylesheet" href="https://assets.jumpseller.com/store/verduleria-online/themes/290816/color_pickers.css?1619244409" />
<link rel="stylesheet" href="https://assets.jumpseller.com/store/verduleria-online/themes/290816/linear-icon.css?1619244409" />

<body>
    <header class="header">
        <div class="preheader">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="preheader-message">
                            Estamos en facebook como: <a href="https://www.facebook.com/asopagua.asopagua.75" class="text-white" target="_blank"><b>@Asopagua</b></a> ¡Síguenos!
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="logo-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 d-lg-none text-center mb-3">
                        <a href="/" title="Asopagua" class="navbar-brand">
                            <img src="<?php echo URL . VW ?>assets/images/ASOPAGUA.png" class="store-image" alt="Asopagua" />
                        </a>
                    </div>
                    <div class="col-2 d-lg-none">
                        <button class="btn primary mobile-menu-trigger">
                            <div class="nav-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </button>
                    </div>
                    <div class="col-lg-4 col-md-4 d-none d-lg-block">
                        <a href="" title="Despacho Pistacho" class="navbar-brand">
                            <span class="logo_text">Logo pendiente</span>
                        </a>
                    </div>
                    <div class="col-lg-4 col-8">
                        <form id="search_mini_form" class="form-group" method="get" action="/search">
                            <input type="text" value="" name="q" class="form-control form-control-sm" onFocus="javascript:this.value=''" placeholder="Buscar productos" />
                            <button type="submit" class="btn primary"><i class="linear-icon icon-0803-magnifier"></i></button>
                        </form>
                    </div>
                    <div class="col-lg-4 col-2 text-right">
                        <div class="header-cart">
                            <span class="cart-size">0</span>
                            <a id="cart-link" href="<?php URL . VW ?>cart" class="btn secondary">
                                <i class="linear-icon icon-0333-bag2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-area">
            <nav id="mobile-menu" aria-labelledby="menu-trigger" class="trsn d-lg-none">
                <ul>
                    <li class=" mobile">
                        <a href="/inicio" title="inicio">Inicio</a>
                    </li>
                    <li class=" mobile">
                        <a href="/nosotros" title="nosotros">Nosotros</a>
                    </li>
                    <li class=" mobile">
                        <a href="catalogo-productos" title="productos">Productos</a>
                    </li>
                    <li class=" mobile">
                        <a href="/contacto" title="contacto">Contacto</a>
                    </li>
                </ul>
            </nav>
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-12">
                        <div class="navbar navbar-expand-lg">
                            <div id="main-menu" class="collapse navbar-collapse">
                                <ul class="navbar-nav mr-auto list-group-horizontal d-table">
                                    <li class="nav-item d-table-cell">
                                        <a href="/" title="inicio" class=" trsn nav-link d-table-cell align-middle">Inicio</a>
                                    </li>
                                    <li class="nav-item d-table-cell">
                                        <a href="/nosotros" title="nosotros" class=" trsn nav-link d-table-cell align-middle">Nosotros</a>
                                    </li>
                                    <li class="nav-item d-table-cell">
                                        <a href="catalogo-productos" title="productos" class=" trsn nav-link d-table-cell align-middle">Productos</a>
                                    </li>
                                    <li class="nav-item d-table-cell">
                                        <a href="/noticias" title="Noticias" class=" trsn nav-link d-table-cell align-middle">Noticias</a>
                                    </li>
                                    <li class="nav-item d-table-cell">
                                        <a href="/contacto" title="Contacto" class=" trsn nav-link d-table-cell align-middle">Contacto</a>
                                    </li>
                                </ul>
                                <ul class="social navbar-toggler-right list-inline d-none d-xl-block">
                                    <li class="list-inline-item">
                                        <a href="" class="trsn" title="Ir a Facebook" target="_blank">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="" class="trsn" title="Ir a Instagram" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="" class="trsn" title="WhatsApp" target="_blank">
                                            <i class="fab fa-whatsapp fa-fw"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!---<main class="container container-main">
    	<div class="col-12">
    		<h2 class="block-header">Noticias Recientes</h2>
    	</div>
    </main>-->
    <main class="container container-main" id="contentNoticesEmpty">

    </main>
    <main id="contentNotices">
        <div>
            <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
                <div class="col-md-8 mx-auto">
                    <h3 class="display-4 font-italic text-center" id="notice-welcome">ASOPAGUA INFORMA</h3>
                    <p class="lead my-3" id="description">Bienvenido a la sección de noticias relacionados con la Asociación Asopagua. Entererese de lo todo lo relacionado con la Asociación. </br> </br> Nuevos productos, nuevas ofertas, nuevos distribuidores, trabajo para y con la comunidad.... <br> Enteresé desde las fuentes oficiales de la Asociación.</p>
                </div>
            </div>
        </div>
        <div class="container container-fluid">
            <div class="row mb-2" id="card-notices">
                <template id="notices">
                    <div class="col-md-6">
                        <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                            <div class="card-body d-flex flex-column align-items-start">
                                <strong class="d-inline-block mb-2 text-primary title-categoria">World</strong>
                                <h3 class="mb-0">
                                    <a class="text-dark title-noticia" href="#">Featured post</a>
                                </h3>
                                <div class="mb-1 text-muted notice-creator">Nov 12</div>
                                <p class="card-text mb-auto notice-description">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                                <button type="button" class=" btn btn-notice continueReading" data-toggle="modal" data-target="#modalNoticia">Continuar leyendo</button>
                            </div>
                            <img class="card-img-right flex-auto d-none d-lg-block img-notice img-fluid img-thumbnail" src="<?php echo URL . VW ?>assets/images/notice_1.jpg" alt="Card image cap">
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </main>
    <div class="my-5 mt-3">
        <!-- Footer -->
        <footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
            <!-- Section: Social media -->
            <section class="d-flex justify-content-between p-4" style="background-color:rgb(0, 98, 98)">
                <!-- Left -->
                <div class="me-5">
                    <span>Recuerda buscarnos en nuestra página oficial de Facebook:</span>
                </div>
                <!-- Left -->

                <!-- Right -->
                <div>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </div>
                <!-- Right -->
            </section>
            <!-- Section: Social media -->

            <!-- Section: Links  -->
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold c-white">Nuestra Asociación</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: rgb(0, 98, 98); height: 2px" />
                            <p class="font-italic c-white">
                                "Nuestra asociación tiene garantía de calidad e higiene de todos los productos lacteos"
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold c-white">Productos</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: rgb(0, 98, 98); height: 2px" />
                            <p>
                                <a href="#!" class="text-white">Leche Cruda</a>
                            </p>
                            <p>
                                <a href="#!" class="text-white">Yogourt</a>
                            </p>
                            <p>
                                <a href="#!" class="text-white">Queso</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold c-white">Secciones</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: rgb(0, 98, 98); height: 2px" />
                            <p>
                                <a href="#!" class="text-white">¿Quienes Somos?</a>
                            </p>
                            <p>
                                <a href="#!" class="text-white">Productos</a>
                            </p>
                            <p>
                                <a href="#!" class="text-white">Noticias</a>
                            </p>
                            <p>
                                <a href="#!" class="text-white">Contacto</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold c-white">Contact</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                            <p class="text-white"><i class="fas fa-home mr-3"></i> Parroquia Guasaganga La Mana, Cotopaxi, Ecuador</p>
                            <p class="text-white"><i class="fas fa-envelope mr-3"></i> asopagua@gmail.com</p>
                            <p class="text-white"><i class="fas fa-phone mr-3"></i> + 593 9815 7450 08</p>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>
            <!-- Section: Links  -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
                © 2020 Copyright:
                <a class="text-white">ASOPAGUA OFICIAL</a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->

    </div>
    <div class="modal fade" id="modalNoticia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-notice">
        <h5 class="modal-title text-white" id="modalNoticiaTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
            <div class="card-header">
                <p>Publicado por:  <span class="text-muted" id="creador"></span></p>
                <p class="text-muted font-italic" id="fecha_creacion"></p>    
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <img  id="imgNoticia" class="img-thumbnail" alt="">
                    </div>
                    <div class="col-6">
                        <p id="noticia_desarrollo"></p>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
    <script>
        let notices_arr;
        $(document).ready(function() {
            const notices = document.getElementById('notices').content;
            const card_notice = document.getElementById('card-notices');
            const fragment = document.createDocumentFragment();
            $.ajax({
                type: "POST",
                url: "ajax/noticias.php",
                data: {
                    "getAllNoticias": ""
                },
                success: function(response) {
                    notices_arr = JSON.parse(response);
                    printNotices(notices_arr);
                }
            });

            function printNotices(notices_arr) {
                if (notices_arr.length > 0) {
                    notices_arr.forEach(element => {
                        notices.querySelector(".title-categoria").textContent = "Asopagua";
                        notices.querySelector(".title-noticia").textContent = element.titulo;
                        notices.querySelector(".notice-description").textContent = element.descripcion;
                        notices.querySelector(".notice-creator").textContent = element.publicador;
                        notices.querySelector(".continueReading").setAttribute("onclick", `continueReading(${element.id})`);
                        notices.querySelector(".img-notice").setAttribute('src', '<?php echo URL; ?>uploads/noticias/' + element.imagen);
                        const clone = notices.cloneNode(true);
                        fragment.appendChild(clone);

                    });
                    card_notice.appendChild(fragment);
                } else {
                    printEmptyNotices();
                }
            }

            function printEmptyNotices() {
                $("#contentNotices").hide();
                let printData = `<div class="row">
    		<div class="col-md-10 mx-auto">
    			<div class="card">
    				<div class="card-header bg-notice text-center p-4">
    					<h3 class="text-white">¡Actualmente, no existen noticias publicadas..!</h3>
    				</div>
    				<div class="card-body">
    					<h4>Estamos trabajando para brindarte información actualizada sobre nuestros productos y servicios. En esta sección podras encontrarte con noticias relacionadas con las ASOCIACIÓN ASOPAGUA.</br></br>
                        
                        Te mantendremos informado sobre el lanzamiento de nuevos productos, inclusión de nuevos distribuidores, actualización de los precios de nuestros productos, así como el trabajo que realiza nuestra Asociación para y con la comunidad.</h4>
    				</div>
    			</div>
    		</div>
    	</div>`;
                $("#contentNoticesEmpty").html(printData);
            }
        });

        function continueReading(id) {
            let id_noticia = id;
            let selectNoticia = notices_arr.filter(noticia => noticia.id == id_noticia);
            $("#modalNoticiaTitle").html(selectNoticia[0].titulo);
            $("#creador").html(selectNoticia[0].publicador);
            $("#fecha_creacion").html(selectNoticia[0].fecha_creacion);
            $("#noticia_desarrollo").html(selectNoticia[0].desarrollo);
            $("#imgNoticia").attr('src','<?php echo URL;?>uploads/noticias/' + selectNoticia[0].imagen);
        }
    </script>
    <style>
        #notice-welcome {
            font-weight: bold;
        }
        #modalNoticiaTitle{
            color: white;
            text-transform: uppercase;
            text-align: center;
        }
        .c-white {
            color: white;
        }

        .img-notice {
            width: 250px;
            height: 250px;
        }

        .continueReading {
            cursor: pointer;
        }

        .btn-notice {
            background-color: rgb(0, 98, 98);
            font-size: 14px;
            display: block;
            width: 100%;
        }

        .jumbotron {
            background-image: url("<?php echo URL . VW ?>assets/images/hero.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            height: 400px;
        }

        .bg-notice {
            background-color: rgb(0, 98, 98);
        }

        .card-body h4 {
            color: black;
            text-align: justify;
        }
    </style>

</body>