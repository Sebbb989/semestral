<header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            <img src="assets/images/new-logo.png" align="klassy cafe html template">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="/index.php" class="active">Inicio</a></li>
                           	
							<?php if (!isset($_SESSION["id_usuario"])) { ?>
							<li class="nav-item"><a href="<?php echo "index.php?c=" . seg::codificar("usuario") . "&m=" . seg::codificar("login") ?>" >Iniciar</a></li>
							<li class="nav-item cta"><a href="<?php echo "index.php?c=" . seg::codificar("usuario") . "&m=" . seg::codificar("registro") ?>" >Registro</a></li>
							<?php } else { ?>
							<li class="submenu">
                                <a href="javascript:;"><?php echo $_SESSION["usuario"] ?></a>
                                <ul>
                                    <li><a href="#">Configurar Cuenta</a></li>
                                    <li><a href="<?php echo "index.php?c=" . seg::codificar("usuario") . "&m=" . seg::codificar("cerrar_sesion") ?>">Cerrar Sesion</a></li>
                                </ul>
                            </li>
							<?php }  ?>
                            <!-- <li class=""><a rel="sponsored" href="https://templatemo.com" target="_blank">External URL</a></li> -->
                            
                        	</ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
