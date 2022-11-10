<?php 
    session_start();
    if (!isset($_SESSION["estadoAutentica"])) {
        header('Location:http://localhost/HorasExtra/');
    }
?>

<section id="four" class="wrapper style1 special fade-up">
    <div class="table-wrapper" style="--left:200px">
		<table class="alt" id="dataTable" data-page-length='5' style="width:80%;">
			<thead>
				<tr>
					<th>Id</th>
					<th>Fecha Reporte</th>
					<th>Año</th>
					<th>Mes</th>
					<th>Aprobador</th>
					<th>Estado</th>
					<th>Accion</th>
				</tr>
			</thead>
			<tbody id="tableBody">
				
			</tbody>
		</table>
	</div>
</section>