$(document).ready(function(e) {

    selectAprobador();
    restarDescuento();
    setDataAprobador();
    sendData();
    showHelp();


    $.notify.defaults({ className: "info" });

    $.notify.addStyle('happyblue', {
        html: "<b>⚠ <span data-notify-text/>⚠</b>",
        classes: {
          base: {
            "white-space": "nowrap",
            "background-color": "#D9EDF7",
            "color": "#3a87ad",
            "padding": "5px",
            "font-size": "15px !important"
          }
        }
      });

    $('#formReporte').validate({
        rules: {
            cc: 'required',
            ceco: 'required',
            mes: 'required',
            novedad: 'required',
        },
        messages: {
            cc: 'Ingrese un numero de cedula valido con al menos 10 digitos.',
            ceco: 'Seleccione un Centro de Costo',
            mes: 'Seleccione el mes a reportar.',
            novedad: 'Ingrese la causa de la novedad.',
        }
    });

    $.when($.ajax('../controller/CRUD.controller.php?action=listAll&model=CentroCosto&crud=get'), $.ajax('../controller/CRUD.controller.php?action=listAll&model=TipoHE&crud=get'), $.ajax('../controller/CRUD.controller.php?action=listAll&model=TipoRecargo&crud=get'), $.ajax('../controller/CRUD.controller.php?action=listAll&model=Aprobador&crud=get'))
    .then(function (result1, result2, result3, result4) {
        // Cargar HTML Reporte
        var html;
        var datos = JSON.parse(result1[0]);

        datos.forEach(element => {
            html += `<option value="${element.id}">${element.titulo}</option>`;
        });

        $('#ceco').html(html);

        // Cargar Tabla HE
        var headerTable = '<tr>';
        var bodyTable = '<tr>';
        var id;
        var datos = JSON.parse(result2[0]);
                
        datos.forEach(element => {
            id = element.nombre.replaceAll(' ', '');
        
            headerTable += `<th>${element.nombre}</th>`;
        
            bodyTable += `<td><input type="text" class="values valueHE" name="${id}" id="${id}" data-codigo="${element.codigo}" value="0" required pattern="^[0-9]{1,2}?(.[0,5]{0,1})?$" title="Solo numeros, debe terminar en un decimal .5 o en la unidad mas próxima"/></td>`
        });
    
        headerTable += '</tr>';
        bodyTable += '</tr>';
    
        $('#encTableHE').append(headerTable);
        $('#bodyTableHE').html(bodyTable);

        // Cargar Table Recargos
        headerTable = '<tr>';
        bodyTable = '<tr>';
        id;
        datos = JSON.parse(result3[0]);

        datos.forEach(element => {
            id = element.nombre.replaceAll(' ', '');

            headerTable += `<th>${element.nombre}</th>`;

            bodyTable += `<td><input type="text" class="values valueRecargo" name="${id}" id="${id}" data-codigo="${element.codigo}" value="0" required pattern="^[0-9]{1,2}?(.[0,5]{0,1})?$" title="Solo numeros, debe terminar en un decimal .5 o en la unidad mas próxima"/></td>`
        });
        
        headerTable += '</tr>';
        bodyTable += '</tr>';
        
        $('#encTableRecargo').html(headerTable);
        $('#bodyTableRecargo').html(bodyTable);

        //Cargar listado Jefes/Gerentes
        var htmlJefe;
        var htmlGerente;
        var datos = JSON.parse(result4[0]);

        htmlJefe += `<option value="">-- Seleccione un Jefe --</option>`;
        htmlGerente += `<option value="">-- Seleccione un Gerente --</option>`;
        
        datos.forEach(element => {
            if (element.tipo == 'Gerente') {
                htmlGerente += `<option value="${element.id}" data-correoAprobador="${element.correo}">${element.nombre}</option>`;
            }else if (element.tipo == 'Jefe') {
                htmlJefe += `<option value="${element.id}" data-correoAprobador="${element.correo}">${element.nombre}</option>`;
            }
        });
    
        $('#listJefe').html(htmlJefe);
        $('#listGerente').html(htmlGerente);

        focusValuesHE();
        sumValuesHE();
        sumValuesRecargo();
    });
    
});

function showHelp() {
    $('.help').on('mouseover', function() {
        $(this).notify('Digite los decimales separados por punto "."". Redondee los decimales de modo que sea .5 o a la unidad mas proxima.', {style: 'happyblue', position: 'right', autoHideDelay: 3500} )
    })
}

function selectAprobador() {
    $('#jefe').click(function(e) {
        $('#listJefe').attr('disabled', false);
        $('#listGerente').find('option:first-child').prop('selected', true);
        localStorage.setItem('correoAprobador', '');
        localStorage.setItem('aprobador', '');
        localStorage.setItem('TipoAprobador', '');
        $('#listGerente').attr('disabled', true);
        $('#errorRadio').css({display: 'none'});
    });

    $('#gerente').click(function(e) {
        $('#listJefe').attr('disabled', true);
        $('#listJefe').find('option:first-child').prop('selected', true);
        localStorage.setItem('correoAprobador', '');
        localStorage.setItem('aprobador', '');
        localStorage.setItem('TipoAprobador', '');
        $('#listGerente').attr('disabled', false);
        $('#errorRadio').css({display: 'none'});
    })
}

function setDataAprobador() {
    $('#listJefe').on('change', function(e) {
        var correoAprobador = $(this).find(':selected').data('correoaprobador');
        var aprobador = $(this).find(':selected').val();
        localStorage.setItem('correoAprobador', correoAprobador);
        localStorage.setItem('aprobador', aprobador);
        localStorage.setItem('TipoAprobador', 'Jefe');
        $('#errorRadio').css({display: 'none'});
    });

    $('#listGerente').on('change', function(e) {
        var correoAprobador = $(this).find(':selected').data('correoaprobador');
        var aprobador = $(this).find(':selected').val();
        localStorage.setItem('correoAprobador', correoAprobador);
        localStorage.setItem('aprobador', aprobador);
        localStorage.setItem('TipoAprobador', 'Gerente');
        $('#errorRadio').css({display: 'none'});
    })
}

function focusValuesHE() {
    
    $('.values').on('focus', function(e) {

        var valorActual = $(this).val();
        if (valorActual == '0') {
            $(this).val('');
        }
    });

    $('.values').on('blur', function(e) {

        var valorActual = $(this).val();
        if (valorActual == '') {
            $(this).val('0');
            return;
        }

        if (parseFloat(valorActual) < 0) {
            $(this).val( Math.abs(valorActual) );
            return;
        }
    })
}

function sumValuesHE() {

    var suma;

    $('.valueHE').on('focus', function(e) {

        suma = $('#calcHE').html();
        suma = parseFloat(suma);
        
        var valorHE;

        valorHE = $(this).val();
        
        if (valorHE == '') {
            valorHE = 0;
        }

        if (!isNaN(valorHE)) {

            if (valorHE !== '0.0' || valorHE !== 0 || valorHE !== '0') {
                
                suma -= parseFloat(valorHE);
            }
        }
        
    });

    $('.valueHE').on('blur', function(e) {    
        var valorHE;

        valorHE = $(this).val();
        
        if (valorHE == '') {
            valorHE = 0;
        }

        if (!isNaN(valorHE)) {
            suma += parseFloat(valorHE);
            colorSum(suma, 'calcHE');
            if (suma > 48) {
                suma -= parseFloat(valorHE);
                $(this).val(0);
                setTimeout(()=>{
                    alert('Exede el numero de horas extra permitidas');
                }, 150);
            }
            
        }

        $('#calcHE').html(suma);
        total();
    });

}

function sumValuesRecargo() {
    var suma;

    $('.valueRecargo').on('focus', function(e) {

        suma = $('#calcRec').html();
        suma = parseFloat(suma);
        
        var valorHE;

        valorHE = $(this).val();

        if (valorHE == '') {
            valorHE = 0;
        }

        if (!isNaN(valorHE)) {

            if (valorHE !== '0.0' || valorHE !== 0 || valorHE !== '0') {
                
                suma -= parseFloat(valorHE);
            }
        }
        
    });

    $('.valueRecargo').on('blur', function(e) {    
        var valorHE;

        valorHE = $(this).val();

        if (valorHE == '') {
            valorHE = 0;
        }

        if (!isNaN(valorHE)) {
            suma += parseFloat(valorHE);
        }

        $('#calcRec').html(suma);
        total();

    });

}

function restarDescuento() {
    $('#descuentos').on('blur', function(e) {
        total();
    });
}

function colorSum(suma, id) {
    switch (true) {
        case suma >= 0 && suma < 20:
            $(`#${id}`).css({color: 'greenyellow'});
            break;
        case suma >= 20 && suma < 35:
            $(`#${id}`).css({color: 'orange'});
            break;
        case suma >= 35 && suma < 48:
            $(`#${id}`).css({color: '#ff6600'});
            break;
        case suma >= 48 || suma < 0:
            $(`#${id}`).css({color: 'red'});
            break;
        case suma < 0:
            $(`#${id}`).css({color: 'red'});
            break;
        default:
            break;
    }
}

function total() {
    var total;

    var horasExtra = $('#calcHE').html();
    var recargos = $('#calcRec').html();
    var descuentos = $('#descuentos').val();

    total = parseFloat(Math.abs(horasExtra)) + parseFloat(Math.abs(recargos)) + parseFloat(Math.abs(descuentos));

    $('#total').html(total);

}

function sendData() {
    $('#sendData').click(function(e) {
        var idHoraExtra;

        var cc = $('#cc').val();
        console.log("🚀 ~ file: reporteHE.js ~ line 282 ~ $ ~ cc", cc)
        var empleado = $('#cc').data('empleado');
        console.log("🚀 ~ file: reporteHE.js ~ line 284 ~ $ ~ empleado", empleado)
        var novedad = $('#novedad').val();
        console.log("🚀 ~ file: reporteHE.js ~ line 286 ~ $ ~ novedad", novedad)
        var ceco = $('#ceco').children("option:selected").val();
        console.log("🚀 ~ file: reporteHE.js ~ line 288 ~ $ ~ ceco", ceco)
        var correoEmpleado = $('#cc').data('correoempleado');
        console.log("🚀 ~ file: reporteHE.js ~ line 356 ~ $ ~ correoEmpleado", correoEmpleado)

        var descuentos = $('#descuentos').val();
        console.log("🚀 ~ file: reporteHE.js ~ line 316 ~ $ ~ descuentos", descuentos)
        var total = $('#total').html();
        console.log("🚀 ~ file: reporteHE.js ~ line 318 ~ $ ~ total", total)

        if (cc.length <= 0 || empleado.length <= 0 || novedad.length <= 0 || ceco.length <= 0 || descuentos.length <= 0) {
            $(this).notify("Hay campos requeridos (*) que estan vacios!", 'error');
            console.log('Hay datos vacios');
            return false;
        }

        if (cc.length > 10) {
            $(this).notify("El numero de Cedula no es valido!", 'error');
            console.log('Error en la cedula');
            return false;
        }

        var valuesHE = getDataHE();
        var valuesRecargo = getDataRecargos();

        let regex = new RegExp('^[0-9]{1,2}?(.[0,5]{0,1})?$');

        console.log(valuesHE);
        console.log(valuesRecargo);

        for (let i = 0; i < valuesHE.length; i++) {
            if (!regex.test(valuesHE[i].value)) {
                $(this).notify("El formato de las Horas Extra no cumple con el solicitado!", 'error');
                return false;
            }
        }

        for (let i = 0; i < valuesRecargo.length; i++) {
            if (!regex.test(valuesRecargo[i].value)) {
                $(this).notify("El formato de los Recargos no cumple con el solicitado!", 'error');
                return false;
            }
        }

        var fechas = getFechas();
        
        if ( !Array.isArray(fechas) ) {
            $(this).notify("Seleccione una fecha de reporte!", 'error');
            console.log('Error al generar fechas');
            return false;
        }

        var aprobador;
        var correoAprobador;

        if( $('input[name="aprobador"]').is(':checked')) {
            
            aprobador = localStorage.getItem('aprobador');
            correoAprobador = localStorage.getItem('correoAprobador');

           if (aprobador.length <= 0 || correoAprobador.length <= 0 ) {
                $('#errorRadio').css({display: 'inline'});
                console.log('Error, datos incompletos'); 
                return false;
           }

            console.log("🚀 ~ file: reporteHE.js ~ line 340 ~ $ ~ aprobador", aprobador)
            console.log("🚀 ~ file: reporteHE.js ~ line 340 ~ $ ~ correoAprobador", correoAprobador)
        }else{

            if (!localStorage.getItem('TipoAprobador')){
                $('#errorRadio').css({display: 'inline'});
                console.log('Escoja un aprobador');
                return false;
            }

            let type =  localStorage.getItem('TipoAprobador');

            if (type == 'contable' || type == 'rh'){
                aprobador = localStorage.getItem('aprobador');
                correoAprobador = localStorage.getItem('correoAprobador');
            }
        }

        var estado = getEstado();

        if (estado.length <= 0) {
            $(this).notify("No hay un estado para agregar!", 'error');
            return false;
        }

        let object = {
            'object': {
                'cc': cc,
                'empleado': empleado,
                'correoEmpleado': correoEmpleado,
                'fechareporte': fechas[0],
                'novedad': novedad,
                'fechaInicio': fechas[2],
                'fechaFin': fechas[1],
                'descuento': descuentos,
                'total': total,
                'ceco': ceco,
                'aprobador': aprobador,
                'estado': estado,
            }
        }

        e.preventDefault();

        var actionExecute = $(this).data('type');

        switch (actionExecute) {
            case 'create':
                $.ajax({
                    data: object,
                    url: '../controller/CRUD.controller.php?action=execute&model=HoraExtra&crud=insert',
                    type: 'post',
                    beforeSend: function () {
        
                        $('#butonSend').css({display: 'none'});
                        $('#loadSpinner').css({display: 'inline'}); 
                    },
                    success: function(result){
                        
                        console.log("🚀 ~ file: reporteHE.js ~ line 435 ~ $ ~ result", result)
        
                        if (isNaN(parseInt(result))) {
                            $.notify('Error al registrar las Horas Extra.', 'error');    
                            return false;
                        }
        
                        idHoraExtra = result;
        
                        var data = {
                            'horaExtra': idHoraExtra,
                            'valuesHE': JSON.stringify(valuesHE),
                        }
                        
                        $.ajax({
                            datatype: 'JSON',
                            data: { "data" : data },
                            url: '../controller/CRUD.controller.php?action=insertMany&model=HoraExtra&crud=insertHoras',
                            type: 'post',
                            success: function(result){
                                
                                console.log("🚀 ~ file: reporteHE.js ~ line 450 ~ $ ~ result", typeof result)
        
                                if (result !== '1') {
                                    $.notify('Error al registrar las Horas Extra.', 'error');    
                                    return false;
                                }
                                
                                var data = {
                                    'horaExtra': idHoraExtra,
                                    'valuesRecargo': JSON.stringify(valuesRecargo)
                                }
                                
                                $.ajax({
                                    datatype: 'JSON',
                                    data: { "data" : data },
                                    url: '../controller/CRUD.controller.php?action=insertMany&model=Recargo&crud=insert',
                                    type: 'post',
                                    success: function(result){
                                        
                                        console.log("🚀 ~ file: reporteHE.js ~ line 450 ~ $ ~ result", typeof result)
                
                                        if (result !== '1') {
                                            $.notify('Error al registrar los recargos.', 'error');    
                                            return false;
                                        }
                                        
                                        $('#formReporte').trigger("reset");
                                        $('#total').html(0);
                                        $('#calcRec').html(0);
                                        $('#calcHE').html(0);
        
                                        $('#listGerente').find('option:first-child').prop('selected', true);
                                        $('#listJefe').find('option:first-child').prop('selected', true);
                                        $('#listJefe').attr('disabled', true);
                                        $('#listJefe').attr('disabled', true);
                                        $.notify('Enviado con exito', 'success');
        
                                        var data = {
                                            'to': correoAprobador,
                                            'from': correoEmpleado,
                                            'empleado': empleado,
                                            'idHE': idHoraExtra
                                        }
        
                                        $.ajax({
                                            data:  data,
                                            url: '../controller/Email.controller.php?email=solicitudEmpleado',
                                            type: 'post',
                                            success: function(result){
        
                                                if (result == 1) {
                                                    $.notify('Notificación enviada', 'success');
                                                    $('#butonSend').css({display: 'inline'});
                                                    $('#loadSpinner').css({display: 'none'});
                                                    return true;
                                                }
        
                                                $.notify('No se envió la notificación', 'error');
                                            }
        
                                        });
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        $.notify('Error al registrar los recargos.', 'error');
                                        console.error(title, 'textStatus::' + textStatus, 'errorThrown:: ' + errorThrown);
                                    }
                                }); 
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                $.notify('Error al registrar los recargos.', 'error');
                                console.error(title, 'textStatus::' + textStatus, 'errorThrown:: ' + errorThrown);
                            }
                        });     
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $.notify('Error al crear el registro.', 'error');
                        console.error(title, 'textStatus::' + textStatus, 'errorThrown:: ' + errorThrown);
                    }
                });
                break;
            case 'update':

                console.log('Actualizando...');

                $('#butonSend').css({display: 'none'});
                $('#loadSpinner').css({display: 'inline'});
                let id = $('#idHE').data('id');

                object.object.id = id;

                let data = {
                    'horaExtra': id,
                    'valuesHE': JSON.stringify(valuesHE),
                    'valuesRecargo': JSON.stringify(valuesRecargo)
                }

                $.when($.ajax({data: object, url: '../controller/CRUD.controller.php?action=execute&model=HoraExtra&crud=update', type: 'post'}), $.ajax({datatype: 'JSON', data: { "data" : data }, url: '../controller/CRUD.controller.php?action=insertMany&model=HoraExtra&crud=updateHoras', type: 'post'}), $.ajax({datatype: 'JSON', data: { "data" : data }, url: '../controller/CRUD.controller.php?action=insertMany&model=Recargo&crud=update', type: 'post'}))
                    .then(function (result1, result2, result3) {

                        if (isNaN(parseInt(result1[0]))) {
                            $.notify('Error al actualizar los datos de Horas Extra.', 'error');    
                            return false;
                        }

                        if (isNaN(parseInt(result2[0]))) {
                            $.notify('Error al actualizar las Horas Extra.', 'error');    
                            return false;
                        }

                        if (isNaN(parseInt(result3[0]))) {
                            $.notify('Error al actualizar los Reportes.', 'error');    
                            return false;
                        }

                        $.notify('Actualizado con exito', 'success');
                        $('#butonSend').css({display: 'inline'});
                        $('#loadSpinner').css({display: 'none'});

                        $.when($.ajax('./estado/listEstado.view.php'))
                        .then(function(result1) {
                            var script = "<script src=\"../assets/js/listadoHE.js\"></script>";
                            //Cargar HTML
                            $('#links').append(script);
                            
                            $('#result').html(result1);

                            var data = {
                                'to': correoAprobador,
                                'from': correoEmpleado,
                                'empleado': empleado,
                                'idHE': id
                            }

                            $.ajax({
                                data:  data,
                                url: '../controller/Email.controller.php?email=actualizacionHE',
                                type: 'post',
                                success: function(result){

                                    if (result == 1) {
                                        $.notify('Notificación enviada', 'success');
                                        return true;
                                    }

                                    $.notify('No se envió la notificación', 'error');
                                }

                            });
                        
                        })
                        return true;

                    });

                break;
            default:
                break;
        }
    })
}

function getFechas(){
    var fechas = [];
    var fecha;
    var mes = $('#mes').val();


    if (mes.length <= 0) {
        return;
    }

    mes = mes.split('-');

    if (parseInt(mes[1]) <= 9) {
        mes = mes[0] + '-' + '0' + (parseInt(mes[1]) + 1);
    }else if (parseInt(mes[1]) > 9 && parseInt(mes[1]) <= 11) {
        mes = mes[0] + '-' + (parseInt(mes[1]) + 1);
    }else if (parseInt(mes[1]) == 12) {
        mes = mes[0] + '-' + '01';
    }

    fecha = new Date();
    fechas[0] = fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-' + fecha.getDate();
    fecha = new Date(mes);
    fechas[1] = fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-' + fecha.getDate();
    fechas[2] = fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-01';

    return fechas;

}

function getDataHE() {
    var valuesHE = [];

    $.each($('.valueHE'), function(e) {
        var valorHE = {};
        valorHE.codigo = $(this).data('codigo');
        if ($(this).val() == '0.0') {
            valorHE.value = '0';
        }else{
            valorHE.value = $(this).val();
        }
        valuesHE.push(valorHE);
    });

    return valuesHE;
    
}

function getDataRecargos(params) {
    var valuesRecargo = [];

    $.each($('.valueRecargo'), function(e) {
        var valorRecargo = {};
        valorRecargo.codigo = $(this).data('codigo');
        if ($(this).val() == '0.0') {
            valorRecargo.value = '0';
        }else{
            valorRecargo.value = $(this).val();
        }
        valuesRecargo.push(valorRecargo);
    });

    return valuesRecargo;
}

function getEstado() {
    var tipoAprobador = localStorage.getItem('TipoAprobador');
    var estado;
    
    if(tipoAprobador == 'Jefe'){
        estado = 1002;
    }else if (tipoAprobador == 'Gerente') {
        estado = 1003;
    }else if (tipoAprobador == 'contable'){
        estado = 1005;
    }else if (tipoAprobador == 'rh'){
        estado = 1004;
    }

    return estado;
}
