$(document).ready(function(){

    let typeGestion = $('#typeGestion').data('type');
    console.log('Tipo de Gestion', typeGestion);
    let url;

    switch (typeGestion) {
        case 'gestionJefesGerentes':
            url = '../controller/CRUD.controller.php?action=execute&model=HoraExtra&crud=getListHEGestionAprobador';
            break;
        case 'gestionRH':
            url = '../controller/CRUD.controller.php?action=execute&model=HoraExtra&crud=getListHEGestionRH';
            break;
        case 'gestionContable':
            url = '../controller/CRUD.controller.php?action=execute&model=HoraExtra&crud=getListHEGestionContable';
            break;
    }

    const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    var user = $('#gestionar').data('aprobador');

    if (!user){
        user = 'none';
    }

    console.log(user);

    let object = {
        'object': {
            'aprobador': user
        }
    }

    $.when($.ajax({data: object, url: url, type: 'post',}))
        .then(function (result) {
            //Cargar Datos de Tabla
            localStorage.setItem('arrayHEporGestionar', result);
            var datos = JSON.parse(result);
            var html;

            datos.forEach((dato, index) => {
                html += '<tr>';
                var anno = dato.fechaFin;
                anno = new Date(anno);

                html += `<td></td>`;
                html += `<td>${index}</td>`;
                html += `<td>${dato.id}</td>`;
                html += `<td>${dato.fechaReporte}</td>`;
                html += `<td>${anno.getFullYear()}</td>`;
                html += `<td>${ meses[anno.getMonth()] }</td>`;
                html += `<td>${dato.empleado}</td>`;
                html += `<td>${dato.aprobadorNombre}</td>`;
                html += `<td>${dato.aprobadorTipo}</td>`;
                html += `<td>${dato.estadoNombre}</td>`;

                html += '</tr>';

            });

            $('#tableBody').html(html);
            var table = $('#dataTable').DataTable({
                columns: [
                    {
                        className: 'dt-control',
                        orderable: false,
                        data: 'ver mas',
                        defaultContent: '',
                    },
                    {data: 'num'},
                    {data: 'id'},
                    {data: 'fecha reporte'},
                    {data: 'año'},
                    {data: 'mes'},
                    {data: 'colaborador'},
                    {data: 'aprobador'},
                    {data: 'rol aprobador'},
                    {data: 'estado'}
                ],
                paging: false,
                "language": {
                    "search": "Ingrese un valor para filtrar la tabla: ",
                    "info": "Hay _TOTAL_ registros"
                },
                dom: '<"top"if>rt<"clear">',
                stateSave: true,
            });

            coloriceTable();

            $('#dataTable tbody').on('click', 'td.dt-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    let object = {
                        'object': {
                            'id': row.data().id
                        }
                    }

                    $.when($.ajax({data: object, url: '../controller/CRUD.controller.php?action=execute&model=HoraExtra&crud=getDetalleHora', type: 'post',}), $.ajax({data: object, url: '../controller/CRUD.controller.php?action=execute&model=Recargo&crud=getRecargos', type: 'post',}))
                        .then(function (result1, result2) {
                            row.child(format(row.data(), {result1, result2})).show();
                            tr.addClass('shown');
                            showComments();
                            showAprobar();
                            rechazar();
                        });

                }
            });
        })
});

function coloriceTable() {
    $('#dataTable tbody').on('mouseenter', 'td', function () {
        var colIdx = $('#dataTable').DataTable().cell(this).index().column;

        $($('#dataTable').DataTable().cells().nodes()).removeClass('highlight');
        $($('#dataTable').DataTable().column(colIdx).nodes()).addClass('highlight');
    });
}

function format(d, {...results}) {
    var data = localStorage.getItem('arrayHEporGestionar');
    var html = '';
    data = JSON.parse(data);
    data = data[d.num];

    var arrayHE = JSON.parse(results.result1[0]);
    var arrayRecargo = JSON.parse(results.result2[0]);

    var headTableHE = `<thead>
                       <tr>`;
    var bodyTableHE = `<tbody>
                        <tr>`;
    var sumaHE = 0;
    arrayHE.forEach(element=>{
        headTableHE += `<th>${element.nombre}</th>`;

        bodyTableHE += `<td>${element.cantidad == '.0' ? '0' : element.cantidad == '.5' ? '0.5' : element.cantidad}</td>`;

        sumaHE += parseFloat(element.cantidad);
    });

    var headTableRec = `<thead>
                       <tr>`;
    var bodyTableRec = `<tbody>
                        <tr>`;
    var sumaRec = 0;
    arrayRecargo.forEach(element=>{
        headTableRec += `<th>${element.nombre}</th>`;

        bodyTableRec += `<td>${element.cantidad == '.0' ? '0' : element.cantidad == '.5' ? '0.5' : element.cantidad}</td>`;

        sumaRec += parseFloat(element.cantidad);
    });

            html = `<section class="wrapper" style="background-color: rgb(245 245 245 / 42%); padding: 50px 15px 70px 15px; box-shadow: 1px -1px 20px 5px rgb(0 0 0 / 53%);">
                <div class="content">
			            <div class="row gtr-uniform gtr-50">
			                <div class="col-10 col-8-xsmall" style="margin: auto;">
                                <ul class="actions special">
                                        <li> <button type="submit" data-he="${d.id}" data-estado="${data.estado}" class="aprobar button icon solid fa-check-circle fit" style="background-color: #3c763d">Aprobar</button> </li>
                                        <li> <button type="submit" data-he="${d.id}" data-estado="${data.estado}" class="rechazar button icon solid fa-trash-alt fit" style="background-color: tomato">Rechazar</button> </li>
                                </ul>
                                <div class="col-8 col-6-xsmall" id="moduloGestionar${d.id}" style="margin: auto; padding: 10px">
                                    
                                </div>    
                                <hr>
			                </div>
			                <div class="col-3 col-6-xsmall" style="margin: auto;">
                                <input type="text" name="index" id="index_${d.id}" value=${d.num} placeholder="Index" style="display: none;"/>
			                    <label for="ceco" style="font-weight: bold;">Centro de Costo</label>
                                <input type="text" name="ceco" id="ceco" value=${data.cecoName} placeholder="Centro de Costo" disabled/>
                            </div>
                            <div class="col-3 col-6-xsmall" style="margin: auto;">
			                    <label for="novedad" style="font-weight: bold;">Motivo de la Novedad</label>
                                <input type="text" name="novedad" id="novedad" value=${data.novedad} placeholder="Novedad" disabled/>
                            </div>
                            <div class="col-12 col-8-xsmall">
                                <hr>
                                <table>
                                ${headTableHE}
                                <th>Suma</th>
                                </tr>
                                </thead>
                                ${bodyTableHE}
                                <td>${sumaHE}</td>
                                </tr>
                                </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-8-xsmall">
                                <hr>
                                <table>
                                ${headTableRec}
                                <th>Suma</th>
                                </tr>
                                </thead>
                                ${bodyTableRec}
                                <td>${sumaRec}</td>
                                </tr>
                                </tbody>
                                </table>
                                <hr>
                            </div>
                            <div class="col-3 col-6-xsmall" style="margin: auto;">
                                <label for="descuento" style="font-weight: bold;">Permisos Descuentos</label>
                                <input type="text" name="descuento" id="descuento" value=${data.descuento} placeholder="Descuento" disabled/>
                            </div>   
                            <br>
                            <div class="col-3 col-6-xsmall" style="margin: auto;">
                                <label for="total" style="font-weight: bold;">Total</label>
                                <input type="text" name="total" id="total" value=${data.total} placeholder="Total" disabled/>
                            </div>    
                            <div class="col-10 col-8-xsmall" style="margin: auto;">
                                <hr>
                            </div>  
                            <div class="col-12 col-8-xsmall" style="margin: auto;">
                                <h3>Comentarios <span class="showComments icon solid fa-chevron-down fit" data-id="${d.id}" id="show_${d.id}"></span> <span class="hideComments icon solid fa-chevron-up fit" data-id="${d.id}" id="hide_${d.id}" style="display: none;"></span></h3>
                                <div>
                                    <table id="table_${d.id}">
                                        <!-- Llenar datos de comentarios -->                                    
                                    </table>
                                </div>
                            </div>
                            <div class="col-10 col-8-xsmall" style="margin: auto;">
                                <div class="col-5 col-4-xsmall" style="margin: auto;">
                                    <form action="" id="formReporte">
                                        <label for="comentario" style="font-weight: bold;">Agregar Comentario</label>
                                        <textarea name="comentario" id="comentario_${d.id}" placeholder="Ingrese texto para el comentario." rows="3" style="resize: none;" required></textarea>
                                        <br>
                                        <ul class="actions special">
                                            <li> <button type="submit" onclick="sendComment(event, this)" class="sendComment button primary icon solid fa-paper-plane fit" id="sendComment_${d.id}" data-id="${d.id}" data-isVisible="false">Enviar Comentario</button> </li>
                                        </ul>
                                    </form>
                                </div>   
                            </div>    
			            </div>
			    </div>
			</section>`;

    return (html);
}

function showComments(){
    $('.showComments').click(function (e){

        e.preventDefault();

        hideComments();

        let id = $(this).data('id');

        let htmlComments = '';

        let object = {
            'object': {
                'id': id
            }
        }

        $.when($.ajax({data: object, url: '../controller/CRUD.controller.php?action=execute&model=Comentario&crud=getComments', type: 'post',}))
            .then(function (result){

                var arrayComments = JSON.parse(result);

                arrayComments.forEach(element=>{
                    htmlComments += `<tr>
                            <td style="text-align: left">${element.creadoPor} - ${element.fecha}</td>
                        </tr>
                        <tr>
                            <td>${element.cuerpo}</td>
                        </tr>`;
                });

                $(`#table_${id}`).html(`${htmlComments ? '<tbody class="animate__animated animate__fadeInUp" id="bodyComments" data-content="full"> ' + htmlComments + '</tbody>' : '<tbody class="animate__animated animate__fadeInUp" id="bodyComments" data-content="empty"><tr><td> No hay Comentarios</td></tr></tbody>'}`);

                $(`#sendComment_${id}`).attr(`data-isvisible`, 'true');
                $(`#show_${id}`).css({display: 'none'});
                $(`#hide_${id}`).css({display: 'inline'});
            });
    });
}

function hideComments(){
    $('.hideComments').click(function (e){
        e.preventDefault();

        let id = $(this).data('id');
        $(`#table_${id}`).html('');

        $(`#sendComment_${id}`).attr(`data-isvisible`, 'false');
        $(`#show_${id}`).css({display: 'inline'});
        $(`#hide_${id}`).css({display: 'none'});
    });
}

function sendComment(e, element) {

        e.preventDefault();

        let row;
        let htmlId = element.id;
        let id = element.dataset.id;

        console.log(element.dataset.id);

        let isCommentsVisibles = element.dataset.isvisible;

        console.log(isCommentsVisibles);

        var comentario = $(`#comentario_${id}`).val();

        console.log(comentario);

        if (comentario.length <= 0) {
            $(`#${htmlId}`).notify("El comentario esta vacio!", 'error');
            return false;
        }

        comentario = comentario.replaceAll('script', '');

        let creador = $('#usuarioLogin').html();
        let fecha = new Date();
        fecha = fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-' + fecha.getDate();

        let object = {
            'object': {
                'creadoPor': creador,
                'fecha': fecha,
                'idHE': id,
                'cuerpo': comentario
            }
        }

        $.ajax({
            data:  object,
            url: '../controller/CRUD.controller.php?action=execute&model=Comentario&crud=insert',
            type: 'post',
            beforeSend: function() {
                element.style.display = "none";
            },
            success: function(result){

                if (isNaN(parseInt(result))) {
                    $.notify('No se envió el comentario', 'error');
                    return false;
                }

                if (isCommentsVisibles == 'true'){

                    row = `<tr>
                        <td style="text-align: left" id="comment-${result}">${creador} - ${fecha}</td>
                        </tr>
                        <tr>
                        <td>${comentario}</td>
                        </tr>`;

                    let hasComments = $('#bodyComments').data('content');

                    if (hasComments == 'full') {
                        $('#bodyComments').append(row);
                    }else{
                        $('#bodyComments').html(row);
                    }
                }

                $(`#comentario_${id}`).val('');

                $.notify('Comentario enviado', 'success');
                element.style.display = "inline";

                let arrayData = localStorage.getItem('arrayHEporGestionar');
                let values = JSON.parse(arrayData);
                values = values[$(`#index_${id}`).val()];

                let correoAprobador = values.correoJefe;
                let correoEmpleado = values.correoEmpleado;
                let empleado = values.aprobadorNombre;

                var data = {
                    'to': correoEmpleado,
                    'from': correoAprobador,
                    'empleado': empleado,
                    'idHE': id,
                    'novedad': comentario
                }

                sendEmail(data, 'reporteNovedad');

                return true;

            }

        });
}

async function showAprobar() {
    $('.aprobar').click(async function (){

        let he = $(this).data('he');
        let estado = $(this).data('estado');
        let object;

        console.log(estado);
        console.log(typeof estado);

        switch (estado.toString()) {
            case '1002':
                let html = `<section id="" class="wrapper style2 special fade" style="padding: 20px">
                        <div class="col-6 col-4-xsmall" id="moduloGestionar" style="margin: auto;">
                            <form action="" id="gestionarFrom">
                                <label for="listAprobador">Gerente Aprobador</label>
                                <select name="listAprobador${he}" id="listAprobador${he}">
                                </select>
                                <br>
                                <ul class="actions special">
                                    <li> <button type="submit" data-id="${he}" class="sendData button primary icon solid fa-check-circle fi">Enviar</button> </li>
                                </ul>
                            </form>
                        </div> 
                    </section>`;
                let htmlGerente;

                $.when($.ajax('../controller/CRUD.controller.php?action=listAll&model=Aprobador&crud=get'))
                    .then(function (result){
                        let datos = JSON.parse(result);
                        datos.forEach(element => {
                            if (element.tipo == 'Gerente') {
                                htmlGerente += `<option value="${element.id}" data-correoAprobador="${element.correo}">${element.nombre}</option>`;
                            }
                        });
                        $(`#moduloGestionar${he}`).html(html);
                        $(`#listAprobador${he}`).html(htmlGerente);
                        aprobar();
                    })
                break;
            case '1003':

                object = {
                    'object': {
                        'gestion': 'RH'
                    }
                }

                getAprobadorByGestion(object).then(async (res) => {
                    console.log(res);
                    let data = JSON.parse(res);
                    let estado = '1004';
                    var correoAprobador = data[0].correo;

                    object = {
                        'object': {
                            'he': he,
                            'aprobador': data[0].id,
                            'estado': estado,
                        }
                    }

                    try {
                        let ejecutado = await ejecutarAprobacion(object);
                        console.log('Ejecutado ', ejecutado);

                        if (!ejecutado){
                            return true;
                        }

                        let arrayData = localStorage.getItem('arrayHEporGestionar');
                        let values = JSON.parse(arrayData);
                        values = values[$(`#index_${he}`).val()];

                        let correoEmpleado = values.correoEmpleado;
                        let empleado = values.empleado;

                        data = {
                            'to': correoAprobador,
                            'from': correoEmpleado,
                            'empleado': empleado,
                            'idHE': he
                        }

                        sendEmail(data, 'solicitudEmpleado');

                        reloadPage();
                    }catch (e){
                        console.log(e);
                    }

                }).catch(e =>{
                    console.log(e);
                });

                break;
            case '1004':

                object = {
                    'object': {
                        'gestion': 'Contable'
                    }
                }

                getAprobadorByGestion(object).then(async (res) => {
                    console.log(res);
                    let data = JSON.parse(res);
                    let estado = '1005';
                    var correoAprobador = data[0].correo;

                    object = {
                        'object': {
                            'he': he,
                            'aprobador': data[0].id,
                            'estado': estado,
                        }
                    }

                    console.log(object);

                    try {
                        let ejecutado = await ejecutarAprobacion(object);
                        console.log('Ejecutado ', ejecutado);

                        if (!ejecutado){
                            return true;
                        }

                        let arrayData = localStorage.getItem('arrayHEporGestionar');
                        let values = JSON.parse(arrayData);
                        values = values[$(`#index_${he}`).val()];

                        let correoEmpleado = values.correoEmpleado;
                        let empleado = values.empleado;

                        data = {
                            'to': correoAprobador,
                            'from': correoEmpleado,
                            'empleado': empleado,
                            'idHE': he
                        }

                        sendEmail(data, 'solicitudEmpleado');

                        reloadPage();
                    }catch (e){
                        console.log(e);
                    }

                }).catch(e =>{
                    console.log(e);
                });

                break;
            case '1005':
                let estado = '1';

                let arrayData = localStorage.getItem('arrayHEporGestionar');
                let values = JSON.parse(arrayData);
                values = values[$(`#index_${he}`).val()];

                object = {
                    'object': {
                        'he': he,
                        'aprobador': values.aprobador,
                        'estado': estado,
                    }
                }

                console.log(object);

                try {
                    let ejecutado = await ejecutarAprobacion(object);
                    console.log('Ejecutado ', ejecutado);

                    if (!ejecutado){
                        return true;
                    }

                    let correoAprobador = values.correoJefe;
                    let correoEmpleado = values.correoEmpleado;
                    let empleado = values.empleado;

                    data = {
                        'to': correoEmpleado,
                        'from': correoAprobador,
                        'empleado': empleado,
                        'idHE': he
                    }

                    sendEmail(data, 'aprobacionHE');

                    reloadPage();
                }catch (e){
                    console.log(e);
                }

                break;
            default:
                console.log('No hay acciones disponibles');
                $.notify('No hay acciones disponibles', 'info');
                break;
        }
    });
}

function rechazar() {
    $('.rechazar').click(function(){

        let option = confirm('¿Desea rechazar el registro?');

        if (!option){
            $.notify('Se ha cancelado la transacción.', 'info');
            return false;
        }

        let he = $(this).data('he');
        let estado =  $(this).data('estado');

        switch (estado.toString()) {
            case '1004':
                estado = '1007';
                break;
            case '1005':
                estado = '1006';
                break;
            default:
                estado = '2';
                break;
        }

        let object = {
            'object': {
                'he': he,
                'estado': estado,
            }
        }

        console.log(object);

        $.ajax({
            data: object,
            url: '../controller/CRUD.controller.php?action=execute&model=HoraExtra&crud=rejectEstado',
            type: 'post',
            beforeSend: function () {

            },
            success: function (result) {
                if (isNaN(parseInt(result))) {
                    $.notify('No se actualizó el registro de Horas Extra', 'error');
                    return false;
                }

                $.notify('Registro rechazado con éxito', 'success');

                let arrayData = localStorage.getItem('arrayHEporGestionar');
                let values = JSON.parse(arrayData);
                values = values[$(`#index_${he}`).val()];

                var correoAprobador = values.correoJefe;
                let correoEmpleado = values.correoEmpleado;
                let empleado = values.aprobadorNombre;

                var data = {
                    'to': correoEmpleado,
                    'from': correoAprobador,
                    'empleado': empleado,
                    'idHE': he
                }

                sendEmail(data, 'rechazoHE');

                reloadPage();

                return true;

            }
        });


    });

}

function aprobar() {
    $('.sendData').click(async function (e){
        e.preventDefault();
        let he = $(this).data('id');
        let aprobador = $(`#listAprobador${he}`).find(':selected').val();
        let estado = '1003';

        let object = {
            'object': {
                'he': he,
                'aprobador': aprobador,
                'estado': estado,
            }
        }

        try {
            let ejecutado = await ejecutarAprobacion(object);

            console.log('Ejecutado ', ejecutado);

            if (!ejecutado){
                return true;
            }

            let arrayData = localStorage.getItem('arrayHEporGestionar');
            let values = JSON.parse(arrayData);
            values = values[$(`#index_${he}`).val()];

            var correoAprobador = $(`#listAprobador${he}`).find(':selected').data('correoaprobador');
            let correoEmpleado = values.correoEmpleado;
            let empleado = values.empleado;

            var data = {
                'to': correoAprobador,
                'from': correoEmpleado,
                'empleado': empleado,
                'idHE': he
            }

            sendEmail(data, 'solicitudEmpleado');

            reloadPage();

            return true;

        }catch (e){
            console.log(e);
        }

    });
}

function ejecutarAprobacion(object) {
    return new Promise((resolve, reject)=>{
        let option = confirm('¿Desea enviar a aprobación?');

        if (!option){
            $.notify('Se ha cancelado la transacción.', 'info');
            resolve(false);
            return;
        }

        $.ajax({
            data: object,
            url: '../controller/CRUD.controller.php?action=execute&model=HoraExtra&crud=updateEstado',
            type: 'post',
            beforeSend: function () {

            },
            success: function (result) {
                console.log('Resultado Aprob ', result);

                if (isNaN(parseInt(result))) {
                    $.notify('No se actualizó el registro de Horas Extra', 'error');
                    reject(false);
                    return;
                }

                $.notify('Registro aprobado con éxito', 'success');
                resolve(true);
                return;
            }
        });
    });
}

function sendEmail(data, tipo){
    $.ajax({
        data:  data,
        url: `../controller/Email.controller.php?email=${tipo}`,
        type: 'post',
        success: function(result){

            console.log(result);

            if (result == 1) {
                $.notify('Notificación enviada', 'success');
                return true;
            }

            $.notify('No se envió la notificación', 'error');
        }

    });
}

function reloadPage() {
    $.when($.ajax('./gestionHE/gestionar.view.php'))
        .then(function(result) {
            var script = "<script src=\"../assets/js/aproveRejectHE.js\"></script>";

            let type = $('#typeGestion').data('type');
            //Cargar HTML
            $('#links').append(script);
            $('#result').html(result);
            $('#typeGestion').attr('data-type', type);
        })
}

function getAprobadorByGestion(object) {
    return new Promise((resolve, reject)=>{
        $.ajax({
            data: object,
            url: '../controller/CRUD.controller.php?action=execute&model=Aprobador&crud=getAprobadorbyGestion',
            type: 'post',
            success: function (result) {
                if (JSON.parse(result).length < 1) {
                    $.notify('No se encontro un aprobador.', 'error');
                    reject(false);
                }

                resolve(result);

            }
        })
    });
}

