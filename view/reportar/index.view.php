<?php
session_start();
if (!isset($_SESSION["estadoAutentica"])) {
    require_once "../../config/LoadConfig.config.php";
    $config = LoadConfig::getConfig();
    header('Location:'.$config['URL_SITE'].'index.php');
}
?>
<!-- Form Reportar -->
<section id="four" class="wrapper style1 special fade-up">
    <div class="container" id="one">
        <header class="major">
            <h3>Reporte Horas Extra</h3>
            <p></p>
        </header>
        <div class="box alt">
            <form action="" id="formReporte">
                <div class="row gtr-uniform" style="font-size: 0.8em !important;">
                    <section class="col-2 col-3-medium col-12-xsmall">
                        <h4 title="Sin puntuación">Cedula <b title="Sin puntuación" style="color: black;">❗</b> <span class="error">*</span></h4>
                        <input title="Sin puntuación" type="text" name="cc" id="cc" class="mainValue fieldReport" value="" placeholder="**********" data-empleado="<?php echo $_SESSION['usuario'] ?>" data-correoEmpleado="<?php echo $_SESSION['email'] ?>" pattern="[0-9]{1,10}" required /> <!-- title="Solo numeros. No debe exceder los 10 digitos." -->
                    </section>
                    <section class="col-2 col-3-medium col-12-xsmall">
                        <h4>Cargo<span class="error">*</span></h4>
                        <input type="text" name="cargo" id="cargo" class="mainValue fieldReport" required /> <!-- title="Solo numeros. No debe exceder los 10 digitos." -->
                    </section>

                    <section class="col-2 col-3-medium col-12-xsmall">
                        <h4>Mes Reportado<span class="error">*</span></h4>
                        <input type="month" name="mes" id="mes" class="mainValue fieldReport" value="" required />
                    </section>
                    <section class="col-3 col-3-medium col-10-xsmall">
                        <h4>Correo <span class="error">*</span></h4>
                            <input type="email" name="correoEmpleado" id="correoEmpleado" class="mainValue fieldReport" value="<?php echo $_SESSION['email'] ?>" required />
                    </section>

                    <section class="col-3 col-4-medium col-12-xsmall">
                        <h4>Centro de Costo</h4>
                        <select name="ceco" id="ceco" class="fieldReport">
                            <!--Llenar datos con BD-->
                        </select>
                    </section>

                    <section class="col-12">
                        <h4>Proyecto Asociado</h4>
                        <input type="text" name="proyecto" id="proyecto" class="fieldReport" required style="width: 30%; margin: auto;"/>
                    </section>

                    <section class="col-12">
                        <a href="#two" class="goTo"><span class="icon solid fa-chevron-down fit"></span></a>
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

                    <!--<section class="col-12">
                        <header>
                            <h3>Información de Horas Extra (HE) <span class="icon solid fa-exclamation-triangle help" style="color: #e44c65 !important; padding: 3px;"></span></h3>
                        </header>
                    </section>-->

                    <section id="tableHE" class="col-12 sectionDisabled">
                        <div class="table-wrapper-he" id="two">
                            <table id="table" class="table-fixed-header">
                                <thead>
                                    <tr id="encTableHE">
                                        <th>Fecha <span class="error">*</span></th>
                                        <th style="width: 180px;">Actividad <span class="error">*</span></th>
                                        <th>Permisos Descuentos</th>
                                    </tr>
                                    <!--Llenar datos con DB-->
                                </thead>
                                <tbody id="bodyTableHE">
                                    <!--Llenar datos con DB-->
                                    <tr id="rowTableHE">
                                        <td style="width: 150px;"><input type="date" class="fechasActividades" name="fechaActividad" id="fechaActividad" value="" required /></td>
                                        <td style="width: 150px;"><input type="text" class="novedades" name="novedad" id="novedad" placeholder="Ingrese la novedad" style="font-size: 12px;" required></td>
                                        <td style="width: 70px;"><input type="text" class="values descuentos" name="descuentos" value="0" required pattern="^[0-9]{1,2}?(.[5]{0,1})?$" title="Solo numeros, para decimales debe terminar en .5" /></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td style="text-align: right;" id="botonAgregar"><span class="icon solid fa-plus-square fi" title="Agregar fila" data-rows="0" name="agregarhe" id="agregarhe" style="font-size: 30px; color: #5480f1;"></span></td>
                                        <!-- <span style="color: tomato;" data-id="${id}" class="deleteRow icon solid fa-window-close fi" onclick="deleteRow(event, this, false)"></span> -->
                                    <tr>
                                    <tr>
                                        <td style="height: 50px;"></td>
                                    </tr>
                                    <tr id="summaries">
                                        <td colspan="2">Totales:</td>
                                        <td id="calcDescuentos" class="summariesFields">0</td>
                                    </tr>
                                    <tr>
                                        <td class="tituloTotal" align="right">Total Horas Extra</td>
                                        <td><span style="font-weight: bold; color: greenyellow;" id="calcHE">0</span></td>
                                    <tr>
                                        <td class="tituloTotal" align="right">Total Recargos</td>
                                        <td><span style="font-weight: bold;" id="calcRec">0</span></td>
                                    </tr>
                                    <!-- <tr>
                                        <td class="tituloTotal" align="right">Total Descuentos</td>
                                        <td><span style="font-weight: bold;" id="calcDescuentos">0</span></td>
                                    </tr> -->
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
    <a href="#three" class="goTo"><span class="icon solid fa-chevron-down fit"></span></a>
</section>
<!-- Accion Reportar -->
<section id="reportar" class="wrapper style2 special fade">
    <div class="container" id="three">
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
                    <span>❗ Si no selecciona un aprobador, el registro quedara en modo de edición y podrá modificarlo desde el módulo "Mis Horas Extra".</span>
                </footer>
                <br>
                <a href="#one" class="goTo"><span class="icon solid fa-chevron-up fit"></span></a>
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