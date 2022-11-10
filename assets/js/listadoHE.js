$(document).ready(function(e) {
    console.log('Ready List'); 

    const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

    var user = $('#usuarioLogin').html();

    var object = {
        'object': {
            'empleado': user
        }
    }

    $.when($.ajax({data: object, url: '../controller/CRUD.controller.php?action=execute&model=HoraExtra&crud=getListado', type: 'post',}))
            .then(function(result1) {

                console.log('Cargando datos..');

                //Cargar Datos de Tabla
                localStorage.setItem('arrayListado', result1);
                var datos = JSON.parse(result1);
                var html;

                datos.forEach((dato, index) => {
                    html += '<tr>';
                    var anno = dato.fechaFin;
                    anno = new Date(anno);
    
                    html += `<td>${dato.id}</td>`;
                    html += `<td>${dato.fechaReporte}</td>`;
                    html += `<td>${anno.getFullYear()}</td>`;
                    html += `<td>${ meses[anno.getMonth()] }</td>`;
                    html += `<td>${dato.aprobadorNombre}</td>`;
                    html += `${ dato.estadoNombre.includes('Rechaz') ? '<td style="color: #e44c65; font-weight: bold;">'+ dato.estadoNombre + '</td>' : '<td>' + dato.estadoNombre + '</td>' }`;
                    html += `<td>${ dato.estadoNombre.includes('Rechaz') ? '<a href="#" data-index="' + index + '" class="button primary small editarRegistro">Editar</a>' : '<p>Editar</p>' } </td>`;
    
                    html += '</tr>';
    
                });

                $('#tableBody').html(html);
                $('#dataTable').DataTable({
                    paging: false,
                    "language": {
                        "search": "Ingrese un valor para filtrar la tabla: ",
                        "info": "Hay _TOTAL_ registros"
                    },
                    dom: '<"top"if>rt<"clear">',
                    stateSave: true,
                });

                coloriceTable();
                editar();
            });
});


function coloriceTable() {
    $('#dataTable tbody').on('mouseenter', 'td', function () {
        var colIdx = $('#dataTable').DataTable().cell(this).index().column;

        $($('#dataTable').DataTable().cells().nodes()).removeClass('highlight');
        $($('#dataTable').DataTable().column(colIdx).nodes()).addClass('highlight');
    });
}

function modal() {

    var style = "<link rel='stylesheet' href=\"../assets/css/load.css\"></link>";

    $('#links').append(style);
    
    var html = `<div class="animate__animated animate__jackInTheBox" id="contentModal">
    <span id="textoLoad">Cargando ...</span>
    </div>
    <div class="load-9">
    <div class="spinner">
    <div class="bubble-1"></div>
    <div class="bubble-2"></div>
    </div>`;
    $('#myModal').html(html);
    $('#myModal').css({display: 'block'});

}

function hideModal() {
    $('#myModal').html('');
    $('#myModal').css({display: 'none'});
}

function editar() {

    $('.editarRegistro').on('click', function() {
        var index = $(this).data('index');
        
        var data = localStorage.getItem('arrayListado');
        var script = "<script src=\"../assets/js/reporteHE.js\"></script>";
        var script_two = "<script src=\"../assets/js/editarHE.js\"></script>";
        var style = "<link rel='stylesheet' href=\"../assets/css/load.css\"></link>";

        data = JSON.parse(data);

        data = data[index];

        var object = {
            'object': {
                'id': data.id
            } 
        }
        
        $.when($.ajax({data: data, url: './estado/editarHE.view.php', type: 'post'}), $.ajax('./reportar/index.view.php'), $.ajax({data: object, url: '../controller/CRUD.controller.php?action=execute&model=HoraExtra&crud=getDetalleHora', type: 'post',}), $.ajax({data: object, url: '../controller/CRUD.controller.php?action=execute&model=Recargo&crud=getRecargos', type: 'post',}), $.ajax({data: object, url: '../controller/CRUD.controller.php?action=execute&model=Comentario&crud=getComments', type: 'post',}))
        .then(function (result1, result2, result3, result4, result5) {
            $('#links').append(script, script_two, style);
            modal();

            var arrayHE = JSON.parse(result3[0]);
            var arrayRecargo = JSON.parse(result4[0]);
            var arrayComments = JSON.parse(result5[0]);
            
            //Cargar HTML Editar
            $('#result').html(result1[0]);
                
            // Cargar HTML Reporte

            $('#formReporte').html(result2[0]);
            var fecha = data.fechaFin;
            fecha = new Date(fecha);

            var month = fecha.getMonth();
            month = month + 1;
            
            if (month < 10) {
                month = '0' + month;
            }

            $('#cc').val(data.cc);
            setTimeout(() => {

                var htmlComments;

                arrayComments.forEach(element=>{
                    htmlComments += '<tr>';
                    htmlComments += `<td style="text-align: left" id="comment-${element.id}">${element.creadoPor} - ${element.fecha}</td>`;
                    htmlComments += '</tr>';
                    htmlComments += '<tr>';
                    htmlComments += `<td>${element.cuerpo}</td>`;
                    htmlComments += '</tr>';
                });

                //Cargar comentarios
                $('#bodyComments').html(htmlComments);

                $("#ceco option[value="+ data.ceco +"]").attr("selected",true);
                
                var sumaHE = 0;
                arrayHE.forEach(element=>{
                    $(`#${element.horaExtra.replaceAll(' ', '')}`).val(element.cantidad == '.0' ? '0' : element.cantidad == '.5' ? '0.5' : element.cantidad);
                    sumaHE += parseFloat(element.cantidad);
                });

                $('#calcHE').html(sumaHE);

                var sumaRecargo = 0;
                arrayRecargo.forEach(element=>{
                    $(`#${element.recargo.replaceAll(' ', '')}`).val(element.cantidad == '.0' ? '0' : element.cantidad == '.5' ? '0.5' : element.cantidad);
                    sumaRecargo += parseFloat(element.cantidad);
                });

                $('#calcRec').html(sumaRecargo);

                if (data.estado == '2'){
                    if (data.aprobadorTipo == 'Jefe') {
                        $("#jefe").prop("checked", true);
                        $('#listJefe').attr('disabled', false);
                        $("#listJefe option[value="+ data.aprobador +"]").attr("selected",true);

                        var correoAprobador = $('#listJefe').find(':selected').data('correoaprobador');
                        var aprobador = $('#listJefe').find(':selected').val();
                        localStorage.setItem('correoAprobador', correoAprobador);
                        localStorage.setItem('aprobador', aprobador);
                        localStorage.setItem('TipoAprobador', 'Jefe');


                    }else if(data.aprobadorTipo == 'Gerente'){
                        $("#gerente").prop("checked", true);
                        $('#listGerente').attr('disabled', false);
                        $("#listGerente option[value="+ data.aprobador +"]").attr("selected",true);

                        var correoAprobador = $('#listGerente').find(':selected').data('correoaprobador');
                        var aprobador = $('#listGerente').find(':selected').val();
                        localStorage.setItem('correoAprobador', correoAprobador);
                        localStorage.setItem('aprobador', aprobador);
                        localStorage.setItem('TipoAprobador', 'Gerente');
                    }
                }else if (data.estado == '1006' || data.estado == '1007'){
                    $("#jefe").attr("disabled", true);
                    $('#listJefe').attr('disabled', true);
                    $("#gerente").attr("disabled", true);
                    $('#listGerente').attr('disabled', true);

                    var correoAprobador = data.correoAprobador;
                    var aprobador = data.aprobador;
                    localStorage.setItem('correoAprobador', correoAprobador);
                    localStorage.setItem('aprobador', aprobador);
                    if (data.estado == '1006'){
                        localStorage.setItem('TipoAprobador', 'contable');
                    }else if (data.estado == '1007'){
                        localStorage.setItem('TipoAprobador', 'rh');
                    }
                }

                $('#sendData').attr('data-type', 'update');

                hideModal();
            }, 3000);
            $('#mes').val(fecha.getFullYear() + '-' + month);
            $('#novedad').val(data.novedad);
            $('#descuentos').val(data.descuento);
            $('#total').html(data.total);

        });
    })
        
}

