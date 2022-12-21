        <!-- Header -->
		<header id="header">

			<nav id="nav">
				<ul>
                    <li><a href="" class="menuItem" id="reportar">Reportar Horas Extra</a></li>
					<li><a href="" class="menuItem" id="estado">Mis Horas Extra</a></li>
                    <?php 
                        if (isset($_SESSION["rol"]) || isset($_SESSION["isAdmin"])) {
                            if (strcasecmp($_SESSION["rol"], 'Jefe') == 0 || strcasecmp($_SESSION["rol"], 'Gerente') == 0 || strcasecmp($_SESSION["isAdmin"], 'Si') == 0) {
                            
                    ?>
					<li><a href="" class="menuItem" id="gestionar" data-aprobador="<?php echo $_SESSION['idAprobador']?>">Gestionar Horas Extra</a></li>
                    <?php 
                            }
                            if (strcasecmp($_SESSION["isAdmin"], 'Si') == 0) {
                    ?>

                    <li>
                        <a href="#" id="admin">Administrar</a>
						<ul>
                            <li><a href="#" onclick="adminCECO(event)">Centros de Costo</a></li>
							<li><a href="#" onclick="adminAprobadores(event)">Aprobadores</a></li>
							<li><a href="#">Tipos de Recargo</a></li>
							<li><a href="#">Tipos de HE</a></li>
						</ul>
					</li>

                    <?php 
                            }
                        }

                        if (isset($_SESSION["gestion"]) || (isset($_SESSION["isAdmin"]) && strcasecmp($_SESSION["isAdmin"], 'Si') == 0)) {
                            
                            if (strcasecmp($_SESSION["gestion"], 'RH') == 0 || strcasecmp($_SESSION["isAdmin"], 'Si') == 0) {
                    ?>

                    <li><a href="#" class="menuItem" id="gestionarRH">Gestion RH</a></li>

                    <?php 
                            }
                            if (strcasecmp($_SESSION["gestion"], 'Contable') == 0 || strcasecmp($_SESSION["isAdmin"], 'Si') == 0) {
                    ?>

                    <li><a href="#" class="menuItem" id="mainContable">Gestion Contable</a>
                        <ul>
                            <li><a href="#" id="gestionarContable" onclick="gestionContable(event)">Aprobar/Rechazar</a></li>
                            <li><a href="#" id="reporte" onclick="reporte(event)">Generar Reporte</a></li>
                        </ul>
                    </li>

                    <?php
                            }
                    
                        } 
                    ?>

                    <li id="user">
                        <span style="font-size: 25px;" class="icon solid fa fa-user-circle fi"></span>
                        <a href="#" id="usuarioLogin"><?php echo $_SESSION['usuario']?></a>
                        <a href="#" id="close" class="button primary" style="display: none; margin-left: 1em;">Salir</a>
                    </li>

				</ul>
			</nav>
		</header>