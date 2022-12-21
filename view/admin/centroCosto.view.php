<?php
session_start();
if (!isset($_SESSION["isAdmin"]) || (strcasecmp($_SESSION["isAdmin"], 'Si') !== 0)) {
    header('Location:http://gestionhe.servimeters.net:86/');
}

?>

<section id="five" class="wrapper style2 special fade">
    <div class="container">
        <header>
            <h3 style="color: white;">Administracion Centro de Costo</h3>
        </header>

        <section class="col-12 col-4-medium col-12-xsmall">
            <table class="tableAdmin">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Guardar</th>
                    </tr>
                </thead>
                <tbody id="ceco">
                    <!-- Llenar datos con iteracion -->
                </tbody>
            </table>
        </section>
    </div>
</section>

<section id="four" class="wrapper style1 special fade-up">
    <div class="container">
        <header>
            <h3>Agregar Centro de Costo</h3>
        </header>
        <form action="#" id="formCeco">
            <div class="row gtr-uniform">
                <section class="col-4 col-3-medium col-1-xsmall">
                    <p></p>
                </section>
                <section class="col-4 col-6-medium col-10-xsmall">
                    <input type="text" name="title" placeholder="Ingrese el titulo del centro de costo" style="color: black !important;" requerid/>
                </section>
                <section class="col-4 col-3-medium col-1-xsmall">
                    <p></p>
                </section>
                <section class="col-12 col-8-medium col-12-xsmall" id="butonSend">
                    <footer class="major">
                        <ul class="actions special">
                            <li> <button type="submit" id="sendData" class="button primary icon solid fa-check-circle fi">Guardar</button> </li>
                        </ul>
                    </footer>
                </section>
            </div>
        </form>
    </div>
</section>