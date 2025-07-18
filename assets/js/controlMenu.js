let config;
$(document).ready(function(e) {
    removeClass();
    reportar();
    estado();
    gestionar();
    gestionRH();
    generarReporteGeneral();
});

function reportar(){
    $('#reportar').click(function(e) {
        //e.preventDefault();
        var reportar = $(this);
        reportar.css('pointer-events', 'none');
        var script = "<script src=\"../assets/js/reporteHE.js\"></script>";
        var style = "<link rel='stylesheet' href=\"../assets/css/load.css\"></link>";

        $.when($.ajax('./reportar/index.view.php'))
            .then(function (result1) {
                // Cargar HTML Reporte
                $('#links').append(style);
                $('#links_js').append(script);
                
                reportar.css('pointer-events', 'auto');
                reportar.addClass('menuSelect');

                $('#result').html(result1);
            });
    });
}

function estado() {
    $('#estado').click(function(e) {
        e.preventDefault();

        var estado = $(this);
        estado.css('pointer-events', 'none');
        var script = "<script src=\"../assets/js/listadoHE.js\"></script>";
        var script2 = "<script src=\"../assets/js/detailsReporte.js\"></script>";

        $.when($.ajax('./estado/listEstado.view.php'))
            .then(function(result1) {
                
                //Cargar HTML
                $('#links_js').append(script2);
                $('#links_js').append(script);

                estado.css('pointer-events', 'auto');
                estado.addClass('menuSelect');
                $('#result').html(result1);
                $(this).prop('disabled', false);

            })

    });
}

function gestionar() {
    $('#gestionar').click(function(e) {
        e.preventDefault();

        var gestionar = $(this);
        gestionar.css('pointer-events', 'none');
        var script = "<script src=\"../assets/js/aproveRejectHE.js\"></script>";
        var script2 = "<script src=\"../assets/js/detailsReporte.js\"></script>";

        $.when($.ajax('./gestionHE/gestionar.view.php'))
            .then(function(result) {

                //Cargar HTML
                $('#links_js').append(script);
                $('#links_js').append(script2);
                gestionar.addClass('menuSelect');
                gestionar.css('pointer-events', 'auto');
                $('#result').html(result);
                $(this).prop('disabled', false);
                $('#typeGestion').attr('data-type', 'gestionJefesGerentes');

            })

    });
}

function gestionRH() {
    $('#gestionarRH').click(function(e) {
        e.preventDefault();

        var gestionContable = $(this);
        gestionContable.css('pointer-events', 'none');
        var script = "<script src=\"../assets/js/aproveRejectHE.js\"></script>";
        var script2 = "<script src=\"../assets/js/detailsReporte.js\"></script>";

        $.when($.ajax('./gestionHE/gestionar.view.php'))
            .then(function(result) {

                //Cargar HTML
                $('#links_js').append(script);
                $('#links_js').append(script2);
                gestionContable.addClass('menuSelect');
                gestionContable.css('pointer-events', 'auto');

                $('#result').html(result);
                $(this).prop('disabled', false);

                $('#typeGestion').attr('data-type', 'gestionRH');

            })
    });
}

function gestionContable(e) {
    //$('#gestionarContable').click(function(e) {
        e.preventDefault();

        var gestionContable = $('#mainContable');
        gestionContable.css('pointer-events', 'none');
        var script = "<script src=\"../assets/js/aproveRejectHE.js\"></script>";
        var script2 = "<script src=\"../assets/js/detailsReporte.js\"></script>";

        $.when($.ajax('./gestionHE/gestionar.view.php'))
            .then(function(result) {

                //Cargar HTML
                $('#links_js').append(script);
                $('#links_js').append(script2);
                gestionContable.addClass('menuSelect');
                gestionContable.css('pointer-events', 'auto');
                $('#result').html(result);
                $(this).prop('disabled', false);

                $('#typeGestion').attr('data-type', 'gestionContable');

            })
    //});
}

function reporte(e){
    e.preventDefault();
    $(this).prop('disabled', true);

    var gestionContable = $('#mainContable');
    gestionContable.css('pointer-events', 'none');
    var script = "<script src=\"../assets/js/generarReporte.js\"></script>";

    $.when($.ajax('./reporte/index.view.php'))
        .then(function(result) {

            //Cargar HTML
            $('#links_js').append(script);
            gestionContable.addClass('menuSelect');
            gestionContable.css('pointer-events', 'auto');
            $('#result').html(result);
            $(this).prop('disabled', false);
        })
}

function adminClase(e) {
    e.preventDefault();
    $(this).prop('disabled', true);

    var adminCeco = $('#admin');
    adminCeco.css('pointer-events', 'none');
    var script = "<script src=\"../assets/js/admin/claseAdmin.js\"></script>";

    $.when($.ajax('./admin/clase.view.php'))
        .then(function(result) {

            //Cargar HTML
            $('#links_js').append(script);
            adminCeco.addClass('menuSelect');
            adminCeco.css('pointer-events', 'auto');
            $('#result').html(result);
            $(this).prop('disabled', false);
        })
}

function adminCECO(e) {
    e.preventDefault();
    $(this).prop('disabled', true);

    var adminCeco = $('#admin');
    adminCeco.css('pointer-events', 'none');
    var script = "<script src=\"../assets/js/admin/cecoAdmin.js\"></script>";

    $.when($.ajax('./admin/centroCosto.view.php'))
        .then(function(result) {

            //Cargar HTML
            $('#links_js').append(script);
            adminCeco.addClass('menuSelect');
            adminCeco.css('pointer-events', 'auto');
            $('#result').html(result);
            $(this).prop('disabled', false);
        })
}

function adminAprobadores(e) {
    e.preventDefault();
    $(this).prop('disabled', true);

    var adminCeco = $('#admin');
    adminCeco.css('pointer-events', 'none');
    var script = "<script src=\"../assets/js/admin/aprobadoresAdmin.js\"></script>";

    $.when($.ajax('./admin/Aprobadores.view.php'))
        .then(function(result) {

            //Cargar HTML
            $('#links_js').append(script);
            adminCeco.addClass('menuSelect');
            adminCeco.css('pointer-events', 'auto');
            $('#result').html(result);
            $(this).prop('disabled', false);
        })
}

function generarReporteGeneral(e){
    $('#reporteGeneral').on('click', function(e) {
        console.log('Click');
        e.preventDefault();
        let reporteGeneral = $(this);

        reporteGeneral.prop('disabled', true);
        reporteGeneral.css('pointer-events', 'none');

        $.when($.ajax('./reporteGeneral/index.view.php'))
            .then(function(result) {
                //Cargar HTML
                reporteGeneral.addClass('menuSelect');
                reporteGeneral.css('pointer-events', 'auto');
                $('#result').html(result);
                reporteGeneral.prop('disabled', false);
            }) 
    });
}

function removeClass() {
    $('li').on('click', function() {
        $(".menuSelect").removeClass("menuSelect");
    })
}