<?php
session_start();
if (!isset($_SESSION["estadoAutentica"])) {
    header('Location:http://localhost/HorasExtra/view/');
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
							<div class="col-4 col-8-xsmall"><input type="date" name="fechaInicio" id="fechaInicio" style="color: black" required/></div>
                            <label for="fechaFin" style="color: white;">Hasta</label>
							<div class="col-4 col-8-xsmall"><input type="date" name="fechaFin" id="fechaFin" style="color: black" required/></div>
							<div class="col-4 col-8-xsmall"><input type="submit" value="Generar" class="fit primary fit small" /></div>
						</div>
					</form>
				</div>
			</section>
        </div>
    </div>
</section>