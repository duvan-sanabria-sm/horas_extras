<?php
session_start();
if (!isset($_SESSION["estadoAutentica"])) {
	require_once "../../config/LoadConfig.config.php";
	$config = LoadConfig::getConfig();
	header('Location:' . $config['URL_SITE'] . 'index.php');
}
?>
<section id="four" class="wrapper style1 special fade-up" style="height: 75vh;">
	<div class="container">
		<div class="box alt">
			<section id="five" class="wrapper style2 special fade">
				<div class="container">
					<header>
						<h3 style="color: white;">Seleccione un rango de fechas</h3>
					</header>
					<form method="post" action="reporte/template.php" class="cta">
						<div class="row gtr-uniform gtr-50">
							<label for="fechaInicio" style="color: white;">Desde</label>
							<div class="col-4 col-8-xsmall"><input type="date" name="fechaInicio" id="fechaInicio" style="color: black" required /></div>
							<label for="fechaFin" style="color: white;">Hasta</label>
							<div class="col-4 col-8-xsmall"><input type="date" name="fechaFin" id="fechaFin" style="color: black" required /></div>
							<div class="col-4 col-8-xsmall"><input type="submit" value="Generar" class="fit primary fit small" /></div>
						</div>
					</form>
					<blockquote>Para generar el reporte del mes, seleccione el primer día del mes anterior al mes a generar y el último día del mes a generar.<br>
						Eje: Julio - 01/06/<?php echo date("Y"); ?> hasta 31/07/<?php echo date("Y"); ?>
					</blockquote>
				</div>
			</section>
		</div>
	</div>
</section>