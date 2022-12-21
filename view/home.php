<?php 
    session_start();
    if (!isset($_SESSION["estadoAutentica"])) {
        header('Location:http://gestionhe.servimeters.net:86/');
    }
?>
<!DOCTYPE html>
<html lang="es">
<head id="links">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title>Home - Reporte Horas Extra</title>

    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/buttons.jqueryui.min.css" />
    <link rel="stylesheet" href="../assets/css/datatables.min.css" />
    <link rel="stylesheet" href="../assets/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="../assets/css/animate.min.css" />
    <noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="../assets/js/login.js"></script>
    <script src="../assets/js/controlMenu.js"></script>
</head>
<body class="is-preload">
    <div id="page-wrapper">

        <?php include_once('./shared/header.php')?>

        <div id="myModal" class="modal" style="display: none;"> 
            
        </div>

        <div id="result">
            <!-- Banner -->
            <section id="banner">
                <div class="content">
                    <header>
                        <h2 style="color: white;">Plataforma - Reporte de Horas Extra</h2>
                        <p>Crea y Sigue tus Reportes de Horas Extra.</p>
                    </header>
                    <span class="image"><img src="../images/Logo Prueba SM.webp" alt="Logo SM" /></span>
                </div>
            </section>
        </div>


        <script src="../assets/js/jquery.min.js"></script>
	    <script src="../assets/js/jquery.scrolly.min.js"></script>
	    <script src="../assets/js/jquery.dropotron.min.js"></script>
	    <script src="../assets/js/jquery.scrollex.min.js"></script>
	    <script src="../assets/js/browser.min.js"></script>
	    <script src="../assets/js/breakpoints.min.js"></script>
	    <script src="../assets/js/util.js"></script>
	    <script src="../assets/js/main.js"></script>
        <script src="../assets/js/jquery.validate.min.js"></script>
        <script src="../assets/js/additional-methods.min.js"></script>
        <script src="../assets/js/notify.min.js"></script>
        <script src="../assets/js/dataTables.buttons.min.js"></script>
        <script src="../assets/js/datatables.min.js"></script>
        <script src="../assets/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/sweetalert.min.js"></script>
        
        <?php include_once('./shared/footer.php')?>

    </div>

</body>
</html>