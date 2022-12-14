<?php

if (!isset($_POST['id'])) {
    echo 'No hay datos';
}else{
?>

<section id="five" class="wrapper style2 special fade">
	<div class="container">
		<header>
			<h3 style="color: white;">Edición Reporte Hora Extra <?php echo $_POST['id']?></h3>
			<h2 style="color: white;">Estado: <span><?php echo $_POST['estadoNombre']?></span></h2>
			<input type="text" name="idReporteHE" id="idReporteHE" data-id="<?php echo $_POST['id']?>" style="display: none;">
		</header>

		<section class="col-12 col-4-medium col-12-xsmall">
			<h3 style="float: left; color: white;">Comentarios:</h3>
			<table>
				<tbody id="bodyComments">
					<!-- Llenar tabla -->
				</tbody>
			</table>
		</section>

		<section class="col-12 col-4-medium col-12-xsmall">
			<h3 style="float: left; color: white;">Añadir Comentario <span id="addComment" class="icon solid fit fa-plus-circle" style="color: #5480f1;"></span> <span id="hideComment" class="icon solid fit fa-minus-circle" style="display: none; color: #5480f1;"></span></h3>
		</section>
		<br>
		<br>
		<form method="post" action="#" >
			<div class="row gtr-uniform gtr-50 comentarios" >
				<!-- Cargar HTML Agregar comentarios -->
			</div>
		</form>
	</div>
</section>

<div id="formReporte">
	<!-- Cargar HTML Reporte -->
</div>

<?php
}
?>