<?php 
    session_start();
    if (!isset($_SESSION["estadoAutentica"])) {
        header('Location:http://gestionhe.servimeters.net:86/');
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
                        <input type="text" name="cc" id="cc" class="mainValue" value="" placeholder="**********" data-empleado="<?php echo $_SESSION['usuario']?>" data-correoEmpleado="<?php echo $_SESSION['email']?>" pattern="[0-9]{1,10}" required/> <!-- title="Solo numeros. No debe exceder los 10 digitos." -->
                    </section>
                    <section class="col-3 col-4-medium col-12-xsmall">
                        <h3>Cargo <span class="error">*</span></h3>
                        <input type="text" name="cargo" id="cargo" class="mainValue" required/> <!-- title="Solo numeros. No debe exceder los 10 digitos." -->
                    </section>
                    <section class="col-3 col-4-medium col-12-xsmall">
                        <h3>Centro de Costo</h3>
                        <select name="ceco" id="ceco">
                            <!--Llenar datos con BD-->
                        </select>
                    </section>
                    <section class="col-3 col-4-medium col-12-xsmall">
                        <h3>Mes Reportado <span class="error">*</span></h3>
                        <input type="month" name="mes" id="mes" class="mainValue" value="" required/>
                    </section>

                    <section class="col-4 col-4-medium col-1-xsmall">
                        <p></p>
                    </section>
                    <section class="col-4 col-4-medium col-10-xsmall">
                        <h3>Correo <span class="error">*</span></h3>
                        <input type="email" name="correoEmpleado" id="correoEmpleado" class="mainValue" value="<?php echo $_SESSION['email']?>" required/>
                    </section>
                    <section class="col-4 col-4-medium col-1-xsmall">
                        <p></p>
                    </section>

                    <section class="col-12">
                        <hr />
                    </section>

                    <section class="col-12" id="heReportadas">
                        <header>
                            <h3>Horas Extra (HE) Reportadas</h3>
                        </header>
                        <table id="tableEdit">
                            <thead>
                                <tr id="headTableEdit">
                                    <th>Fecha</th>
                                    <th>Actividad</th>
                                    <th>Permisos Descuentos</th>
                                </tr>
                            <!--Llenar encabezado con script-->
                            </thead>
                            <tbody id="bodyTableEdit">

                            </tbody>
                        </table>
                        <br>
                        <hr />
                        <button type="submit" id="allowAddRows" class="button primary icon solid fa-toggle-off fi">Agregar Horas Extra</button>
                    </section>

                <section class="col-12">
                    <header>
                        <h3>Información de Horas Extra (HE) <span class="icon solid fa-exclamation-triangle help" style="color: #e44c65 !important; padding: 3px;"></span></h3>
                    </header>
                </section>

                <section id="tableHE" class="col-12 sectionDisabled">
                    <div class="table-wrapper">
                        <table id="table">
                            <thead>
                            <tr id="encTableHE">
                                <th>Fecha <span class="error">*</span></th>
                                <th>Actividad <span class="error">*</span></th>
                                <th>Permisos Descuentos</th>
                            </tr>
                            <!--Llenar datos con DB-->
                                </thead>
                                <tbody id="bodyTableHE">
                                <!--Llenar datos con DB-->
                                <tr id="rowTableHE">
                                    <td style="width: 150px;"><input type="date" class="fechasActividades" name="fechaActividad" id="fechaActividad" value="" required/></td>
                                    <td style="width: 150px;"><input type="text" class="novedades" name="novedad" id="novedad" placeholder="Ingrese la novedad" style="font-size: 12px;" required></td>
                                    <td style="width: 70px;"><input type="text" class="values descuentos" name="descuentos" value="0" required pattern="^[0-9]{1,2}?(.[5]{0,1})?$" title="Solo numeros, debe terminar en un decimal .5 o en la unidad mas próxima"/></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td style="text-align: right;" id="botonAgregar"><input class="button primary icon solid fa-check-circle fi" data-rows="0" type="button" name="agregarhe" id="agregarhe" value="Agregar"/></td>
                                <tr>
                                <tr>
                                    <td class="tituloTotal" align="right">Total Horas Extra</td>
                                    <td><span style="font-weight: bold; color: greenyellow;" id="calcHE">0</span></td>
                                <tr>
                                    <td class="tituloTotal" align="right">Total Recargos</td>
                                    <td><span style="font-weight: bold;" id="calcRec">0</span></td>
                                </tr>
                                <tr>
                                    <td class="tituloTotal" align="right">Total Descuentos</td>
                                    <td><span style="font-weight: bold;" id="calcDescuentos">0</span></td>
                                </tr>
                                <tr>
                                    <td class="tituloTotal" align="right">Total</td>
                                    <td><span style="font-weight: bold;" id="total">0.0</span></td>
                                </tr>
                                </tfoot>
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
                        <h4 style="color: white;">Enviando Datos...</h4>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                </div>
            </section>
            <div id="resultTest">

            </div>
        </div>
        </form>
    </div>
</section>