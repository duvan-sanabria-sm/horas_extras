<?php
session_start();
if (!isset($_SESSION["estadoAutentica"])) {
	require_once "../../config/LoadConfig.config.php";
	$config = LoadConfig::getConfig();
	header('Location:' . $config['URL_SITE'] . 'index.php');
}
?>

<section id="four" class="wrapper style1 special fade-up">
	<div class="table-wrapper" style="--left:200px">
		<table class="alt tableStatus row-border display compact" id="dataTable" data-page-length='5' style="width:80%;">
			<thead>
				<tr>
					<th>Id</th>
					<th># Documento</th>
					<th>Centro Costo</th>
					<th>Clase</th>
					<th>Año</th>
					<th>Mes</th>
					<th>Aprobador</th>
					<th>Estado</th>
					<th>Accion</th>
					<th>Descarga</th>
				</tr>
			</thead>
			<tbody id="tableBody">

			</tbody>
		</table>
	</div>
</section>