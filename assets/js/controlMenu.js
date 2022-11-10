$(document).ready(function(e) {
    console.log('Ready Control Menu');
    
    removeClass();
    reportar();
    estado();
    gestionar();
    gestionRH();
    gestionContable();
});

function reportar(){
    $('#reportar').click(function(e) {
        //e.preventDefault();

        console.log('click')

        var reportar = $(this);
        var script = "<script src=\"../assets/js/reporteHE.js\"></script>";
        var style = "<link rel='stylesheet' href=\"../assets/css/load.css\"></link>";

        $.when($.ajax('./reportar/index.view.php'))
            .then(function (result1) {
                // Cargar HTML Reporte
                $('#links').append(script, style);
                
                reportar.addClass('menuSelect');

                $('#result').html(result1);
            });
    });
}

function estado() {
    $('#estado').click(function(e) {
        e.preventDefault();

        var estado = $(this);
        var script = "<script src=\"../assets/js/listadoHE.js\"></script>";

        $.when($.ajax('./estado/listEstado.view.php'))
            .then(function(result1) {
                
                //Cargar HTML
                $('#links').append(script);

                estado.addClass('menuSelect');
                $('#result').html(result1);

            })

    });
}

function gestionar() {
    $('#gestionar').click(function(e) {
        e.preventDefault();

        var gestionar = $(this);
        var script = "<script src=\"../assets/js/aproveRejectHE.js\"></script>";

        $.when($.ajax('./gestionHE/gestionar.view.php'))
            .then(function(result) {

                //Cargar HTML
                $('#links').append(script);
                gestionar.addClass('menuSelect');
                $('#result').html(result);

                $('#typeGestion').attr('data-type', 'gestionJefesGerentes');

            })

    });
}

function gestionRH() {
    $('#gestionarRH').click(function(e) {
        e.preventDefault();
        var gestionContable = $(this);
        var script = "<script src=\"../assets/js/aproveRejectHE.js\"></script>";

        $.when($.ajax('./gestionHE/gestionar.view.php'))
            .then(function(result) {

                //Cargar HTML
                $('#links').append(script);
                gestionContable.addClass('menuSelect');
                $('#result').html(result);

                $('#typeGestion').attr('data-type', 'gestionRH');

            })
    });
}

function gestionContable(e) {
    //$('#gestionarContable').click(function(e) {
        e.preventDefault();
        var gestionContable = $('#mainContable');
        var script = "<script src=\"../assets/js/aproveRejectHE.js\"></script>";

        $.when($.ajax('./gestionHE/gestionar.view.php'))
            .then(function(result) {

                //Cargar HTML
                $('#links').append(script);
                gestionContable.addClass('menuSelect');
                $('#result').html(result);

                $('#typeGestion').attr('data-type', 'gestionContable');

            })
    //});
}

function reporte(e){
    e.preventDefault();
    var gestionContable = $('#mainContable');
    var script = "<script src=\"../assets/js/generarReporte.js\"></script>";

    $.when($.ajax('./reporte/index.view.php'))
        .then(function(result) {

            //Cargar HTML
            $('#links').append(script);
            gestionContable.addClass('menuSelect');
            $('#result').html(result);

        })
}

function removeClass() {
    $('li').on('click', function() {
        $(".menuSelect").removeClass("menuSelect");
    })
}