<?php
session_start();
if (!isset($_SESSION["isAdmin"]) || (strcasecmp($_SESSION["isAdmin"], 'Si') !== 0)) {
    header('Location:http://localhost/HorasExtra/view/');
}

?>

<section id="five" class="wrapper style2 special fade">
    <div class="container">
        <header>
            <h3 style="color: white;">Administracion Aprobadores</h3>
        </header>

        <section class="col-12 col-4-medium col-12-xsmall">
            <table class="tableAdmin">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Tipo</th>
                    <th>Gestiona</th>
                    <th>Es Administrador</th>
                    <th>Guardar</th>
                </tr>
                </thead>
                <tbody id="aprobadores">
                <!-- Llenar datos con iteracion -->
                </tbody>
            </table>
        </section>
    </div>
</section>

<section id="four" class="wrapper style1 special fade-up">
    <div class="container">
        <header>
            <h3>Agregar Aprobadores</h3>
        </header>
        <form action="#" id="formAprob">
            <div class="row gtr-uniform">
                <section class="col-4 col-3-medium col-1-xsmall">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" style="color: black !important;" requerid/>
                </section>
                <section class="col-4 col-6-medium col-10-xsmall">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" style="color: black !important;" requerid/>
                </section>
                <section class="col-4 col-3-medium col-1-xsmall">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo">
                        <option value="NA">NA</option>
                        <option value="Jefe">Jefe</option>
                        <option value="Gerente">Gerente</option>
                    </select>
                </section>
                <section class="col-4 col-3-medium col-1-xsmall">
                    <label for="tipo">Gestiona</label>
                    <select name="gestiona" id="gestiona">
                        <option value="NA">NA</option>
                        <option value="Contable">Contable</option>
                        <option value="RH">RH</option>
                    </select>
                </section>
                <section class="col-4 col-3-medium col-1-xsmall">
                    <label for="tipo">Es Administrador</label>
                    <select name="isadmin" id="isadmin">
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                    </select>
                </section>
                <section class="col-12 col-8-medium col-12-xsmall" id="butonSend">
                    <footer class="major">
                        <ul class="actions special">
                            <li> <button type="submit" id="sendDataAprob" class="button primary icon solid fa-check-circle fi">Guardar</button> </li>
                        </ul>
                    </footer>
                </section>
            </div>
        </form>
    </div>
</section>