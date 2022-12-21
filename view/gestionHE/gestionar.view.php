<?php
session_start();
if (!isset($_SESSION["estadoAutentica"])) {
    header('Location:http://gestionhe.servimeters.net:86/');
}
?>

<section id="four" class="wrapper style1 special fade">
	<div class="container">
		<header>
			<h3>Aprobar / Rechazar Horas Extra</h3>
            <div id="typeGestion" data-type=""></div>
		</header>

		<section class="col-12 col-4-medium col-12-xsmall" style="--left:0px">
			<table class="alt" id="dataTable">
                <thead>
                <tr>
                    <th>Ver Mas</th>
                    <th>Num</th>
                    <th>Id</th>
                    <th># Documento</th>
                    <th>Año</th>
                    <th>Mes</th>
                    <th>Colaborador</th>
                    <th>Aprobador</th>
                    <th>Rol Aprobador</th>
                    <th>Estado</th>
                    <th>Ver detalle</th>
                </tr>
                </thead>
				<tbody id="tableBody">
					<!-- Llenar tabla -->
				</tbody>
			</table>
		</section>
	</div>
</section>
