<?php 
    session_start();
    if (!isset($_SESSION["estadoAutentica"])) {
        header('Location:http://localhost/HorasExtra/');
    }
?>
<!-- Form Reportar -->
<section id="four" class="wrapper style1 special fade-up">
	<div class="container">
		<header class="major">
			<h2>Reporte Horas Extra</h2>
			<p></p>
		</header>
		<div class="box alt">
			<form action="" id="formReporte">
				<div class="row gtr-uniform">
					<section class="col-3 col-4-medium col-12-xsmall">
						<h3>Cedula (Sin puntuación) <span class="error">*</span></h3>
						<input type="text" name="cc" id="cc" value="" placeholder="**********" data-empleado="<?php echo $_SESSION['usuario']?>" data-correoEmpleado="<?php echo $_SESSION['email']?>" pattern="[0-9]{1,10}" required/> <!-- title="Solo numeros. No debe exceder los 10 digitos." -->
					</section>
					<section class="col-3 col-4-medium col-12-xsmall">
						<h3>Centro de Costo <span class="error">*</span></h3>
						<select name="ceco" id="ceco" required>
							<!--Llenar datos con BD-->
						</select>
					</section>
					<section class="col-3 col-4-medium col-12-xsmall">
						<h3>Mes Reportado <span class="error">*</span></h3>
						<input type="month" name="mes" id="mes" value="" required/>
					</section>
					<section class="col-3 col-4-medium col-12-xsmall">
						<h3>Motivo de la Novedad <span class="error">*</span></h3>
						<textarea name="novedad" id="novedad" placeholder="Ingrese la novedad" rows="3" style="resize: none;" required></textarea>
					</section>

					<section class="col-12">
						<hr />
					</section>

					<section class="col-12">
						<header>
							<h3>Horas Extra (HE) <span class="icon solid fa-exclamation-triangle help" style="color: #e44c65 !important; padding: 3px;"></span></h3>
						</header>
					</section>

					<section class="col-12">
						<div class="table-wrapper">
							<table>
								<thead id="encTableHE">
									<!--Llenar datos con DB-->
								</thead>
								<tbody id="bodyTableHE">
									<!--Llenar datos con DB-->
								</tbody>
								<tfoot>
									<tr>
										<td colspan="3">Total</td>
										<td><span style="font-weight: bold; color: greenyellow;" id="calcHE">0</span></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</section>


					<section class="col-12">
						<hr />
					</section>

					<section class="col-12">
						<header>
							<h3>Recargos <span class="icon solid fa-exclamation-triangle help" style="color: #e44c65 !important; padding: 3px;"></span></h3>
						</header>
					</section>

					<section class="col-12">
						<div class="table-wrapper">
							<table>
								<thead id="encTableRecargo">
									<!--Llenar datos con DB-->
								</thead>
								<tbody id="bodyTableRecargo">
									<!--Llenar datos con DB-->
								</tbody>
								<tfoot>
									<tr>
										<td>Total</td>
										<td><span style="font-weight: bold;" id="calcRec">0</span></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</section>

					<section class="col-12">
						<hr />
					</section>

					<section class="col-12">
						<header>
							<h3>Permisos Descuentos <span class="icon solid fa-exclamation-triangle help" style="color: #e44c65 !important; padding: 3px;"></span></h3>
						</header>
					</section>

					<section class="col-12">
						<div class="table-wrapper">
							<table>
								<thead>
									<tr>
										<th>Permisos Descuentos <span class="error">*</span></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input type="text" class="values" name="descuentos" id="descuentos" required pattern="^[0-9]{1,2}?(.[5]{0,1})?$" title="Solo numeros, debe terminar en un decimal .5 o en la unidad mas próxima"/></td>
									</tr>
								</tbody>
							</table>
						</div>
					</section>

					<section class="col-12">
						<hr />
					</section>

					<section class="col-12">
						<header>
							<h3>Total</h3>
						</header>
					</section>

					<section class="col-12">
						<div class="table-wrapper">
							<table>
								<tbody>
									<tr>
										<td><span style="font-weight: bold;" id="total">0.0</span></td>
									</tr>
								</tbody>
							</table>
						</div>
					</section>
				</div>

		</div>
	</div>
</section>
<!-- Accion Reportar -->
<section id="reportar" class="wrapper style2 special fade">
	<div class="container">
		<header>
			<h2 style="color: white;">Reportar</h2>
			<p>Seleccione un tipo de aprobador.</p>
		</header>
		
			<div class="row gtr-uniform gtr-50">
				<section class="col-6 col-8-medium col-12-xsmall">
					<input type="radio" id="jefe" name="aprobador" required>
					<label for="jefe">Jefe</label>
					
					<div class="col-12">
						<select name="listJefe" id="listJefe" disabled>
							<!--Llenar datos con DB-->
						</select>
					</div>
				</section>
				<section class="col-6 col-8-medium col-12-xsmall">
					<input type="radio" id="gerente" name="aprobador" required>
					<label for="gerente">Gerente</label>

					<div class="col-12">
						<select name="listGerente" id="listGerente" disabled>
							<!--Llenar datos con DB-->
						</select>
					</div>

				</section>
				<section class="col-12 col-8-medium col-12-xsmall">
					<div class="col-12" id="errorRadio" style="display: none;">
						<p>✗ Por favor seleccione un aprobador.</p>
					</div>
				</section>
				<section class="col-12 col-8-medium col-12-xsmall" id="butonSend">
					<footer class="major">
						<ul class="actions special">
							<li> <button type="submit" id="sendData" data-type="create" class="button primary icon solid fa-check-circle fi">Enviar</button> </li>
						</ul>
					</footer>
				</section>
				<section class="col-12 col-8-medium col-12-xsmall" id="loadSpinner">
					<div class="load-wrapp">
    				  <div class="load-3">
    				    <h4>Enviando Datos...</h4>
    				    <div class="line"></div>
    				    <div class="line"></div>
    				    <div class="line"></div>
    				  </div>
    				</div> 
				</section>
			</div>
		</form>
	</div>
</section>