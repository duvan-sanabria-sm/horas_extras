<?php
session_start();
if (!isset($_SESSION["estadoAutentica"])) {
    header('Location:http://localhost/HorasExtra/view/');
}
?>

<section id="four" class="wrapper style1 special fade">
	<div class="container summaryContainer">
		<header>
			<h3>Aprobar / Rechazar Horas Extra</h3>
            <div id="typeGestion" data-type="" data-rol=""></div>
		</header>

		<section class="col-12 col-4-medium col-12-xsmall" style="--left:0px">
            <div class="top">
                <ul class="actions special">
                    <li> <button type="submit" id="allAprove" class="button icon solid fa-check-circle fit" style="background-color: #3c763d">Aprobar</button> </li>
                    <li> <button type="submit" id="allReject" class="button icon solid fa-trash-alt fit" style="background-color: tomato">Rechazar</button> </li>
                </ul>
                <div class="col-4 col-6-xsmall" id="moduloGestionar" style="margin: auto; padding: 10px; width: 550px;">
                </div>
                <div class="col-4 col-6-xsmall" id="resultTest" style="margin: auto; padding: 10px; width: 550px;">
                </div>
                <hr>
            </div>
            <div class="row gtr-uniform">
                <section class="col-4 col-6-medium col-12-xsmall" style="width: 15%;">
                    <button id="selectAllRows" class="button primary icon solid fa-check-circle fit" style="background-color: #3c763d;">Seleccionar Todo</button>
                </section>
                <section class="col-4 col-6-medium col-12-xsmall" style="width: 15%;">
                    <button id="deselectAllRows" class="button primary icon solid fa-check-circle fit">Deseleccionar Todo</button>
                </section>
            </div>
            <br>
            <div style="overflow: auto; max-width: 100%;">
                <table class="alt tableSummary cell-border display compact" id="dataTable" style="max-width:100%;">
                    <thead>
                        <tr id="encabezadoTable">
                            <th>Ver Mas</th>
                            <th>Num</th>
                            <th>Id</th>
                            <th># Documento</th>
                            <th>Año</th>
                            <th>Mes</th>
                            <th>Colaborador</th>
                            <th>Estado</th>
                            <th>Clase</th>
                            <th>CeCo</th>
                            <th>Descuento</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Llenar tabla -->
                    </tbody>
                </table>
            </div>
		</section>
	</div>
</section>
